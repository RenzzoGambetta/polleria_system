<?php

namespace App\Services\inventory;

use App\Models\Person;
use App\Models\Supplier;
use App\Models\Supply;
use Exception;
use Illuminate\Support\Facades\DB;
class SupplierService
{
    public function __construct(){}

    public function createFastSupplier(array $data)
    {
        DB::beginTransaction();

        try {
            $person = Person::create([
                'document_type_id' => 2,
                'document_number' => $data['ruc'],
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);

            $supplier = Supplier::create([
                'person_id' => $person->id,
            ]);

            DB::commit();
            return $supplier;
        }
        catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function createSupplier(array $data)
    {
        DB::beginTransaction();

        try {
            $person = Person::create([
                'document_type_id' => 2,
                'document_number' => $data['ruc'],
                'name' => $data['name'],
                'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
                'gender' => isset($data['phone']) && $data['gender'] == 'male' ? 0 : 1,
                'phone' => isset($data['phone']) ? $data['phone'] : null,
                'email' => isset($data['email']) ? strtolower($data['email']) : null,
            ]);

            $supplier = Supplier::create([
                'person_id' => $person->id,
                'address' => isset($data['address']) ? $data['address'] : null,

            ]);

            DB::commit();
            return $supplier;
        }
        catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function updateSupplier(Supplier $supplier, array $data)
    {
        DB::beginTransaction();

        try {
            $supplier->update([
                'address' => isset($data['address']) ? $data['address'] : null,
            ]);

            $personId = $supplier->person_id;
            $person = Person::first($personId);

            $person->update([
                'document_number' => $data['ruc'],
                'name' => $data['name'],
                'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
                'gender' => isset($data['phone']) && $data['gender'] == 'male' ? 0 : 1,
                'phone' => isset($data['phone']) ? $data['phone'] : null,
                'email' => isset($data['email']) ? strtolower($data['email']) : null,
            ]);

            DB::commit();
            return $supplier;
        }
        catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function deleteSupplier(Supplier $supplier)
    {
        DB::beginTransaction();

        try {
            $personId = $supplier->person_id;
            $supplier->delete();

            $person = Person::first($personId);
            $person->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function getSupplyDTOBySupplierId(int $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) throw new Exception('No se encontró un proveedor con ese id');

        $supplies = $supplier->supplies()->get();

        if (!$supplies) throw new Exception('No hay suministros para este proveedor');

        $suppliesDTO = [];

        foreach ($supplies as $s)
        {
            $lastDetail = $s->inventoryReceiptDetails()->orderBy('updated_at', 'desc')->first(['price', 'quantity']);

            $suppliesDTO[] = [
                'id' => $s->id,
                'code' => $s->code,
                'name' => $s->name,
                'lastPrice' => $lastDetail ? $lastDetail->price : null,
                'lastQuantity' => $lastDetail ? $lastDetail->quantity : null,
            ];

            return $suppliesDTO;
        }
    }

    public function getAllSupplierDTO()
    {
        $supplies = Supplier::all();
        $suppleisDTO = [];

        foreach ($supplies as $e) {
            $suppleisDTO[] = $this->mapSupplierToDTO($e);
        }

        return $suppleisDTO;
    }

    //Mapper
    private function mapSupplierToDTO(Supplier $supplier)
    {
        $supplierDTO = [
            'id' => $supplier->id,
            'ruc' => $supplier->person->dni,
            'name' => $supplier->person->firstname .' '.$supplier->person->lastname
        ];

        return $supplierDTO;
    }
}
