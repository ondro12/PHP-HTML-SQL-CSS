<?php

if(isset($_SESSION['login'][$nick])) { //prihlaseny
	$poznamka = $_POST['poznamka'];
	$stavdorucenia = $_POST['stavdorucenia'];
	$stavplatby = $_POST['stavplatby'];
	$sql = "INSERT INTO objednavka (prih_meno, poznamka, celkovacena, stav,  sposob_dopravy, sposob_platby) VALUES ('"
	. $_SESSION['login'][$nick] . "', '" . $poznamka . "', '" . $_SESSION['totalprice'] . "', 'Zaevidovaná', '" . $stavdorucenia . "', '" . $stavplatby . "')";
	if ($result=mysqli_query($db,$sql)) {
		$pageData->content .= "<font color=white>Vašu objednávku sme spracovali.</font>";
		$orderID= mysqli_insert_id($db);

		foreach($_SESSION['cart'] as $id => $value) {
			$sql = "INSERT INTO objednanytovar (id_objednavky, id_tovaru, mnozstvo) VALUES ('"
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
	$pageData->content .= "Je nutné prihlásenie.";
}