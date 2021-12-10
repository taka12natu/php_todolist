<?php
require('dbconnection.php');
$counts = $db->query('select count(*) as cnt from todolist');
$count = $counts->fetch_assoc();
$max_page = ceil($count['cnt']/5);
$stmt = $db->prepare('select * from todolist order by id desc limit ?,5');
if(!$stmt){
    die($db->error);
};
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
if(!$page){
    $page = 1;
}
$start = ($page - 1) * 5;
$stmt->bind_param('i', $start);
$result = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todolist</title>
</head>
<body>
    <h1>todolist</h1>
    <p><a href="input.html">新規登録</a></p>
    <?php if(!$result): ?>
        <p>表示する内容はありません</p>
        <?php endif; ?>
    <?php $stmt->bind_result($id, $text, $created); ?>
    <?php while($stmt->fetch()): ?>
    <div>
        <h2><a href="detail.php?id=<?php echo $id; ?>"><?php echo htmlspecialchars(mb_substr($text, 0, 10)); ?></a></h2>
        <div><?php echo htmlspecialchars($created); ?></div>
    </div>
    <hr>
    <?php endwhile; ?>
    <p>
        <?php if($page>1): ?>
        <a href="?page=<?php echo $page-1 ?>"><?php echo $page-1?>ページ目へ</a> | 
        <?php endif; ?>
        <?php if($page<$max_page): ?>
        <a href="?page=<?php echo $page+1 ?>"><?php echo $page+1?>ページ目へ</a> 
        <?php endif; ?>
    </p>
</body>
</html>