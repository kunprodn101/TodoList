<?php

namespace App\Controller\Base;

use App\Model\TodoModel;

class BaseController
{
    public $model;

    /**
     * construct
     */
    public function __construct()
    {
        $this->model = new TodoModel();
    }
}

?>
