<?php

namespace App\Services\order;

use App\Models\order\Order;

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
}
