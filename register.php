<?php include 'includes/db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);// hashes password entry for security
    $fullname = $_POST['fullname'];
    $city = $_POST['city'];
    $mobile = $_POST['mobile'];

    $rows = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $rows->execute([$username]);
    $dupe_count = $rows->fetchColumn();

    if ($dupe_count > 0){
        $error_message = "Username already exists. Please choose a different one.";
    }
    else{
            if (strlen($mobile) == 10 && !empty($username)) {//strlen for mobile as it is a requirement to be 10 and username can't be empty as it is a primary key
            $rows = $pdo->prepare("INSERT INTO users (username, password, fullname, city, mobile) VALUES (?, ?, ?, ?, ?)");
            $rows->execute([$username, $password, $fullname, $city, $mobile]);
            header("Location: index.php");
        } else {
            $error_message = "Invalid input. Make sure all fields are filled correctly.";
            //will display for example when all fields are full but phone number is not 10 digits
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<!-- HTML for register page -->
<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="fullname">Full Name:</label>
    <input type="text" name="fullname" required>

    <label for="city">City:</label>
    <input type="text" name="city" required>

    <label for="mobile">Mobile:</label>
    <input type="text" name="mobile" required>

    <button type="submit">Register</button>
</form>
<!-- error message handeling -->
<?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
<?php include 'includes/footer.php'; ?>
