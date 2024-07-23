<?php

namespace App\Services\user_managment;

use App\Models\Employee;
use App\Models\Person;
use Exception;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function __construct(){}

    public function create(array $data)
    {
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

            $employee = Employee::create([
                'person_id' => $person->id,
                'address' => $data['address'],
                'nationality' => $data['nationality'],
            ]);

            DB::commit();
            return $employee;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $person_id = $employee->person_id;
            
            $employee->delete();

            $person = Person::find($person_id);
            $person->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
