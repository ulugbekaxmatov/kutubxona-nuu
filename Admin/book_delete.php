<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Retrieve book information before deletion for logging
    $sql_select_book = "SELECT name FROM books WHERE book_id = '$book_id'";
    $result_select_book = mysqli_query($host, $sql_select_book);
    $row_select_book = mysqli_fetch_assoc($result_select_book);
    $book_name = $row_select_book['name'];

    // SQL query to delete a book based on book_id
    $sql_delete_book = "DELETE FROM books WHERE book_id = '$book_id'";

    if (mysqli_query($host, $sql_delete_book)) {
        // Log the 'Delete Book' action to admin_tasks table
        log_admin_action('Delete Book', 'Admin deleted the book: ' . $book_name);
        ?>
        <script type="text/javascript">
            alert("Book deleted successfully");
            window.location.href = "books.php"; // Redirect to books page after deletion
        </script>
        <?php
    } else {
        $error_message = mysqli_error($host);
        ?>
        <script type="text/javascript">
            alert("Error deleting book: <?php echo $error_message; ?>");
            window.location.href = "books.php"; // Redirect to books page if deletion encounters an error
        </script>
        <?php
    }
} else {
    $error_message = mysqli_error($host);
    ?>
    <script type="text/javascript">
        alert("Error deleting book: <?php echo $error_message; ?>");
        window.location.href = "books.php"; // Redirect to books page if deletion encounters an error
    </script>
    <?php
}
?>
