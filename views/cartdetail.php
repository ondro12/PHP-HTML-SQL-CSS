<?php

if(isset($_POST['registration'])) {
	header("Location: index.php?reg");
}

if(isset($_SESSION['cart'])) {
	$pageData->content .= "
	<div class='datagrid'>
	<table>
	<thead>
	<tr>
		<th>Názov</th>
		<th>Počet</th>
		<th>Suma</th>
		<th>Dokopy</th>
	</tr>
	</thead>
	<tfoot>
	<tr><td colspan='4'><div id='no-paging'>&nbsp;</div></tr></tfoot>
<tbody>
	";

	$sql = "SELECT id_tovaru, nazovtovaru, cena FROM tovar WHERE id_tovaru IN (";

		foreach($_SESSION['cart'] as $id => $value) {
			$sql .= $id.",";
		}

		$sql = substr($sql, 0, -1); //musim odstranit poslednu ciarku pred zatvorkou
		$sql .= ") ORDER BY nazovtovaru ASC";
		
		if ($result=mysqli_query($db,$sql)) {
			$celkovasuma = 0;
			while($row=mysqli_fetch_row($result)) {

				$celkovasuma += $_SESSION['cart'][$row[0]]['quantity']*$row[2];

				$pageData->content .= "<tr>";
				$pageData->content .= "<td>" . $row[1] . "</td>"; //nazovtovaru
				$pageData->content .= "<td><b><a href='index.php?action=cartdetail&id=$row[0]&operation=dec' style='color:#FF5722'>< </a></b>"
				 . $_SESSION['cart'][$row[0]]['quantity'] . "<b><a href='index.php?action=cartdetail&id=$row[0]&operation=inc' style='color:#FF5722'> ></a></b></td>";
				$pageData->content .= "<td>" . $row[2] . "€</td>"; //cena
				$pageData->content .= "<td>" . $_SESSION['cart'][$row[0]]['quantity']*$row[2] . "€</td>"; //mnozstvo*cena
				$pageData->content .= "</tr>";
			}
		}

	$pageData->content .= "</tbody></table></div>";
	$pageData->content .= "<br>";
	$pageData->content .= "<tr><h3>Celková suma : " . $celkovasuma . "€</h3>";
	$_SESSION['totalprice'] = $celkovasuma;
	$pageData->content .= "<nav><a href='index.php?buydetails'>Prejsť ku objednávke.</a>";
}
else {
	$pageData->content .= "<h2><center>Nákupký košík je prázdny.</center></h2>";
}