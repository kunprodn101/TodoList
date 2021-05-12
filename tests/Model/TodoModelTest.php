<?php

namespace Tests;

require_once(__DIR__ . "/../../src/Database/DefineDatabase.inc");

use PHPUnit\Framework\TestCase;
use App\Model\TodoModel;

class TodoModelTest extends TestCase
{
    public $todoModel;
    public $connection;

    /**
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();
        $this->todoModel = new TodoModel();
        $this->connection = $this->connectDB();
        $this->setValueVariable($this->todoModel, 'connection', $this->connection);
    }

    /**
     * test function getAllTask
     */
    public function testGetAllTask()
    {
        $this->connection->begin_transaction();

        // test case no data
        $this->connection->query("DELETE FROM todo");
        $this->assertTrue(count($this->todoModel->getAllTask()) == 0);

        // test case has data
        $this->connection->query("INSERT INTO todo (task_name, start_date, end_date, status) VALUES ('test1', '2021-05-13', '2021-05-12', 'Doing')");
        $this->assertTrue(count($this->todoModel->getAllTask()) > 0);

        $this->connection->rollback();
    }

    /**
     * test function addTask
     */
    public function testAddTask()
    {
        $this->connection->begin_transaction();

        $this->connection->query("DELETE FROM todo");

        $dataFake = [
            'taskName' => 'test',
            'startDate' => '2021-05-12',
            'endDate' => '2021-05-13',
            'status' => 'Doing'
        ];

        $this->todoModel->addTask($dataFake);
        $result = $this->connection->query("SELECT * FROM todo");
        $this->assertTrue($result->num_rows > 0);

        $this->connection->rollback();
    }

    /**
     * test function editTask
     */
    public function testEditTask()
    {
        $this->connection->begin_transaction();

        $taskId = '1';
        $taskName = 'test1';
        $startDate = '2021-05-11';
        $endDate = '2021-05-13';
        $status = 'Planning';

        // insert work
        $this->connection->query("REPLACE INTO todo VALUES($taskId,'test', '2021-05-12', '2021-05-12', 'Doing')");

        $dataFake = [
            'id' => $taskId,
            'taskName' => $taskName,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status
        ];

        // edit work
        $this->todoModel->editTask($dataFake);
        $result = $this->connection->query(
            "SELECT * FROM todo WHERE id = '$taskId' AND task_name = '$taskName' AND start_date = '$startDate' AND end_date = '$endDate' AND status = '$status'"
        );
        $this->assertTrue($result->num_rows > 0);

        $this->connection->rollback();
    }

    /**
     * test function deleteTask
     */
    public function testDeleteTask()
    {
        $this->connection->begin_transaction();

        $taskId = '1';
        $this->connection->query("REPLACE INTO todo VALUES($taskId,'test', '2021-05-12', '2021-05-12', 'Doing')");
        $this->todoModel->deleteTask($taskId);
        $result = $this->connection->query("SELECT * FROM todo WHERE id = '$taskId'");
        $this->assertTrue($result->num_rows == 0);

        $this->connection->rollback();
    }

    /**
     * get connect
     */
    public function connectDB()
    {
        $connection = mysqli_connect(constant("SERVER_NAME"), constant("USER_NAME"), constant("PASS_WORK"), constant("DATABASE_NAME"));

        if ($connection->connect_error) {
            echo("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }

    /**
     * get setValueVariable
     *
     * @param Object $objectClass
     * @param string $propertyName
     * @param mixed $propertyValue
     * @throws \ReflectionException
     */
    public function setValueVariable(&$objectClass, $propertyName, $propertyValue)
    {
        $this->setAccessibleVariable($objectClass, $propertyName)->setValue($objectClass, $propertyValue);
    }

    /**
     * setAccessibleVariable
     *
     * @param Object $objectClass
     * @param string $propertyName
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    public function setAccessibleVariable($objectClass, $propertyName)
    {
        $reflection = new \ReflectionClass($objectClass);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property;
    }
}