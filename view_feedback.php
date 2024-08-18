<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "student_feedback");

$department = '';
$feedback_data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    // Fetch feedback data for the selected department
    $sql = "SELECT faculty.name AS teacher_name, students.name AS student_name, feedback.feedback 
            FROM feedback 
            JOIN faculty ON feedback.faculty_id = faculty.id 
            JOIN students ON feedback.student_id = students.id 
            WHERE faculty.department = '$department'";
    
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $feedback_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        select, input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>View Feedback</h2>
    <a href="index.php"><input type="button" value="Home Page"></a>
    <form method="POST" action="view_feedback.php">
        <br><label>Select Department:</label>
        <select name="department" required>
            <option value="" selected disabled>Select Department</option>
            <option value="BCA" <?php if ($department == 'BCA') echo 'selected'; ?>>BCA</option>
            <option value="MBA" <?php if ($department == 'MBA') echo 'selected'; ?>>MBA</option>
            <option value="PhD" <?php if ($department == 'PhD') echo 'selected'; ?>>PhD</option>
        </select><br>
        <input type="submit" value="View Feedback">
    </form>

    <?php if (!empty($feedback_data)): ?>
        <h3>Feedback for <?php echo htmlspecialchars($department); ?> Department</h3>
        <table>
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Student</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedback_data as $feedback): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($feedback['teacher_name']); ?></td>
                        <td><?php echo htmlspecialchars($feedback['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($feedback['feedback']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No feedback found for the selected department.</p>
    <?php endif; ?>
</div>

</body>
</html>
