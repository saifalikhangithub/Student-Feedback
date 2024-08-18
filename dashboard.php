<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "student_feedback");
$department = $_SESSION['department'];
$student_id = $_SESSION['student_id'];

$result = mysqli_query($conn, "SELECT * FROM faculty WHERE department='$department'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        h2 {
            margin-top: 0;
        }
        textarea {
            width: 100%;
            height: 80px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="logout.php" class="logout-btn">Logout</a>
    <h2>Faculty in <?php echo $department; ?> Department</h2>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . $row['name'] . "</p>";
            echo "<form method='POST' action='submit_feedback.php'>";
            echo "<input type='hidden' name='faculty_id' value='" . $row['id'] . "'>";
            echo "<textarea name='feedback' required></textarea><br>";
            echo "<input type='submit' value='Submit Feedback'>";
            echo "</form>";
        }
    } else {
        echo "No faculty found for your department.";
    }
    ?>
</div>

</body>
</html>
