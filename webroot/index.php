<?php
/**
 * ACE Demo by Snake.Zero
 * @copyright Alibaba group. since 2014
 */


require "common.php";

// 留言列表
// 先从OCS里取出列表
$ocs  = Alibaba::Cache();
$rows = $ocs->get('datas');

$usecache = true;
if (false == isset($rows['time']) || $rows['time'] + 30 < time()) {
    $usecache = false;
    // 取得mysql连接
    $mysql = Demo::Mysql();

    $sql = "SELECT * FROM `contents` ORDER BY ID DESC LIMIT 30";
    $query = $mysql->query($sql);
    $data  = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[$row['id']] = $row;
    }
    $rows = array(
        'time' => time(),
        'data' => $data
    );
    $ocs->set('datas', $rows);
}else{
    $data = $rows['data'];
}

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<style>
div{
width:800px;
}
</style>
</head>
<body>

<div>
<div>
<h1>DEMO - 留言板</h1>
</div>
<div>
<?php if ($usecache):?>
已使用缓存
<?php else: ?>
直连数据库
<?php endif; ?>
</div>
<?php foreach ($data as $row):?>
<div style="border:1px solid black; padding:1px;margin:2px;">
<pre>
(<?php echo $row['id'];?>) [<a href="delete.php?id=<?php echo $row['id']?>">删除</a>]
<br/>
<?php echo $row['data'];?>
<?php if(!empty($row['image'])):?>
<br/><img src="image.php?id=<?php echo $row['image'];?>"/><br/>
<?php endif; ?>
</pre>
</div>
<?php endforeach; ?>
</div>

<div style="border:2px solid blue; padding:2px;margin:3px;">
    <form action="create.php" method="post" enctype="multipart/form-data">
        留言内容：<br/>
        <textarea style="width:500px;height:300px;" name="data"></textarea>
        <br/>图片附件：<br/>
        <input type="file" name="file" size="40" />
        <input type="submit" value="提交留言">
    </form>
</div>
</body>
</html>
