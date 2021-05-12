<?php

namespace App\Model;

require_once(__DIR__ . "/../Database/DefineDatabase.inc");

/**
 * TodoModel
 */
class TodoModel
{
    private $connection;

    /**
     * construct
     */
    public function __construct()
    {
        $this->connection = $this->connectDB();
    }

    /**
     * get work list
     */
    public function getAllTask()
    {
        $sql = "SELECT * FROM todo ORDER BY id DESC";
        $result = $this->connection->query($sql);
        $dataTodo = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($dataTodo, $row);
            }
        }
        return $dataTodo;
    }

    /**
     * add new work
     * @param $data
     * @return bool
     */
    public function addTask($data)
    {
        $stmt = $this->connection->prepare("INSERT INTO todo (task_name, start_date, end_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $data['taskName'], $data['startDate'], $data['endDate'], $data['status']);
        $check = $stmt->execute();
        $stmt->close();
        return $check;
    }

    /**
     * edit work
     * @param $data
     * @return bool
     */
    public function editTask($data)
    {
        $sql = "UPDATE todo SET task_name = '" . $data['taskName'] . "', start_date = '" . $data['startDate'] . "', end_date = '" . $data['endDate'] . "', status = '" . $data['status'] . "' WHERE id = " . $data['id'];
        $check = $this->connection->query($sql);
        return $check;
    }

    /**
     * delete work
     * @param $id
     * @return bool
     */
    public function deleteTask($id)
    {
        $sql = "DELETE FROM todo WHERE id = " . $id;
        $check = $this->connection->query($sql);
        return $check;
    }

    /**
     * get connect
     */
    private function connectDB()
    {
        $connection = mysqli_connect(constant("SERVER_NAME"), constant("USER_NAME"), constant("PASS_WORK"), constant("DATABASE_NAME"));

        if ($connection->connect_error) {
            echo("Connection failed: " . $connection->connect_error);
        }
        return $connection;
    }
}

?>