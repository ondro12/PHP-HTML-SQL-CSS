<?php
if(isset($_POST['register'])) {
	$chyba = 0;
  $heslo;
  $prava = 0;
	$pole = array();
	$pole[8] = hash("sha512", $_POST["pass"]);  //sifrovanie hesla , bezpecnost
	$pole[9] = $_SERVER["REMOTE_ADDR"];
	$pole[10] = session_id();
  $pole[11] = $prava;
	$pouzite_loginy = mysqli_query($db, "SELECT prih_meno FROM zakaznik");
	$pouzite_emaily = mysqli_query($db, "SELECT email FROM zakaznik");

	foreach ($_POST as $key => $value) // Kontrola správnosti , ci bolo vsetko zadane spravne
	{
		$value = mysqli_real_escape_string($db, $value);
		switch ($key) 
		{
			case "company":
				$pole[0] = $value;
				break;
			case "ico":
				$pole[5] = $value;
				break;
			case "dic":
				$pole[6] = $value;
				break;
			case "meno_priezvisko":
				$pole[1] = $value;
				break;
			case "prih_meno":
				if(strlen($value)<5 || strlen($value)>25)
				{
					$chyba = 1;		
					break;
				}					
				while($row = mysqli_fetch_array($pouzite_emaily)) 
				{
					if(strcasecmp($row["prih_meno"], $value)==0) 
					{
						$chyba = 2; 
						break;
					}
				}
				$pole[7] = $value;
				break;
			case "pass": 		 
				if(strlen($value)<6 || strlen($value)>32){ 
					$chyba = 3;	
          break;
        }
				break;
			case "pass_check":
				if($value != $_POST["pass"])
					$chyba = 4; 	
        $heslo = $value;
				break;
			case "email":
				if(strlen($value)==0) 
				{
					$chyba = 5;
					break;
				}
				while($row = mysqli_fetch_array($pouzite_emaily)) 
				{
					if(strcasecmp($row["email"], $value)==0) 
					{
						$chyba = 6;
						break;
					}
				}
				$pole[2] = $value;
				break;
			case "address":
				$pole[4] = $value;
				break;
			case "phone":
				$pole[3] = $value;
				break;	 	
			 default:
			 	break;
		}
		if($chyba!=0) break;
	}      
	ksort($pole);
	if($chyba==0) 
	{
		//Vlozenie do databazy
		$reg_zak = "INSERT INTO zakaznik (nazov_firmy, meno_priezvisko, email, telefon, adresa, ico, dic, prih_meno, heslo, ip, reg_session, prava)" ."VALUES ('".implode("', '",$pole)."')";
		mysqli_query($db, $reg_zak);
    // Odoslanie potvrdzujúceho emailu s menom a heslom.
		$mail_text = "
		<html><body><h2>Zaregistrovanie</h2>
		<p>Dobrý deň potvrdzujeme , že ste vykonali registráciu na portáli http://iis.webinator.sk</p>
		<p>vaše užívateľské meno je : $pole[7] </a><p>
		<p>Vaše heslo je: $heslo</p>
    <p>Prajeme vám pekný deň s pozdravom oapapiernictvo.</p>
		</body></html>";
		$headers  = 'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=UTF-8' . "\r\n".'From: Internetový obchod oapapiernictvo<info@3oapapiernictvo.sk>' . "\r\n";
	 	ini_set('info@3oapapiernictvo.sk', 'info@3soapapiernictvo.sk');
		mail($_POST["email"], "Potvrdenie registrácie u oapapiernictvo.sk", $mail_text, $headers);
		header("location: index.php?msg=3");
	} 
	else 
		header("location: index.php?err=".$chyba."&company=".$_POST["company"]."&ico=".$_POST["ico"]."&dic=".$_POST["dic"]."&prih_meno=".$_POST["prih_meno"]."&email=".$_POST["email"]."&meno_priezvisko=".$_POST["meno_priezvisko"]."&address=".$_POST["address"]."&phone=".$_POST["phone"]);
}