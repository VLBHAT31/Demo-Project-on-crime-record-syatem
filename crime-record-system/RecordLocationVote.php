<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "crime_record";

$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $selectedLocation = $_POST["selectedLocation"];

  $checkLocationQuery = "SELECT * FROM vote_counts WHERE location = '$selectedLocation'";
  $locationResult = mysqli_query($conn, $checkLocationQuery);

  if (mysqli_num_rows($locationResult) > 0) {
    $updateVoteQuery = "UPDATE vote_counts SET vote = vote + 1 WHERE location = '$selectedLocation'";

    if (mysqli_query($conn, $updateVoteQuery)) {
      $response = array("message" => "Voted successfully");
    } else {
      $response = array("message" => "Voting is unsuccessful");
    }
  } else {
    $insertVoteQuery = "INSERT INTO vote_counts (location, vote) VALUES ('$selectedLocation', 1)";

    if (mysqli_query($conn, $insertVoteQuery)) {
      $response = array("message" => "Voted successfully");
    } else {
      $response = array("message" => "Voting is unsuccessful");
    }
  }

  echo json_encode($response);
}

$conn->close();
?>
