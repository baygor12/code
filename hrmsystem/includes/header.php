<?php
// header.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Management System</title>
    <link rel="stylesheet" href="../styles/style.css"> <!-- Link to your CSS file -->
    <script src="../scripts/script.js" defer></script> <!-- Link to your JavaScript file -->
</head>
<body>
    <header>
        <h1>HR Management System</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="applicant-management.php">Applicant Management</a></li>
                <li><a href="recruitment-management.php">Recruitment Management</a></li>
                <li><a href="employee-onboarding.php">Employee Onboarding</a></li>
                <li><a href="performance-management.php">Performance Management</a></li>
                <li><a href="disciplinary-management.php">Disciplinary Management</a></li>
                <li><a href="time-attendance.php">Time and Attendance</a></li>
                <li><a href="leave-management.php">Leave Management</a></li>
                <li><a href="reports-analytics.php">Reports and Analytics</a></li>
                <li><a href="learning-management.php">Learning Management</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
