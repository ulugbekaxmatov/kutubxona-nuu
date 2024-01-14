<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Fetching news information before deletion
    $sql_fetch_news = "SELECT * FROM news WHERE news_id = '$news_id'";
    $result_fetch_news = mysqli_query($host, $sql_fetch_news);
    $news_info = mysqli_fetch_assoc($result_fetch_news);

    // SQL query to delete a news entry based on news_id
    $sql_delete_news = "DELETE FROM news WHERE news_id = '$news_id'";

    if (mysqli_query($host, $sql_delete_news)) {
        // Log the 'Delete News Entry' action to admin_tasks table
        log_admin_action('Delete News Entry', 'Admin deleted news entry: ' . $news_info['subject']);
        ?>
        <script type="text/javascript">
            alert("News entry deleted successfully");
            window.location.href = "news.php"; // Redirect to news page after deletion
        </script>
        <?php
    } else {
        $error_message = mysqli_error($host);
        ?>
        <script type="text/javascript">
            alert("Error deleting news entry: <?php echo $error_message; ?>");
            window.location.href = "news.php"; // Redirect to news page if deletion encounters an error
        </script>
        <?php
    }
} else {
    $error_message = mysqli_error($host);
    ?>
    <script type="text/javascript">
        alert("Error deleting news entry: <?php echo $error_message; ?>");
        window.location.href = "news.php"; // Redirect to news page if deletion encounters an error
    </script>
    <?php
}
?>
