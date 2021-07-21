<?php

namespace Source\Controllers\Web;

use Source\Core\Controller as CoreController;
use Source\Models\App\Auth;

class Controller extends CoreController
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../themes/' . CONF_VIEW_WEB . '/');

        $this->view->engine()->addData(['user' => Auth::user()]);
    }
}
