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
    $job_title = $_POST['job_title'];
    $description = $_POST['description'];
    $status = 'open';

    $query = "INSERT INTO recruitments (job_title, description, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $job_title, $description, $status);
    $stmt->execute();
}

$query = "SELECT * FROM recruitments";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recruitment Management</title>
</head>
<body>
    <h1>Recruitment Management</h1>

    <form action="recruitment-management.php" method="POST">
        <input type="text" name="job_title" placeholder="Job Title" required>
        <textarea name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Add Job</button>
    </form>

    <h2>All Job Postings</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Job Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Posted Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['job_title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['posted_date']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
	<?php include '../includes/footer.php'; ?>
</body>
</html>
