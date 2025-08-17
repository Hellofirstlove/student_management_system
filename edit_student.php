<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get student ID from URL
$id = $_GET['id'];

// Fetch current student info
$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "Student not found!";
    exit();
}

// Handle form submission
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $phone = $_POST['phone'];
    $cgpa = $_POST['cgpa'];
    $batch = $_POST['batch'];

    $sql = "UPDATE students 
            SET student_name='$name', student_id='$student_id', phone='$phone', cgpa='$cgpa', batch='$batch'
            WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Student</h2>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $student['student_name']; ?>" required><br>
        <input type="text" name="student_id" value="<?php echo $student['student_id']; ?>" required><br>
        <input type="text" name="phone" value="<?php echo $student['phone']; ?>" required><br>
        <input type="number" step="0.01" name="cgpa" value="<?php echo $student['cgpa']; ?>" required><br>
        <input type="text" name="batch" value="<?php echo $student['batch']; ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
