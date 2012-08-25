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
            <{showResult}>
        </table>
        <?php
        echo "<h1>" . $count . "</h1>";
        mysql_close($connection);
        ?>
    </body>
</html>