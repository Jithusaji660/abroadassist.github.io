<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Light Gray */
            color: #333;
            margin: 0;
            padding: 0;
            animation: fadeInBody 1.5s ease-in-out;
        }

        @keyframes fadeInBody {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .contact-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .contact-form {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background: #ffffff; /* White */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeInForm 2s ease-in-out;
        }

        @keyframes fadeInForm {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00796b; /* Teal */
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .contact-form input[type="text"]:focus,
        .contact-form input[type="email"]:focus,
        .contact-form textarea:focus {
            border-color: #00bcd4; /* Cyan */
        }

        .contact-form button {
            padding: 10px 20px;
            background-color: #00bcd4; /* Cyan */
            color: #ffffff; /* White */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s, transform 0.3s;
            display: block;
            width: 100%;
        }

        .contact-form button:hover {
            background-color: #00796b; /* Teal */
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            .contact-form-container {
                padding: 10px;
            }

            .contact-form {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="contact-form-container">
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form action="contact_form_handler.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</body>
</html>
