<?php
include_once 'dbconfig.php';

function log_admin_action($task_type, $description)
{
    global $host;
    $sql_query_log = "INSERT INTO admin_tasks (task_type, description) VALUES ('$task_type', '$description')";
    mysqli_query($host, $sql_query_log);
}

if (isset($_POST['btn-save'])) {
    // Retrieving the updated book information from the form
    $book_id = $_POST['book_id'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    // SQL query to update book information based on book_id
    $sql_query = "UPDATE books SET name='$name', author='$author', price='$price', image_url='$image_url' WHERE book_id='$book_id'";

    if (mysqli_query($host, $sql_query)) {
        // Log the 'Update Book' action to admin_tasks table
        log_admin_action('Update Book', 'Admin updated the book: ' . $name);
        ?>
        <script type="text/javascript">
            alert('Book updated successfully');
            window.location.href = 'books.php';
        </script>
        <?php
    } else {
        $error_message = mysqli_error($host);
        ?>
        <script type="text/javascript">
            alert("Error while updating book: <?php echo $error_message; ?>");
            window.location.href = 'books.php';
        </script>
        <?php
    }
} elseif (isset($_GET['id'])) {
    // Fetching the book information based on book_id for editing
    $book_id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE book_id='$book_id'";
    $result = mysqli_query($host, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
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
                        <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>" />
                        <table align="center">
                            <tr>
                                <td><input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" required /></td>
                                <td><input type="text" name="author" placeholder="Author" value="<?php echo $row['author']; ?>" required /></td>
                            </tr>
                            <tr>
                                <td><input type="number" name="price" placeholder="Price" value="<?php echo $row['price']; ?>" step="0.01" required /></td>
                                <td><input type="text" name="image_url" placeholder="Image URL" value="<?php echo $row['image_url']; ?>" /></td>
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
                        +998(94)000 00 00<br />
                        +998(90)000 00 00
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
