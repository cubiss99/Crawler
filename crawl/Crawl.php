<?php
require_once('DantriParser.php');
require_once('VietnamnetParser.php');
require_once('VnexpressParser.php');

if (isset($_POST['VnExpress'])) {
    $url = $_POST['VnExpress'];
    $parser = new VnexpressParser();
    $parser->articleParser($url);
} else if (isset($_POST['Dantri'])) {
    $url = $_POST['Dantri'];
    $parser = new DantriParser();
    $parser->articleParser($url);
} else if (isset($_POST['Vietnamnet'])) {
    $url = $_POST['Vietnamnet'];
    $parser = new VietnamnetParser();
    $parser->articleParser($url);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Crawler</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    form {}

    .form {
        width: 400px;
        margin: 0 auto;
        position: relative;
        top: 200px;
    }

    .form label {
        margin-right: 20px;
    }
</style>

<body>
    <div class="form">
        <h1 style="text-align:center">Crawl Article</h1>
        <form action="Crawl.php" method="post">

            <input type="text" name="VnExpress" placeholder="VnExpress" size="40" />
            <button type="submit">Crawl</button>
        </form>
        <br>
        <form action="Crawl.php" method="post">
            <input type="text" name="Dantri" placeholder="Dân trí" size="40" />
            <button type="submit">Crawl</button>

        </form>
        <br>
        <form action="Crawl.php" method="post">
            <input type="text" name="Vietnamnet" placeholder="Vietnamnet" size="40" />
            <button type="submit">Crawl</button>

        </form>
    </div>
</body>

</html>