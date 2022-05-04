<?php
$connect = mysqli_connect("localhost","root",'',"seprojectdb");
//Sending form data to sql db.
mysqli_query($connect,"INSERT INTO users (first_name, last_name, phone_number, password)
VALUES ('$_POST[post_category]', '$_POST[post_title]', '$_POST[post_contents]', '$_POST[post_tags]')";
/*include 'db_connection.php';

$first_name = $_POST["fisrt_name"];


$query = $mysqli->prepare("INSERT INTO users (first_name) VALUES (?)");
$query->bind_param("s", $first_name);
$query->execute();

$response = [];
$response["status"] = "Mabrouk!";

$json_response = json_encode($response);
echo $json_response;
*/
?>