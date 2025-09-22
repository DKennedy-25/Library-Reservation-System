<?php

session_start();//session start included in header so all pages have it

// logout check so after pressing logout no other page can be accessed until logged back into
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {

    session_unset();
    session_destroy();

    header("Location: index.php");
    exit();
}
?>



<!-- HTML for header -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Book Reservation</title>
</head>
<body>
<header>
    <h1>Library Book Reservation System</h1>
    <nav>
        <a href="search.php">Search</a>
        <a href="reserved.php">My Reservations</a>
        <a href="index.php?logout=true">Logout</a>
    </nav>
</header>
