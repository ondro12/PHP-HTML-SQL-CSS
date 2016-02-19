<?php
// Zobrazenie klientských objednávok
if(isset($_SESSION['login'][$nick])) {
	$pageData->content .= "<h2><center>Vlastné objednávky</center></h2>";
	$sql = "SELECT id_objednavky, poznamka, celkovacena, datumvytvorenia, stav FROM objednavka WHERE prih_meno = " . "'" . $_SESSION['login'][$nick] . "'";
	if ($result=mysqli_query($db,$sql)) {
    	while ($row=mysqli_fetch_row($result)) {
            $pageData->content .= "<h3><center>ID objednavky: </b> #" . $row[0] . "</center></h3>";
            $pageData->content .= "<p><b>Dátum: </b> " . $row[3];
            $pageData->content .= "<br><b>Suma: </b>" . $row[2] . "€";
            $pageData->content .= "<br><b>Stav: </b>" . $row[4];
    		$pageData->content .= "<br><a href='index.php?order=$row[0]'>Detail</a><p>";
    	}
    }
    else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
}
else {
	$pageData->content .= "Je nevyhnutné, aby ste sa prihlásili.";
}
