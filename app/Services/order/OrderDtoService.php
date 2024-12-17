<?php

namespace App\Services\order;

use App\Models\order\Order;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Throw_;

use function Laravel\Prompts\text;

class OrderDtoService
{
    public function __construct(){}

    public function returnSaleDetails(Order $order) 
    {
        $arrSaleDetails = [];
        //Definir datos claves
        $clientPersonalData = $order->client->person;
        $voucher = $order->voucher;

        //Preparacion de datos para el array de DataDocument
        $voucherTypeName = $order->voucher->voucherSerie->voucherType->voucher_name;
        $voucherSerieNumber = $order->voucher->voucherSerie->serie_number.'-'.$order->voucher->correlative_number;
        
        $datetime = $order->voucher->issuance_date;
        $issuanceDate = $datetime->toDateString();
        $issuanceTime = $datetime->toTimeString();

        $lounge = $order->table->code; 
        $table = $order->table->lounge->name;
        $areaOfAttention = 'Salon '. $lounge .' / Mesa '. $table;

        $dataDocument = [
            'voucherTypeName' => $voucherTypeName,
            'voucherSerieNumber' => $voucherSerieNumber,
            'issuanceDate' => $issuanceDate,
            'issuanceTime' => $issuanceTime,
            'areaOfAttention' => $areaOfAttention
        ];

        //Preparacion de datos para el array dataClient
        $client = $order->client->person;
        $clientName = $client->name;
        $clientLastName = $client->lastname;
        $clientFullName = $clientName .' '. $clientLastName;

        $identityDocumentType = $client->documnent_type->abbreviation;
        $identityDocumentNumber = $client->document_number;
        
        $dataClient = [
            'clientFullName' => $clientFullName,
            'identityDocumentType' => $identityDocumentType,
            'identityDocumentNumber' => $identityDocumentNumber,
        ];

        //Preparacion de datos para el array dataPayment
        $paymentDetails = $voucher->paymentDetails;
        $paymentMethod = $paymentDetails[0]->paymentMethod->abbreviation;
        $totalPaid = $paymentDetails[0]->amount;
        $totalAmount = $order->total_amount;
        $totalChange = $totalPaid - $totalAmount;
        $igv = round($totalAmount * 0.18, 2);

        $dataPayment = [
            'paymentMethod' => $paymentMethod,
            'totalPaid' => $totalPaid,
            'totalAmount' => $totalAmount,
            'totalChange' => $totalChange,
            'opGravada' => round( $totalAmount - $igv , 2),
            'opExonerada' => 0,
            'igv' => $igv,
        ];

        //Preparacion de datos para el array del detalle del pedido
        $orderItemDetails = $order->details;
        $items = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price'],
            ];
        }, $orderItemDetails);

        $arrSaleDetails = [
            'dataCompany' => [
                'ruc' => 20612460401,
                'phone' => 948447099,
                'address' => 'Alfonso Ugarte III ET Mz. A5 Lt:11',
            ],
            'dataDocument' => $dataDocument,
            'dataClient' => $dataClient,
            'dataPayment' => $dataPayment,
            'items' => $items,
        ];

        return $arrSaleDetails;
    }

    public function getAllOrdersDtoForCounter(string $counterViewType) 
    {
        $ordersFilteredByViewType = null;

        try {
            $counterOrdersToday = Order::whereNull('table_id')
                ->whereDate('created_at', Carbon::today())
                ->get();

            if ($counterViewType == 'order') {
                $ordersFilteredByViewType = $counterOrdersToday->whereNotIn('status', ['pagado', 'completado', 'cancelado', 'reembolsado']);
            } else if ($counterViewType == 'preparation') {
                $ordersFilteredByViewType = $counterOrdersToday->whereNotIn('status', ['completado', 'cancelado', 'reembolsado'])->whereNotNull('voucher_id');
            } else if ($counterViewType == 'history') {
                $ordersFilteredByViewType = $counterOrdersToday->whereIn('status', ['completado', 'cancelado', 'reembolsado']);
            }

        if (!$ordersFilteredByViewType) throw new Exception("No hay ordenes para mostrar");

        $counterOrdersDTO = [];

        foreach ($ordersFilteredByViewType as $o) {
            $orderNumber = $o->orderSerie->serie_number . '-' . $o->correlative_number;
            $clientFullName = isset($o->client) ? ($o->client->person->name ?? '') . ' ' .($o->client->person->lastname ?? '') : '';

            $paymentMethod = isset($o->voucher) ? $o->voucher->paymentDetails()->first() : null;
            $paymentMethodText = isset($o->voucher) ? $paymentMethod->paymentMethod->abbreviation : null;

            $counterOrdersDTO[] = [
                'id' => $o->id,
                'order_number' => $orderNumber,
                'order_date_time' => $o->created_at,
                'client' => $clientFullName,
                'payment_method' => $paymentMethodText,
                'total_amount' => $o->total_amount,
            ];
        }

        return $counterOrdersDTO;
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }

    public function getAllCompleteOrdersDtoByCashierSession()
    {
        $loggedInUser = Auth::user();

        try {
            $activeCashierSession = User::find($loggedInUser->id)
                                        ->cashierSessions()
                                        ->latest()
                                        ->whereNull('cash_close_at')
                                        ->first();

            $completeOrdersByCashierSession = Order::where('cashier_session_id', $activeCashierSession->id)
                                                ->whereIn('status', ['completado', 'cancelado', 'reembolsado']);

            $counterOrdersDTO = [];

            foreach ($completeOrdersByCashierSession as $o) {
                $orderNumber = $o->orderSerie->serie_number . '-' . $o->correlative_number;
                $clientFullName = isset($o->client) ? ($o->client->person->name ?? '') . ' ' .($o->client->person->lastname ?? '') : '';

                $paymentMethod = isset($o->voucher) ? $o->voucher->paymentDetails()->first() : null;
                $paymentMethodText = isset($o->voucher) ? $paymentMethod->paymentMethod->abbreviation : null;

                $counterOrdersDTO[] = [
                    'id' => $o->id,
                    'order_number' => $orderNumber,
                    'order_date_time' => $o->created_at,
                    'client' => $clientFullName,
                    'payment_method' => $paymentMethodText,
                    'status' => $o->status,
                    'total_amount' => $o->total_amount,
                ];
            }

            return $counterOrdersDTO;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
