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
    $review_text = $_POST['review_text'];
    $score = $_POST['score'];

    $query = "INSERT INTO performance_reviews (employee_id, review_text, score) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isi', $employee_id, $review_text, $score);
    $stmt->execute();
}

$query = "SELECT * FROM performance_reviews";
$result = $conn->query($query);

$query2 = "SELECT id, name FROM employees";
$employees = $conn->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Performance Management</title>
</head>
<body>
    <h1>Performance Management</h1>

    <form action="performance-management.php" method="POST">
        <select name="employee_id">
            <?php while ($row = $employees->fetch_assoc()) : ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <textarea name="review_text" placeholder="Review" required></textarea>
        <input type="number" name="score" min="1" max="10" placeholder="Score (1-10)" required>
        <button type="submit">Add Review</button>
    </form>

    <h2>Performance Reviews</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Review</th>
            <th>Score</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['employee_id']; ?></td>
                <td><?php echo $row['review_text']; ?></td>
                <td><?php echo $row['score']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
	
<?php include '../includes/footer.php'; ?>

</body>
</html>
