<?php

namespace Controller;

require_once("../Model/TodoModel.php");

class CalendarController
{
    public $model;

    public function __construct()
    {
        $this->model = new \Model\TodoModel();
    }

    public function show()
    {
        session_start();
        $_SESSION['todoList'] = $this->model->getAllTask();
        header('Location:../View/calendar.php');
    }

}

(new CalendarController())->show();

?>