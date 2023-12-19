<?php
$host = "localhost";
$user = "root";
$pass = "Jai1421tej@333";
$dbname = "BigBasket1";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection Failed..." . mysqli_connect_error());
} else {
    echo "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the cartItems table
    $stmtCart = $conn->prepare("SELECT * FROM cartItems");
    $stmtCart->execute();
    $resultCart = $stmtCart->get_result();

    if ($resultCart->num_rows > 0) {
        echo "<div style='margin: 0px;padding:30px;'>";
        echo "<h1 style='font-size:40px;color:white;'>Cart Items</h1>";

        while ($rowCart = $resultCart->fetch_assoc()) {
            echo "<p><b style='color: blue;font-size:20px; margin-right:95px;'>
            Product Name:</b> " . htmlspecialchars($rowCart['product_name']) . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:175px;'>
            Price:</b> " . htmlspecialchars($rowCart['price']) . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:104px;'>
            Image Source:</b> " . htmlspecialchars($rowCart['image_src']) . "</p>";

            echo "<hr>";
        }
        echo "</div>";
    } else {
        echo "<p>No cart items found.</p>";
    }

    // Retrieve data from the orders table
    $stmtOrders = $conn->prepare("SELECT * FROM orders");

    $stmtOrders->execute();
    $resultOrders = $stmtOrders->get_result();

    if ($resultOrders->num_rows > 0) {
        echo "<div style='margin-left: 7px;padding:40px;'>";
        echo "<h1 style='font-size:40px;color:white;'>Your Orders</h1>";

        while ($rowOrders = $resultOrders->fetch_assoc()) {
            // Display order information
            echo "<p><b style='color: blue;font-size:20px; margin-right:95px;'>
            Full Name:</b> " . (isset($rowOrders['FullName']) ? htmlspecialchars($rowOrders['FullName']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:135px;'>
            Email:</b> " . (isset($rowOrders['Email']) ? htmlspecialchars($rowOrders['Email']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:108px;'>
            PhoneNo:</b> " . (isset($rowOrders['PhoneNo']) ? htmlspecialchars($rowOrders['PhoneNo']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:115px;'>
            Country:</b> " . (isset($rowOrders['Country']) ? htmlspecialchars($rowOrders['Country']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:145px;'>
            State:</b> " . (isset($rowOrders['State']) ? htmlspecialchars($rowOrders['State']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:151px;'>
            City:</b> " . (isset($rowOrders['City']) ? htmlspecialchars($rowOrders['City']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:126px;'>
            Doorno:</b> " . (isset($rowOrders['Doorno']) ? htmlspecialchars($rowOrders['Doorno']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:136px;'>
            PinNo:</b> " . (isset($rowOrders['PinNo']) ? htmlspecialchars($rowOrders['PinNo']) : "") . "</p>";

            echo "<p><b style='color: blue;font-size:20px; margin-right:50px;'>
            PaymentMethod:</b> " . (isset($rowOrders['PaymentMethod']) ? htmlspecialchars($rowOrders['PaymentMethod']) : "") . "</p>";
            
            echo "</div>";
            echo "<hr>";
        
        }
    } else {
        // No data found, handle accordingly
        header("Location: deliveryaddress.html");
        exit();
    }
} else {
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>