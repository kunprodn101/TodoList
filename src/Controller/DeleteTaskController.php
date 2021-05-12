<?php

namespace App\Controller;

use App\Controller\Base\BaseController;

require_once("./Base/BaseController.php");
require_once("../Model/TodoModel.php");

class DeleteTaskController extends BaseController
{
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
