<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Creuset French Ovens - TheWholeStory</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

    <style>
        /* Ensure html and body fill the full screen */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poiret One', sans-serif;
        }
      
        /* Container to take full height of screen */
        .container {
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
        }

        /* Navigation Menu Styles */
        nav {
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 10px;
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
        }

        nav ul li a {
            font-family: 'Poiret One', sans-serif;
            font-weight: bold; /* Make text bold */
            color: gold; /* Set text color to gold */
            text-decoration: none; /* Remove underline */
        }


        /* Main content fills remaining space after navbar */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
            background-color: #999999;

        }

        h1, h2 {
            font-weight: bold;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1);
        }

        /* Product Image */
        .product-image {
            max-width: 40%;
            height: auto;
            transition: opacity 0.5s ease;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }

        /* Button styling */
        .next-button {
            margin-top: 10px;
            padding: 10px;
            background-color: #FFD700;
            color: #fff;
            border: 2px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .next-button:hover {
            background-color: gray;
        }

        .arrow {
            margin-left: 5px;
        }

        /* Dropdown styling */
        select {
            appearance: none;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            margin-bottom: 10px;
        }

        select:hover {
            border-color: #007bff;
        }

        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .product-details {
            text-align: center;
            margin-top: 20px;
        }

        /* Footer stays at the bottom */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
        }
    </style>

    <script>
        let currentRedIndex = 0;
        let currentMarineIndex = 0;
        let currentBlackIndex = 0;

        function updateImage() {
            const color = document.getElementById("color").value;
            const redImages = document.querySelectorAll('.red-image');
            const marineImages = document.querySelectorAll('.marine-image');
            const blackImages = document.querySelectorAll('.black-image');

            redImages.forEach(img => img.classList.add('hidden'));
            marineImages.forEach(img => img.classList.add('hidden'));
            blackImages.forEach(img => img.classList.add('hidden'));

            if (color === "red") {
                currentRedIndex = 0;
                redImages[currentRedIndex].classList.remove('hidden');
            } else if (color === "marine") {
                currentMarineIndex = 0;
                marineImages[currentMarineIndex].classList.remove('hidden');
            }
            else if (color === "black") {
                currentBlackIndex = 0;
                blackImages[currentBlackIndex].classList.remove('hidden');
            }
        }

        function nextImage() {
            const color = document.getElementById("color").value;

            if (color === "red") {
                const images = document.querySelectorAll('.red-image');
                images[currentRedIndex].classList.add('hidden');
                currentRedIndex = (currentRedIndex + 1) % images.length;
                images[currentRedIndex].classList.remove('hidden');
            } else if (color === "marine") {
                const images = document.querySelectorAll('.marine-image');
                images[currentMarineIndex].classList.add('hidden');
                currentMarineIndex = (currentMarineIndex + 1) % images.length;
                images[currentMarineIndex].classList.remove('hidden');
            }
            else if (color === "black") {
                const images = document.querySelectorAll('.black-image');
                images[currentBlackIndex].classList.add('hidden');
                currentBlackIndex = (currentBlackIndex + 1) % images.length;
                images[currentBlackIndex].classList.remove('hidden');
            }
        }

        function updatePrice() {
            const size = document.getElementById("size").value;
            const priceDisplay = document.getElementById("price-display");
            const priceHidden = document.getElementById("product-price-hidden");
            let price = 220.00;

            switch (size) {
                case "22":
                    price = 220.00;
                    break;
                case "26":
                    price = 240.00;
                    break;
                case "32":
                    price = 260.00;
                    break;
                
            }

            priceDisplay.textContent = `$${price.toFixed(2)}`;
            priceHidden.value = price.toFixed(2);
        }

        function addToCart() {
    // Make an AJAX request to check login status
    fetch('check_login.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                const productName = "Le Creuset Casserole";
                const productPrice = document.getElementById("product-price-hidden").value;
                const selectedColor = document.getElementById("color").value;
                const selectedSize = document.getElementById("size").value;

                const cartData = {
                    name: productName,
                    price: productPrice,
                    color: selectedColor,
                    size: selectedSize
                };

                fetch('add_to_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(cartData)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert("Product added to cart!");
                        updateCartIndicator(result.cart_count); // Update the cart indicator
                    } else {
                        alert("Failed to add product to cart.");
                    }
                })
                .catch(error => console.error('Error:', error));
            } else {
                alert("Please log in to add items to your cart.");
                window.location.href = "login.php";
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateCartIndicator(cartCount) {
    const cartIndicator = document.getElementById("cart-indicator"); // Assuming you have an element for the cart count
    if (cartIndicator) {
        cartIndicator.textContent = cartCount; // Update the cart count display
    }
}




    </script>
</head>
<body>

    <div class="container">
       <!-- Navigation Menu -->
       <nav>
                <ul>
                    <li><a href="TWS_index.php">Home</a></li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <li><a href="logout.php">Logout</a></li> <!-- Show Logout link -->
                        <li><a href="order_history.php">Order History</a></li>
                        <li><a href="admin_orders.php">Admin Orders</a></li>
                    <?php else: ?>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li> <!-- Show Login link -->
                        <li><a href="admin_login.php">Admin Login</a></li> <!-- New admin login link -->
                    <?php endif; ?>
                </ul>
                <?php include('cart_summary.php'); ?>
            </nav>

        <main>
            <h1>Le Creuset Casserole</h1>

            <div class="product-details">
                <img class="product-image red-image" src="21180260602430_01.jpg" alt="Le Creuset Casserole Red">
                <img class="product-image red-image hidden" src="21180260602430_02.jpg" alt="Le Creuset Casserole Red Side">
                <img class="product-image red-image hidden" src="21180260602430_04.jpg" alt="Le Creuset Casserole Red Top">

                <img class="product-image marine-image hidden" src="21180265362430_01.jpg" alt="Le Creuset Casserole Marine">
                <img class="product-image marine-image hidden" src="21180265362430_02.jpg" alt="Le Creuset Casserole Marine Side">
                <img class="product-image marine-image hidden" src="21180265362430_04.jpg" alt="Le Creuset Casserole Marine Top">

                <img class="product-image black-image hidden" src="21180264962430_01.jpg" alt="Le Creuset Casserole Cool Mint">
                <img class="product-image black-image hidden" src="21180264962430_02.jpg" alt="Le Creuset Casserole Cool Mint Side">
                <img class="product-image black-image hidden" src="21180264962430_04.jpg" alt="Le Creuset Casserole Cool Mint Top">
                <h2>Select Color:</h2>
                <select id="color" onchange="updateImage()">
                    <option value="red">Red</option>
                    <option value="marine">Marine</option>
                    <option value="black">Cool Mint</option>
                </select>

                <h2>Select Size:</h2>
                <select id="size" onchange="updatePrice()">
                    <option value="22">22 cm</option>
                    <option value="26">26 cm</option>
                    <option value="32">32 cm</option>
                </select>

                <h2 id="price-display">$220.00</h2>
                <input type="hidden" id="product-price-hidden" value="220.00" />

                <button class="next-button" onclick="nextImage()">Next Image <span class="arrow">→</span></button>
                <button class="next-button" onclick="addToCart()">Add to Cart</button>
            </div>
            
        </main>

        <footer>
            <p>© 2024 The Whole Story. All rights reserved.</p>
        </footer>
    </div>

</body>
</html>
