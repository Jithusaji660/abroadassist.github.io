<!DOCTYPE html>
<html>
<head>
    <title>About Us - Abroadassist</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fafafa; /* Light gray background */
            color: #333;
        }

        .about-container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeInSection 2s ease-in-out;
        }

        @keyframes fadeInSection {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1, h2 {
            color: #00796b; /* Teal */
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 28px;
            margin-top: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .team-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .team-member {
            background-color: #ffffff; /* White */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 calc(50% - 20px);
            box-sizing: border-box;
            text-align: center;
        }

        .team-member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .team-member h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #00796b; /* Teal */
        }

        .team-member p {
            font-size: 14px;
            color: #555;
        }

        .contact-info {
            margin-top: 30px;
            text-align: center;
        }

        .contact-info a {
            color: #00bcd4; /* Cyan */
            text-decoration: none;
            font-weight: bold;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Abroadassist</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                
                <li><a href="contact.php">Contact</a></li>
               
                
            </ul>
        </nav>
    </header>

    <main>
        <div class="about-container">
            <h1>About Abroadassist</h1>
            <p>At Abroadassist, we are dedicated to helping students embark on their educational journeys across the globe. Our mission is to provide comprehensive support and guidance to students seeking opportunities to study abroad, ensuring they find the best fit for their academic and personal aspirations.</p>

            <h2>Our Mission</h2>
            <p>Our mission is to simplify the study abroad process by offering a wide range of services, including university and program selection, scholarship opportunities, and application assistance. We strive to make the transition to studying in a foreign country as smooth and enjoyable as possible.</p>

            <h2>Our Vision</h2>
            <p>We envision a world where every student has access to the resources and support they need to pursue international education opportunities. Our goal is to empower students to achieve their dreams and make a positive impact in their chosen fields.</p>

            <h2>Our Values</h2>
            <ul>
                <li><strong>Integrity:</strong> We operate with honesty and transparency in all our interactions.</li>
                <li><strong>Excellence:</strong> We are committed to providing the highest quality service and support to our clients.</li>
                <li><strong>Empathy:</strong> We understand the challenges of studying abroad and provide compassionate, personalized assistance.</li>
                <li><strong>Innovation:</strong> We continuously seek new and effective ways to enhance the study abroad experience for students.</li>
            </ul>

            <h2>Meet the Team</h2>
            <div class="team-section">
                <div class="team-member">
                    <img src="ayith.jpg" alt="Team Member 1">
                    <h3>Ajith Prakash</h3>
                    <p>Co-founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="jithu.jpg" alt="Team Member 2">
                    <h3>Jithu Saji</h3>
                    <p>Co-founder & CTO</p>
                </div>
                <!-- Add more team members here -->
            </div>

            <div class="http://localhost/ha/contact.php">
                <p>For more information, please <a href="contact.php">contact us</a>.</p>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; Abroadassist</p>
    </footer>
</body>
</html>
