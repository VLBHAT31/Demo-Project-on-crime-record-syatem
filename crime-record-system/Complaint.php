<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow requests from any domain (not recommended for production)
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Allow POST and OPTIONS requests
header("Access-Control-Allow-Headers: Content-Type"); 

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crime_record";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Extract data from the JSON object
$aadhar_number = $data['aadhar_number'];
$location = $data['location'];
$date = $data['date'];
$crime_type = $data['crime_type'];
$description = $data['description'];

// Insert data into the complaint table
$sql = "INSERT INTO complaint (aadharNumber, location, date, crime_type, description)
        VALUES ('$aadhar_number', '$location', '$date', '$crime_type', '$description')";

if ($conn->query($sql) === TRUE) {
    $response = array("message" => "Complaint submitted successfully");
    echo json_encode($response);
} else {
    $response = array("error" => "Error submitting complaint: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
