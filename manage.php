<?php
session_start();
require 'settings.php';

// Check if the manager is logged in
if (!isset($_SESSION["manager"])) {
    header("Location: register.php");
    exit();
}
if ($_SESSION["manager"] !== "admin") {
    header("Location: jobs.php");
    exit();
}

// Initialize variables
$eois = [];
$notification = "";

// Job reference number
if (isset($_POST["view_by_job"])) {
    $jobRef = trim($_POST["job_reference_number"]);

    if (!empty($jobRef)) {
        $stmt = $pdo->prepare("SELECT * FROM eoi WHERE job_reference_number = ?");
        $stmt->execute([$jobRef]);
        $eois = $stmt->fetchAll();

        if (empty($eois)) {
            $notification = "No EOIs found for the job reference number: $jobRef.";
        }
    } else {
        $notification = "Please enter a job reference number.";
    }
}

// Viewing EOIs by applicant name
if (isset($_POST["view_by_name"])) {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);

    if (!empty($firstName) || !empty($lastName)) {
        $stmt = $pdo->prepare("SELECT * FROM eoi WHERE first_name LIKE ? AND last_name LIKE ?");
        $stmt->execute(["%$firstName%", "%$lastName%"]);
        $eois = $stmt->fetchAll();

        if (empty($eois)) {
            $notification = "No EOIs found for the applicant name: $firstName $lastName.";
        }
    } else {
        $notification = "Please enter at least one name field.";
    }
}

// EOIs deletions by job reference number
if (isset($_POST["delete"])) {
    $jobRef = trim($_POST["job_reference_number"]);

    if (!empty($jobRef)) {
        $stmt = $pdo->prepare("DELETE FROM eoi WHERE job_reference_number = ?");
        $stmt->execute([$jobRef]);
        $deletedCount = $stmt->rowCount();

        if ($deletedCount > 0) {
            $notification = "Deleted $deletedCount EOIs with job reference number: $jobRef.";
        } else {
            $notification = "No EOIs found to delete for the job reference number: $jobRef.";
        }
    } else {
        $notification = "Please enter a job reference number to delete.";
    }
}


if (empty($eois) && !isset($_POST["view_by_job"]) && !isset($_POST["view_by_name"])) {
    $stmt = $pdo->query("SELECT * FROM eoi");
    $eois = $stmt->fetchAll();
}

if (isset($_POST["update_status"])) {
    $eoi_id = $_POST["eoi_id"];
    $new_status = $_POST["status"];
    $stmt = $pdo->prepare("UPDATE eoi SET status = ? WHERE eoi_id = ?");
    $stmt->execute([$new_status, $eoi_id]);
    echo "<div class='notification'>Status updated successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage EOIs</title>
    <link rel="stylesheet" href="styles/manage.css">
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <div class="form-section">
                <h2>Manage EOIs</h2>

                <!-- Notification -->
                <?php if (!empty($notification)): ?>
                    <div class="notification"><?php echo htmlspecialchars($notification); ?></div>
                <?php endif; ?>
                <form method="post">
                    <label>Enter job reference number to view EOIs:</label>
                    <input type="text" name="job_reference_number"vplaceholder="Job Reference Number">
                    <button type="submit" name="view_by_job">View</button>
                </form>
                <form method="post">
                    <label>Enter applicant name to view EOIs:</label>
                    <input type="text" name="first_name" placeholder="First Name">
                    <input type="text" name="last_name" placeholder="Last Name">
                    <button type="submit" name="view_by_name">View</button>
                </form>
                <form method="post">
                    <label>Enter job reference number to delete all EOIs:</label>
                    <input type="text" name="job_reference_number" placeholder="Choose EOIs to delete">
                    <button type="submit" name="delete">Delete</button>
                </form>
                <form method="post">
                    <label>Update EOI status:</label>
                    <input type="text" name="eoi_id" placeholder="EOI ID">
                    <select name="status">
                        <option value="New">New</option>
                        <option value="Current">Current</option>
                        <option value="Final">Final</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Job Reference Number</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Skills</th>
                    <th>Status</th>
                </tr>
                <?php if (!empty($eois)): ?>
                    <?php foreach ($eois as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['eoi_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['job_reference_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['street_address'] . ', ' . $row['suburb'] . ', ' . $row['state'] . ' ' . $row['postcode']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['skill1'] . ', ' . $row['skill2'] . ', ' . $row['skill3']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
