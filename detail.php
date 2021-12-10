<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
    <?php
    require('dbconnection.php');
    $stmt = $db->prepare('select * from todolist where id=?');
    if(!$stmt){
        die($db->error);
    }
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $stmt->bind_result($id, $text, $created);
    $stmt->fetch();
    ?>
    <div><pre><?php echo htmlspecialchars($text); ?></pre></div>
    <p>
        <a href="edit.php?id=<?php echo $id ?>">編集する</a> |
        <a href="delete.php?id=<?php echo $id ?>">削除する</a> |
        <a href="index.php">一覧へ</a>
    </p>
</body>
</html>