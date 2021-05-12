<?php

namespace Model;

/**
 * Model connect Todo data
 */
class TodoModel
{
    /**
     * construct
     */
    public function __construct()
    {

    }

    /**
     * get work list
     */
    public function getAllTask()
    {
        $connection = $this->connectDB();
        $sql = "SELECT * FROM todo ";
        $result = $connection->query($sql);
        $dataTodo = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($dataTodo, $row);
            }
        }
        $connection->close();
        return $dataTodo;
    }

    /**
     * add new work
     * @param $data
     * @return bool
     */
    public function addTask($data)
    {
        $connection = $this->connectDB();
        $stmt = $connection->prepare("INSERT INTO todo (task_name, start_date, end_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $data['taskName'], $data['startDate'], $data['endDate'], $data['status']);
        $check = $stmt->execute();
        $stmt->close();
        $connection->close();
        return $check;
    }

    /**
     * edit work
     * @param $data
     * @return bool
     */
    public function editTask($data)
    {
        $connection = $this->connectDB();
        $sql = "UPDATE todo SET task_name = '" . $data['taskName'] . "', start_date = '" . $data['startDate'] . "', end_date = '" . $data['endDate'] . "', status = '" . $data['status'] . "' WHERE id = " . $data['id'];
        $check = $connection->query($sql);
        $connection->close();
        return $check;
    }

    /**
     * delete work
     * @param $id
     * @return bool
     */
    public function deleteTask($id)
    {
        $connection = $this->connectDB();
        $sql = "DELETE FROM todo WHERE id = " . $id;
        $check = $connection->query($sql);
        $connection->close();
        return $check;
    }

    /**
     * get connect
     */
    private function connectDB()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "todolist";

        $connection = mysqli_connect($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            echo("Connection failed: " . $connection->connect_error);
        }
        return $connection;
    }
}

?>