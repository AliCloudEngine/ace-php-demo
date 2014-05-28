<?php
/**
 * ACE Demo by Snake.Zero
 * @copyright Alibaba group. since 2014
 */


require "common.php";
$pic = '';
// 保存留言
if (false == empty($_FILES)) {
    // 只允许上传 jpeg 图片
    if ('image/jpeg' == $_FILES['file']['type']) {
        $pic = time().'.jpg';
        $Storage = Alibaba::Storage('demo');
        $result  = $Storage->saveFile($pic, $_FILES['file']['tmp_name']);
        if (false == $result) {
            exit ("图片上传失败");
        }
    }
}

// 取得mysql连接
$mysql = Demo::Mysql();
$_POST['data'] = $mysql->real_escape_string($_POST['data']);
$sql = "INSERT INTO `contents` (`data`, `image`) VALUE ('{$_POST['data']}', '{$pic}')";

$query = $mysql->query($sql);

$ocs  = Alibaba::Cache();
$ocs->delete('datas');
header("Location: index.php");
