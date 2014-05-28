<?php
/**
 * ACE Demo by Snake.Zero
 * @copyright Alibaba group. since 2014
 */

$Storage = Alibaba::Storage('demo');
$id      = $_GET['id'];
$res     = $Storage->get($id);
echo $res;
