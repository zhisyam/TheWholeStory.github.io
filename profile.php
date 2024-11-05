<?php
session_start();
include('db_connect.php'); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Get username from session
$username = $_SESSION['username'];

// Fetch user data from database
$sql = "SELECT full_name, email, address FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($fullName, $email, $address);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
       /* Sidebar Styles */
.sidebar {
    width: 250px; /* Width of the sidebar */
    position: fixed; /* Fixed position */
    top: 60px; /* Adjust to be below the navbar */
    left: 0; /* Align to the left */
    background-color: rgba(128, 128, 128, 0.9); /* Background color */
    color: white; /* Text color */
    padding: 20px; /* Padding inside sidebar */
    height: calc(100% - 60px); /* Full height minus navbar */
    overflow-y: auto; /* Scroll if content overflows */
    z-index: 99; /* Above other content */
    transition: transform 0.3s ease; /* Smooth transition */
}

.sidebar.hidden {
    transform: translateX(-100%); /* Hide by moving out */
}

/* Sidebar hover effect */
.sidebar:hover {
    transform: translateX(0); /* Slide in on hover */
}



.sidebar h2 {
    font-size: 24px; /* Sidebar heading size */
    margin-bottom: 20px; /* Space below heading */
}

.sidebar ul {
    list-style: none; /* Remove default list styles */
    padding: 0; /* Remove padding */
}

.sidebar ul li {
    margin: 10px 0; /* Space between items */
}

.sidebar ul li a {
    color: gold; /* Link color */
    text-decoration: none; /* Remove underline */
    transition: color 0.3s; /* Smooth color transition */
}

.sidebar ul li a:hover {
    color: white; /* Change color on hover */
    text-decoration: underline; /* Underline on hover */
}

        body {
            font-family: 'Poiret One', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #d3d3d3; /* Light gray background */
            color: black; /* Change text color to black */
            display: flex;
        }

        /* Navigation Menu Styles */
nav {
    background-color: rgba(128, 128, 128, 0.8); /* Semi-transparent gray */
    padding: 21px;
    position: fixed; /* Fixed at the top */
    width: 100%; /* Full width */
    top: 0; /* Position it at the top */
    z-index: 100; /* Above other content */
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 15px;
    position: relative; /* Make sure the button is positioned correctly */
}


nav ul li a {
    font-family: 'Poiret One', sans-serif;
    font-weight: bold;
    color: gold; /* Text color */
    text-decoration: none; /* Remove underline */
}

nav ul li a:hover {
    color: white; /* Hover effect */
}
        .content {
            flex-grow: 1;
            padding: 10%;
            max-width: 800px;
            margin: auto;
        }

        .profile-container {
            background-color: rgba(128, 128, 128, 0.8);
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: gold;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        footer {
    background-color: rgba(128, 128, 128, 0.8); /* Match footer background with nav */
    text-align: center;
    padding: 10px; /* Add some padding */
    width: 100%; /* Make footer full width */
    color: black; /* Text color */
}
    </style>
</head>
<body>

   <!-- Sidebar -->
     <div class="sidebar hidden"> <!-- Add 'hidden' class here -->
        <h2>User Menu</h2>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="support.php">Support</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>


   <!-- Navigation Menu -->
<nav>
    <ul>
        <li><a href="TWS_index.php">Home</a></li>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li><a href="logout.php">Logout</a></li> 
            <li><a href="order_history.php">Order History</a></li>
            <li><a href="admin_orders.php">Admin Orders</a></li>
        <?php else: ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        <?php endif; ?>
    </ul>
    <li style="position: absolute; left: 10px; top: 10px;">
    <button id="toggleSidebar" style="position: absolute; left: 10px; top: 10px; background: none; border: none; cursor: pointer;">
    <i class="fas fa-chevron-right" id="sidebarArrow" style="font-size: 24px; color: gold;"></i>
</button>

</li>

    <?php include('cart_summary.php'); ?>
</nav>
    <!-- Main Content Area -->
    <div class="content">
        <div class="profile-container">
            <h1>User Profile</h1>
            <div class="profile-info">
                <label for="full_name">Full Name:</label>
                <p id="full_name"><?php echo htmlspecialchars($fullName); ?></p>
            </div>
            <div class="profile-info">
                <label for="email">Email:</label>
                <p id="email"><?php echo htmlspecialchars($email); ?></p>
            </div>
            <div class="profile-info">
                <label for="address">Address:</label>
                <p id="address"><?php echo htmlspecialchars($address); ?></p>
            </div>
        </div>

    

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden'); // Toggle the hidden class
            
            const arrow = document.getElementById('sidebarArrow');

            // Change the arrow direction based on sidebar visibility
            if (sidebar.classList.contains('hidden')) {
                arrow.classList.remove('fa-chevron-left'); // Change to right arrow
                arrow.classList.add('fa-chevron-right');
            } else {
                arrow.classList.remove('fa-chevron-right'); // Change to left arrow
                arrow.classList.add('fa-chevron-left');
            }
        });
    </script>
</body>

</html>
