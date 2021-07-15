<?php

namespace Source\Models\Admin;

use Source\Core\Model;
use Source\Core\Session;
use Source\Models\Admin;

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
     * @param string $nickname
     * @param string $password
     * @return boolean
     */
    public function signin(string $nickname, string $password): bool
    {
        $admin = (new Admin())->findByNickname($nickname, 'id, password');

        if (!$admin) {
            $this->message->before('Apelido inválido. ')->error('Apelido informado não está cadastrado');
            $this->invalid('nickname');
            return false;
        }

        if (!passwd_verify($password, $admin->password)) {
            $this->message->before('Senha inválida. ')->error('A senha informada está incorreta');
            $this->invalid('password');
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
