<?php
// Database connection
include 'class/db.php'; // Adjust this line to use your actual database connection script

// Retrieve query parameters
$status = $_GET['status'] ?? '';
$projectId = $_GET['id'] ?? '';

if (!empty($projectId)) {
    // SQL to update project status to rejected
    $sql = "UPDATE projects SET status = 4 WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    if ($stmt->execute()) {
        // Redirect or display success message
        header("Location: pending_projects.php?message=Project+rejected+successfully");
    } else {
        // Handle error
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>