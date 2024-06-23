<?php
// Include database connection
include 'class/db.php';

$sql = "SELECT budget_remaining FROM current_budget";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['budget_remaining' => 0]);
}

$conn->close();
?>