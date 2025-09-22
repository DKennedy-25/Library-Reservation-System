<?php 
include 'includes/db.php';
include 'includes/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: search.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!-- Index HTML code -->
<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
    <p><a href="register.php">Register</a></p>
</form>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
<?php include 'includes/footer.php'; ?>
