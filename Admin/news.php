<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

$sql_query_news = "SELECT * FROM news";
$result_set_news = mysqli_query($host, $sql_query_news);

if (isset($_GET['search'])) {
    $subject = $_GET['subject'];
    $summary = $_GET['summary'];
    $text = $_GET['text'];

    $sql_query_news = "SELECT * FROM news WHERE 1=1";

    if (!empty($subject)) {
        $sql_query_news .= " AND subject LIKE '%$subject%'";
    }
    if (!empty($summary)) {
        $sql_query_news .= " AND summary LIKE '%$summary%'";
    }
    if (!empty($text)) {
        $sql_query_news .= " AND text LIKE '%$text%'";
    }

    $result_set_news = mysqli_query($host, $sql_query_news);
}
?>

<script type="text/javascript">
    function edt_id(id) {
        if (confirm('Do you really want to change the data?')) {
            window.location.href = "news_edit.php?id=" + id;
        }
    }

    function delete_id(id) {
        if (confirm('Do you really want to delete data?')) {
            window.location.href = "news_delete.php?id=" + id;
        }
    }
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ulugbek</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/arial.js"></script>
    <script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="header_resize">
                <div class="logo">
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
                    <form method="get" action="news.php">
                        <input type="text" name="subject" placeholder="Subject" />
                        <input type="text" name="summary" placeholder="Summary" />
                        <input type="text" name="text" placeholder="Text" />
                        <input type="submit" name="search" value="Search" />
                    </form>
                    <br />
                    <table align="center" style="font-size: 16px;">
                        <tr>
                            <th>News ID</th>
                            <th>Subject</th>
                            <th>Summary</th>
                            <th>Text</th>
                            <th>Time</th>
                            <th colspan="3">Actions</th>
                        </tr>

                        <?php
                        while ($row = mysqli_fetch_assoc($result_set_news)) {
                            echo "<tr>";
                            echo "<td>" . $row['news_id'] . "</td>";
                            echo "<td>" . $row['subject'] . "</td>";
                            echo "<td>" . $row['summary'] . "</td>";
                            echo "<td>" . $row['text'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo '<td align="center"><a href="javascript:edt_id(\'' . $row['news_id'] . '\')"><button style="width: 100px;">Edit</button></a></td>';
                            echo '<td align="center"><a href="javascript:delete_id(\'' . $row['news_id'] . '\')"><button style="width: 100px;">Delete</button></a></td>';
                            echo "</tr>";
                        }

                        // Log the 'View News' action
                        log_admin_action('View News', 'Admin viewed news table');
                        ?>
                    </table>
                    <br />
                    <div style="text-align: center; margin-bottom: 20px;">
                        <a href="news_add.php">
                            <button style="width: 150px; padding: 8px 12px; background: #00a2d1; color: #fff; font-weight: bold; border-radius: 3px; border: none; cursor: pointer;"> Add New News
                            </button>
                        </a>
                    </div>
                    <br />
                </div>
            </div>
        </div>
        <div class="fbg">
            <div class="fbg_resize">
                <div class="col c1">
                    <h2><span>Images</span></h2>
                    <a href="#"><img src="images/pix1.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix2.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix3.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix4.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix5.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix6.jpg" width="58" height="58" alt="" /></a>
                </div>
                <div class="col c3">
                    <h2><span>Contact</span></h2>
                    <p>Contact the developer</p>
                    <p><a href="https://t.me/AUF_1974">ulugbekaxmatov03@gmail.com</a></p>
                    <p>
                       +998-94-004-82-51<br />
                        +998-91-010-07-51
                    </p>
                    <p>Tashkent city, Almazor district, 12th students residence :)</p>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="footer">
            <div class="footer_resize">
                <p class="lf">Copyright &copy; <a href="#">Cyberdine</a>. All Rights Reserved</p>
                <div class="clr"></div>
            </div>
        </div>
    </div>
</body>
</html>
