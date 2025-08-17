<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['search_id']) && $_GET['search_id'] != "") {
    $search_id = $_GET['search_id'];
    $students = mysqli_query($conn, "SELECT * FROM students WHERE student_id LIKE '%$search_id%'");
} else {
    $students = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-bar">
    <img src="uploads/profile.png" alt="Profile" class="profile-logo">
    <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
    <a href="logout.php" class="logout-btn add-btn">Logout</a>
</div>

<div class="container2">
    <h2>Student List</h2>
    <a href="add_student.php" class="add-btn"> Add Student</a> <!--add-btn class-->
    <form method="GET" action="dashboard.php" style="margin-bottom:15px;">
    <input type="text" name="search_id" placeholder="Enter Student ID" 
        value="<?php if(isset($_GET['search_id'])) echo $_GET['search_id']; ?>">
        <button type="submit">Search</button>
        <a href="dashboard.php" style="margin-left:10px;" class="add-btn">Reset</a>
    </form>
    <table>
        <tr>
            <th>Name</th>
            <th>ID</th>
            <th>Phone</th>
            <th>CGPA</th>
            <th>Batch</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($students)) { ?>
        <tr>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['cgpa']; ?></td>
            <td><?php echo $row['batch']; ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="delete_student.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this student?');">Delete</a>
            </td>

        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
