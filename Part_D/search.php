<?php
require_once 'db.php';
//create PDO object to connect database
try {
    $db = new PDO(
                    "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
                    DB_USER, DB_PW
    );
} catch (PDOException $e) {
    die($e->getMessage());
}

//define function to create droplist to dynamically show values for user to choose
function createDropList($tableName, $attributeName, $pulldownName) {
    // Query to find distinct values of $attributeName in $tableName
    global $db;
    $query = "SELECT DISTINCT {$attributeName} FROM {$tableName}";

//    if (!($resultRows = @ mysql_query($query, $connection)))
//        showerror();

    $results = array();
    $i = 0;
    try {
        //retrieve each row from the query
        foreach ($db->query($query) as $row) {
            $results[$i++] = $row[$attributeName];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    //sort the results
    sort($results);

    // Start the select widget
    echo "\n<select name=\"{$pulldownName}\">";
    echo "\n\t<option value=\"\" />";

    for ($i = 0; $i < count($results); $i++) {
        //display each attribute as a option
        echo "\n\t<option value=\"{$results[$i]}\">{$results[$i]}</option>";
    }
    echo "\n</select>";
}
?>

<!DOCTYPE HTML PUBLIC
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
                        <?php
                        createDropList("region", "region_name", "regionName");
                        ?>
                    </td></tr>
                <tr><td>Grape Variety: </td><td colspan="2">
                        <?php
                        createDropList("grape_variety", "variety", "grapeVariety");
                        ?>
                    </td></tr>
                <tr><td>Year Range: </td>
                    <?php
                    echo "<td>";
                    createDropList("wine", "year", "yearMin");
                    echo "(Min) </td><td>";
                    createDropList("wine", "year", "yearMax");
                    ?>
                    (Max)</td</tr>
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
        <?php
        //Close the database connection
        $db = null;
        ?>
    </body>
</html>
