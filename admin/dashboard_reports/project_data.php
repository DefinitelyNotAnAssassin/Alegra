<?php
    header('Content-Type: application/json');

    include_once("../class/db.php");

    $sqlQuery = "SELECT * FROM projects";

    $result = mysqli_query($conn, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);
?>