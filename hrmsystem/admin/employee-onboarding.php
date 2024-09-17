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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $status = $_POST['status'];

    $query = "INSERT INTO employees (name, email, position, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $name, $email, $position, $status);
    $stmt->execute();
}

$query = "SELECT * FROM employees";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Onboarding</title>
</head>
<body>
    <h1>Employee Onboarding</h1>

    <form action="employee-onboarding.php" method="POST">
        <input type="text" name="name" placeholder="Employee Name" required>
        <input type="email" name="email" placeholder="Employee Email" required>
        <input type="text" name="position" placeholder="Position" required>
        <select name="status">
            <option value="onboard">Onboard</option>
            <option value="passed">Passed</option>
            <option value="failed">Failed</option>
        </select>
        <button type="submit">Add Employee</button>
    </form>

    <h2>All Employees</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
	<?php include '../includes/footer.php'; ?>
</body>
</html>
