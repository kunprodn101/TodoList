<?php

namespace Controller;

require_once("../Model/TodoModel.php");

class DeleteTaskController
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
     * delete work
     * @param $id
     */
    public function deleteTask($id)
    {
        if ($this->model->deleteTask($id)) {
            $msgStatus = "Added data successfully!";
        } else {
            $msgStatus = "Failed to add data";
        }
        session_start();
        $_SESSION['msgStatus'] = $msgStatus;
        header('Location:../View/home.php');
    }
}

(new DeleteTaskController())->deleteTask($_REQUEST['taskId']);

?>
