<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $phone = $_POST['phone'];
    $cgpa = $_POST['cgpa'];
    $batch = $_POST['batch'];

    $sql = "INSERT INTO students (student_name, student_id, phone, cgpa, batch) 
            VALUES ('$name', '$student_id', '$phone', '$cgpa', '$batch')";
    mysqli_query($conn, $sql);

    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Add Student</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="text" name="student_id" placeholder="Student ID" required><br>
        <input type="text" name="phone" placeholder="Phone" required><br>
        <input type="number" step="0.01" name="cgpa" placeholder="CGPA" required><br>
        <input type="text" name="batch" placeholder="Batch" required><br>
        <button type="submit" name="save">Save</button>
    </form>
</div>
</body>
</html>
