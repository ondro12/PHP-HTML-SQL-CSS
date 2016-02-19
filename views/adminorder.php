<?php

if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {

	if(isset($_POST['zmenitstav'])) {
		if(isset($_POST['stav'])) {
            if($_POST['stav'] == "Expedovaná") {
                $sql = "SELECT  id_tovaru, mnozstvo FROM objednanytovar WHERE id_objednavky = '" . $_GET['adminorder'] . "'";
                if ($result=mysqli_query($db,$sql)) {
                    while ($row=mysqli_fetch_row($result)) {
                        $sql = "SELECT  nazovtovaru, skladom FROM tovar WHERE id_tovaru = '" . $row[0] . "'"; 
                        if(!$goodsresult = mysqli_query($db,$sql)) {
                            echo "Chyba: " . $sql . "<br>" . $db->error;
                            exit();
                        }
                        $goods= mysqli_fetch_row($goodsresult);
                        if($goods[1] < $row[1]) {
                            $pageData->content .= "<font color=white>Expedácia je nemožna , nedostatok na sklade" . $goods[0] . "</font>";
                            return;
                        }
                        else { 
                            $sql = "UPDATE  tovar SET skladom = skladom - " . $row[1] . " WHERE id_tovaru = '" . $row[0] . "'";
                            if(!$goodsresult = mysqli_query($db,$sql)) {
                                echo "Chyba: " . $sql . "<br>" . $db->error;
                                exit();
                            }
                        }
                    }
                }
                else {
                    echo "Chyba: " . $sql . "<br>" . $db->error;
                    exit();
                }
            }
            $sql = "UPDATE objednavka SET stav ='" . $_POST['stav'] . "' WHERE id_objednavky = '" . $_GET['adminorder'] . "'";
            $result=mysqli_query($db,$sql);
            if (!$result) {
                echo "Error: " . $sql . "<br>" . $db->error;
                exit();
            }
			header("Refresh:0");
		}
	}

	$pageData->content .= "<h3>Detail objednavky ID: #" . $_GET['adminorder'] . "</h3>";
	$pageData->content .= "
	<div class='datagrid'>
    <table>
    <thead>
    <tr>
        <th>Názov</th>
        <th>Počet</th>
        <th>Suma</th>
        <th>Spolu</th>
        <th>Skladom</th>
    </tr>
    </thead>
    <tfoot>
    <tr><td colspan='5'><div id='no-paging'>&nbsp;</div></tr></tfoot>
<tbody>
	";
	$sql = "SELECT  id_tovaru, mnozstvo FROM objednanytovar WHERE id_objednavky = '" . $_GET['adminorder'] . "'";

	if ($result=mysqli_query($db,$sql)) {
		$totalprice = 0;
    	while ($row=mysqli_fetch_row($result)) {
    		$sql = "SELECT  nazovtovaru, cena, skladom FROM tovar WHERE id_tovaru = '" . $row[0] . "'";
    		$goodsresult = mysqli_query($db,$sql);
    		$goods= mysqli_fetch_row($goodsresult);

    		$totalprice += $goods[1]*$row[1];
    		$pageData->content .= "<tr>";
			$pageData->content .= "<td>" . $goods[0] . "</td>"; 
			$pageData->content .= "<td>" . $row[1] . "</td>"; 
			$pageData->content .= "<td>" . $goods[1] . "€</td>"; 
			$pageData->content .= "<td>" . $row[1]*$goods[1] . "€</td>"; 
            $pageData->content .= "<td>" . $goods[2] . "</td>"; 
			$pageData->content .= "</tr>";
    	}
    }
    else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }
    $pageData->content .= "</tbody></table></div>";
    $pageData->content .= "<br><h3><center>Celkom:" . $totalprice . "€";

    $sql = "SELECT poznamka, prih_meno, stav FROM objednavka WHERE id_objednavky = '" . $_GET['adminorder'] . "'";
    if ($result=mysqli_query($db,$sql)) {
    	$row=mysqli_fetch_row($result);
    	$pageData->content .= " | Stav:" . $row[2] . "</center></h3>";
    }
    else {
            echo "Chyba: " . $sql . "<br>" . $db->error;
            exit();
    }

    $pageData->content .= "
    <div class='login-log'>
    <form name='zmenastavu' method='post'>
    	<select name='stav'>
    		<option value='' style='display:none'>Zvoľte nový stav</option>
  			<option value='Zaevidovaná'>Zaevidovaná</option>
  			<option value='Spracovaná'>Spracovaná</option>
  			<option value='Naskladňuje sa'>Naskladňuje sa</option>
  			<option value='Expedovaná'>Expedovaná</option>
  			<option value='Doručená'>Doručená</option>
		</select>
		<input type='submit' class='login login-submit' name='zmenitstav' value='Potvrdiť'>
	</form>";


    $pageData->content .= "<button onclick='javascript:window.print();' class='login login-submit'>Vytlačiť objednávku</button></div>";
    $pageData->content .= "<br><br><font color=white>*Pri zmene stavu na 'Expedovaná' budú dané položky odpočítane zo skladu.</font><br>";

}
else {
	$pageData->content .= "Na prevedenie nasledujúcej akcie nemáte dostatočné oprávnenia.<br>";
}