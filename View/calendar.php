<?php
$todoList = [];
session_start();
if (isset($_SESSION['todoList'])) {
    $todoList = $_SESSION['todoList'];
    unset($_SESSION['todoList']);
} else {
    header("Location: ../Controller/CalendarController.php");
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'/>
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        $(document).ready(function () {
            let todos = <?php echo json_encode($todoList); ?>;
            let dataEvent = [];

            for (let [index, todo] of Object.entries(todos)) {
                let color = "";
                switch (todo['status']) {
                    case "Planning":
                        color = "#17a2b8";
                        break;
                    case "Doing":
                        color = "#28a745";
                        break;
                    case "Complete":
                        color = "#ffc107";
                        break;
                }
                let endDate = new Date(todo['end_date']);
                endDate.setDate(endDate.getDate() + 1);
                dataEvent.push({
                    id: todo['id'],
                    title: todo['task_name'],
                    start: todo['start_date'],
                    end: endDate.toISOString().split('T')[0],
                    color: color
                });
            }

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    center: 'dayGridMonth, dayGridWeek, dayGridDay'
                },
                events: dataEvent
            });

            calendar.render();
        });
    </script>
</head>
<body>
<div class="col-md-12 text-center">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                <a href="../index.php" class="btn"><i class="fa fa-home"></i></a>
            </h3>
        </div>
    </div>
</div>
<div id='calendar'></div>
</body>
</html>