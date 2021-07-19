<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Admin;

class TestUser extends Model
{
    /**
     * TestUser constructor.
     */
    public function __construct()
    {
        parent::__construct('test_users', [], ['user_id', 'first_name', 'last_name', 'email']);
    }

    /**
     * @param Admin $admin
     * @return boolean
     */
    public function normalize(Admin $admin): bool
    {
        $count = (new TestUser())
            ->find('user_id = :user_id', "user_id={$admin->id}", 'count(*) as count')
            ->findFetch();

        $inserts = (15 - intval($count->count));

        if ($inserts <= 0) {
            return true;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://gerador-nomes.herokuapp.com/nomes/' . ($inserts * 2),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $names = json_decode(curl_exec($curl));
        curl_close($curl);

        $failMessage = [
            'insert' => 'Erro ao tentar cadastrar usuário teste',
            'update' => 'Erro ao tentar atualizar dados do usuário teste'
        ];

        for ($i = 0; $i < $inserts; $i++) {
            if (!$names) {
                $this->message->before('Erro inesperado. ')->error('Erro inesperado ocorreu ao normalizar usuários testes');
                return false;
            }

            $testUser = new TestUser();
            $testUser->user_id = $admin->id;
            $testUser->first_name = $names[$i];
            $testUser->last_name = $names[$inserts + $i];
            $testUser->email = str_slug($testUser->first_name) . str_slug($testUser->last_name) . '@email.com';

            $testUser->save($failMessage);
        }

        return true;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return string
     */
    public function cutFirstName(): string
    {
        return str_limit_chars($this->first_name, 10, '');
    }

    /**
     * @return string
     */
    public function cutLastName(): string
    {
        return str_limit_chars($this->last_name, 10, '');
    }
}
