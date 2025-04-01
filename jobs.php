<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers at TechNova</title>
    <link rel="stylesheet" href="styles\jobs.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
     integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
     crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
</head>

<body class="jobs-page">    
    
    <div class="body-container">

    <?php include 'inc/header_jobs.inc'; ?>

        <main>    

                <div class="jobs-content">
                 
                    <h1 data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="2000">
                        START AND BUILD <br> YOUR CAREER HERE.
                    </h1>
        
                    <p data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="2500" class="description">
                        Be a part of a team of passionate talents solving some of the world's hardest problems and discovering never-before-seen ways to improve the quality of life for people everywhere—from AI to robotics and a growing list of new opportunities every single day.
                    </p>
        
                    <div data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="3000" class="buttons">
                        <a href="apply.html" class="btn-signing-main">Get Started &gt;</a>
                    </div>
                </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

        </main>

    </div>

    <div class="slideshow-container" >
        <img src="images\work1.png" class="slide">
        <img src="images\work2.png" class="slide">
        <img src="images\work3.png" class="slide">
    </div>

    <div data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="3000" class="job-heading-container">
        <h1 class="job-heading">We are looking for</h1>
    </div>

 <div data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="3000" class="jobs-detail">

    <div  class="jobs-card">
        <div class="top"><img class="jobs-img" src="images\SeniorWebDeveloper.jpg" alt="job-1"></div>
        <div class="bottom">
            <h2 class="jobs-heading">Senior Web Design Engineer | JR184</h2>
            <p>
                We are looking for a Senior Web Developer to build and maintain functional web pages and applications...
            </p>
            <a href="detail.php" class="view-btn">View</a>
        </div>
    </div>

    <div class="jobs-card">
        <div class="top"><img class="jobs-img" src="images\tester.avif" alt="job-2"></div>
        <div class="bottom">
            <h2 class="jobs-heading">Software Test Engineer | DE949</h2>
            <p>
                You will join our Software Development Test team and gain valuable, hands-on experience in all validation aspects of...
            </p>
            <a href="detail.php" class="view-btn">View</a>
        </div>
    </div>

    <div class="jobs-card">
        <div class="top"><img class="jobs-img" src="images\cybersecurity.jpg" alt="job-3"></div>
        <div class="bottom">
            <h2 class="jobs-heading">Cybersecurity Analyst | GC940</h2>
            <p>
                We are looking for a driven and passionate Cybersecurity Analyst to join our growing software engineering team...
            </p>
            <a href="detail.php" class="view-btn">View</a>
        </div>
    </div>

    <div class="jobs-card">
        <div class="top"><img class="jobs-img" src="images\Technical-support-specialists.jpg" alt="job-4"></div>
        <div class="bottom">
            <h2 class="jobs-heading">IT Support Specialist | DH583</h2>
            <p>
                As an IT Support Specialist, you will play a crucial role in ensuring seamless IT operations by providing...
            </p>
            <a href="detail.php" class="view-btn">View</a>
        </div>
    </div>

 </div>

 <?php include 'inc/footer_jobs.inc'; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
