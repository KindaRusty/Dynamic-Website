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
<div class="alert-success">
    <div class="alert-icon" class="alert-success" >
      <ion-icon class="icon" name="checkmark"></ion-icon>
    </div>
    <div class="content">
       <h1>Application Submitted Successfully</h1>
       <p>Thank you for your expression of interest. Your EOI number is: <strong><?php echo $eoiNumber; ?></strong></p>
       <p>We will contact you soon regarding your application.</p>
    </div>
    <a href="index.php">
      <button>Roll back</button>
    </a>
</div>
</div>  

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>