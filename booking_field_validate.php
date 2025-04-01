<?php
session_start();
header('Content-Type: application/json');

$errors = [];
$status = "success";

// Validate Check-in Date
if (empty($_POST["checkin1"])) {
    $errors["checkin1"] = "Check-in date is required.";
}

// Validate Check-out Date
if (empty($_POST["checkout1"])) {
    $errors["checkout1"] = "Check-out date is required.";
} elseif ($_POST["checkout1"] == $_POST["checkin1"]) {
    $errors["checkout1"] = " check-in and Check-out date must be different";
} elseif (!empty($_POST["checkin1"]) && $_POST["checkout1"] <= $_POST["checkin1"]) {
    $errors["checkout1"] = "Check-out date must be after check-in date.";
}

// Validate Adults
if (!isset($_POST["adults"]) || !filter_var($_POST["adults"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
    $errors["adults"] = "Please enter a valid number of adults.";
}

// Validate Children
if (!isset($_POST["children"])) {
    $errors["children"] = "Please enter a valid number of children.";
}

// If there are errors, update status
if (!empty($errors)) {
    $status = "error";
}
echo json_encode(["status" => $status, "errors" => $errors]);
?>
