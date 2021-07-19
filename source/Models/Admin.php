<?php

namespace Source\Models;

class Admin extends User
{
    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param boolean $all
     * @return Admin|null
     */
    public function findFetch(bool $all = false): ?Admin
    {
        $admin = parent::findFetch($all);

        if (!$admin) {
            return null;
        }

        $admin->level = 1;
        return $admin;
    }
}
