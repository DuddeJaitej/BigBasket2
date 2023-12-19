<?php
$host = "localhost";
$user = "root";
$pass = "Jai1421tej@333";
$dbname = "BigBasket1";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection Failed..." . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $storedCart = $_POST["cartData"];
    $cart = json_decode($storedCart, true);

    foreach ($cart as $item) {
        $productName = $item['productName'];
        $price = $item['price'];
        $imageSrc = isset($item['imageSrc']) ? $item['imageSrc'] : '';
        

        $stmt = $conn->prepare("INSERT INTO cartItems VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $productName, $price, $imageSrc);

        if (!$stmt->execute()) {
            die("Error: " . $stmt->error);
        }

        $stmt->close();
    }

    // Redirect to the desired page after successful insertion
    header("Location: thankyou.html");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
