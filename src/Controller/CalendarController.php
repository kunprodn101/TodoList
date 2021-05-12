<?php

namespace App\Controller;

use App\Controller\Base\BaseController;

require_once("./Base/BaseController.php");
require_once("../Model/TodoModel.php");

class CalendarController extends BaseController
{
    /**
     * show calendar
     */
    public function show()
    {
        session_start();
        $_SESSION['todoList'] = $this->model->getAllTask();
        header('Location:../View/calendar.php');
    }
}

(new CalendarController())->show();

?>