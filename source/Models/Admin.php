<?php

namespace Source\Models;

use Source\Core\Model;

class Admin extends Model
{
    const RULE_NICKNAME_MIN_LEN = 20;
    const RULE_NICKNAME_MAX_LEN = 20;
    const RULE_FIRST_NAME_MIN_LEN = 3;
    const RULE_FIRST_NAME_MAX_LEN = 50;
    const RULE_LAST_NAME_MIN_LEN = 3;
    const RULE_LAST_NAME_MAX_LEN = 50;
    const RULE_EMAIL_MAX_LEN = 255;
    const RULE_PASSWORD_MIN_LEN = CONF_PASSWD_MIN_LEN;
    const RULE_PASSWORD_MAX_LEN = CONF_PASSWD_MAX_LEN;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct('admins', [], ['nickname', 'first_name', 'last_name', 'email', 'password']);
    }

    /**
     * @param string $nickname
     * @param string $columns
     * @return Admin|null
     */
    public function findByNickname(string $nickname, string $columns = '*'): ?Admin
    {
        return $this->find('nickname = :nickname', "nickname={$nickname}", $columns)->findFetch();
    }

    /**
     * @param string $email
     * @param string $columns
     * @return Admin|null
     */
    public function findByEmail(string $email, string $columns = '*'): ?Admin
    {
        return $this->find('email = :email', "email={$email}", $columns)->findFetch();
    }
}
