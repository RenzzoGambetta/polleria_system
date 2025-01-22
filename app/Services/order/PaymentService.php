<?php

namespace App\Services\order;

use App\Models\finance\Voucher;
use App\Models\order\Order;
use App\Models\various\PaymentMethod;
use App\Models\various\VoucherSerie;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(){}

    public function payOrder(int $orderId, array $data) 
    {
        $order = Order::findOrFail($orderId);

        $voucherTotalAmount = array_sum($data['amounts']);
        $difference = $order->total_amount - $voucherTotalAmount;
        if ($difference > 0) throw new Exception($difference);

        DB::beginTransaction();

        try {
            $voucherSerie = VoucherSerie::findOrFail($data['voucher_serie_id']);
            $currentCorrelativeNumber = $voucherSerie->last_correlative_number + 1;

            //REGISTRAR EL COMPROBANTE
            $order->voucher()->create([
                'voucher_serie_id' => $data['voucher_serie_id'],
                'correlative_number' => $currentCorrelativeNumber,
                'issuance_date' => isset($data['issuance_date']) ?? now(),
                'expiration_date' => isset($data['expiration_date']) ?? null,
                'payment_type' => isset($data['payment_type']) ?? null,
                'commentary' => isset($data['commentary']) ?? null,
            ]);

            //REGISTRAR EL DETALLE DE LA FORMA DE PAGO
            for ($i = 0; $i < count($data['amounts']); $i++) {
                $paymentMethod = PaymentMethod::where('name', $data['payment_methods'][$i])->get();
                if (!$paymentMethod) throw new Exception('Método de pago no valido');

                $order->voucher->paymentDetails()->create([
                    'payment_method_id' => $paymentMethod->id,
                    'amount' => $data['amounts'][$i]
                ]);
            }

            //ACTUALIZAR EL CORRELATIVO
            $voucherSerie->update([
                'last_correlative_number' => $currentCorrelativeNumber,
            ]);

            //ACTUALIZAR EL ESTADO DEL PEDIDO
            $order->update([
                'status' => 'completado'
            ]);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
