<?php
session_start();
include '../includes/header.php';
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../includes/DBConnection.php';
$db = new DBConnection();
$conn = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $training_name = $_POST['training_name'];
    $status = $_POST['status'];

    $query = "INSERT INTO trainings (employee_id, training_name, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $employee_id, $training_name, $status);
    $stmt->execute();
}

$query = "SELECT * FROM trainings";
$result = $conn->query($query);

$query2 = "SELECT id, name FROM employees";
$employees = $conn->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learning Management</title>
</head>
<body>
    <h1>Learning Management</h1>

    <form action="learning-management.php" method="POST">
        <select name="employee_id">
            <?php while ($row = $employees->fetch_assoc()) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="training_name" placeholder="Training Name" required>
        <select name="status">
            <option value="completed">Completed</option>
            <option value="in_progress">In Progress</option>
            <option value="not_started">Not Started</option>
			
			<?php include '../includes/footer.php'; ?>
       
