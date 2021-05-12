<?php
session_start();

$todoList = [];
if (isset($_SESSION['todoList'])) {
    $todoList = $_SESSION['todoList'];
    unset($_SESSION['todoList']);
} else {
    header("Location:../index.php");
    exit();
}

$msgStatus = '';
if (isset($_SESSION['msgStatus'])) {
    $msgStatus = $_SESSION['msgStatus'];
    unset($_SESSION['msgStatus']);
}
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/todo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
            crossorigin="anonymous"></script>
    <script src="../assets/js/todo.js"></script>
</head>
<body class="antialiased">
    <div>
        <div class="container">
            <div class="col-md-12">
                <?php if (!empty($msgStatus)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= $msgStatus ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
            </div>
            <div class="row py-5">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <button type="button" id="btn-add" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                                Add
                            </button>
                            <a href="../Controller/CalendarController.php">
                                <button type="button" id="btn-add" class="btn btn-success">
                                    Calendar
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div style="height: 520px">
                        <table class="table table-borderless">
                            <thead>
                            <tr class="border-bottom border-dark">
                                <th class="col-sm-4" scope="col">Work Name</th>
                                <th class="col-sm-2" scope="col">Start Date</th>
                                <th class="col-sm-2" scope="col">End Date</th>
                                <th class="col-sm-2" scope="col">Status</th>
                                <th class="col-sm-2" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($todoList as $todo) { ?>
                                <tr>
                                    <td class="col-sm-4">
                                        <span class="txt-task-name"><?= $todo['task_name'] ?></span>
                                    </td>
                                    <td class="col-sm-2">
                                        <span style="max-width: 300px" class="d-inline-block text-truncate txt-start-date">
                                            <?= $todo['start_date'] ?>
                                        </span>
                                    </td>
                                    <td class="col-sm-2">
                                        <span style="max-width: 300px" class="d-inline-block text-truncate txt-end-date">
                                            <?= $todo['end_date'] ?>
                                        </span>
                                    </td>
                                    <td class="col-sm-2">
                                        <span style="max-width: 300px" class="d-inline-block text-truncate txt-status">
                                           <?= $todo['status'] ?>
                                        </span>
                                    </td>
                                    <td class="col-sm-2">
                                        <button type="button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#addModal">
                                            Edit
                                        </button>
                                        <a href="../Controller/DeleteTaskController.php?taskId=<?= $todo['id'] ?>">
                                            <button type="button" class="btn btn-success">
                                                Delete
                                            </button>
                                        </a>
                                        <input type="hidden" class="task-id" value="<?= $todo['id'] ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add-->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form method="POST" action="" id="form-add-todo">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div style="display: none;">
                            <input name="type" value="ADD">
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Task info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-3 col-form-label">Work Name</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" value="" id="task-name-input" name="taskName" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-date-input" class="col-3 col-form-label">Start Date</label>
                                <div class="col-9">
                                    <input class="form-control date-start-add" type="date" value="" id="start-date-input" name="startDate" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-date-input" class="col-3 col-form-label">End Date</label>
                                <div class="col-9">
                                    <input class="form-control date-end-add" type="date" value="" id="end-date-input" name="endDate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Status</legend>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status-planning" value="Planning">
                                            <label for="male">Planning</label><br>
                                            <input class="form-check-input" type="radio" name="status" id="status-doing" value="Doing">
                                            <label for="male">Doing</label><br>
                                            <input class="form-check-input" type="radio" name="status" id="status-complete" value="Complete">
                                            <label for="male">Complete</label><br>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="btn-save" class="btn btn-primary btn-submit-form">Save</button>
                            <input type="hidden" name="taskId" id="task-id">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
