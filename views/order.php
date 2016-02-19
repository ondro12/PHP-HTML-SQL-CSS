<?php

if(isset($_SESSION['login'][$nick])) {
	$pageData->content .= "<h3>Objednávka ID: #" . $_GET['order'] . "</h3>";
	$pageData->content .= "
	<div class='datagrid'>
    <table>
    <thead>
    <tr>
        <th>Názov</th>
        <th>Počet</th>
        <th>Suma</th>
        <th>Spolu</th>
    </tr>
    </thead>
    <tfoot>
    <tr><td colspan='4'><div id='no-paging'>&nbsp;</div></tr></tfoot>
<tbody>
	";
	$sql = "SELECT  id_tovaru, mnozstvo FROM objednanytovar WHERE id_objednavky = '" . $_GET['order'] . "'";

	if ($result=mysqli_query($db,$sql)) {
		$totalprice = 0;
    	while ($row=mysqli_fetch_row($result)) {
    		$sql = "SELECT  nazovtovaru, cena FROM tovar WHERE id_tovaru = '" . $row[0] . "'";
    		$goodsresult = mysqli_query($db,$sql);
    		$goods= mysqli_fetch_row($goodsresult);

    		$totalprice += $goods[1]*$row[1];
    		$pageData->content .= "<tr>";
			$pageData->content .= "<td>" . $goods[0] . "</td>"; 
			$pageData->content .= "<td>" . $row[1] . "</td>"; 
			$pageData->content .= "<td>" . $goods[1] . "€</td>"; 
			$pageData->content .= "<td>" . $row[1]*$goods[1] . "€</td>"; 
			$pageData->content .= "</tr>";
    	}
    }
    else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
    $pageData->content .= "</tbody></table></div>";
    $pageData->content .= "<br><h3><center>Celkom:" . $totalprice . "€</center></h3>";

    $pageData->content .= "<div class='login-log'><button onclick='javascript:window.print();' class='login login-submit'>Vytlačiť objednávku</button></div>";
}
else {
	$pageData->content .= "Je vyžadované prihlásenie";
}