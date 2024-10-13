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

    // Check if table is empty
    $sql = "SELECT COUNT(*) as count FROM USERS";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $sql = "INSERT INTO USERS (permissions, email, pass)
        VALUES ('Admin', 'maddieanels88@gmail.com', 'plpluu78')";

        $conn->query($sql);

        $sql = "INSERT INTO USERS (permissions, email, pass)
        VALUES ('User', 'nightc1over0@gmail.com', 'plpl')";
        $conn->query($sql);

        $sql = "INSERT INTO USERS (permissions, email, pass)
            VALUES ('User', 'test1@gmail.com', 'password')";
            $conn->query($sql);
    }
    $conn->close();


   
?>