<?php
/**
 * ACE Demo by Snake.Zero
 * @copyright Alibaba group. since 2014
 */


require "common.php";

// 删除留言
// 取得mysql连接
$mysql = Demo::Mysql();

$id  = $mysql->real_escape_string($_GET['id']);
$sel = "SELECT * FROM `contents` WHERE `id` = '{$id}';";
$selquery = $mysql->query($sel);
$row = mysqli_fetch_assoc($selquery);

if (!empty($row)) {
    $sql = "DELETE FROM `contents` WHERE `id` = '{$id}' LIMIT 1;";
    if (!empty($row['image'])) {
        $Storage = Alibaba::Storage('demo');
        $result  = $Storage->delete($row['image']);
        if ($result == false){exit('delete failed');}
    }

    $query = $mysql->query($sql);

    $ocs  = Alibaba::Cache();
    $ocs->delete('datas');
}
header("Location: index.php");
