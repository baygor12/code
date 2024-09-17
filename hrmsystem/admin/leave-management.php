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
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = 'pending';

    $query = "INSERT INTO leaves (employee_id, leave_type, start_date, end_date, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issss', $employee_id, $leave_type, $start_date, $end_date, $status);
    $stmt->execute();
}

$query = "SELECT * FROM leaves";
$result = $conn->query($query);

$query2 = "SELECT id, name FROM employees";
$employees = $conn->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave Management</title>
</head>
<body>
    <h1>Leave Management</h1>

    <form action="leave-management.php" method="POST">
        <select name="employee_id">
            <?php while ($row = $employees->fetch_assoc()) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <select name="leave_type" required>
            <option value="vacation">Vacation</option>
            <option value="sick">Sick</option>
            <option value="maternity">Maternity</option>
        </select>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Submit Leave</button>
    </form>

    <h2>Leave Records</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['employee_id']; ?></td>
                <td><?php echo $row['leave_type']; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['end_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
	<?php include '../includes/footer.php'; ?>
</body>
</html>
