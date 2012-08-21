<?php
//echo "<h1>" . $_SERVER['PHP_SELF'] . "</h1>";
//check if the page link to answer.php is from search.php
if ($_GET['submit'] != "search") {
    header("Location: search.php");
    exit;
}

require_once('db.php');
//create PDO object to connect database
try {
    $db = new PDO(
                    "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
                    DB_USER, DB_PW
    );
} catch (PDOException $e) {
    die($e->getMessage());
}

//get initial params from search.php
$wineName = trim($_GET['wineName']);
$wineryName = trim($_GET['wineryName']);
$regionName = trim($_GET['regionName']);
$grapeVariety = trim($_GET['grapeVariety']);
$yearMin = (int) trim($_GET['yearMin']);
$yearMax = (int) trim($_GET['yearMax']);
$minWineNumInStock = (float) trim($_GET['minWineNumInStock']);
$minWineNumOrdered = (float) trim($_GET['minWineNumOrdered']);
$costMin = (float) trim($_GET['costMin']);
$costMax = (float) trim($_GET['costMax']);

//create the query
$query = "select wine.wine_name, wine.year, new_grape.variety, winery.winery_name, region.region_name,";
$query .= " inventory.cost, inventory.on_hand, new_items.total_sold_qty, ";
$query .= " new_items.total_sold_price-(new_items.total_sold_qty*inventory.cost) ";
$query .= " from wine, winery, region, inventory, ";
$query .= " (SELECT wine_id, sum(qty) as total_sold_qty, sum(qty*price) as total_sold_price FROM items group by wine_id) as new_items, ";
$query .= " (SELECT wine_variety.wine_id as wine_id, group_concat(grape_variety.variety) as variety FROM wine_variety, grape_variety ";
$query .= "where wine_variety.variety_id = grape_variety.variety_id group by wine_variety.wine_id) as new_grape ";
$query .= " where wine.wine_id = new_grape.wine_id";
$query .= " and wine.winery_id = winery.winery_id";
$query .= " and winery.region_id = region.region_id";
$query .= " and wine.wine_id = inventory.wine_id";
$query .= " and wine.wine_id = new_items.wine_id";

//check the initial varablse and add to query
if (isset($wineName) && $wineName != "") {
    $query .= " and wine.wine_name like \"%" . $wineName . "%\"";
}
if (isset($wineryName) && $wineryName != "") {
    $query .= " and winery.winery_name like \"%" . $wineryName . "%\"";
}
if (isset($regionName) && $regionName != "") {
    if ($regionName != "All") {
        $query .= " and region.region_name = \"" . $regionName . "\"";
    }
}
if (isset($grapeVariety) && $grapeVariety != "") {
    $query .= " and new_grape.variety like \"%" . $grapeVariety . "%\"";
}
if ($yearMin != 0 && $yearMax != 0 && $yearMin < $yearMax) {
    $query .= " and wine.year >= " . $yearMin . " and wine.year <=" . $yearMax;
}
if ($costMin != 0 && $costMax != 0 && $costMin < $costMax) {
    $query .= " and inventory.cost >= " . $costMin . " and inventory.cost <=" . $costMax;
}
if ($minWineNumInStock != 0) {
    $query .= " and inventory.on_hand >= " . $minWineNumInStock;
}
if ($minWineNumOrdered != 0) {
    $query .= " and new_items.total_qty >= " . $minWineNumOrdered;
}


//run query
$query .= " order by wine.wine_name, year;";
try {
    $result = $db->query($query);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE HTML PUBLIC
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
            <?php
            $count = 0;
            foreach ($result as $row) {
                echo "<tr>";
                for ($i = 0; $i < count($row); $i++) {
                    echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
                $count++;
            }
            ?>
        </table>
        <?php
        if ($count == 0) {
            $db = null;
            die("sorry, no wine found!");
        }
        echo "<h1>" . $count . "</h1>";
        $db = null;
        ?>
    </body>
</html>

