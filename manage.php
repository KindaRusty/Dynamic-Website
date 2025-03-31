<?php
session_start();
require 'settings.php';

// Check if the manager is logged in
if (!isset($_SESSION["manager"])) {
    header("Location: manage.php");
    exit();
}

// Handle deletion of EOIs by job reference number
if (isset($_POST["delete"])) {
    $jobRef = $_POST["job_reference_number"];
    $stmt = $pdo->prepare("DELETE FROM eoi WHERE job_reference_number = ?");
    $stmt->execute([$jobRef]);
    echo "Deleted all EOIs with job reference number $jobRef!";
}

// Handle updating the status of an EOI
if (isset($_POST["update_status"])) {
    $eoi_id = $_POST["eoi_id"];
    $new_status = $_POST["status"];
    $stmt = $pdo->prepare("UPDATE eoi SET status = ? WHERE eoi_id = ?");
    $stmt->execute([$new_status, $eoi_id]);
    echo "Status updated successfully!";
}
?>

<h2>Manage EOIs</h2>

<!-- Form to view EOIs by job reference number -->
<form method="post">
    <label>Enter job reference number to view EOIs:</label>
    <input type="text" name="job_reference_number">
    <button type="submit" name="view_by_job">View</button>
</form>

<!-- Form to view EOIs by applicant name -->
<form method="post">
    <label>Enter applicant name to view EOIs:</label>
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <button type="submit" name="view_by_name">View</button>
</form>

<!-- Form to delete EOIs by job reference number -->
<form method="post">
    <label>Enter job reference number to delete all EOIs:</label>
    <input type="text" name="job_reference_number">
    <button type="submit" name="delete">Delete</button>
</form>

<!-- Form to update the status of an EOI -->
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

<!-- Table to display all EOIs -->
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
    <?php
    $stmt = $pdo->query("SELECT * FROM eoi");
    while ($row = $stmt->fetch()) {
        echo "<tr>
                <td>{$row['eoi_id']}</td>
                <td>{$row['job_reference_number']}</td>
                <td>{$row['first_name']} {$row['last_name']}</td>
                <td>{$row['street_address']}, {$row['suburb']}, {$row['state']} {$row['postcode']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['skill1']}, {$row['skill2']}, {$row['skill3']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }
    ?>
</table>
