<?php

if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {
	$pageData->content .= "<h2><center>Dodávatelia</center></h2>";
	$sql = "SELECT * FROM dodavatelia";
	if ($result=mysqli_query($db,$sql)) {
    	while ($row=mysqli_fetch_row($result)) {
            $pageData->content .= "<h3><center>ID dodávateľa: #" . $row[0]."</center></h3>";
            $pageData->content .= "<p><b>Názov spoločnisti:</b> " . $row[1];
            $pageData->content .= "<br><b>Adresa:</b> " . $row[2];
            $pageData->content .= "<br><b>Email: </b>" . $row[3];
            $pageData->content .= "<br><b>Telefón: </b>" . $row[4];
            $pageData->content .= "<br><b>Čas dodania: </b>" . $row[5];
            $pageData->content .= "<br></p>";
    	}
    }
    else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
}
else {
	$pageData->content .= "Na prezeranie tohoto obsahu nemáte dostatočné oprávnenia.<br>";
}
