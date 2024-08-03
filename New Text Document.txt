<!DOCTYPE html>
<html>
<head>
    <title>Welcome - Abroadassist</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Existing styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #87e9dc;
            color: #fff;
            padding: 15px 20px;
        }
        
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #84878a;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        nav ul li a:hover {
            background-color: #7d838a;
        }
        
        main {
            padding: 20px;
        }
        
        .welcome {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        
        .welcome h2 {
            margin-top: 0;
            font-size: 28px;
            color: #333;
            animation: slideInDown 1s ease-in-out;
        }
        
        .welcome p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }
        
        .welcome a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #87e9dc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        .welcome a:hover {
            background-color: #6cc6b2;
        }
        
        footer {
            text-align: center;
            padding: 10px;
            background-color: #a8cef5;
            color: #fff;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Abroadassist</h1>
        <nav>
            <ul>
                <li><a href="http://localhost/ha/next.html">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="admin_dashboard.php">Chat with Admin</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <p>Name: <?php echo htmlspecialchars($user['name']); ?></p>
            <p>Score: <?php echo htmlspecialchars($user['Marks']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
            <p>Address: <?php echo htmlspecialchars($user['address']); ?></p>
            <a href="profile.php">Edit Profile</a>
        </section>
    </main>

    <footer>
        <p>&copy; Abroadassist</p>
    </footer>
</body>
</html>
