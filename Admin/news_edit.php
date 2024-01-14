<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

if (isset($_POST['btn-save'])) {
    // Update news entry
    if (isset($_POST['news_id'])) {
        $news_id = $_POST['news_id'];
        $subject = $_POST['subject'];
        $summary = $_POST['summary'];
        $text = $_POST['text'];

        $sql_update_news = "UPDATE news SET subject='$subject', summary='$summary', text='$text' WHERE news_id='$news_id'";

        if (mysqli_query($host, $sql_update_news)) {
            // Log the 'Update News Entry' action to admin_tasks table
            log_admin_action('Update News Entry', 'Admin updated news entry: ' . $subject);
            ?>
            <script type="text/javascript">
                alert('News entry updated successfully');
                window.location.href = 'news.php';
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Error while updating news entry: <?php echo mysqli_error($host); ?>");
                window.location.href = 'news.php';
            </script>
            <?php
        }
    }
} elseif (isset($_GET['id'])) {
    // Fetching the news entry based on news_id for editing
    $news_id = $_GET['id'];
    $sql_news = "SELECT * FROM news WHERE news_id='$news_id'";
    $result_news = mysqli_query($host, $sql_news);

    if ($result_news) {
        $row_news = mysqli_fetch_assoc($result_news);
    } else {
        echo "Error: " . mysqli_error($host);
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ulugbek</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/arial.js"></script>
    <script type="text/javascript" src="js/cuf_run.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Adding jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="header_resize">
                <<div class="logo">
                    <h1><a href="index.php">Library<span> Admin</span></a></h1>
                </div>
                <div class="clr"></div>
                <div class="menu_nav">
                    <ul>
                        <li><a href="index.php">Main</a></li>
                        <li><a href="books.php">Books</a></li>
                        <li class="active"><a href="news.php">News</a></li>
                        <li><a href="tasks.php">Admin tasks</a></li>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="content">
            <div id="body">
                <div id="content">
                    <form method="post">
                        <input type="hidden" name="news_id" value="<?php echo $row_news['news_id']; ?>" />
                        <table align="center">
                            <tr>
                                <td><input type="text" name="subject" placeholder="Subject" value="<?php echo $row_news['subject']; ?>" required /></td>
                                <td><input type="text" name="summary" placeholder="Summary" value="<?php echo $row_news['summary']; ?>" required/></td>
                            </tr>
                            <tr>
                                <td colspan="2"><textarea name="text" placeholder="Text" required rows="10" cols="62"><?php echo $row_news['text']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
                            </tr>
                        </table>
                    </form>
                    <br />
                </div>
            </div>
        </div>
        <div class="fbg">
            <div class="fbg_resize">
                <div class="col c1">
                    <h2><span>Suratlar</span></h2>
                    <a href="#"><img src="images/pix1.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix2.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix3.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix4.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix5.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix6.jpg" width="58" height="58" alt="" /></a>
                </div>
                <div class="col c3">
                    <h2><span>Ulanish</span></h2>
                    <p>Kompaniyaga murojaat qilish</p>
                    <p><a href="https://t.me/AUF_1974">@mail adress</a></p>
                    <p>
                        +998-94-004-82-51<br />
                        +998-91-010-07-51
                    </p>
                    <p>Address: Manzil</p>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="footer">
            <div class="footer_resize">
                <p class="lf">Copyright &copy; <a href="#">Ekg</a>. All Rights Reserved</p>
                <div class="clr"></div>
            </div>
        </div>
    </div>
</body>
</html>
