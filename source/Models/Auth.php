<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Session;

use Source\Models\User;

class Auth extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct('users', [], []);
    }

    /**
     * @return User|null
     */
    public static function user(): ?User
    {
        if (!(new Session())->has('authUser')) {
            return null;
        }

        return (new User())->findById((new Session())->authUser);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $passwordRe
     * @return bool
     */
    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $passwordRe
    ): bool
    {
        $user = (new User())->bootstrap(
            $firstName,
            $lastName,
            $email,
            $password,
            $passwordRe
        );

        if (!$user->register()) {
            $this->message = $user->message();
            $this->invalid = $user->invalid();
            return false;
        }

        return true;
    }

    /**
     * @param string $email
     * @param string $password
     * @param boolean $save
     * @return boolean
     */
    public function signin(string $email, string $password, bool $save = false): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->message->before('E-mail inválido. ')->warning('O e-mail informado é inválido');
            $this->invalid('email');
            return false;
        }

        $user = (new User())->findByEmail($email, 'id, password');

        if (!$user) {
            $this->message->before('E-mail inválido. ')->error('E-mail informado não está cadastrado');
            $this->invalid('email');
            return false;
        }

        if (!passwd_verify($password, $user->password)) {
            $this->message->before('Senha inválida. ')->error('A senha informada está incorreta');
            $this->invalid('password');
            return false;
        }

        (new Session())->set('authUser', $user->id);

        $user->passwordRehash($password);

        if ($save) {
            setcookie('authEmail', $email, (time() + (60 * 60 * 24 * 7)), '/');
        } else {
            setcookie('authEmail', null, (time() - (60 * 60)), '/');
        }

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
