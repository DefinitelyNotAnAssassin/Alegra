
<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Dompdf\Dompdf;

// Set PDF renderer
Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
Settings::setPdfRendererName('DomPDF');

// Path to your .docx template
$templatePath = 'certificates/base/Homeowners-Association-Certification.docx';

// Create a new TemplateProcessor instance with your .docx template
$templateProcessor = new TemplateProcessor($templatePath);

// Replace the placeholder [Full Name] with the actual name
$fullName = "John Doe"; // Example name
$address = "123 Example St."; // Example address
$hoaName = "Example Homeowners Association"; // Example HOA name

// Note: No comma or other characters outside the brackets in the placeholder

$templateProcessor->setValue('fullname', $fullName);
$templateProcessor->setValue('address', $address);


// Save the changes to a new temporary Word file
$tempDocxPath = tempnam(sys_get_temp_dir(), 'cert') . '.docx';
$templateProcessor->saveAs($tempDocxPath);

// Load the modified Word file
$phpWord = IOFactory::load($tempDocxPath);

// Save it to a temporary PDF file
$tempPdfPath = tempnam(sys_get_temp_dir(), 'cert') . '.pdf';
$xmlWriter = IOFactory::createWriter($phpWord, 'PDF');
$xmlWriter->save($tempPdfPath);

// Output the generated PDF to browser for download
header("Content-Disposition: attachment; filename=certificate.pdf");
header("Content-Type: application/pdf");
readfile($tempPdfPath);

// Clean up the temporary files
unlink($tempDocxPath);
unlink($tempPdfPath);
?>