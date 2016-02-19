<?php
//prepojenie s db naskladnených tovarov
if(isset($_SESSION['login'][$nick])  && $_SESSION['prava'] == '1') { //admin
	$poz = $_POST['poznamka'];
	$sql = "INSERT INTO naskladnenie (prih_meno, poznamka, celkovacena, stav) VALUES ('"
	. $_SESSION['login'][$nick] . "', '" . $poz . "', '" . $_SESSION['totalprice'] . "', 'Objednané')";
	if ($result=mysqli_query($db,$sql)) {
		$pageData->content .= "Vašu objednávku sme odoslali na spracovanie";
		$orderID= mysqli_insert_id($db);

		foreach($_SESSION['cart'] as $id => $value) {
			$sql = "INSERT INTO naskladnenytovar (id_naskladnenia, id_tovaru, mnozstvo) VALUES ('"
				. $orderID . "', '" . $id . "', '" . $_SESSION['cart'][$id]['quantity'] . "')";
			if(!$result=mysqli_query($db,$sql)) {
				echo "Chyba: " . $sql . "<br>" . $db->error;
            	exit();
			}
		}
		unset($_SESSION['cart']);
	}
	else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
}
else {
	$pageData->content .= "Pre danú akciu je vyžadované prihlásenie.";
}