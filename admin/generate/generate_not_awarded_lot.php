<?php

require_once '../../vendor/autoload.php'; // Adjust the path as needed

include('../class/db.php');
session_start();

// Assuming $conn is your database connection from db.php

$household_id = $_GET['id']; // Get the household ID

if (empty($household_id)) {
  $sql = "SELECT * FROM members WHERE award_type = 'Not Yet Awarded'";
  $stmt = $conn->prepare($sql);
}




$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
  $_SESSION['error'] = "No Not Yet Awarded Lots found";
  header("Location: /alegra/admin/household_masterlist.php");
  exit();
}


// Check if row is empty then generate a word file that have a centered NO PWD text






// Create a new PHPWord object
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add a new section to the document
$section = $phpWord->addSection();

// Add a table style
$phpWord->addTableStyle('myTable', ['borderSize' => 6, 'borderColor' => '999999']);
$table = $section->addTable('myTable');

// Add header row
$table->addRow();

$table->addCell(2000)->addText('Name');
$table->addCell(2000)->addText('Contact Number');
$table->addCell(2000)->addText('Block and Lot Number');

// Add more columns as needed

// Fetch each row from the result
while ($row = $result->fetch_assoc()) {

    $name = $row['first_name'] . ' ' . $row['mid_name'] . ' ' . $row['last_name'];

    $table->addRow();
    $table->addCell(2000)->addText($name); 
    $table->addCell(2000)->addText($row['contact']);
    $table->addCell(2000)->addText('Blk' . $row['block_number'] . ' ' . 'Lot' . $row['lot_number']);
  
    // Add more cells as needed
}

// Save the Word file


$household = "SELECT * FROM household WHERE id = ?"; 
$stmt = $conn->prepare($household);
$stmt->bind_param("i", $household_id);
$stmt->execute();
$household_result = $stmt->get_result();
$household_row = $household_result->fetch_assoc();

$writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
if (empty($household_id)) {
  $filename = 'NOT_AWARDED_LOTS_' . date('Y-m-d') . '.docx';
}
else{
  $filename = 'NOT_AWARDED_LOTS_' . date('Y-m-d') . ' Blk' . $household_row['Blk'] . " Lot" . $household_row['Lot']. '.docx';
}
$writer->save($filename);
// Download the file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($filename));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
flush(); // Flush system output buffer
readfile($filename);

// Delete the file

unlink($filename);

exit;