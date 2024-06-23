<?php
// Database connection
include 'class/db.php'; // Adjust this line to use your actual database connection script

// Retrieve query parameters
$status = $_GET['status'] ?? '';
$projectId = $_GET['id'] ?? '';

if (!empty($projectId)) {

    // Check first if the overall_cost is not greater than the current_budget 

    $sql = "SELECT overall_cost FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $overall_cost = $row['overall_cost'];
    }


    $sql = "SELECT budget_remaining FROM current_budget"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $budget_remaining = $row['budget_remaining'];
    }

    if ($overall_cost > $budget_remaining) {
        header("Location: pending_projects.php?message=Project+budget+is+greater+than+current+budget+please+increase+budget+or+reject+project");
        exit;
    }
  



    // SQL to update project status to approved
    $sql = "UPDATE projects SET status = 1 WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    if ($stmt->execute()) {
        header("Location: pending_projects.php?message=Project+approved+successfully");
       
    } else {
        // Handle error
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>