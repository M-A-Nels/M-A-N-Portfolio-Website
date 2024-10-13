<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ecs417";
     
    // Creates connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checks connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "Connection failed";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['Email'];
        $pass1 = $_POST['password'];

        $sql = "SELECT * FROM USERS WHERE email = '$email' AND pass = '$pass1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['UserID'] = $email;
            echo $_SESSION['UserID'];
            $sql2 = "SELECT permissions FROM USERS WHERE email = '$email' AND pass = '$pass1'";
            $_SESSION['Role'] = $conn->query($sql2)->fetch_assoc()['permissions'];
            echo $_SESSION['Role'];
            $conn->close();
            header("Location: http://localhost/Project/Blog.php");
        } else {
            echo "Login failed!";
            $conn->close();
            header("Location: http://localhost/Project/Login.html");
        }
    }
?>