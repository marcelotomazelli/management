<?php

namespace Source\Models;

use Source\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct('users', [], ['first_name', 'last_name', 'email', 'password']);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $passwordRe
     * @return User
     */
    public function bootstrap(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $passwordRe
    ): User
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->password_re = $passwordRe;

        return $this;
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function register(): bool
    {
        if (empty($this->data)) {
            return false;
        }

        return $this->save();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function save(): bool
    {
        unset($this->data->password_re);

        $failMessage = [
            'insert' => 'Erro ao tentar cadastrá-lo como usuário',
            'update' => 'Erro ao tentar atualizar seus dados usuário'
        ];

        return parent::save($failMessage);
    }
}
