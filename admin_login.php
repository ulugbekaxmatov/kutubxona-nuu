<?php
session_start();

function logAdminLoginActivity($task_type, $description)
{
    $conn = new mysqli("localhost", "root", "root", "library");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO admin_tasks (task_type, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $task_type, $description);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle the error if prepare() fails
        die("Error in the prepared statement: " . $conn->error);
    }

    $conn->close();
}

// if (isset($_SESSION['admin']) && $_SESSION['admin']) {
//     // logAdminLoginActivity('Admin already logged in.');
//     header('Location: admin_login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'adminpass') {
        logAdminLoginActivity('Admin login', 'Admin logged in successfully.');

        $_SESSION['admin'] = true;
        header('Location: Admin/index.php');
        exit();
    } else {
        logAdminLoginActivity('Error admin login', 'Invalid login attempt.');
        $error_message = 'Invalid login credentials.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include necessary head elements here -->
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="body_img   ">
    <div class="wrapper">
        <div class="slide_active" >
            <div class="container">
                <div class="row align-items-center">
                    <div class="home-content">
                        <h1>Tizimga kirish</h1>
                   </div>
                </div>
            </div>


            <?php if (isset($error_message)): ?>
                <p style="color: red;">
                    <?php echo $error_message; ?>
                </p>
            <?php endif; ?>
            <form method="post" action="">
                <label for="username" class="classss">
                    <h3>Elektron pochta: </h3>
                </label>

                <input type="text" id="username" name="username" required>
                <br>
                <label for="password" class="klasas">
                    <h3>Parolni kiriting: </h3>
                </label>
                <input type="password" id="password" name="password" required>
                <br>
                <br>
                <button type="submit" class="login">
                    <h3>Tizimga kiritish: </h3>
                </button>
            </form>
        </div>
    </div>
</body>

</html>