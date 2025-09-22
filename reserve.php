<?php
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $username = $_SESSION['username'];

    // Check if the book is available
    $stmt = $pdo->prepare("SELECT available FROM books WHERE isbn = ?");
    $stmt->execute([$isbn]);
    $book = $stmt->fetch();

    if ($book && $book['available']) {
        // Reserve the book
        $stmt = $pdo->prepare("INSERT INTO reservations (username, isbn, reservation_date) VALUES (?, ?, NOW())");
        $stmt->execute([$username, $isbn]);

        // Mark the book as unavailable
        $stmt = $pdo->prepare("UPDATE books SET available = 0 WHERE isbn = ?");
        $stmt->execute([$isbn]);

        echo "Book reserved successfully!";
    } else {
        echo "Book is not available.";
    }
} else {
    echo "No book selected.";
}

echo '<p><a href="search.php">Back to search</a></p>';
?>
