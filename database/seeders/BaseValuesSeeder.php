<?php

namespace Database\Seeders;

use App\Models\order\OrderSerie;
use App\Models\various\IdentityDocumentType;
use App\Models\various\PaymentMethod;
use App\Models\various\VoucherSerie;
use App\Models\various\VoucherType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BaseValuesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('identity_document_types')->truncate();
        DB::table('voucher_types')->truncate();
        DB::table('voucher_series')->truncate();
        DB::table('payment_methods')->truncate();
        DB::table('order_series')->truncate();
        Schema::enableForeignKeyConstraints();

        IdentityDocumentType::factory(2)->create();
        VoucherType::factory(3)->create();
        VoucherSerie::factory(5)->create();
        PaymentMethod::factory(5)->create();
        OrderSerie::factory(2)->create();
    }
}
