<?php
    header('Content-Type: application/json');

    include_once("../class/db.php");

    $sqlQuery = "SELECT * FROM projects WHERE status < 10 AND STATUS <> 4 AND STATUS <> 0";

    $result = mysqli_query($conn, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);
?>