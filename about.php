<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="styles/about.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>

<body>
    <?php include 'inc/header_about.inc'; ?>
    <section id="about">
        <h1>About Our Group</h1>
        <dl>
            <dt><strong>Group Name:</strong></dt>
            <dd>TechNova Solutions</dd>

            <dt><strong>Group ID:</strong></dt>
            <dd>TechNova COS10026</dd>

            <dt><strong>Tutor's Name:</strong></dt>
            <dd>Ms. Phan Thanh Trà</dd>

            <dt><strong>Members Contribution:</strong></dt>
            <dd>
            <ul>
            <li><strong>Nguyễn Thành Kiên:</strong> Index.html and CSS designer</li>
            <li><strong>Hồ Cao Cường:</strong> Form writer and its CSS</li>
            <li><strong>Bùi Tiến Hưng:</strong> Job Script and its CSS</li>
            </ul>
            </dd>
        </dl>
        <h2>Group Timetable</h2>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monday</td>
                    <td>9:00 AM - 12:00 PM</td>
                    <td>Project Meeting</td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td>2:00 PM - 5:00 PM</td>
                    <td>Development Session</td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td>10:00 AM - 1:00 PM</td>
                    <td>Testing & Review</td>
                </tr>
            </tbody>
        </table>

        <h2>Group Demographics</h2>
        <table class="info-table">
            <tr>
                <th>Age Range</th>
                <td>20-28 years old</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>3 male, 2 female</td>
            </tr>
            <tr>
                <th>Education Level</th>
                <td>All members have a Bachelor's degree, and two members are currently pursuing a Master's degree in Computer Science in Swinburne University.</td>
            </tr>
        </table>

        <h2>Hometown Description</h2>
        <table class="info-table">
            <tr>
                <th>City</th>
                <td>Đà Nẵng, Vietnam</td>
            </tr>
            <tr>
                <th>Population</th>
                <td>Approximately 1.2 million people</td>
            </tr>
            <tr>
                <th>Notable Features</th>
                <td>Beautiful beaches, the Dragon Bridge, Marble Mountains, and the bustling Han Market.</td>
            </tr>
            <tr>
                <th>Climate</th>
                <td>Tropical monsoon climate with distinct wet and dry seasons.</td>
            </tr>
        </table>

        <h2>Programming Skills</h2>
        <table class="info-table">
            <tr>
                <th>Languages</th>
                <td>Python, Java, C++, JavaScript, HTML/CSS</td>
            </tr>
            <tr>
                <th>Frameworks</th>
                <td>React, Node.js, Django</td>
            </tr>
            <tr>
                <th>Tools</th>
                <td>Git, Docker, Jenkins</td>
            </tr>
            <tr>
                <th>Experience</th>
                <td>Each member has at least 2 years of experience in software development, with a focus on web and mobile applications.</td>
            </tr>
        </table>

        <h2>Working Experiences</h2>
        <table class="info-table">
            <tr>
                <th>Companies</th>
                <td>ABC Tech, XYZ Solutions, Creative Code Co.</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>Software Developer, Frontend Engineer, DevOps Specialist, Project Manager, Data Analyst</td>
            </tr>
            <tr>
                <th>Projects</th>
                <td>E-commerce websites, mobile apps, data analysis tools, and cloud-based solutions.</td>
            </tr>
        </table>

        <p>Contact us at: <a href="mailto:thanhkien2900@gmail.com">TechNova@gmail.com</a></p>
    </section>
    <?php include 'inc/footer.inc'; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>  

</body>
</html>