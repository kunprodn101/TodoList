$(document).ready(function () {
    $(".date-start-add, .date-end-add").change(function () {
        let start = $(".date-start-add").val();
        let end = $(".date-end-add").val();
        compareDate(start, end);
    });

    $(".date-start-edit, .date-end-edit").change(function () {
        let start = $(".date-start-edit").val();
        let end = $(".date-end-edit").val();
        compareDate(start, end);
    });

    function compareDate(start, end) {
        if (new Date(start) > new Date(end)) {
            alert("Start date is greater than the end date");
            $(".btn-submit-form").prop('disabled', true);
        } else {
            $(".btn-submit-form").prop('disabled', false);
        }
    }

    $("#btn-add").click(function () {
        $('#form-add-todo').trigger("reset");
        $("#status-planning").prop("checked", true);
        $("#form-add-todo").attr("action", "../Controller/AddTaskController.php");
    });

    $(".btn-edit").click(function () {
        $('#form-add-todo').trigger("reset");
        $("#form-add-todo").attr("action", "../Controller/EditTaskController.php");
        let taskId = $(this).closest('tr').find('.task-id').val();
        let taskName = $(this).closest('tr').find('.txt-task-name').text().trim();
        let startDate = $(this).closest('tr').find('.txt-start-date').text().trim();
        let endDate = $(this).closest('tr').find('.txt-end-date').text().trim();
        let status = $(this).closest('tr').find('.txt-status').text().trim();

        $('#task-id').val(taskId);
        $('#task-name-input').val(taskName);
        $('#start-date-input').val(startDate);
        $('#end-date-input').val(endDate);
        switch (status) {
            case "Planning":
                $("#status-planning").prop("checked", true);
                break;
            case "Doing":
                $("#status-doing").prop("checked", true);
                break;
            case "Complete":
                $("#status-complete").prop("checked", true);
                break;
        }
    });
});