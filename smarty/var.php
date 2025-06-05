<?php
require_once('./libs/Smarty.class.php');
use \Smarty\Smarty;
$smarty = new Smarty;
$smarty->assign('name', 'Taro');
$smarty->display('var.tpl'); ?>
