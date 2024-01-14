<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

if (isset($_POST['btn-save'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    $sql_query = "INSERT INTO books (name, author, price, image_url)
                  VALUES ('$name', '$author', $price, '$image_url')";

    if (mysqli_query($host, $sql_query)) {
        // Log the 'Add Book' action to admin_tasks table
        log_admin_action('Add Book', 'Admin added a new book: ' . $name);
        ?>
        <script type="text/javascript">
            alert('Book information added successfully');
            window.location.href = 'books.php';
        </script>
        <?php
    } else {
        $error_message = mysqli_error($host);
        ?>
        <script type="text/javascript">
            alert("Error while adding book information: <?php echo $error_message; ?>");
            window.location.href = 'books.php';
        </script>
        <?php
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
                <div class="logo">
                    <h1><a href="index.php">Library<span> Admin</span></a></h1>
                </div>
                <div class="clr"></div>
                <div class="menu_nav">
                    <ul>
                        <li><a href="index.php">Main</a></li>
                        <li class="active"><a href="books.php">Books</a></li>
                        <li><a href="news.php">News</a></li>
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
                        <table align="center">
                            <tr>
                                <td><input type="text" name="name" placeholder="Name" required /></td>
                                <td><input type="text" name="author" placeholder="Author" required /></td>
                            </tr>
                            <tr>
                                <td><input type="number" name="price" placeholder="Price" step="0.01" required /></td>
                                <td><input type="text" name="image_url" placeholder="Image URL" /></td>
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
