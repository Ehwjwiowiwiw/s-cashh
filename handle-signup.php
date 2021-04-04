<?php 

session_start();
include 'connection.php';

$fullName = $_POST['FullName'];
$UserEmail = $_POST['Uemail'];
$UserPass = $_POST['password'];
$confpass=$_POST['confpassword'];
$UserPhone = $_POST['phone'];




$errors=[];

// validation of name
if(empty($fullName))
{
$errors[]= "fullName is required";
}elseif(! is_string($fullName))
{
    $errors[]="you should enter string fullName";
}elseif( strlen($fullName) < 5 or strlen($fullName) > 255 )
{
$errors[]="fullName min is 5 and max is 255";
}



    // validate email 
    if (empty($UserEmail)) {
        $errors[] = 'email is required';
    } elseif (! filter_var($UserEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'email is not valid';
    }

    //validate password
    if(empty($UserPass))
    {
        $errors[]= 'password is required';
    }

    //validation verify password
    if(empty($confpass))
    {
        $errors[]= 'confirm password is required';
    }else if($confpass !== $UserPass)
    {
        $errors[]= "enter right password ";
    }


//validation of phonr
if(empty($UserPhone))
{
    $errors[]="us$UserPhone is required";
}elseif(! is_numeric($UserPhone))
{
    $errors[]="you should enter phone ";
}

if(empty($errors))
{
$_SESSION['success'] = 'user added successful';
header("location: login.php");


}else{
    $_SESSION['errors']=$errors;
    header("location: signup.php");
}



$q = "INSERT INTO users (FullName,UserEmail,UserPassword,UserPhone) VALUES ('$fullName','$UserEmail','$UserPass','$UserPhone')";

$newRes = mysqli_query($con, $q);


?>