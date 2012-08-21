<?php /* Smarty version Smarty-3.1.11, created on 2012-08-21 10:43:32
         compiled from "./templates/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13216394665032d9b4efc4a2-72256630%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '692c3bc93f5ce1085954c77c1d0c047332ab27c2' => 
    array (
      0 => './templates/search.tpl',
      1 => 1345103821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13216394665032d9b4efc4a2-72256630',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'connection' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5032d9b51e3c70_22391719',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5032d9b51e3c70_22391719')) {function content_5032d9b51e3c70_22391719($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC
    "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html401/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Wines Search</title>
        <script name="JavaScript">
            //define javascript function to validate simple user input
            function validate(f){
                var con = true;
                var error_message = "";
                //check if year range is set correctly
                if(f.yearMin.value != ""){
                    if(f.yearMax.value=="" || f.yearMax.value <= f.yearMin.value){
                        con = false;
                        error_message += "year max should be greater than year min";
                    }
                }
                //check if set MinWineNumberInStock is number
                if(/\S/.test(f.minWineNumInStock.value) && /\D/.test(f.minWineNumInStock.value)){
                    con = false;
                    error_message += "MinWineNumberInStock should be a number \n";
                }
                //check if set MinWineNumberOrdered is number
                if(/\S/.test(f.minWineNumOrdered.value) && /\D/.test(f.minWineNumOrdered.value)){
                    con = false;
                    error_message += "MinWineNumberOrderd should be a number \n";
                }
                //if set cost range then check cost range
                if(/\S/.test(f.costMin.value) && /\D/.test(f.costMin.value)){
                    con = false;
                    error_message += "Cost Range min should be a number \n";
                }
                if(/\S/.test(f.costMax.value) && /\D/.test(f.costMax.value)){
                    con = false;
                    error_message += "Cost Range max should be a number \n";
                }
                if(/^\d+$/.test(f.costMax.value) && /^\d+$/.test(f.costMin.value) 
                    && Number(f.costMax.value)<=Number(f.costMin.value)){
                    con = false;
                    error_message += "Cost Range max should be greater than min\n";
                }
                
                if(!con){
                    alert(error_message);
                }
                return con;
            }
        </script>
    </head>
    <body bgcolor="white">

        <h1>Wine Search Page</h1>
        <form name="search_form" action="answer.php" method="GET" onSubmit="return validate(this)">
            <table>
                <tr><td>Wine Name: </td><td colspan="2"><input type="text" id="wineName" name="wineName" /></td></tr>
                <tr><td>Winery Name: </td><td colspan="2"><input type="text" id="wineryName" name="wineryName" /></td></tr>
                <tr><td>Region: </td><td colspan="2">
                        <?php echo createDropList(array('tableName'=>"region",'attributeName'=>"region_name",'pulldownName'=>"regionName"),$_smarty_tpl);?>

                    </td></tr>
                <tr><td>Grape Variety: </td><td colspan="2">
                        <?php echo createDropList(array('tableName'=>"grape_variety",'attributeName'=>"variety",'pulldownName'=>"grapeVariety"),$_smarty_tpl);?>

                    </td></tr>
                <tr><td>Year Range: </td>
                    <td><?php echo createDropList(array('tableName'=>"wine",'attributeName'=>"year",'pulldownName'=>"yearMin"),$_smarty_tpl);?>
(min) </td>
                    <td><?php echo createDropList(array('connection'=>$_smarty_tpl->tpl_vars['connection']->value,'tableName'=>"wine",'attributeName'=>"year",'pulldownName'=>"yearMax"),$_smarty_tpl);?>
(max)</td>
                <tr><td>MinWineNumberInStock: </td>
                    <td colspan="2"><input type="text" id="minWineNumInStock" name="minWineNumInStock" /></td></tr>
                <tr><td>MinWineNumberOrdered: </td>
                    <td colspan="2"><input type="text" id="minWineNumOrdered" name="minWineNumOrdered" /></td></tr>
                <tr><td>Cost Range: </td>
                    <td><input type="text" id="costMin" name="costMin" />(min) </td>
                    <td><input type="text" id="costMax" name="costMax" />(max)</td></tr>
                <tr>
                    <td><input type="submit" name="submit" id="submit" value="search"></td>
                    <td><input type="reset" value="reset"></td>
                    <td></td>
                </tr>
            </table>
        </form>
        <br>
    </body>
    <?php echo closeDatabaseConnection(array(),$_smarty_tpl);?>

</html><?php }} ?>