<?php
$name=$_POST['name'];
$address=$_POST['address'];
$phone=$_POST['phoneno'];
$username = $_POST['userid'];
$password = $_POST['password'];
$role=$_POST['role'];
$conn = mysqli_connect('localhost', 'root', '', 'quiz_database') or die ("connection failed");
$sql = "INSERT INTO user VALUES ('$name','$address','$phone','$username', '$password','$role')";
$result=mysqli_query($conn,$sql) or die ("query failed");
echo "Successfull";
header("Location: login.html");
?>