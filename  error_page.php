<!DOCTYPE html>
<html>
<head>
    <title>Application Error</title>
</head>
<body>
    <h1>Application Submission Error</h1>
    <p>Please correct the following errors:</p>
    <ul>
        <?php foreach ($errors as $field => $message): ?>
            <li><strong><?php echo ucfirst(str_replace('_', ' ', $field)); ?>:</strong> <?php echo $message; ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="apply.php">Go back to the application form</a></p>
</body>
</html>