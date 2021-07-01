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
        if (empty($this->data) || !empty($this->id)) {
            $this->message->before('Erro inesperado ocorreu. ')->error('Verifique os campos ou tente mais tarde');
            return false;
        }

        if (!$this->required(['password_re'])) {
            $this->message->before('Há campos obrigatórios não preenchidos. ')->warning('Preencha todos os campos corretamente');
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
        if (!empty($this->first_name)) {
            $this->first_name = filter_var($this->first_name, FILTER_SANITIZE_STRIPPED);
        }

        if (!empty($this->last_name)) {
            $this->last_name = filter_var($this->last_name, FILTER_SANITIZE_STRIPPED);
        }

        if (!empty($this->email)) {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->message->before('E-mail inválido. ')->warning('O e-mail informado é inválido');
                $this->invalid('email');
                return false;
            }
        }

        if (!empty($this->password) && !empty($this->password_re)) {
            if (!is_passwd($this->password)) {
                $min = CONF_PASSWD_MIN_LEN;
                $max = CONF_PASSWD_MAX_LEN;

                $this->message->before('Senha inválida. ')->warning("A senha precisa ter entre {$min} e {$max} caracteres.");
                $this->invalid('password');
                return false;
            }

            if ($this->password != $this->password_re) {
                $this->message->before('Senhas não correspondentes. ')->warning('As senhas informados são diferentes');
                $this->invalid('password')->invalid('password_re');
                return false;
            }

            unset($this->data->password_re);

            $this->password = passwd($this->password);
        }

        if (!empty($this->password)) {
            if (!is_passwd($this->password)) {
                $this->message->before('Senha inválida. ')->warning("A senha informada não possui formato válido, tente outra.");
                $this->invalid('password');
                return false;
            }
        }

        $failMessage = [
            'insert' => 'Erro ao tentar cadastrá-lo como usuário',
            'update' => 'Erro ao tentar atualizar seus dados de usuário'
        ];

        return parent::save($failMessage);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @param string $password
     * @return boolean
     */
    public function passwordRehash(string $password): bool
    {
        if (empty($this->password) || !empty(password_get_info($password)['algo'])) {
            return true;
        }

        if (passwd_rehash($this->password)) {
            $user = new User();
            $user->id = $this->id;
            $user->password = passwd($password);
            $user->save();
        }

        return true;
    }
}
