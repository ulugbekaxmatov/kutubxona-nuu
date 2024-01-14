<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

$sql_query_books = "SELECT * FROM books";
$result_set_books = mysqli_query($host, $sql_query_books);

if (isset($_GET['search'])) {
    $title = $_GET['title'];
    $author = $_GET['author'];
    $price = $_GET['price'];

    $sql_query_books = "SELECT * FROM books WHERE 1=1";

    if (!empty($title)) {
        $sql_query_books .= " AND name LIKE '%$title%'";
    }
    if (!empty($author)) {
        $sql_query_books .= " AND author LIKE '%$author%'";
    }
    if (!empty($price)) {
        $sql_query_books .= " AND price = '$price'";
    }

    $result_set_books = mysqli_query($host, $sql_query_books);
}
?>


<script type="text/javascript">
    function edt_id(id) {
        if (confirm('Do you really want to edit the data?')) {
            // Log the 'Edit Book' action to admin_tasks table
            // log_admin_action('Edit Book', 'Admin edited book with ID ' + id);
            window.location.href = "book_edit.php?id=" + id;
        }
    }

    function delete_id(id) {
        if (confirm('Do you really want to delete the data?')) {
            // Log the 'Delete Book' action to admin_tasks table
            // log_admin_action('Delete Book', 'Admin deleted book with ID ' + id);
            window.location.href = "book_delete.php?id=" + id;
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
                    <form method="get" action="books.php">
                        <input type="text" id="title" name="title" placeholder="Enter Book Title" />
                        <input type="text" id="author" name="author" placeholder="Enter Author" />
                        <input type="number" id="price" name="price" step="0.01" placeholder="Enter Price" />
                        <input type="submit" name="search" value="Search" />
                    </form>
                    <br />
                    <div class="table-container">
                        <table align="center" style="font-size: 16px;">
                            <tr>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th colspan="2">Actions</th>
                            </tr>

                            <?php
                            while ($row = mysqli_fetch_assoc($result_set_books)) {
                                echo "<tr>";
                                echo "<td>" . $row['book_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['author'] . "</td>";
                                echo "<td>" . number_format($row['price'], 2) . "</td>";
                                echo "<td><img src='" . $row['image_url'] . "' alt='Book Image' style='max-width: 100px; max-height: 100px;' /></td>";
                                echo '<td align="center"><a href="javascript:edt_id(\'' . $row['book_id'] . '\')"><button style="width: 100px;">Edit</button></a></td>';
                                echo '<td align="center"><a href="javascript:delete_id(\'' . $row['book_id'] . '\')"><button style="width: 100px;">Delete</button></a></td>';
                                echo "</tr>";
                            }

                            log_admin_action('View Books', 'Admin viewed books table');
                            ?>
                        </table>
                    </div>
                    <br />
                    <div style="text-align: center; margin-bottom: 20px;">
                        <a href="book_add.php">
                            <button style="width: 150px; padding: 8px 12px; background: #00a2d1; color: #fff; font-weight: bold; border-radius: 3px; border: none; cursor: pointer;">Add New Book</button>
                        </a>
                    </div>
                    <br />
                </div>
            </div>
        </div>
        <div class="fbg">
            <div class="fbg_resize">
                  <h2><span>Images</span></h2>
                    <a href="#"><img src="images/pix1.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix2.jpg" width="58" height="58" alt="" /></a>
                    <a href="#"><img src="images/pix3.jpg" width="58" height="58" alt="" /></a>
                    <a<div class="col c1">
                   href="#"><img src="images/pix4.jpg" width="58" height="58" alt="" /></a>
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
