<?php
session_start();
$conn = new mysqli("localhost", "user", "user","db1");
if ($conn->connect_error) {
    die("Connection failed");
} 
$mobileno = $_POST['mobileno']; 
$_SESSION['flag']=0;
$_SESSION['invalid'] = "*Invalid username and password";
$password = $_POST['password'];
$result = mysqli_query($conn, "SELECT * FROM USER_DETAILS
    WHERE MobileNo IN ('$mobileno') AND Password IN ('$password')");

while ($row = mysqli_fetch_array($result))
{
	$_SESSION['mobile']=$mobileno;
	$_SESSION['user']=$row['Username'];
header("Location: login/index.php?user=".$row['Username']);
mysqli_close($conn);
exit;
}
header("Location: index.php#signin");
mysqli_close($conn);
exit;
?>