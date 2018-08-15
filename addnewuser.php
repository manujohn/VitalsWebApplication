<?php
session_start();
if($_POST['cpwd']==$_POST['pwd'])
{
$conn = new mysqli("localhost", "user", "user","db1");
if ($conn->connect_error) {
    die("Connection failed");
} 
$firstname = $_POST['name'];
$lastname = $_POST['surname'];
$mobileno = $_POST['phone'];
$mail =  $_POST['email'];
$password =  $_POST['pwd'];

$result = mysqli_query($conn, "SELECT * FROM USER_DETAILS
    WHERE MobileNo IN ('$mobileno')");

while ($row = mysqli_fetch_array($result))
{
$_session['error']=1;	
header("Location: index.php#signup");
mysqli_close($conn);
exit;
}
mysqli_query($conn, "insert into USER_DETAILS(Username,MobileNo,Password) VALUES('$firstname','$mobileno','$password')");
mysqli_query($conn, "insert into PROFILE(MobileNo,First_name,Second_name,Email,Profile_type) VALUES('$mobileno','$firstname','$lastname','$mail','Patient')");
header("Location: index.php#signin");
mysqli_close($conn);
exit;
}
else
{
	header("Location: index.php#signup");
}
?>