<?php
$chyba = 0;

$old = mysqli_real_escape_string($db,$_POST["stare"]);
$new = mysqli_real_escape_string($db,$_POST["nove"]);
$new_c=mysqli_real_escape_string($db,$_POST["nove_check"]);
$old = hash("sha512",$old);
$old = substr($old, 0, 30);   //kôli db -> varchar(30)

if(strlen($new)<6 || strlen($new)>32)
	$chyba = 5;    // heslo je prkrátke
elseif (strcmp($new, $new_c)!=0) {
	$chyba = 6;    //heslá nie sú zhodné
}
//kontrola meneného hesla
$sql = "SELECT heslo FROM zakaznik WHERE prih_meno= '" . $_SESSION["login"][$nick] . "'";
if(!($pass_query = mysqli_query($db, $sql))) {
	echo "Chyba: " . $sql . "<br>" . $db->error;
    exit();
}
if($chyba==0) {
	$row = mysqli_fetch_array($pass_query);
	if($old!=$row["heslo"])
		$chyba = 3; //heslo nie je zhodné
}
//aktualizovanie nového hesla
if($chyba==0) {
	$new = hash("sha512",$new);
	$sql = "UPDATE zakaznik SET heslo='$new' WHERE prih_meno='" . $_SESSION["login"][$nick] . "'";
	if(!mysqli_query($db, $sql)) {
		echo "Chyba: " . $sql . "<br>" . $db->error;
    	exit();
	}
	else $pageData->content .= "<font color=white>Heslo bolo úspešne zmenené.</font>";
	
} else {
	header("Location: index.php?msg=".$chyba);
}