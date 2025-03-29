<?php
session_start();
include 'settings.php'; // Include database connection variables

// Connect to the database
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the manager is logged in
if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['list_all'])) {
        // List all EOIs
        $query = "SELECT * FROM eoi";
        $result = $conn->query($query);
    } elseif (isset($_POST['list_by_position'])) {
        // List EOIs by job reference number
        $job_ref = $conn->real_escape_string($_POST['job_reference_number']);
        $query = "SELECT * FROM eoi WHERE job_reference_number = '$job_ref'";
        $result = $conn->query($query);
    } elseif (isset($_POST['list_by_applicant'])) {
        // List EOIs by applicant name
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $query = "SELECT * FROM eoi WHERE first_name LIKE '%$first_name%' AND last_name LIKE '%$last_name%'";
        $result = $conn->query($query);
    } elseif (isset($_POST['delete_by_position'])) {
        // Delete EOIs by job reference number
        $job_ref = $conn->real_escape_string($_POST['job_reference_number']);
        $query = "DELETE FROM eoi WHERE job_reference_number = '$job_ref'";
        $conn->query($query);
        $message = "All EOIs with job reference number $job_ref have been deleted.";
    } elseif (isset($_POST['change_status'])) {
        // Change the status of an EOI
        $eoi_id = $conn->real_escape_string($_POST['eoi_id']);
        $new_status = $conn->real_escape_string($_POST['status']);
        $query = "UPDATE eoi SET status = '$new_status' WHERE eoi_id = '$eoi_id'";
        $conn->query($query);
        $message = "Status of EOI ID $eoi_id has been updated to $new_status.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage EOIs</title>
</head>
<body>
    <h1>Manage EOIs</h1>

    <!-- Display messages -->
    <?php if (isset($message)) echo "<p>$message</p>"; ?>

    <!-- Form to list all EOIs -->
    <form method="POST">
        <button type="submit" name="list_all">List All EOIs</button>
    </form>

    <!-- Form to list EOIs by job reference number -->
    <form method="POST">
        <label for="job_reference_number">Job Reference Number:</label>
        <input type="text" name="job_reference_number" required>
        <button type="submit" name="list_by_position">List EOIs by Position</button>
    </form>

    <!-- Form to list EOIs by applicant name -->
    <form method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name">
        <button type="submit" name="list_by_applicant">List EOIs by Applicant</button>
    </form>

    <!-- Form to delete EOIs by job reference number -->
    <form method="POST">
        <label for="job_reference_number">Job Reference Number:</label>
        <input type="text" name="job_reference_number" required>
        <button type="submit" name="delete_by_position">Delete EOIs by Position</button>
    </form>

    <!-- Form to change the status of an EOI -->
    <form method="POST">
        <label for="eoi_id">EOI ID:</label>
        <input type="text" name="eoi_id" required>
        <label for="status">New Status:</label>
        <input type="text" name="status" required>
        <button type="submit" name="change_status">Change Status</button>
    </form>

    <!-- Display results -->
    <?php if (isset($result) && $result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>EOI ID</th>
                <th>Job Reference Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['eoi_id']; ?></td>
                    <td><?php echo $row['job_reference_number']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif (isset($result)): ?>
        <p>No results found.</p>
    <?php endif; ?>

</body>
</html>