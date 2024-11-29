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
                'document_type' => 1,
                'document_number' => $data['dni'],
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
                'gender' => isset($data['gender']) ? $data['gender'] : 0,
                'phone' => isset($data['phone']) ? $data['phone'] : null,
                'email' => isset($data['email']) ? strtolower($data['email']) : null,
            ]);

            $client = new Client([
                'address' => isset($data['address']) ? $data['address'] : null,
                'nationality' => isset($data['nationality']) ? $data['nationality'] : null,
            ]);

            $person->client()->save($client);

            DB::commit();
           return $person; //lo modifique por que nesesitaba el id
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
                'address' => isset($data['address']) ? $data['address'] : null,
                'nationality' => isset($data['nationality']) ? $data['nationality'] : null,
            ]);

            $client->person->update([
                'document_number' => $data['dni'],
                'name' => $data['name'],
                'lastname' => $data['paternal_surname'] . ' ' . $data['maternal_surname'],
                'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
                'gender' => isset($data['gender']) ? $data['gender'] : 0,
                'phone' => isset($data['phone']) ? $data['phone'] : null,
                'email' => isset($data['email']) ? strtolower($data['email']) : null,
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
