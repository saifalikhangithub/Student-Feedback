<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "student_feedback");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['student_id'];
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    $sql = "INSERT INTO feedback (student_id, faculty_id, feedback) VALUES ('$student_id', '$faculty_id', '$feedback')";
    if (mysqli_query($conn, $sql)) {
        echo "Feedback submitted successfully!";
        header("Location: dashboard.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
