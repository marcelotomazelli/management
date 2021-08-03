<?php

namespace Source\Models;

use Source\Core\Model;

class User extends Model
{
    const RULE_FIRST_NAME_MIN_LEN = 3;
    const RULE_FIRST_NAME_MAX_LEN = 50;
    const RULE_LAST_NAME_MIN_LEN = 3;
    const RULE_LAST_NAME_MAX_LEN = 50;
    const RULE_EMAIL_MAX_LEN = 255;
    const RULE_PASSWORD_MIN_LEN = CONF_PASSWD_MIN_LEN;
    const RULE_PASSWORD_MAX_LEN = CONF_PASSWD_MAX_LEN;
    const RULE_BIRTHDATE_MIN_AGE = 16;
    const RULE_DOCUMENT_LEN = 11;

    /**
     * User constructor.
     */
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
     * @param string $email
     * @param string $columns
     * @return User|null
     */
    public function findByEmail(string $email, string $columns = '*'): ?User
    {
        return $this->find('email = :email', "email={$email}", $columns)->findFetch();
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
     * @param array $edit
     * @return boolean
     */
    public function edit(array $edit): bool
    {
        if (empty($this->id)) {
            $this->message->before('Erro inesperado ocorreu. ')->error('Verifique os dados ou tente novamente mais tarde');
            return false;
        }

        $id = $this->id;

        $this->data = new \stdClass();
        $this->id = $id;

        $editable = ['first_name', 'last_name', 'password', 'password_re', 'birthdate', 'document'];

        foreach ($editable as $name) {
            if (!empty($edit[$name])) {
                $this->$name = $edit[$name];
            }
        }

        return $this->save();
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function save(): bool
    {
        $rules = $this->rules();

        if (!empty($this->first_name)) {
            $firstNameLen = strlen($this->first_name);

            if ($firstNameLen < $rules->first_name_min_len || $firstNameLen > $rules->first_name_max_len) {
                $this->message
                    ->before('Primeiro nome inválido. ')
                    ->warning("O primeiro nome deve ter entre {$rules->first_name_min_len} e {$rules->first_name_max_len} caracteres");
                $this->invalid('first_name');
                return false;
            }

            $this->first_name = filter_var($this->first_name, FILTER_SANITIZE_STRIPPED);
        }

        if (!empty($this->last_name)) {
            $lastNameLen = strlen($this->last_name);

            if ($lastNameLen < $rules->last_name_min_len || $lastNameLen > $rules->last_name_max_len) {
                $this->message
                    ->before('Último nome inválido. ')
                    ->warning("O último nome deve ter entre {$rules->last_name_min_len} e {$rules->last_name_max_len} caracteres");
                $this->invalid('last_name');
                return false;
            }

            $this->last_name = filter_var($this->last_name, FILTER_SANITIZE_STRIPPED);
        }

        if (!empty($this->email)) {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL) || strlen($this->email) > $rules->email_max_len) {
                $this->message->before('E-mail inválido. ')->warning('O e-mail informado é inválido');
                $this->invalid('email');
                return false;
            }

            $emailExists = (new User())->find('email = :email AND id != :id', "email={$this->email}&id={$this->id}")->findFetch();

            if ($emailExists) {
                $this->message->before('E-mail indisponível. ')->error('O e-mail informado já está em uso');
                $this->invalid('email');
                return false;
            }
        }

        if (!empty($this->birthdate)) {
            $date = \DateTime::createFromFormat('d/m/Y', $this->birthdate);

            if (!$date) {
                $this->message->before('Data de nascimento inválida. ')->warning('A data de nascimento não possui formato válido');
                $this->invalid('birthdate');
                return false;
            }

            $date = $date->format('Y-m-d');

            if ($date > date('Y-m-d', strtotime("-{$rules->birthdate_min_age}years"))) {
                $this->message->before('Idade inválida. ')->warning("A idade minima é {$rules->birthdate_min_age} anos");
                $this->invalid('birthdate');
                return false;
            }

            if ($date < date('Y-m-d', strtotime('-120years'))) {
                $this->message->before('Idade inválida. ')->warning("A idade informada ultrapassa 120 anos de idade, confira se digitou corretamente");
                $this->invalid('birthdate');
                return false;
            }

            $this->birthdate = $date;
        }

        if (!empty($this->document)) {
            $this->document = preg_replace('/\D/', '', $this->document);

            if (strlen($this->document) != $rules->document_len) {
                $this->message->before('Documento inválido. ')->warning('O número de documento informado não é válido');
                $this->invalid('document');
                return false;
            }
        }

        if (!empty($this->password) && !empty($this->password_re)) {
            if (!is_passwd($this->password)) {
                $min = $rules->password_min_len;
                $max = $rules->password_max_len;

                $this->message->before('Senha inválida. ')->warning("A senha precisa ter entre {$min} e {$max} caracteres.");
                $this->invalid('password');
                return false;
            }

            if ($this->password != $this->password_re) {
                $this->message->before('Senhas não correspondentes. ')->warning('As senhas informadas são diferentes');
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

    /**
     * @param string $password
     * @return boolean
     */
    public function passwordRehash(string $password): bool
    {
        if (empty($this->password) || empty(password_get_info($this->password)['algo'])) {
            return true;
        }

        if (!passwd_rehash($this->password)) {
            return true;
        }

        if (!empty(password_get_info($password)['algo'])) {
            return true;
        }

        if (passwd_verify($password, $this->password)) {
            $this->edit([
                'password' => $password,
                'password_re' => $password
            ]);
        }

        return true;
    }
}
