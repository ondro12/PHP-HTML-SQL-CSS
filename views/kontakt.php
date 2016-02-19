<?php
if(isset($_POST['registration'])) {
	header("Location: index.php?reg");
}
$pageData->content .= "<h2><center>Kontaktné informácie</center></h2>";
$pageData->content .= "<p><b>Názov spoločnosti: OAPAPIERNICTVO s.r.o.</b> ";
$pageData->content .= "<br><b>Adresa: Mánesova 13, 612 00 Brno</b> " ;
$pageData->content .= "<br><b>IČO: 467 856 899</b>";
$pageData->content .= "<br><b>DIČ: SK 467 856 899</b>";
$pageData->content .= "<br><b>Email: info@oapapiernictvo.sk</b>";
$pageData->content .= "<br><b>Telefón: +421 910 483 342</b>";
$pageData->content .= "<br></p>";