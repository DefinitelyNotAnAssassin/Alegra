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
    $is_senior = isset($_POST['is_senior']) ? 1 : 0;
    $is_military = isset($_POST['is_military']) ? 1 : 0;
    $is_ayuda = isset($_POST['is_ayuda']) ? 1 : 0;
    $is_4ps = isset($_POST['is_4ps']) ? 1 : 0;
    $is_sss = isset($_POST['is_sss']) ? 1 : 0;
    $is_gsis = isset($_POST['is_gsis']) ? 1 : 0;
    $is_sap = isset($_POST['is_sap']) ? 1 : 0;
    $is_sap_qc = isset($_POST['is_sap_qc']) ? 1 : 0;
    // Prepare SQL statement
    $sql = "UPDATE household_members SET relationship_to_head = ?, occupation = ?, national_id = ?, social_security_number = ?, passport_number = ?, other_id_description = ?, other_id_number = ?, social_welfare_programs = ?, is_pwd = ?, is_political_family = ?, is_ethnic = ?, is_military = ?, is_ayuda = ?, is_4ps = ?, is_sss = ?, is_gsis = ?, is_sap = ?, is_sap_qc = ?, is_senior = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssssssiiiiiiiiiiii", $relationshipToHead, $occupation, $nationalId, $socialSecurityNumber, $passportNumber, $otherIdDescription, $otherIdNumber, $socialWelfarePrograms, $isPwd, $isPoliticalFamily, $isEthnic, $is_military, $is_ayuda, $is_4ps, $is_sss, $is_gsis, $is_sap, $is_sap_qc, $is_senior,  $householdMemberId);

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
        <input type="checkbox" class="form-check-input" id="is_senior" name="is_senior" <?php echo $row['is_senior'] ? 'checked' : ''; ?>>
        <label class="form-check-label" for="is_senior">Is Senior</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_pwd" name="is_pwd" <?php echo $row['is_pwd'] ? 'checked' : ''; ?>>
        <label class="form-check-label" for="is_pwd">Is PWD</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_4ps" name="is_4ps" <?php echo $row['is_4ps'] ? 'checked' : ''; ?>>
        <label for="is_4ps" class="form-check-label">Is 4ps:</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_sss" name="is_sss" <?php echo $row['is_sss'] ? 'checked' : ''; ?>>
        <label for="is_sss" class="form-check-label">SSS:</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_gsis" name="is_gsis" <?php echo $row['is_gsis'] ? 'checked' : ''; ?>>
        <label for="is_gsis" class="form-check-label">GSIS:</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_military" name="is_military" <?php echo $row['is_military'] ? 'checked' : ''; ?>>
        <label for="is_military" class="form-check-label">Military:</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_ayuda" name="is_ayuda" <?php echo $row['is_ayuda'] ? 'checked' : ''; ?>>
        <label for="is_ayuda" class="form-check-label">Ayuda:</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_sap" name="is_sap" <?php echo $row['is_sap'] ? 'checked' : ''; ?>>
        <label for="is_sap" class="form-check-label">SAP:</label>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_sap_qc" name="is_sap_qc" <?php echo $row['is_sap_qc'] ? 'checked' : ''; ?>>
        <label for="is_sap_qc" class="form-check-label">SAP QC:</label>
    </div>


    <button type="submit" class="btn btn-primary">Update</button>
