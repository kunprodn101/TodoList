<?php

namespace App\Controller;

use App\Controller\Base\BaseController;

require_once("./Base/BaseController.php");
require_once("../Model/TodoModel.php");

class AddTaskController extends BaseController
{
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