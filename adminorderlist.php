<?php

if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {
	$pageData->content .= "<h2><center>Všetky objednávky zákazníkov</center></h2>";
	$sql = "SELECT id_objednavky, poznamka, celkovacena, datumvytvorenia, prih_meno, stav FROM objednavka";
	if ($result=mysqli_query($db,$sql)) {
    	while ($row=mysqli_fetch_row($result)) {
            $pageData->content .= "<h3><center>ID zakázky: #" . $row[0]."</center></h3>";
            $pageData->content .= "<p><b>Užívateľ:</b> " . $row[4];
            $pageData->content .= "<br><b>Dátum :</b> " . $row[3];
            $pageData->content .= "<br><b>Suma: </b>" . $row[2] . "€";
            $pageData->content .= "<br><b>Stav objednávky: </b>" . $row[5];
    		$pageData->content .= "<br><a href='index.php?adminorder=$row[0]'>Detail</a></p>";
    	}
    }
    else {
            echo "Error: " . $sql . "<br>" . $db->error;
            exit();
    }
}
else {
	$pageData->content .= "Na túto operáciu nemáte dostatočné práva.<br>";
}
