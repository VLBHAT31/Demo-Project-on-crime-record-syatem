<?php
// Set CORS headers to allow requests from any origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "crime_record";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$voteCountsQuery = "SELECT * FROM vote_counts";
$voteCountsResult = $conn->query($voteCountsQuery);

$voteCounts = array();

if ($voteCountsResult->num_rows > 0) {
    while ($row = $voteCountsResult->fetch_assoc()) {
        $voteCounts[] = array(
            "location" => $row["location"],
            "vote" => $row["vote"]
        );
    }
}

$conn->close();

echo json_encode(array("voteCounts" => $voteCounts));
?>
