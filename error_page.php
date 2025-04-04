<!DOCTYPE html>
<html>
<head>
    <title>Application Submitted</title>
    <link rel="stylesheet" href="styles\sumbit.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>
<body>

<div class="wrapper" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="500">
<div class="alert-error">
    <div class="alert-icon">
       <ion-icon class="icon" name="close"></ion-icon>
    </div>
    <div class="content">
       <h1>Application Submission Error</h1>
    <p>Please correct the following errors:</p>
    <ul>
        <?php foreach ($errors as $field => $message): ?>
            <li><strong><?php echo ucfirst(str_replace('_', ' ', $field)); ?>:</strong> <?php echo $message; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="apply.php">
      <button>Try again</button>
    </a>
</div>
</div>  

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>