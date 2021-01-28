<?php
require_once('DantriParser.php');
require_once('VietnamnetParser.php');
require_once('VnexpressParser.php');
require_once('ParserFactory.php');

if (isset($_POST['type'], $_POST['parserUrl'])) {
    $type = $_POST['type'];
    $parserUrl = $_POST['parserUrl'];
    $article = ParserFactory::parser($type);
    $article->articleParserr($parserUrl);
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

            <input type="text" name="parserUrl" placeholder="VnExpress" size="40" />
            <input type="hidden" name="type" value="VnExpress" />
            <button type="submit">Crawl</button>
        </form>
        <br>
        <form action="Crawl.php" method="post">
            <input type="text" name="parserUrl" placeholder="Dân trí" size="40" />
            <input type="hidden" name="type" value="Dantri" />
            <button type="submit">Crawl</button>

        </form>
        <br>
        <form action="Crawl.php" method="post">
            <input type="text" name="parserUrl" placeholder="Vietnamnet" size="40" />
            <input type="hidden" name="type" value="Vietnamnet" />
            <button type="submit">Crawl</button>

        </form>
        <a href="danhsach.php" style="display:block;margin-top:20px">Xem danh sách</a>
    </div>
</body>

</html>