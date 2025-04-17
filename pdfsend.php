<?php

require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

// Layout variables
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

// // Image
$pdf->Image('img\rooms\67dd778fad7e05.png', 10, 40, 100, 50);

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
$pdf->Cell(0, 10, "Dear Mr. Neelkumar Sarvaiya,", 0, 1, 'L');
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
$pdf->Cell($leftValueWidth, 8, "NeelKumar Sarvaiya", 1);
$pdf->Cell($rightLabelWidth, 8, "Room Name", 1);
$pdf->Cell($rightValueWidth, 8, "Supreme Room", 1);
$pdf->Ln();

// Row 2
$pdf->Cell($leftLabelWidth, 8, "Email", 1);
$pdf->Cell($leftValueWidth, 8, "nsarvaiya631@rku.ac.in", 1);
$pdf->Cell($rightLabelWidth, 8, "Room Number", 1);
$pdf->Cell($rightValueWidth, 8, "301", 1);
$pdf->Ln();

// Row 3
$pdf->Cell($leftLabelWidth, 8, "Phone no.", 1);
$pdf->Cell($leftValueWidth, 8, "1234567890", 1);
$pdf->Cell($rightLabelWidth, 8, "Check-in", 1);
$pdf->Cell($rightValueWidth, 8, "17-04-2024", 1);
$pdf->Ln();

// Row 4
$pdf->Cell($leftLabelWidth, 8, "Address", 1);
$pdf->Cell($leftValueWidth, 8, "Rajkot, Gujrat", 1);
$pdf->Cell($rightLabelWidth, 8, "Check-out", 1);
$pdf->Cell($rightValueWidth, 8, "20-04-2024", 1);
$pdf->Ln();

// Row 5
$pdf->Cell($leftLabelWidth, 8, "Date of Birth", 1);
$pdf->Cell($leftValueWidth, 8, "22-03-2007", 1);
$pdf->Cell($rightLabelWidth, 8, "Number of Children", 1);
$pdf->Cell($rightValueWidth, 8, "4", 1);
$pdf->Ln();

// Row 6
$pdf->Cell($leftLabelWidth, 8, "State", 1);
$pdf->Cell($leftValueWidth, 8, "Gujrat", 1);
$pdf->Cell($rightLabelWidth, 8, "Number of Adults", 1);
$pdf->Cell($rightValueWidth, 8, "6", 1);
$pdf->Ln();

// Total Price row
// $pdf->SetFillColor(100, 149, 237);
// $pdf->SetFillColor(135, 206, 237);
$pdf->SetFillColor(176, 196, 222);
$pdf->Cell($leftLabelWidth + $leftValueWidth + $rightLabelWidth, 8, "Total Price", 1, 0, 'R', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($rightValueWidth, 8, "Rs. 10,000/-", 1, 1, 'R', true);
$pdf->Ln(5);

// Note
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 8, "We provide our guests with a completely smoke-free environment.");

// Output
$pdf->Output('D','booking-receipt'.'.pdf');

echo "<script>alert('Booking session expired. Please book again.'); window.location.href = 'rooms.php';</script>";
