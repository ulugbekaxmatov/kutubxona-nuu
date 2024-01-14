<?php
// echo "pre";
// var_dump($_POST);

if (isset($_POST["mavzu"])) {
    $mavzu = $_POST["mavzu"];
    $qisqa = $_POST["Qisqacha"];
    $tarifi = $_POST["Tarifi"];
    $vaqt = "27072023"; // Assuming you want to set a fixed value for $vaqt

    // Establishing a connection to the database
    $conn = mysqli_connect("localhost", "root", "root", "library");

    // Checking if the connection is successful
    if (!$conn) {
        die("Baza bilan bog`lanib bo`lmaydi");
    }

    // Using prepared statement to prevent SQL injection
    $sql = "INSERT INTO yangiliklar VALUES (null, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Binding parameters
    mysqli_stmt_bind_param($stmt, "ssss", $mavzu, $qisqa, $tarifi, $vaqt);

    // Executing the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("location: Yangiliklar.php");
        exit(); // Ensure that the script stops execution after the redirection
    } else {
        echo "Error: " . mysqli_error($conn); // Display any errors in the query
    }

    // Close the prepared statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head class="diyora">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Yangilik.css">
    <title>Dakument</title>
</head>
<body>
  <form method="post">
    <label>Mavzu: </label><br>
    <input type="text" name="Mavzu" > <br>
    <label>Qisqa: </label><br>
    <input type="text" name="Qisqa" > <br>
    <label>Tarifi: </label><br>
    <textarea name="Tarifi" cols="30" rows="10"></textarea> <br>
    <button type="submit">SAQLASH</button>
  </form>
  <style>
   /* styles.css */
   Body {
    background-color: pink;
    text-align: center;
   }
   
  </style>
</body>
</html>
