<?php

namespace Controller;

require_once("../Model/TodoModel.php");

class ShowTaskListController
{
    public $model;

    /**
     * construct
     */
    public function __construct()
    {
        $this->model = new \Model\TodoModel();
    }

    /**
     * get work list
     */
    public function showTaskList()
    {
        session_start();
        $_SESSION['todoList'] = $this->model->getAllTask();
        header('Location:../View/home.php');
    }
}

(new ShowTaskListController())->showTaskList();

?>
