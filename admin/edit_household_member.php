<?php

include('class/db.php');

$householdMemberId = $_GET['id'];

$sql = "SELECT * FROM household_members WHERE id = '$householdMemberId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $householdMemberId = htmlspecialchars($_POST['id']);
    $relationshipToHead = htmlspecialchars($_POST['relationship_to_head']);
    $occupation = htmlspecialchars($_POST['occupation']);
    $nationalId = htmlspecialchars($_POST['national_id']);
    $socialSecurityNumber = htmlspecialchars($_POST['social_security_number']);
    $passportNumber = htmlspecialchars($_POST['passport_number']);
    $otherIdDescription = htmlspecialchars($_POST['other_id_description']);
    $otherIdNumber = htmlspecialchars($_POST['other_id_number']);
    $socialWelfarePrograms = htmlspecialchars($_POST['social_welfare_programs']);
    $isPwd = isset($_POST['is_pwd']) ? 1 : 0;
    $isPoliticalFamily = isset($_POST['is_political_family']) ? 1 : 0;
    $isEthnic = isset($_POST['is_ethnic']) ? 1 : 0;

    // Prepare SQL statement
    $sql = "UPDATE household_members SET relationship_to_head = ?, occupation = ?, national_id = ?, social_security_number = ?, passport_number = ?, other_id_description = ?, other_id_number = ?, social_welfare_programs = ?, is_pwd = ?, is_political_family = ?, is_ethnic = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssssssiiii", $relationshipToHead, $occupation, $nationalId, $socialSecurityNumber, $passportNumber, $otherIdDescription, $otherIdNumber, $socialWelfarePrograms, $isPwd, $isPoliticalFamily, $isEthnic, $householdMemberId);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or show a success message
            header("Location: /alegra/admin/household_masterlist.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
} 


?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<form method="post" class="p-3">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

    <div class="form-group">
        <label for="relationship_to_head">Relationship to Head:</label>
        <input type="text" class="form-control" id="relationship_to_head" name="relationship_to_head" value="<?php echo htmlspecialchars($row['relationship_to_head']); ?>">
    </div>

    <div class="form-group">
        <label for="occupation">Occupation:</label>
        <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($row['occupation']); ?>">
    </div>

    <div class="form-group">
        <label for="national_id">National ID:</label>
        <input type="text" class="form-control" id="national_id" name="national_id" value="<?php echo htmlspecialchars($row['national_id']); ?>">
    </div>

    <div class="form-group">
        <label for="social_security_number">Social Security Number:</label>
        <input type="text" class="form-control" id="social_security_number" name="social_security_number" value="<?php echo htmlspecialchars($row['social_security_number']); ?>">
    </div>

    <div class="form-group">
        <label for="passport_number">Passport Number:</label>
        <input type="text" class="form-control" id="passport_number" name="passport_number" value="<?php echo htmlspecialchars($row['passport_number']); ?>">
    </div>

    <div class="form-group">
        <label for="other_id_description">Other ID Description:</label>
        <input type="text" class="form-control" id="other_id_description" name="other_id_description" value="<?php echo htmlspecialchars($row['other_id_description']); ?>">
    </div>

    <div class="form-group">
        <label for="other_id_number">Other ID Number:</label>
        <input type="text" class="form-control" id="other_id_number" name="other_id_number" value="<?php echo htmlspecialchars($row['other_id_number']); ?>">
    </div>

    <div class="form-group">
        <label for="social_welfare_programs">Social Welfare Programs:</label>
        <input type="text" class="form-control" id="social_welfare_programs" name="social_welfare_programs" value="<?php echo htmlspecialchars($row['social_welfare_programs']); ?>">
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_pwd" name="is_pwd" <?php echo $row['is_pwd'] ? 'checked' : ''; ?>>
        <label class="form-check-label" for="is_pwd">Is PWD</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_political_family" name="is_political_family" <?php echo $row['is_political_family'] ? 'checked' : ''; ?>>
        <label class="form-check-label" for="is_political_family">Is Political Family</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_ethnic" name="is_ethnic" <?php echo $row['is_ethnic'] ? 'checked' : ''; ?>>
        <label class="form-check-label" for="is_ethnic">Is Ethnic</label>
    </div>

    <button type="submit"  class="btn btn-primary">Update</button>
    <a href = "/alegra/admin/household_masterlist.php" class="btn btn-secondary" onclick="window.close();">Close</a>
</form>
