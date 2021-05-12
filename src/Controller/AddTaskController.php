<?php

namespace Controller;

require_once("../Model/TodoModel.php");

class AddTaskController
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
     * add new work
     * @param $data
     */
    public function addTask($data)
    {
        if ($this->model->addTask($data)) {
            $msgStatus = "Added data successfully!";
        } else {
            $msgStatus = "Failed to add data";
        }
        session_start();
        $_SESSION['msgStatus'] = $msgStatus;
        header('Location:../View/home.php');
    }
}

(new AddTaskController())->addTask([
    'taskName' => $_REQUEST['taskName'],
    'startDate' => $_REQUEST['startDate'],
    'endDate' => $_REQUEST['endDate'],
    'status' => $_REQUEST['status']
]);

?>