<?php
session_start();
include 'config.php'; // Include your database configuration file

// Check if the university is logged in
if (!isset($_SESSION['university_id'])) {
    header('Location: university_login.php');
    exit();
}

// Fetch users' data from the database
$query = "SELECT * FROM users"; // Assuming your users table is named 'users'
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>University Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            animation: fadeIn 1s ease-in-out;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            animation: slideInUp 1s ease-in-out;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            transition: background-color 0.3s;
        }

        th {
            background-color: #87e9dc;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f5f7fa;
        }

        tr:hover {
            background-color: #e0f7f7;
        }

        h2 {
            margin-bottom: 20px;
            animation: slideInDown 1s ease-in-out;
        }

        .filter-container {
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .filter-container label {
            font-size: 18px;
            margin-right: 10px;
        }

        .filter-container input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 200px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .filter-container input:focus {
            border-color: #87e9dc;
            box-shadow: 0 0 8px rgba(135, 233, 220, 0.5);
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
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            width: 40px;
            height: 40px;
            background-color: #87e9dc;
            border-radius: 50%;
            opacity: 0.5;
            animation: rise 8s infinite ease-in;
        }

        .bubble:nth-child(2) {
            width: 20px;
            height: 20px;
            left: 20%;
            animation-duration: 6s;
        }

        .bubble:nth-child(3) {
            width: 30px;
            height: 30px;
            left: 40%;
            animation-duration: 7s;
        }

        .bubble:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 60%;
            animation-duration: 9s;
        }

        .bubble:nth-child(5) {
            width: 25px;
            height: 25px;
            left: 80%;
            animation-duration: 5s;
        }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
            }
            50% {
                transform: translateX(100px);
            }
            100% {
                bottom: 100vh;
                transform: translateX(-200px);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['university_name']; ?></h2>
        <div class="filter-container">
            <label for="marksFilter">Filter by Marks:</label>
            <input type="number" id="marksFilter" placeholder="Enter minimum marks">
        </div>
        <table id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['Marks']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <script>
        document.getElementById('marksFilter').addEventListener('input', function() {
            var filterValue = parseInt(this.value, 10);
            var table = document.getElementById('usersTable');
            var rows = table.getElementsByTagName('tr');
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var marks = parseInt(cells[3].textContent, 10);
                if (isNaN(filterValue) || marks >= filterValue) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>
