<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the POST request
    $u_name = $_POST['name'];
    $u_id = $_POST['email'];
    $u_pass = $_POST['password'];
    $u_addr = $_POST['address'];
    $a_no = $_POST['aadhar_number'];
    $gen = $_POST['gender'];
    $mob = $_POST['mobile_number'];

    // Establish a connection to the MySQL database
    $con = mysqli_connect('localhost', 'root', '', 'crime_portal');
    if (!$con) {
        die('could not connect: ' . mysqli_error());
    }

    // Insert user data into the database
    $reg = "INSERT INTO user (u_name, u_id, u_pass, u_addr, a_no, gen, mob)
    VALUES ('$u_name', '$u_id', '$u_pass', '$u_addr', '$a_no', '$gen', '$mob')";

    mysqli_select_db($con, "crime_portal");
    $res = mysqli_query($con, $reg);
    if (!$res) {
        $response = array("message" => "User Already Exists");
    } else {
        $response = array("message" => "User Registered Successfully");
    }

    echo json_encode($response);
}
?>
