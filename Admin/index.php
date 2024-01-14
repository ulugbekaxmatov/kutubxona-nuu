<?php
session_start();
include_once 'dbconfig.php';

if (isset($_POST['logout'])) {
    // Log the "Logout" action
    logAdminLogoutActivity('Admin logout', 'Admin logged out.');

    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
    $image_url = "http://localhost/1-dars/$image_folder$new_image_name";

    // Redirect to the login page
    header('Location: admin_login.php');
    exit();
}

function logAdminLogoutActivity($task_type, $description)
{
    $conn = new mysqli("localhost", "root", "root", "library");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO admin_tasks (task_type, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $task_type, $description);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
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
                    <h1><a href="index.php">Library<span> Admin</span></a></h1>
                </div>
                <form method="post" action="">
                    <div class="logout" style="text-align: center;">
                        <button type="submit" name="logout" style="width: 150px; padding: 8px 12px; background: #00a2d1; color: #fff; font-weight: bold; border-radius: 3px; border: none; cursor: pointer;">Logout</button>
                    </div>
                </form>
                <div class="clr"></div>
                <div class="menu_nav">
                    <ul>
                        <li class="active"><a href="index.php">Main</a></li>
                        <li><a href="books.php">Books</a></li>
                        <li><a href="news.php">News</a></li>
                        <li><a href="tasks.php">Admin tasks</a></li>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="content">
            <div class="content_resize">
                <img src="images/index_image.jpg" width="98%" alt="" class="hbg_img" />
                <div class="rasmga"></div>
                <!--<p class="pages"><small>Page 1 of 2 </small><span>1</span><a href="#">2</a><a href="#">&raquo;</a></p>-->
                <div class="clr"></div>
            </div>
            <div class="sidebar">
                <div class="searchform">
                </div>
                <div class="clr"></div>
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
                    <p><a href="https://t.me/AUF_1974">elektron_pochta@gmail.com</a></p>
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
