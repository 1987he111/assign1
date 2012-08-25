<?php /* Smarty version Smarty-3.1.11, created on 2012-08-21 10:44:29
         compiled from "./templates/answer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10788324445032d9edbff1a5-06729127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6d5ea27a29224bae5f0a726aff91efc35d8acc7' => 
    array (
      0 => './templates/answer.tpl',
      1 => 1345506409,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10788324445032d9edbff1a5-06729127',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5032d9edd6a923_68471838',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5032d9edd6a923_68471838')) {function content_5032d9edd6a923_68471838($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC
    "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html401/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Wines Found</title>
    </head>
    <body bgcolor="white">

        <table>
            <tr>
                <td> wine_name </td><td> year </td><td> grape_variety </td><td> winery </td><td> region</td>
                <td> price </td><td> qty_on_hand </td><td> total_sold_qty </td><td> revenue </td>
            </tr>
            <?php echo showResult(array(),$_smarty_tpl);?>

        </table>
        <<?php ?>?php
        echo "<h1>" . $count . "</h1>";
        mysql_close($connection);
        ?<?php ?>>
    </body>
</html><?php }} ?>