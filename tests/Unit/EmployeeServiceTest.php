<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\Person;
use App\Services\user_management\EmployeeService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class EmployeeServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_employee_successfully()
    {
        // Datos de prueba
        $data = [
            'dni' => '12345678',
            'name' => 'John',
            'paternal_surname' => 'Doe',
            'maternal_surname' => 'Smith',
            'birthdate' => '1980-01-01',
            'gender' => 'male',
            'phone' => '123456789',
            'email' => 'john.doe@example.com',
            'address' => '123 Main St',
            'nationality' => 'US',
        ];

        // Mock de la clase DB
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();
        DB::shouldReceive('rollBack')->never();

        // Mock de la clase Person
        $personMock = Mockery::mock(Person::class);
        $personMock->shouldReceive('create')->once()->with([
            'dni' => $data['dni'],
            'firstname' => $data['name'],
            'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender'] == 'male' ? 0 : 1,
            'phone' => $data['phone'],
            'email' => $data['email'],
        ])->andReturn($personMock);
        $personMock->id = 1;

        // Mock de la clase Employee
        $employeeMock = Mockery::mock(Employee::class);
        $employeeMock->shouldReceive('create')->once()->with([
            'person_id' => $personMock->id,
            'address' => $data['address'],
            'nationality' => $data['nationality'],
        ])->andReturn($employeeMock);

        // Reemplazar los modelos por los mocks
        $this->app->instance(Person::class, $personMock);
        $this->app->instance(Employee::class, $employeeMock);

        // Instancia del servicio
        $employeeService = new EmployeeService();

        // Llamada al método create
        $result = $employeeService->create($data);

        // Aserciones
        $this->assertInstanceOf(Employee::class, $result);
    }

    public function test_create_employee_fails_and_rolls_back_transaction()
    {
        $this->expectException(Exception::class);

        // Datos de prueba
        $data = [
            'dni' => '12345678',
            'name' => 'John',
            'paternal_surname' => 'Doe',
            'maternal_surname' => 'Smith',
            'birthdate' => '1980-01-01',
            'gender' => 'male',
            'phone' => '123456789',
            'email' => 'john.doe@example.com',
            'address' => '123 Main St',
            'nationality' => 'US',
        ];

        // Mock de la clase DB
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->never();
        DB::shouldReceive('rollBack')->once();

        // Mock de la clase Person para lanzar una excepción
        $personMock = Mockery::mock(Person::class);
        $personMock->shouldReceive('create')->once()->with([
            'dni' => $data['dni'],
            'firstname' => $data['name'],
            'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender'] == 'male' ? 0 : 1,
            'phone' => $data['phone'],
            'email' => $data['email'],
        ])->andThrow(new Exception('Error creating person'));

        // Reemplazar el modelo por el mock
        $this->app->instance(Person::class, $personMock);

        // Instancia del servicio
        $employeeService = new EmployeeService();

        // Llamada al método create
        $employeeService->create($data);
    }
}
