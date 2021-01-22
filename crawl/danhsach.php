<?php
require_once('connect.php');
$sql = "SELECT * FROM article";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h2>Danh sách crawl tin tức</h2>
    <table>
        <tr>
            <th>Website</th>
            <th>Tiêu đề</th>
            <th>Thể loại</th>
            <th>Nội dung</th>
        </tr>
        <?php
        if ($result->num_rows > 0) : {
                // output data of each row
                while ($row = $result->fetch_assoc()) : {
        ?>
                        <tr>
                            <td>
                                <?= $row['website'] ?>
                            </td>
                            <td style="width:20%">
                                <?= $row['title'] ?>
                            </td>
                            <td style="width:10%">
                                <?= $row['category'] ?>
                            </td>
                            <td>
                                <?= $row['content'] ?>
                            </td>
                        </tr>
                <?php }
                endwhile; ?>
        <?php }
        endif; ?>
    </table>
    <?php $conn->close(); ?>
</body>

</html>