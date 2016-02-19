<?php
$chyba = 0;

$old = mysqli_real_escape_string($db,$_POST["stare"]);
$new = mysqli_real_escape_string($db,$_POST["nove"]);
$new_c=mysqli_real_escape_string($db,$_POST["nove_check"]);
$heslo = mysqli_real_escape_string($db,$_POST["heslo"]);
$heslo = hash("sha512",$heslo);
$heslo = substr($heslo, 0, 30); //kôli db -> varchar(30)

if(strlen($new)<6 || strlen($new)>32)
	$chyba = 1; // email je príliš krátky
elseif (strcmp($new, $new_c)!=0) {
	$chyba = 2; // nezhoda emailov
}
//overenie stareho hesla
$sql = "SELECT heslo FROM zakaznik WHERE prih_meno= '" . $_SESSION["login"][$nick] . "'";
if(!($pass_query = mysqli_query($db, $sql))) {
	echo "Chyba: " . $sql . "<br>" . $db->error;
    exit();
}

if($chyba==0)
	$row = mysqli_fetch_array($pass_query);
	if($heslo!=$row["heslo"])
		$chyba = 3; //nezhodné heslo

if($chyba==0){
	$query = mysqli_query($db, "SELECT email FROM zakaznik WHERE email='$new'");
	if(mysqli_num_rows($query)==1){
		$chyba = 4; //zadaný email sa už nachádza v db
	}
}
//aktualizovanie nového hesla
if($chyba==0) {
	$sql = "UPDATE zakaznik SET email='$new' WHERE prih_meno='" . $_SESSION["login"][$nick] . "'";
	if(!mysqli_query($db, $sql)) {
		echo "Chyba: " . $sql . "<br>" . $db->error;
    	exit();
	}
	else $pageData->content .= "<font color=white>Email bol úspešne aktualizovaný.</font>";
	
} else {
	header("Location: index.php?msg=".$chyba);
}