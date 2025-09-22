<?php
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// book removal code
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $reservationId = $_POST['remove_id'];


    $stmt = $pdo->prepare("SELECT isbn FROM reservations WHERE id = ? AND username = ?");
    $stmt->execute([$reservationId, $username]);
    $reservation = $stmt->fetch();

    //error checking for reservation
    if ($reservation) {

        $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
        $stmt->execute([$reservationId]);


        $stmt = $pdo->prepare("UPDATE books SET available = 1 WHERE isbn = ?");
        $stmt->execute([$reservation['isbn']]);

        $message = "Reservation removed successfully!";
    } else {
        $error = "Failed to remove the reservation.";
    }
}

// gets the users reservations
$reservations = $pdo->prepare("
    SELECT r.id, b.isbn, b.title, b.author, r.reservation_date 
    FROM reservations r 
    JOIN books b ON r.isbn = b.isbn 
    WHERE r.username = ?
");
$reservations->execute([$username]);
$reservedBooks = $reservations->fetchAll();
?>


<!-- HTML fro reserved books -->
<h2>My Reserved Books</h2>
<?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<?php if ($reservedBooks): ?>
    <form method="POST" action="">
        <table>
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Reservation Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservedBooks as $book): ?>
                    <tr>
                        <td><?= $book['isbn'] ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['reservation_date'] ?></td>
                        <td>
                            <button type="submit" name="remove_id" value="<?= $book['id'] ?>">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
<?php else: ?>
    <p>No books reserved.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
