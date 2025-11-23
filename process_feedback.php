<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $rating = htmlspecialchars($_POST['rating']);
    $comments = htmlspecialchars($_POST['comments']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback_db";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("connection failed: " .$conn->connect_error);
}
$sql = "INSERT INTO feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis",$name,$email,$rating,$comments);

if($stmt->execute()){
echo "<h1>Thank you for your feedback</h1>";
echo "<p>Your feedback has been recorded successfully.</p>";
}
else{
    echo "<h1>ERROR,/h1><p>Could not submit form.please try again later.<p>";
}

$stmt->close();
$conn->close();
}
else{
    echo "<h1>Invalid Access</h1><p>This page is only accessible through the feedback form.</p>";

}

?>