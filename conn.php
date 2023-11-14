<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$name = $_POST['name'];
$username =$_POST['username']; 
$password = $_POST['password']; 
$email= $_POST['email'];
$confirmPassword= $_POST['confirmPassword'];
$phone = $_POST['phone']; 
$bdate = $_POST['bdate']; 
//Database connection
$conn = new mysqli('localhost', 'root',' ','demo');
if($conn->connect_error) 
{
    die('Connection Failed : '.$conn->connect_error);
}
else
{
    $stmt = $conn->prepare("insert into test (name, username, password,email,confirmPassword,phone,bdate)values(?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssis", $name, $username, $password, $confirmPassword, $email, $phone,$DOB);
    $stmt->execute();
    echo "registration Successfully...";
    $stmt->close();
    $conn->close();
}
}
?>