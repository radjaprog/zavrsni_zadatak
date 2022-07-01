<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname;port=3307", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>


    if (isset($_POST['submit'])) {
        $body = $_POST['body'];
        $title = $_POST['title'];
	$author = $_POST['author'];
        if(empty($body) || empty($title) || empty($author)) {
            echo("Please fill in all fields");
    
        } else {
            $currentDate = date("Y-m-d h:i");
            $sql = "INSERT INTO posts (
                title, body, author, created_at)
                VALUES ('$title', '$body', '$author', '$currentDate')";

            $statement = $connection->prepare($sql);
            $statement->execute();
            header("Location: ./index.php");
            echo ("write to db");
        }
    }

?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.ico">
    <title>Zavrsni zadatak - Vladimir Radenovic</title>

    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>


<body class="col-sm-8 blog-main">

    <?php
    include('header.php');
    ?>
    <div class="blog-post">
        <h1 "blog-post-meta"> Create new post </h1>
        <form action="create-post.php" method="POST" id="postsForma">
            <ul class="flax-out">
                <li>
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter title">
                </li>
                <li>
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" placeholder="Enter your name">
                </li>
                <li>
                    <label for="email">Body</label>
                    <textarea name="body" placeholder="Enter body" rows="10" id="bodyPosts"></textarea><br>
                </li>
                <li>
                    <button type="submit" name="submit">Submit</button>
                </li>
            </ul>
        </form>
    </div>

    <?
    include('footer.php');
    ?>