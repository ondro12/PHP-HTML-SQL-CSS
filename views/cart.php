<?php

$pageData->cart = "<h2><center>Košík</center></h2>";
if(isset($_SESSION['cart'])) {
	$sql = "SELECT id_tovaru, nazovtovaru, popisproduktu, cena FROM tovar WHERE id_tovaru IN (";

	foreach($_SESSION['cart'] as $id => $value) {
		$sql .= $id.",";
	}

	$sql = substr($sql, 0, -1); //odstránenie poslednej čiarky
	$sql .= ") ORDER BY nazovtovaru ASC";
	
	if ($result=mysqli_query($db,$sql)) {
		while($row=mysqli_fetch_row($result)) {
			$pageData->cart .= substr($row[1], 0, 27) . " x " . $_SESSION['cart'][$row[0]]['quantity'] ."( ". $row[3]. "€ )<br>";
		}
	}
}
else {
	$pageData->cart .= "Nákupný košík je prázdny<br>";
}
$pageData->cart .= "<a href='index.php?action=cartdetail'>Detail košíka</a>";