<?php

namespace App\Controller;

use App\Controller\Base\BaseController;

require_once("./Base/BaseController.php");
require_once("../Model/TodoModel.php");

class ShowTaskListController extends BaseController
{
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
