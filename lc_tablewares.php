<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Creuset Categories - TheWholeStory</title>
    <link rel="stylesheet" href="lcproducts.ss.css">
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Content Section Styles */
.content-section {
    display: flex;
    flex-direction: column; /* Stack elements vertically */
    align-items: center; /* Center horizontally */
    justify-content: center; /* Center vertically */
    height: 250px; /* Set a height for the section */
    text-align: center; /* Center text */
    background-color: gray; /* Background color */
    padding: 10px; /* Add padding for spacing */
    border-radius: 8px; /* Rounded corners */
}

.content-section h1 {
    font-size: 48px; /* Adjust font size for the heading */

    
}

.content-section p {
    font-size: 20px; /* Adjust font size for the paragraph */
    color: gold; /* Ensure text visibility */
    font-weight: bold;
}
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
         /* Footer Styles */
         footer {
            background-color: gray;
            padding: 20px;
            text-align: center;
            color: gold;
            border-top: 1px solid gold;
        }
        
        /* Apply Poiret One font to body and other elements as needed */
        body {
            font-family: 'Poiret One', sans-serif; /* Apply Poiret One font */
            background-color: #c0c0c0;
        }

        nav ul li a {
            font-family: 'Poiret One', sans-serif; /* Apply Poiret One font to navigation links */
            font-weight: bold; /* Apply bold weight if supported */
        }

        h1, h2 {
            font-family: 'Poiret One', sans-serif; /* Apply Poiret One font to headings */
            font-weight: bold; /* Apply bold weight if supported */
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1); /* Optional: Add shadow for bolder effect */
        }
    
        /* Reset default body margin and padding */
        body {
            margin: 0;
            padding: 0;
        }
 /* History Container */
 .history-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 8px;
        }
        .history-container h2 {
            font-size: 24px;
        }
        .history-container ul {
            list-style: none;
            padding: 0;
        }
        .history-container ul li {
            margin: 5px 0;
        }
        .history-container ul li a {
            text-decoration: none;
            color: blue;
        }
        .history-container ul li a:hover {
            text-decoration: underline;
        }
        /* Container for the product list */
      /* Container for the product list */
ul.products {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: nowrap; /* Keep items in a single row */
    gap: 20px; /* Space between items */
    justify-content: center;
    overflow-x: auto; /* Allow horizontal scrolling */
}

ul.products li {
    flex: 0 0 auto; /* Prevent items from shrinking */
    width: 200px; /* Set a fixed width for each product item */
    height: 300px; /* Adjust height as needed */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative; /* Ensure the positioning for overlays works */
}

/* Hover effect */
ul.products li:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Ensure image fills the space */
ul.products li img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure the image covers the space */
    z-index: 1;
}

/* Text overlay styles */
ul.products li h2,
ul.products li p {
    position: absolute;
    z-index: 2;
    left: 0;
    right: 0;
    text-align: center;
    padding: 0 10px;
}

/* Text styles */
ul.products li h2 {
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
    font-weight: bold;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    color: white;
}

ul.products li p {
    top: 60%;
    transform: translateY(-60%);
    font-size: 1rem;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    color: gold;
    font-weight: bold;
}

/* Dark overlay effect */
ul.products li::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.1);
    z-index: 1;
    transition: background-color 0.3s ease; /* Smooth transition */
}

/* On hover, change overlay */
ul.products li:hover::before {
    background-color: rgba(0, 0, 0, 0.5);
}


       /* Navigation Menu Styles */
nav {
    background-color:#999999; /* Semi-transparent gray */
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
        /* Media query for mobile devices */
        @media (max-width: 600px) {
            nav ul {
                flex-direction: column; /* Stack items vertically */
                align-items: center; /* Center align items */
            }
            nav li {
                margin: 10px 0; /* Adjust margin for vertical layout */
            }
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

    <div class="container">
         <!-- Navigation Menu -->
         <nav>
                <ul>
                    <li><a href="TWS_index.php">Home</a></li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <li><a href="logout.php">Logout</a></li> <!-- Show Logout link -->
                    <?php else: ?>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li> <!-- Show Login link -->
                    <?php endif; ?>
                </ul>
                <li style="position: absolute; left: 10px; top: 10px;">
    <button id="toggleSidebar" style="position: absolute; left: 10px; top: 10px; background: none; border: none; cursor: pointer;">
    <i class="fas fa-chevron-right" id="sidebarArrow" style="font-size: 24px; color: gold;"></i>
</button>
                <?php include('cart_summary.php'); ?>
            </nav>

        <main>
            
            <!-- Content Section -->
    <div class="content-section">
    <h1>Le Creuset Tablewares</h1>
</div>
            <ul class="products">
                <li>
                    <a href="la_cruset_french_ovens.php">
                        <img src="e682d1cb7edf39eb8cba6a1882d83bad.jpg" alt="Bowl">
                        <h2>Bowl</h2>
                        <p>Explore Le Creuset's famous French ovens!</p>
                    </a>
                </li>
                <li>
                    <a href="lc.cassarole.php">
                        <img src="3793b0fad53892526a67c19dbde61bfc.jpg" alt="Casserole">
                        <h2>Casserole Ovens</h2>
                        <p>Explore Le Creuset's Casserole ovens!</p>
                    </a>
                </li>
                <li>
                    <a href="lc_Marmites.php">
                        <img src="marmites.lc.jpeg" alt="Marmites">
                        <h2>Marmites</h2>
                        <p>Discover Le Creuset's marmite collection!</p>
                    </a>
                </li>
                <li>
                    <a href="lc_Pot.php">
                        <img src="rp.lc.jpg" alt="Rice Pots">
                        <h2>Rice Pots</h2>
                        <p>Check out the finest rice pots by Le Creuset!</p>
                    </a>
                </li>
                <li>
                    <a href="lc.skillets.php">
                        <img src="Sarten-skillet-Le-Creuset-azure-4_2048x.jpg" alt="Skillet">
                        <h2>Skillets</h2>
                        <p>Discover Le Creuset's Skillets collection!</p>
                    </a>
                </li>
                <li>
                    <a href="lc_tablewares.php">
                        <img src="LC_20200724_UK_CI_EM_FOODLOVE20LP01_ENG.jpg" alt="Tableware">
                        <h2>Tableware</h2>
                        <p>Check out the various tableware by Le Creuset!</p>
                    </a>
                </li>
            </ul>
        </main>

        <footer>
            <p>&copy; 2024 TheWholeStory. All rights reserved.</p>
        </footer>
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
