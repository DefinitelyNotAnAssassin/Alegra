<?php
    header('Content-Type: application/json');

    include_once("../class/db.php");

    $sqlQuery = "SELECT p.*, t.*, t.id as task_id, t.deadline as task_deadline, t.status as task_status
    FROM projects p
    LEFT JOIN task_list t ON t.project_id = p.id
    WHERE p.status <> 3";

    $result = mysqli_query($conn, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);
?>