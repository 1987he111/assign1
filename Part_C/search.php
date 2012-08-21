<?php

require_once("config.php");
require_once("db.php");

//Open the database connection and select database winestore
if (!($connection = @mysql_connect(DB_HOST, DB_USER, DB_PW))) {
    die("Could not connect");
}
if (!(@ mysql_select_db(DB_NAME, $connection))) {
    showerror();
}

//define function to create droplist to dynamically show values for user to choose
function createDropList($params) {
    // Query to find distinct values of $attributeName in $tableName
    extract($params);
    global $connection;
    $query = "SELECT DISTINCT {$attributeName} FROM {$tableName}";

    if (!($resultRows = @ mysql_query($query, $connection)))
        showerror();

    // Start the select widget
    echo "\n<select name=\"{$pulldownName}\">";
    echo "\n\t<option value=\"\" />";
    // Retrieve each row from the query
    $results = array();
    $i = 0;
    while ($row = @ mysql_fetch_array($resultRows)) {
        $results[$i++] = $row[$attributeName];
    }
    //sort the results
    sort($results);

    for ($i = 0; $i < count($results); $i++) {
        //display each attribute as a option
        echo "\n\t<option value=\"{$results[$i]}\">{$results[$i]}</option>";
    }
    echo "\n</select>";
}

//function used to close database connection, which can be invoked in template
function closeDatabaseConnection(){
    global $connection;
    mysql_close($connection);
}

$smarty->registerPlugin("function", "dropList", "createDropList");
$smarty->registerPlugin("function", "closeDatabase", "closeDatabaseConnection");
$smarty->display("search.tpl");
?>