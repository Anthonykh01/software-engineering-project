<?php
require('../Connecttodb/logindb.php');
$fname=$lname=$pnumber=$dob=$username=$password="";
$dID = 0;
$result1=$result2=$result3=False;
session_start();

if (isset($_POST['submit'])){
    if(isset($_POST['firstname'])){
        $fname = $mysqli->real_escape_string($_POST['firstname']);
    }else{
        die("don't try it");
    }
    if(isset($_POST['lastname'])){
        $lname = $mysqli->real_escape_string($_POST['lastname']);
    }else{
        die("don't try it");
    }
    if(isset($_POST['phonenumber'])){
        $pnumber = $mysqli->real_escape_string($_POST['phonenumber']);
    }else{
        die("don't try it");
    }
    if(isset($_POST['dob'])){
        $dob = $mysqli->real_escape_string($_POST['dob']);
    }else{
        die("don't try it");
    }
    if(isset($_POST['username'])){
        $username = $mysqli->real_escape_string($_POST['username']);
    }else{
        die("don't try it");
    }
    if(isset($_POST['pass'])){
        $password = hash("sha256",$mysqli->real_escape_string($_POST['pass']));
    }else{
        die("don't try it");
    }

    $stmtinsert = $mysqli->prepare("INSERT INTO user(username, password ) VALUES (?,?)");
    $stmtinsert->bind_param("ss", $username,$password);
    $result1 = $stmtinsert->execute(); 

    $query = $mysqli->prepare("SELECT user_id FROM user WHERE username = ? AND password = ? ");
    $query->bind_param('ss', $username, $password);
    $query->execute();
    $query->store_result();
    $query->bind_result($dID);
    $query->fetch();
    
    if($_POST['member_level'] == "Driver"){
            $stmtinsert = $mysqli->prepare("INSERT INTO driver(driver_id, first_name, last_name, phone_number, date_of_birth) VALUES (?,?,?,?,?)");
            $stmtinsert->bind_param('issss', $dID, $fname, $lname, $pnumber, $dob);
            $result2 = $stmtinsert->execute();
    
    }else if($_POST['member_level'] == "Passenger"){
            $stmtinsert = $mysqli->prepare("INSERT INTO passenger(passenger_id,first_name, last_name, phone_number, date_of_birth) VALUES (?,?,?,?,?)");
            $stmtinsert->bind_param('issss', $dID, $fname, $lname, $pnumber, $dob);
            $result3 = $stmtinsert->execute(); 
    }

    if($result1 AND ($result2 OR $result3)){
        header("Location: ./../");
         }
    else{
     die($mysqli->error);
        }

}


?>


