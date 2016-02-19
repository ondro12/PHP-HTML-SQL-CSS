<?php

if(isset($_SESSION['login'][$nick])) {
	$pageData->content .= "<h2><center>Detail účtu</center></h2>";
	$sql = "SELECT nazov_firmy, meno_priezvisko, email, telefon, adresa, ico, dic FROM zakaznik WHERE prih_meno = " . "'" . $_SESSION['login'][$nick] . "'";

	if($result=mysqli_query($db,$sql)) {
    	$row=mysqli_fetch_row($result);
            $pageData->content .= "<p><b>Meno a priezvisko:</b> " . $row[1];
            $pageData->content .= "<br><b>Email: </b>" . $row[2];
            $pageData->content .= "<br><b>Adresa: </b>" . $row[4];
            $pageData->content .= "<br><b>Telefón: </b>" . $row[3];
            $pageData->content .= "<br><b>Názov spoločnosti: </b>" . $row[0];
            $pageData->content .= "<br><b>IČO: </b>" . $row[5];
            $pageData->content .= "<br><b>DIČ: </b>" . $row[6]."</p>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $db->error;
        exit();
    }
}
else {
	$pageData->content .= "Je vyžadované prihlásenie.";
}