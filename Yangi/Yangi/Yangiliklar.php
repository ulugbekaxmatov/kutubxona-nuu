<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Yangi/Yangi/Yangilik.css">


    <title>Yangiliklar</title>
</head>
<body>
  <a href="create.php" class="a-button">Yaratish</a>
  <br>

  <table>
    <tr> 
      <td >Mavzu</td > 
      <td> Qisqa</td>
      <td> Tarifi</td>
      <td> Vaqti</td>
    </tr>

    <?php
    // Establishing a connection to the database
    $conn = mysqli_connect("localhost", "root", "root", "library");

    // Checking if the connection is successful
    if (!$conn) {
        die("Baza bilan bog`lanib bo`lmaydi");
    }

    // Query to retrieve news information from the database
    $sql = "SELECT * FROM yangiliklar";
    $result = mysqli_query($conn, $sql);

    // Check if there are rows in the result
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["Mavzu"] . "</td>";
            echo "<td>" . $row["Qisqa"] . "</td>";
            echo "<td>" . $row["tarifi"] . "</td>";
            echo "<td>" . $row["vaqti"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No news found</td></tr>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
  </table>
</body>
</html>
