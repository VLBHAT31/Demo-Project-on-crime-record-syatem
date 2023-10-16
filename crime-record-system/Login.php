<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $aadharNumber = $_POST['aadhar_number']; // New field

    $con = mysqli_connect('localhost', 'root', '', 'crime_portal');
    if (!$con) {
        die('could not connect: ' . mysqli_error());
    }

    $query = "SELECT * FROM user WHERE u_id = '$email' AND u_pass = '$password' AND a_no = '$aadharNumber'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $response = array("message" => "Login Successful");
    } else {
        $response = array("message" => "Login Failed");
    }

    echo json_encode($response);
}
?>
