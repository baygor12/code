<?php
session_start();
include '../includes/header.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome, Admin</h1>
    <ul>
        <li><a href="admin/applicant-management.php">Applicant Management</a></li>
        <li><a href="admin/recruitment-management.php">Recruitment Management</a></li>
        <li><a href="admin/employee-onboarding.php">Employee Onboarding</a></li>
        <li><a href="admin/performance-management.php">Performance Management</a></li>
        <li><a href="admin/disciplinary-management.php">Disciplinary Management</a></li>
        <li><a href="admin/time-attendance.php">Time and Attendance</a></li>
        <li><a href="admin/leave-management.php">Leave Management</a></li>
        <li><a href="admin/reports-analytics.php">Reports & Analytics</a></li>
        <li><a href="admin/learning-management.php">Learning Management</a></li>
    </ul>
	<?php include '../includes/footer.php'; ?>
</body>
</html>
