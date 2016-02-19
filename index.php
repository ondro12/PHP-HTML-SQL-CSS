<?php
/*   Hlavný index , resp. hlavná stránka projektu
 *   Zobrazenie hlavnej stránky(domov) 
 *   Spracovanie reakcie na yvolené volby
 */
session_start();
ob_start();
include "classes/Page_Data.class.php";
$pageData = new Page_Data();

require "connect.php";

$pageData->title = "OA Eshop";
$pageData->header = include_once "header.php";
include_once "_registracia.php";
include_once "login.php";
include_once "msg.php";

if(isset($_GET['action'])) {
	if($_GET['action'] == "detail") {
		include_once "views/detail.php";
	}
	else if($_GET['action'] == "add") {
		include_once "add.php";
	}
	else if($_GET['action'] == "cartdetail") {
		if(isset($_GET['operation'])) {
			if($_GET['operation'] == "inc") {
				$_SESSION['cart'][$_GET['id']]['quantity']++;
			}
			else {
				$_SESSION['cart'][$_GET['id']]['quantity']--;
				if($_SESSION['cart'][$_GET['id']]['quantity'] == 0) {
					unset($_SESSION['cart'][$_GET['id']]);
					if(sizeof($_SESSION['cart']) == 0)
						unset($_SESSION['cart']);
				}
			}
		}
		include_once "views/cartdetail.php";
	}
}
else if($_POST['buy']) {
	if(isset($_SESSION['login'][$nick])  && $_SESSION['prava'] == '1') {
		include_once "naskladnenie.php";
	}
	else
		include_once "buy.php";
}
else if(isset($_POST['registration']) || isset($_GET["err"])) {
	include_once "registracia.php";	
}
else if(isset($_POST['emailchange'])) {
	include_once "_set_email.php";	
}
else if(isset($_GET['komentovat'])) {
	include_once "_comment.php";	
}
else if(isset($_POST['pwchange'])) {
	include_once "_set_password.php";	
}
else if(isset($_GET['moje_objednavky'])) {
	include_once "orderlist.php";
}
else if(isset($_GET['prehlad_objednavok'])) {
	include_once "adminorderlist.php";
}
else if(isset($_GET['objednany_tovar'])) {
	include_once "objednavkynaskladnenia.php";
}
else if(isset($_GET['order'])) {
	include_once "views/order.php";
}
else if(isset($_GET['storeorder'])) {
	include_once "views/storeorder.php";
}
else if(isset($_GET['adminorder'])) {
	include_once "views/adminorder.php";
}
else if(isset($_GET['buydetails'])) {
	include_once "views/buydetails.php";
}
else if(isset($_GET['moj_ucet'])) {
	include_once "views/myaccount.php";
}
else if(isset($_GET['dodavatelia'])) {
	include_once "views/dodavatelia.php";
}
else if(isset($_GET['zmenit_email'])) {
	include_once "views/zmenaemailu.php";
}
else if(isset($_GET['zmenit_heslo'])) {
	include_once "views/zmenahesla.php";
}
else if(isset($_GET['kontakt'])) {
	include_once "views/kontakt.php";
}
else if(isset($_GET['reg'])) {
	include_once "registration.php";
}
else if(isset($_GET['msg'])) {
	include_once "msg.php";
}
else {
	include_once "views/produkt.php";
}

include_once "views/cart.php";
$page1 = include_once "home.php";
echo $page1;
$page2 = include_once "sidebar.php";
echo $page2;