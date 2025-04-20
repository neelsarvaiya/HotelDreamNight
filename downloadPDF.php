<?php
require 'Admin/connection.php';
require('fpdf/fpdf.php');

if (!isset($_GET['r_id']) && isset($_GET['u_email'])) {
    echo "Invalid request.";
    exit;
}

$email = $_GET['u_email'];

$sql = "SELECT 
re.Full_Name, 
re.Email, 
re.Phone_number, 
re.Address,
re.DOB, 
re.state, 
b.adult, 
b.child, 
b.check_in_date, 
b.check_out_date, 
b.total_price, 
b.created_at,
rc.image, 
rc.name,
r.room_number
FROM 
bookings b
JOIN 
register re ON b.user_id = re.id
JOIN 
rooms r ON b.room_number_id = r.id
JOIN 
room_categories rc ON b.room_id = rc.id
WHERE 
b.id = $_GET[r_id] AND re.Email = '$email'";

$data = mysqli_fetch_assoc(mysqli_query($conn, $sql));

function generateBookingPDF($data)
{

    $pdf = new FPDF();
    $pdf->AddPage();

    $leftLabelWidth = 40;
    $leftValueWidth = 55;
    $rightLabelWidth = 40;
    $rightValueWidth = 55;

    // Header
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 8, 'Reservation Confirmation', 0, 1, 'C');
    $pdf->Cell(0, 3, "", 0, 1);
    $pdf->Cell(0, 8, 'DreamNight', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(0, 5, 'Hotel', 0, 1, 'C');

    // Image (dynamic)
    $imagePath = 'img/rooms/' . $data['image'];
    if (file_exists($imagePath)) {
        $pdf->Image($imagePath, 10, 40, 100, 50);
    }


    $pdf->SetFillColor(240, 240, 240);
    $pdf->Rect(112, 40, 90, 50, 'F');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(120, 120, 120);
    $pdf->SetXY(120, 50);
    $pdf->Cell(70, 10, 'WE LOOK', 0, 2, 'C');
    $pdf->Cell(70, 10, 'FORWARD TO', 0, 2, 'C');
    $pdf->Cell(70, 10, 'SEEING YOU', 0, 2, 'C');
    $pdf->Ln(20);

    // Greeting
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Dear Mr. " . $data['Full_Name'] . ",", 0, 1, 'L');
    $pdf->SetFont('Arial', '', 11);
    $pdf->MultiCell(0, 6, "Thank you for choosing DreamNight Hotel. It is our pleasure to confirm the following reservation. Please advise us if any changes need to be made to this reservation by calling us at 940-818-6776.");
    $pdf->Ln(5);

    // Section headers
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell($leftLabelWidth + $leftValueWidth, 10, 'GUEST INFORMATION', 1, 0, 'L', true);
    $pdf->Cell($rightLabelWidth + $rightValueWidth, 10, 'RESERVATION DETAILS', 1, 1, 'L', true);
    $pdf->SetFont('Arial', '', 11);

    // Row 1
    $pdf->Cell($leftLabelWidth, 8, "Name", 1);
    $pdf->Cell($leftValueWidth, 8, $data['Full_Name'], 1);
    $pdf->Cell($rightLabelWidth, 8, "Room Name", 1);
    $pdf->Cell($rightValueWidth, (string) 8, $data['name'], 1);
    $pdf->Ln();

    // Row 2
    $pdf->Cell($leftLabelWidth, 8, "Email", 1);
    $pdf->Cell($leftValueWidth, 8, $data['Email'], 1);
    $pdf->Cell($rightLabelWidth, 8, "Room Number", 1);
    $pdf->Cell($rightValueWidth, (string) 8, $data['room_number'], 1);
    $pdf->Ln();

    // Row 3
    $pdf->Cell($leftLabelWidth, 8, "Phone no.", 1);
    $pdf->Cell($leftValueWidth, 8, $data['Phone_number'], 1);
    $pdf->Cell($rightLabelWidth, 8, "Check-in", 1);
    $pdf->Cell($rightValueWidth, 8, (string) date("d-m-Y", strtotime($data['check_in_date'])), 1);
    $pdf->Ln();

    // Row 4
    $pdf->Cell($leftLabelWidth, 8, "Address", 1);
    $pdf->Cell($leftValueWidth, 8, $data['Address'], 1);
    $pdf->Cell($rightLabelWidth, 8, "Check-out", 1);
    $pdf->Cell($rightValueWidth, 8, (string) date("d-m-Y", strtotime($data['check_out_date'])), 1);
    $pdf->Ln();

    // Row 5
    $pdf->Cell($leftLabelWidth, 8, "State", 1);
    $pdf->Cell($leftValueWidth, 8, $data['state'], 1);
    $pdf->Cell($rightLabelWidth, 8, "Number of Children", 1);
    $pdf->Cell($rightValueWidth, 8, (string) $data['child'], 1);
    $pdf->Ln();

    // Row 6 - Date of Birth
    $pdf->Cell($leftLabelWidth, 8, "DOB", 1);
    $pdf->Cell($leftValueWidth, 8, date("d-m-Y", strtotime($data['DOB'])), 1);
    $pdf->Cell($rightLabelWidth, 8, "Number of Adults", 1);
    $pdf->Cell($rightValueWidth, 8, (string) $data['adult'], 1);
    $pdf->Ln();


    // Row 7
    $pdf->Cell($rightLabelWidth, 8, "Booked At", 1);
    $pdf->Cell($rightValueWidth, 8, date("d-m-Y h:i A", strtotime($data['created_at'])), 1);
    $pdf->Ln();

    // Total Price
    $pdf->SetFillColor(176, 196, 222);
    $pdf->Cell($leftLabelWidth + $leftValueWidth + $rightLabelWidth, 8, "Total Price", 1, 0, 'R', true);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell($rightValueWidth, 8, "Rs. " . number_format($data['total_price'], 2) . "/-", 1, 1, 'R', true);
    $pdf->Ln(5);

    // Note
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 8, "We provide our guests with a completely smoke-free environment.");

    $pdf->Cell(0, 10, 'Thank you for booking with us!', 0, 1, 'C');

    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 6, 'DreamNight Hotel, 123 Hospitality Lane, Tourism City, TC 12345', 0, 1, 'C');
    $pdf->Cell(0, 6, 'Phone: 940-818-6776 | Email: info@dreamnighthotel.com | www.dreamnighthotel.com', 0, 1, 'C');

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="booking_confirmation.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');

    $pdf->Output('booking_confirmation.pdf', 'D');
}

generateBookingPDF($data);
