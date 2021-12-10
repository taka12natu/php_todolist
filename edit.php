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
$result = $stmt->fetch();
if(!$result){
    echo 'エラー';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>
</head>
<body>
    <form action="edit_do.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <textarea name="text" cols="30" rows="5" placeholder="入力してください"><?php echo htmlspecialchars($text); ?></textarea><br>
        <button type="submit">編集する</button>
    </form>
</body>
</html>