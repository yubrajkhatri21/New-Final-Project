include('php/connector.php');
include('php/content_filter.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];

    // Filter the comment
    $filteredComment = filterContent($comment);

    // Save the filtered comment to the database
    $query = "INSERT INTO comments (user_id, comment) VALUES ('{$_SESSION['user_id']}', '$filteredComment')";
    mysqli_query($con, $query);

    // Redirect back to the page
    header('Location: comments.php');
    exit();
}