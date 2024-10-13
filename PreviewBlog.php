<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Preview</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Slackside+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/MainFormat.css">
    <link rel="stylesheet" href="css/tablet.css" media="screen and (min-width: 501px) and (max-width: 768px)">
    <link rel="stylesheet" href="css/Mobile.css" media="screen and (max-width: 500px)">
    
    <script src="js/Nav.js" defer></script>

</head>
<body>
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
    ?>
    <div class = "Container">
        <!-- Navigation -->
        <div class="Navigation">
            <img class = "Background" src="images/Background.png">
            <nav class = "Content">
                <ul>
                    <li>Preview Blog</li>
                </ul>
            </nav>
        </div>

        <!-- Main Information -->
        <section class="MainContent BlogPage"> 
            <img class = "Background" src="images/Background.png">
            <header class="Content" id="Blog">
                    <h1>Preview Blog</h1>
            </header>

            <!-- Blogs -->
            <!-- Load blogs from database -->
            <div class ="yCards">
                <article class='Content BlogPosts'>
                    <h2><?php echo $_POST['Title']; ?></h2>
                    <?php echo "<h6> ".date('d\t\h F Y') ." ". gmdate('H:i'). " UTC. </h6>"?>
                    <p><?php echo $_POST['BlogContent'];?></p>
                    <form class = "Content" id="AddPost"  method="POST" action="http://localhost/Project/AddPost.php">
                        <fieldset>
                            <input type="text" name="Title"  id = "PreviewTitle" value="<?php echo $_POST['Title']; ?>" readonly>
                
                            <textarea rows="5" name = "BlogContent" id = "PreviewBlogContent" value="<?php echo $_POST['BlogContent'];?>" readonly><?php echo $_POST['BlogContent']; ?></textarea>

                            <input type="submit" value="Post" name = "Post">
                            <input type="submit" value ="Edit" name = "Edit">
                        </fieldset>
                    </form>
                </article>

                <?php 
                    $sql = "SELECT * FROM POSTS";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {

                        // Fetch all rows from the result and store them in an array
                        $rows = [];
                        while ($row = $result->fetch_assoc()) {
                            $rows[] = $row;
                        }
                        
                        // Sort the array using merge sort algorithm
                        function mergeSort(&$array, $key) {
                            if (count($array) <= 1) {
                                return;
                            }
                                                
                            $mid = floor(count($array) / 2);
                            $left = array_slice($array, 0, $mid);
                            $right = array_slice($array, $mid);
                                                
                            mergeSort($left, $key);
                            mergeSort($right, $key);
                                                
                            merge($left, $right, $array, $key);
                        }
                    
                        function merge(&$left, &$right, &$array, $key) {
                            $i = 0;
                            $j = 0;
                            $k = 0;
                                            
                            while ($i < count($left) && $j < count($right)) {

                                $leftDate = date('d m y', strtotime($left[$i][$key]));
                                $rightDate = date('d m y', strtotime($right[$j][$key]));

                                $leftDateComponents = explode(' ', $leftDate);
                                $rightDateComponents = explode(' ', $rightDate);

                                $leftDay = $leftDateComponents[0];
                                $leftMonth = $leftDateComponents[1];
                                $leftYear = $leftDateComponents[2];

                                $rightDay = $rightDateComponents[0];
                                $rightMonth = $rightDateComponents[1];
                                $rightYear = $rightDateComponents[2];

                                if ($leftYear > $rightYear) {
                                    $array[$k] = $left[$i];
                                    $i++;
                                } elseif ($leftYear < $rightYear) {
                                    $array[$k] = $right[$j];
                                    $j++;
                                } else {
                                    if ($leftMonth > $rightMonth) {
                                        $array[$k] = $left[$i];
                                        $i++;
                                    } elseif ($leftMonth < $rightMonth) {
                                        $array[$k] = $right[$j];
                                        $j++;
                                    } else {
                                        if ($leftDay > $rightDay) {
                                            $array[$k] = $left[$i];
                                            $i++;
                                        } elseif($leftDay < $rightDay) {
                                            $array[$k] = $right[$j];
                                            $j++;
                                        }
                                        else{
                                            $leftTime = $left[$i]['TimePosted'];
                                            $rightTime = $right[$j]['TimePosted'];

                                            if ($leftTime >= $rightTime) {
                                                $array[$k] = $left[$i];
                                                $i++;
                                            } else {
                                                $array[$k] = $right[$j];
                                                $j++;
                                            }
                                        }
                                    }
                                }
                                $k++;
                            }
                        
                            while ($i < count($left)) {
                                $array[$k] = $left[$i];
                                $i++;
                                $k++;
                            }
                                                
                            while ($j < count($right)) {
                                $array[$k] = $right[$j];
                                $j++;
                                $k++;
                            }
                        }
                    
                        mergeSort($rows, 'DayPosted');
                            
                        // Print the sorted rows
                        foreach ($rows as $row) {
                            echo "<article class='Content BlogPosts'>";
                            echo "<h2>" . $row['Title'] . "</h2>";
                            echo "<h6>" . date('d\t\h F Y', strtotime($row['DayPosted'])) . " " . date('H:i', strtotime($row['TimePosted'])) . " UTC. </h6>";
                            echo "<p>" . $row['BlogPost'] . "</p>";
                            echo "</article>";
                        }
                        
                    } else {
                        echo "<article class='Content BlogPosts'>";
                        echo "<h2> Empty Blog</h2>";
                        echo "<h6> No posts available </h6>";
                        echo "<p>0 results</p>";
                        echo "</article>";
                    }
                    $conn->close();
                ?>
            </div>

            <footer>
                <p><i><small>Copyright &copy; 2024 M. A. Nelson</small></i></p>
            </footer>
        </section>
    </div>
</body>
</html>