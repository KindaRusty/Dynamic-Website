<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: apply.php");
    exit();
}

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'eoi_database';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$errors = [];
$fields = [
    'job_reference_number' => '', 'first_name' => '', 'last_name' => '',
    'dob' => '', 'gender' => '', 'street_address' => '', 'suburb' => '',
    'state' => '', 'postcode' => '', 'email' => '', 'phone' => '',
    'skill1' => '', 'skill2' => '', 'skill3' => '', 'other_skills' => ''
];
foreach ($fields as $key => $value) {
    if (isset($_POST[$key])) {
        $fields[$key] = sanitizeInput($_POST[$key]);
    }
}

$stateCodes = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];

// Job reference number (exactly 5 alphanumeric)
if (!preg_match('/^[a-zA-Z0-9]{5}$/', $fields['job_reference_number'])) {
    $errors['job_reference_number'] = 'Job reference number must be exactly 5 alphanumeric characters';
}

// First name (max 20)
if (!preg_match('/^[a-zA-Z]{1,20}$/', $fields['first_name'])) {
    $errors['first_name'] = 'First name must be up to 20 alphabetic characters';
}

// Last name (max 20)
if (!preg_match('/^[a-zA-Z]{1,20}$/', $fields['last_name'])) {
    $errors['last_name'] = 'Last name must be up to 20 alphabetic characters';
}

// Date of birth (YYYY-MM-DD, between 15 and 80 years old)
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fields['dob'])) {
    $errors['dob'] = 'Date of birth must be in the format YYYY-MM-DD';
} else {
    $dob = DateTime::createFromFormat('Y-m-d', $fields['dob']);
    if (!$dob) {
        $errors['dob'] = 'Invalid date format';
    } else {
        $age = $dob->diff(new DateTime())->y;
        if ($age < 15 || $age > 80) {
            $errors['dob'] = 'Age must be between 15 and 80 years';
        }
    }
}
// Gender (must be selected)
if (empty($fields['gender']) || !in_array($fields['gender'], ['Male', 'Female', 'Other'])) {
    $errors['gender'] = 'Please select a valid gender';
}

// Street address (max 40)
if (strlen($fields['street_address']) > 40) {
    $errors['street_address'] = 'Street address must be 40 characters or less';
}

// Suburb/town (max 40)
if (strlen($fields['suburb']) > 40) {
    $errors['suburb'] = 'Suburb/town must be 40 characters or less';
}

// State
if (!in_array($fields['state'], $stateCodes)) {
    $errors['state'] = 'Please select a valid state';
}

// Postcode (exactly 4 digits)
if (!preg_match('/^\d{4}$/', $fields['postcode'])) {
    $errors['postcode'] = 'Postcode must be exactly 4 digits';
}

// Email (validate format)
if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format';
}

// Phone (8-20 digits or spaces)
if (!preg_match('/^[\d\s]{8,20}$/', $fields['phone'])) {
    $errors['phone'] = 'Phone must be 8-20 digits (spaces allowed)';
}

// Other skills (not empty if checkbox selected)
if ((isset($_POST['other_skills_checkbox']) && $_POST['other_skills_checkbox'] === 'yes') && empty($fields['other_skills'])) {
    $errors['other_skills'] = 'Please describe your other skills';
}

// Check for errors
if (!empty($errors)) {
    include('error_page.php');
    exit();
}

// Create EOI table if it doesn't exist
$createTableSQL = "CREATE TABLE IF NOT EXISTS eoi (
    eoi_id INT AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(10) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    street_address VARCHAR(100) NOT NULL,
    suburb VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    postcode VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    skill1 VARCHAR(50),
    skill2 VARCHAR(50),
    skill3 VARCHAR(50),
    other_skills TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";

if (!$conn->query($createTableSQL)) {
    die("Error creating table: " . $conn->error);
}

// Prepare and bind
$stmt = $conn->prepare(query: "INSERT INTO eoi (
    job_reference_number, first_name, last_name, dob, gender, street_address, suburb,
    state, postcode, email, phone, skill1, skill2, skill3, other_skills
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "sssssssssssssss",
    $fields['job_reference_number'], $fields['first_name'], $fields['last_name'],
    $fields['dob'], $fields['gender'], $fields['street_address'], $fields['suburb'],
    $fields['state'], $fields['postcode'], $fields['email'], $fields['phone'],
    $fields['skill1'], $fields['skill2'], $fields['skill3'], $fields['other_skills']
);

if ($stmt->execute()) {
    $eoiNumber = $conn->insert_id;

    include('success_page.php'); 
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
