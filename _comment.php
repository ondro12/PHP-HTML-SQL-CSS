<?php
$chyba = 0;
$prih_id = $_GET['id'];
$prih_meno = $_GET['meno'];
$mail = $_GET['email'];
$val = $_GET['hodn'];
$sprava = $_GET['text'];
$adresa_ip = $_SERVER["REMOTE_ADDR"];
if(strlen($prih_meno)==0) {$chyba = 1;}
if(strlen($mail)==0) {$chyba = 2;}
if(strlen($sprava)==0) {$chyba = 3;}
if(strlen($val)==0) {$chyba = 4;}
if ($chyba == 0){
$sql = "INSERT INTO recenziehodnotenia (hodnotenie, recenzie, meno, email, ip, produkt) VALUES
										('".$val."','".$sprava."','".$prih_meno."','".$mail."', '".$adresa_ip."', '".$prih_id."')";
if ($result=mysqli_query($db,$sql)) {
		$pageData->content .= "<font color=white>Úspešne ste vložili komentár.</font>";
}
else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
}
else
	header("location: /views/detail.php?err=".$chyba."");