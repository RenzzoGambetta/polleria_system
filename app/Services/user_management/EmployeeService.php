<?php

namespace App\Services\user_management;

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
                'gender' =>   $data['gender'] ?? 1,
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
                'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
                'gender' => isset($data['gender']) ? $data['gender'] : 0,
                'phone' => isset($data['phone']) ? $data['phone'] : null,
                'email' => isset($data['email']) ? $data['email'] : null,
            ]);

            $employee = new Employee([
                'address' => isset($data['address']) ? $data['address'] : null,
                'nationality' => isset($data['nationality']) ? $data['nationality'] : null,
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
                'address' => isset($data['address']) ? $data['address'] : null,
                'nationality' => isset($data['nationality']) ? $data['nationality'] : null,
            ]);

            $employee->person->update([
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
                'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
                'gender' => isset($data['gender']) ? $data['gender'] : 0,
                'phone' => isset($data['phone']) ? $data['phone'] : null,
                'email' => isset($data['email']) ? $data['email'] : null,
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
