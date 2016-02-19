<?php
//Naskladnené objednávky pripravené na expedovanie administrátorom
if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {
	$pageData->content .= "<h2><center>Objednávky na naskladnenie</center></h2>";
	$sql = "SELECT id_naskladnenia, poznamka, celkovacena, datumvytvorenia, prih_meno, stav FROM naskladnenie";
	if ($result=mysqli_query($db,$sql)) {
    	while ($row=mysqli_fetch_row($result)) {
            $pageData->content .= "<h3><center>ID objednavky: #" . $row[0]."</center></h3>";
            $pageData->content .= "<p><b>Od užívateľa:</b> " . $row[4];
            $pageData->content .= "<br><b>Dátum: </b> " . $row[3];
            $pageData->content .= "<br><b>Suma: </b>" . $row[2] . "€";
            $pageData->content .= "<br><b>Stav: </b>" . $row[5];
    		$pageData->content .= "<br><a href='index.php?storeorder=$row[0]'>Detail</a><br><br></p>";
    	}
    }
    else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
}
else {
	$pageData->content .= "Pre zobrazenie tohto obsahu nemáte dostatočné práva<br>";
}
