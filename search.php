<?php 
include 'includes/db.php'; 
include 'includes/header.php'; 

// bypass protection
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$searchResults = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $category = $_POST['category'] ?? '';

    //if no search parameters entered, reset the page
    if (empty($title) && empty($author) && empty($category)) {
        header("Location: search.php");
        exit;
    }

    $query = "SELECT b.isbn, b.title, b.author, b.available, c.category_description 
              FROM books b 
              JOIN categories c ON b.category_code = c.category_ID";
    
    $conditions = [];
    $params = [];


    if (!empty($title)) {
        $conditions[] = "b.title LIKE ?";
        $params[] = "%$title%";
    }


    if (!empty($author)) {
        $conditions[] = "b.author LIKE ?";
        $params[] = "%$author%";
    }


    if (!empty($category)) {
        $conditions[] = "c.category_ID = ?";
        $params[] = $category;
    }


    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Prepare and execute the query
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $searchResults = $stmt->fetchAll();

    } catch (PDOException $e) { //catch incase an error occurs in searching
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML code -->
<form method="POST" action="">
    <label for="title">Title:</label>
    <input type="text" name="title" placeholder="Search by title">
    <label for="author">Author:</label>
    <input type="text" name="author" placeholder="Search by author">
    <label for="category">Category:</label>
    <select name="category">
        <option value="">Select a category</option>
        <?php
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
        foreach ($categories as $cat) {
            echo "<option value='{$cat['category_ID']}'>{$cat['category_description']}</option>";
        }
        ?>
    </select>
    <button type="submit">Search</button>
</form>

<!-- HTML and PHP for displaying search results -->
<!-- Acceses the databse rather than being hardcoded -->
<?php if ($searchResults): ?>
    <table>
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody><!-- takes variables from database, not hard coded -->
            <?php foreach ($searchResults as $book): ?>
                <tr>
                    <td><?= $book['isbn'] ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['category_description'] ?></td>
                    <td><?= $book['available'] ? 'Available' : 'Reserved' ?></td>
                    <td>
                        <?php if ($book['available']): ?> <!-- for removing the reserve button if a book is already reserved -->
                            <a href="reserve.php?isbn=<?= $book['isbn'] ?>">Reserve</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>
