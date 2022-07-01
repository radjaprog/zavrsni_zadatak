
<?php
  $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blogs";

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

<?php include('header.php') ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">

                 <?php
			if (isset($_GET['post_id'])) {
                $sql = "SELECT c.id, c.author, c.text, c.post_id 
                FROM comments as c INNER JOIN posts as p
                ON c.post_id = p.id
                WHERE c.id = {$_GET['post_id']}";

                $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $singlePost = $statement->fetch();
		
		 $sql = "SELECT * FROM posts as p WHERE c.id =  {$_GET['id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $comments = $statement->fetchAll();
            ?>
                    <article class="blog-post">
                        <header>
                            <h3><?php echo $singlePost['title'] ?></h3>

                            <div class="blog-post"><?php echo($post['created_at']) ?>by <?php echo($post['author']) ?></div>
                        </header>

                        <div>
                            <p><?php echo($post['body']) ?></p>
                        </div>                

                        <div class="blog-post">
                            <h3>comments</h3>
                        <?php foreach($comments as $comment) { ?>
                            <div class="blog-post">
                                <div>posted by: <strong><?php echo $comment['author'] ?></strong> on <?php echo $comment['post_id']?></div>
                                <div><?php echo $comment['text'] ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </article>

            <?php
                } else {
                    echo('post_id not sent through $_GET');
                }
            ?>

        </main>
    </div> 

<?php include('footer.php'); ?>
</body>
</html>
