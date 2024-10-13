<?php
    if($_POST['Edit']){
        header("Location: http://localhost/Project/AddBlog.html");
    }

    if($_POST['Post']){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "ecs417";
           
        // Creates connection
        $conn = new mysqli($servername, $username, $password, $dbname);
                
        // Checks connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $message = "Connection failed";
        }
        $Title = $_POST['Title'];
        $BlogPost = $_POST['BlogContent'];
        $date = date('d F Y');
        $time = gmdate('H:i:s');
            
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $sql = "INSERT INTO POSTS (Title, BlogPost, DayPosted, TimePosted)
            VALUES ('$Title', '$BlogPost', '$date', '$time')";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                header("Location: http://localhost/Project/Blog.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
                header("Location: http://localhost/Project/Blog.php");
            }
            $conn->close();
        }
    }
?>