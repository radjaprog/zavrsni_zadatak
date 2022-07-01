
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
                $sql = "SELECT c.id, c.author, c.text, c.post_id 
                FROM comments as c INNER JOIN posts as p
                ON c.post_id = p.id
                ORDER BY p.created_at DESC LIMIT 3";

                $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $comments = $statement->fetchAll();

            ?>
	          <?php
                foreach ($posts as $post) {
            ?>

                    <article class="blog-post">
                        <header>
                            <h1><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h1>
                            <div class="blog-post"><?php echo($post['created_at']) ?>by <?php echo($post['author']) ?></div>
                        </header>

                        <div>
                            <p><?php echo($post['body']) ?></p>
                        </div>
                    </article>

            <?php
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

    <?php include('sidebar.php'); ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include('footer.php'); ?>
</body>
</html>
