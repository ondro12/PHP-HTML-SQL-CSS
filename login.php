<?php

if(isset($_POST['login'])) {
	if($_POST['nick'] == '' || $_POST['password'] == '') { //ziaden vstup
		$pageData->login = include_once "views/log.php";
		$pageData->login .= "Zadajte váš nick a heslo prosím.";
		return;
	}
	else {
		$login = $_POST['nick'];
        $password = hash("sha512", $_POST['password']);
        $password = substr($password, 0, 30); //v db je varchar(30)

        $sql = "SELECT prih_meno,heslo,prava FROM zakaznik WHERE prih_meno = '$login' AND heslo = '$password'";

        if ($result=mysqli_query($db,$sql)) {
            if($row=mysqli_fetch_row($result)) //bola nájdená 1
            {
				$_SESSION['login'][$nick] = $login;
				$_SESSION['prava'] = $row[2];
			}
			else {
				$pageData->login = include_once "views/log.php";
				$pageData->login .= "Neplatné prihlasovacie údaje!";
				return;
			}
		}
		else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
        }
	}
}

if(isset($_POST['logout'])) {
	unset($_SESSION['login'][$nick]);
	header("Refresh:0");
}

if(isset($_SESSION['login'][$nick])) {
	if($_SESSION['prava'] == '1')
		$pageData->login = include_once "views/adminbar.php";
	else 
	$pageData->login = include_once "views/userbar.php";
	$pageData->login .= "<br>Prihlásený užívateľ ";
	$pageData->login .= "<b>" . $_SESSION['login'][$nick] . "</b>";
	$pageData->login .= include_once "views/logout.php";
}
else {
	$pageData->login = include_once "views/log.php";
}