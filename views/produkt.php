<?php

$kategoria = 1;
$navigationIsClicked = isset($_GET['page']);
if($navigationIsClicked) {
    $_SESSION['returnpage'] = "page=" . $_GET['page'];
	switch ($_GET['page']) {
    case "farby":
        $kategoria = 1;
        break;
    case "ceruzky":
        $kategoria = 2;
        break;
    case "voskovky":
        $kategoria = 3;
        break;
    case "kriedy":
        $kategoria = 4;
        break;
    case "vykresy":
        $kategoria = 5;
        break;
	}
}

$sql = "SELECT id_tovaru, nazovtovaru, obrazok, cena, skladom FROM tovar WHERE kategoria = '$kategoria'";

if ($result=mysqli_query($db,$sql)) {
    while ($row=mysqli_fetch_row($result))
    {
    	$pageData->content .= "<div class='product'><a href='index.php?id=$row[0]&action=detail'><img src='images/$row[2]' alt='$row[2]' height='120' width='120'></a>"; 
        $pageData->content .= "<h2>Suma: $row[3]€</h2><br>";
        $pageData->content .=  "<h3><a href='index.php?id=$row[0]&action=detail'>$row[1]</a></h3>"; 
    	$pageData->content .= "<center><b><a href='index.php?id=$row[0]&action=detail'><button class='login login-submit'>Informácie</button></a></b> "; 
        if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {
            $pageData->content .= "<b>Skladom: </b>";
            if($row[4] == 0) {
                $pageData->content .= "<font color='yellow'><b>" . $row[4] . " ks</b></font></center>";
               
        }
            else 
                $pageData->content .= "<font color='blue'><b>" . $row[4] . " ks</b></font><br>";
                $pageData->content .= "<center><a href='index.php?id=$row[0]&action=add'>Doobjednať</a></center><br></div>";
        }
        else
            $pageData->content .= "<b><a href='index.php?id=$row[0]&action=add'><button class='login login-submit'>Vložiť do košíka</button></a></b></div>";

    }
    mysqli_free_result($result);
}