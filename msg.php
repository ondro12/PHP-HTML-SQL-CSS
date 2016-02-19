<? if(isset($_GET["msg"])) 
{
	switch ($_GET["msg"]) 
	{
		case 1:
			$msg = "Chyba: Prikrátky email.<br>";
			break;
		case 2:
			$msg = "Chyba: Emaily sa nezhodujú.<br>";
			break;
		case 3:
			$msg = "OK: Registrácia prebehla úspešne.<br>";
			break;
		case 4:
			$msg = "Chyba: Zadaný email už bol použitý.<br>";
			break;
		case 5:
			$msg = "Chyba: Prikrátke heslo.<br>";
			break;
		case 6:
			$msg = "Chyba: Heslá niesú zhodné.<br>";
			break;
		default:
			$msg = "";
			break;			
	}
	$pageData->content .= "<font color=white>" . $msg . "</font>";
}				