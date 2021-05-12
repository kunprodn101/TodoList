<?php

namespace App\Controller;

use App\Controller\Base\BaseController;

require_once("./Base/BaseController.php");
require_once("../Model/TodoModel.php");

class EditTaskController extends BaseController
{
    /**
     * edit work
     * @param $data
     */
    public function editTask($data)
    {
        if ($this->model->editTask($data)) {
            $msgStatus = "Added data successfully!";
        } else {
            $msgStatus = "Failed to add data";
        }
        session_start();
        $_SESSION['msgStatus'] = $msgStatus;
        header('Location:../View/home.php');
    }
}

(new EditTaskController())->editTask([
    'id' => $_REQUEST['taskId'],
    'taskName' => $_REQUEST['taskName'],
    'startDate' => $_REQUEST['startDate'],
    'endDate' => $_REQUEST['endDate'],
    'status' => $_REQUEST['status']
]);

?>
