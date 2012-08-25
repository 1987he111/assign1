<?php

/*
 * this is smarty config file
 */
include("./libs/Smarty.class.php");
//initialzie smarty instance
$smarty = new Smarty();
$smarty->template_dir = "./templates/";
$smarty->compile_dir = "./templates_c/";
$smarty->config_dir = "./configs/";
$smarty->cache_dir = "./cache/";
$smarty->left_delimiter = "<{";
$smarty->right_delimiter = "}>";

?>
