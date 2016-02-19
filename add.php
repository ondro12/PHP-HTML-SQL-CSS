<?php

//prida vec do kosika

$id = $_GET['id'];

if(isset($_SESSION['cart'][$id])) { //tento produkt uz je v kosiku
	$_SESSION['cart'][$id]['quantity']++;
}
else {
	$sql = "SELECT id_tovaru,nazovtovaru,cena FROM tovar WHERE id_tovaru = '$id'";

	if ($result=mysqli_query($db,$sql)) {
		if($row=mysqli_fetch_row($result)) {
    		
    		$_SESSION['cart'][$row[0]] = array(
    			"quantity" => 1,
    			"price" => $row[2]
    			);

    		mysqli_free_result($result);
		}
		else $pageData->content .= "Zle zadané ID tovaru!";
	}
}

header("Location: index.php?" . $_SESSION['returnpage']);
exit();