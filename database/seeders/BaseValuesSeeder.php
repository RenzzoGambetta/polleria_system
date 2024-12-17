<?php

namespace Database\Seeders;

use App\Models\order\OrderSerie;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
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
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_permission')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        IdentityDocumentType::factory(2)->create();
        VoucherType::factory(3)->create();
        VoucherSerie::factory(5)->create();
        PaymentMethod::factory(5)->create();
        OrderSerie::factory(2)->create();

        $roles = Role::factory(4)->create();
        $permissions = Permission::factory(8)->create();

        foreach ($roles as $r) {
            $permissions->where('category', $r->name);

            $r->permissions()->attach($permissions);
        };

        User::factory(5)->create();
    }
}
