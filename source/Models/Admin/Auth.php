<?php

namespace Source\Models\Admin;

use Source\Core\Model;
use Source\Core\Session;
use Source\Models\Admin;
use Source\Models\TestUser;

class Auth extends Model
{
    /**
     * Admin Auth constructor.
     */
    public function __construct()
    {
        parent::__construct('admins', [], []);
    }

    /**
     * @return Admin|null
     */
    public static function admin(): ?Admin
    {
        if (!(new Session())->has('authAdmin')) {
            return null;
        }

        return (new Admin())->findById((new Session())->authAdmin);
    }

    /**
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function signin(string $email, string $password): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->message->before('E-mail inválido. ')->warning('O e-mail informado é inválido');
            $this->invalid('email');
            return false;
        }

        $admin = (new Admin())->findByEmail($email, 'id, password');

        if (!$admin) {
            $this->message->before('E-mail inválido. ')->error('E-mail informado não está cadastrado');
            $this->invalid('email');
            return false;
        }

        if (!passwd_verify($password, $admin->password)) {
            $this->message->before('Senha inválida. ')->error('A senha informada está incorreta');
            $this->invalid('password');
            return false;
        }

        $testUser = new TestUser();
        if (!$testUser->normalize((new Admin())->findById($admin->id))) {
            $this->message = $testUser->message();
            return false;
        }

        (new Session())->set('authAdmin', $admin->id);

        return true;
    }

    /**
     * @return void
     */
    public static function signout(): void
    {
        (new Session())->destroy();
    }
}
