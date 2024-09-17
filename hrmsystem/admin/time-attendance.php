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
    $date = $_POST['date'];
    $clock_in = $_POST['clock_in'];
    $clock_out = $_POST['clock_out'];

    $query = "INSERT INTO attendance (employee_id, date, clock_in, clock_out) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isss', $employee_id, $date, $clock_in, $clock_out);
    $stmt->execute();
}

$query = "SELECT * FROM attendance";
$result = $conn->query($query);

$query2 = "SELECT id, name FROM employees";
$employees = $conn->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Time and Attendance</title>
</head>
<body>
    <h1>Time and Attendance</h1>

    <form action="time-attendance.php" method="POST">
        <select name="employee_id">
            <?php while ($row = $employees->fetch_assoc()) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="date" name="date" required>
        <input type="time" name="clock_in" placeholder="Clock In" required>
        <input type="time" name="clock_out" placeholder="Clock Out" required>
        <button type="submit">Submit Attendance</button>
    </form>

    <h2>Attendance Records</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Date</th>
            <th>Clock In</th>
            <th>Clock Out</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['employee_id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['clock_in']; ?></td>
                <td><?php echo $row['clock_out']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
	<?php include '../includes/footer.php'; ?>
</body>
</html>
