<?php
// Prevent direct URL access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: apply.php"); // Redirect to your form page
    exit();
}

// Database configuration
$db_host = 'localhost';
$db_user = 'root'; // XAMPP default
$db_pass = ''; // XAMPP default
$db_name = 'your_database_name'; // Change this

// Connect to MySQL
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize and validate input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize variables and error array
$errors = [];
$fields = [
    'job_reference' => '', 'first_name' => '', 'last_name' => '',
    'street_address' => '', 'suburb_town' => '', 'state' => '',
    'postcode' => '', 'email' => '', 'phone' => '', 'dob' => '',
    'gender' => '', 'skill1' => '', 'skill2' => '', 'skill3' => '',
    'skill4' => '', 'other_skills' => ''
];

// Sanitize all inputs
foreach ($fields as $key => $value) {
    if (isset($_POST[$key])) {
        $fields[$key] = sanitizeInput($_POST[$key]);
    }
}

// Validation rules
$stateCodes = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];

// Job reference (exactly 5 alphanumeric)
if (!preg_match('/^[a-zA-Z0-9]{5}$/', $fields['job_reference'])) {
    $errors['job_reference'] = 'Job reference must be exactly 5 alphanumeric characters';
}

// First name (max 20 alpha)
if (!preg_match('/^[a-zA-Z]{1,20}$/', $fields['first_name'])) {
    $errors['first_name'] = 'First name must be up to 20 alphabetic characters';
}

// Last name (max 20 alpha)
if (!preg_match('/^[a-zA-Z]{1,20}$/', $fields['last_name'])) {
    $errors['last_name'] = 'Last name must be up to 20 alphabetic characters';
}

// Date of birth (dd/mm/yyyy between 15 and 80)
$dobParts = explode('/', $fields['dob']);
if (count($dobParts) !== 3 || !checkdate($dobParts[1], $dobParts[0], $dobParts[2])) {
    $errors['dob'] = 'Invalid date format (dd/mm/yyyy)';
} else {
    $dobDate = new DateTime($fields['dob']);
    $today = new DateTime();
    $age = $today->diff($dobDate)->y;
    
    if ($age < 15 || $age > 80) {
        $errors['dob'] = 'Age must be between 15 and 80 years';
    }
}

// Gender (must be selected)
if (empty($fields['gender'])) {
    $errors['gender'] = 'Gender must be selected';
}

// Street address (max 40)
if (strlen($fields['street_address']) > 40) {
    $errors['street_address'] = 'Street address must be 40 characters or less';
}

// Suburb/town (max 40)
if (strlen($fields['suburb_town']) > 40) {
    $errors['suburb_town'] = 'Suburb/town must be 40 characters or less';
}

// State (must be valid)
if (!in_array($fields['state'], $stateCodes)) {
    $errors['state'] = 'Please select a valid state';
}

// Postcode (exactly 4 digits and matches state)
if (!preg_match('/^\d{4}$/', $fields['postcode'])) {
    $errors['postcode'] = 'Postcode must be exactly 4 digits';
} else {
    // State-postcode validation (basic implementation)
    $firstDigit = substr($fields['postcode'], 0, 1);
    $statePostcodes = [
        'NSW' => ['2'], 'VIC' => ['3', '8'], 'QLD' => ['4', '9'],
        'WA' => ['6'], 'SA' => ['5'], 'TAS' => ['7'],
        'NT' => ['0'], 'ACT' => ['0', '2']
    ];
    
    if (!in_array($firstDigit, $statePostcodes[$fields['state']])) {
        $errors['postcode'] = 'Postcode does not match selected state';
    }
}

// Email (validate format)
if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format';
}

// Phone (8-12 digits or spaces)
if (!preg_match('/^[\d\s]{8,12}$/', $fields['phone'])) {
    $errors['phone'] = 'Phone must be 8-12 digits (spaces allowed)';
}

// Other skills (not empty if checkbox selected)
if ((isset($_POST['other_skills_checkbox']) && $_POST['other_skills_checkbox'] === 'yes') && empty($fields['other_skills'])) {
    $errors['other_skills'] = 'Please describe your other skills';
}

// Check for errors
if (!empty($errors)) {
    // Display errors to user (you might want to redirect back to form with errors)
    include('error_page.php');
    exit();
}

// Create EOI table if it doesn't exist
$createTableSQL = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_reference VARCHAR(10) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    street_address VARCHAR(100) NOT NULL,
    suburb_town VARCHAR(50) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode VARCHAR(4) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    skill1 VARCHAR(50),
    skill2 VARCHAR(50),
    skill3 VARCHAR(50),
    skill4 VARCHAR(50),
    other_skills TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";

if (!$conn->query($createTableSQL)) {
    die("Error creating table: " . $conn->error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO eoi (
    job_reference, first_name, last_name, street_address, suburb_town,
    state, postcode, email, phone, dob, gender, skill1, skill2, skill3, skill4, other_skills
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Format date for MySQL (yyyy-mm-dd)
$mysqlDate = date('Y-m-d', strtotime(str_replace('/', '-', $fields['dob'])));

$stmt->bind_param(
    "ssssssssssssssss",
    $fields['job_reference'], $fields['first_name'], $fields['last_name'],
    $fields['street_address'], $fields['suburb_town'], $fields['state'],
    $fields['postcode'], $fields['email'], $fields['phone'], $mysqlDate,
    $fields['gender'], $fields['skill1'], $fields['skill2'], $fields['skill3'],
    $fields['skill4'], $fields['other_skills']
);

// Execute and check for errors
if ($stmt->execute()) {
    $eoiNumber = $conn->insert_id;
    
    // Display success page
    include('success_page.php'); 
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
