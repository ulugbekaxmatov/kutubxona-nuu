<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

// Delete tasks completed over one week
$one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));
$sql_delete_old_tasks = "DELETE FROM admin_tasks WHERE timestamp < '$one_week_ago'";
mysqli_query($host, $sql_delete_old_tasks);

$sql_query_tasks = "SELECT * FROM admin_tasks";

if (isset($_GET['search'])) {
    $task_type = $_GET['task_type'];
    $description = $_GET['description'];
    $task_date = $_GET['task_date'];

    $sql_query_tasks .= " WHERE 1=1";

    if (!empty($task_type)) {
        $sql_query_tasks .= " AND task_type LIKE '%$task_type%'";
    }
    if (!empty($description)) {
        $sql_query_tasks .= " AND description LIKE '%$description%'";
    }
    if (!empty($task_date)) {
        $sql_query_tasks .= " AND timestamp >= '$task_date'";
    }
}

// Display tasks in reverse order based on time
$sql_query_tasks .= " ORDER BY timestamp DESC";

$result_set_tasks = mysqli_query($host, $sql_query_tasks);
?>


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
                    <h1><a href="index.php">Kutubxona<span> Admin</span></a></h1>
                </div>
                <div class="clr"></div>
                <div class="menu_nav">
                    <ul>
                        <li><a href="index.php">Asosiy</a></li>
                        <li><a href="books.php">Kitoblar</a></li>
                        <li><a href="news.php">Yangiliklar</a></li>
                        <li class="active"><a href="tasks.php">Admin vazifalari</a></li>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="content">
            <div id="body">
                <div id="content">
                    <form method="get" action="tasks.php">
                        <input type="text" id="task_type" name="task_type" placeholder="Enter Task Type" />
                        <input type="text" id="description" name="description" placeholder="Enter Description" />
                        <input type="date" id="task_date" name="task_date" />
                        <input type="submit" name="search" value="Search" />
                    </form>
                    <br />
                    <div class="table-container">
                        <table align="center" style="font-size: 16px;">
                            <tr>
                                <th>Task ID</th>
                                <th>Task Type</th>
                                <th>Description</th>
                                <th>Task Date</th>
                            </tr>

                            <?php
                            while ($row = mysqli_fetch_assoc($result_set_tasks)) {
                                echo "<tr>";
                                echo "<td>" . $row['task_id'] . "</td>";
                                echo "<td>" . $row['task_type'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['timestamp'] . "</td>";
                                echo "</tr>";
                            }

                            log_admin_action('View tasks', 'Admin viewed taks schedule');
                            ?>
                        </table>
                        <br />
                    </div>
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
                    <p><a href="#">javohirabdugafforov222@gmail.com</a></p>
                    <p>
                        +998-93-149-78-56<br />
                        +998-99-281-54-94
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
