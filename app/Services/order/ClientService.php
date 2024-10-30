<?php

namespace App\Services\order;

use App\Models\Client;
use App\Models\Person;
use Exception;
use Illuminate\Support\Facades\DB;

class ClientService
{
    public function __construct(){}

    public function createClient(array $data)
    {
        DB::beginTransaction();
        try {
            $person = Person::create([
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['lastname'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'] == 'male' ? 0 : 1,
                'phone' => $data['phone'],
                'email' => $data['email'],
            ]);

            $client = new Client([
                'address' => $data['address'],
                'type' => $data['type'],
            ]);

            $person->client()->save($client);

            DB::commit();
           return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateClient(array $data, Client $client)
    {
        DB::beginTransaction();
        try {
            $client->update([
                'address' => $data['address'],
                'type' => $data['type'],
            ]);

            $client->person->update([
                'dni' => $data['dni'],
                'firstname' => $data['name'],
                'lastname' => $data['lastname'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'] == 'male' ? 0 : 1,
                'phone' => $data['phone'],
                'email' => $data['email'],
            ]);

            DB::commit();
            return $client;
         } catch (Exception $e) {
            DB::rollBack();
            throw $e; 
         }
    }

    public function deleteClient(Client $client)
    {
        DB::beginTransaction();
        try {
            $person_id = $client->person_id;

            $client->delete();

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
