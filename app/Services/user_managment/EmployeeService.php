<?php

namespace App\Services\user_managment;

use App\Models\Employee;
use App\Models\Person;
use Exception;
use Illuminate\Support\Facades\DB;
//use App\Utils\LogHelper;//Usalo para guardar los errores en consola
class EmployeeService
{
    public function __construct(){}

    public function createEmployee(array $data)
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

            $employee = new Employee([
                'address' => $data['address'],
                'nationality' => $data['nationality'],
            ]);

            $person->employee()->save($employee);

            DB::commit();
           return true;
        } catch (Exception $e) {
            DB::rollBack();
            //LogHelper::logError($this,$e);//Se gurada los errores en consola
            throw $e;
        }
    }

    public function updateEmployee(array $data, Employee $employee)
    {
        DB::beginTransaction();
        try {
            $employee->update([
                'address' => $data['address'],
                'nationality' => $data['nationality'],
            ]);

            $employee->person->update([
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'] == 'male' ? 0 : 1,
                'phone' => $data['phone'],
                'email' => $data['email'],
            ]);

            DB::commit();
            return $employee;
         } catch (Exception $e) {
            DB::rollBack();
            throw $e; 
         }
    }

    public function deleteEmployee(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $person_id = $employee->person_id;

            $employee->delete();

            $person = Person::first($person_id);
            $person->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
