<?php

namespace App\Services\inventory;

use App\Models\Person;
use App\Models\Supplier;
use Exception;
use Illuminate\Support\Facades\DB;

class SupplierService
{
    public function __construct(){}
    
    public function createSupplier(array $data) {
        DB::beginTransaction();

        try {
            $person = Person::create([
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'] == 'male' ? 0 : 1,
                'phone' => $data['phone'],
                'email' => $data['email'],
            ]);

            $supplier = Supplier::create([
                'person_id' => $person->id,
                'address' => $data['address'],

            ]);

            DB::commit();
            return $supplier;
        }
        catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function updateSupplier(Supplier $supplier, array $data) {
        DB::beginTransaction();

        try {
            $supplier->update([
                'address' => $data['address'],
            ]);

            $personId = $supplier->person_id;
            $person = Person::first($personId);

            $person->update([
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'] == 'male' ? 0 : 1,
                'phone' => $data['phone'],
                'email' => $data['email'],
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

}
