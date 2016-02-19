<?php

if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {

	if(isset($_POST['zmenitstav'])) {
		if(isset($_POST['stav'])) {
			$sql = "UPDATE naskladnenie SET stav ='" . $_POST['stav'] . "' WHERE id_naskladnenia = '" . $_GET['storeorder'] . "'";
			$result=mysqli_query($db,$sql);
			if (!$result) {
				echo "Error: " . $sql . "<br>" . $db->error;
            	exit();
			}
			if($_POST['stav'] == "Naskladnené") { //naskladnenie
                $sql = "SELECT  id_tovaru, mnozstvo FROM naskladnenytovar WHERE id_naskladnenia = '" . $_GET['storeorder'] . "'";
                if ($result=mysqli_query($db,$sql)) {
                    while ($row=mysqli_fetch_row($result)) {
                        $sql = "UPDATE  tovar SET skladom = skladom + " . $row[1] . " WHERE id_tovaru = '" . $row[0] . "'";
                        if(!$goodsresult = mysqli_query($db,$sql)) {
                            echo "Error: " . $sql . "<br>" . $db->error;
                            exit();
                        }
                    }
                }
                else {
                    echo "Chyba: " . $sql . "<br>" . $db->error;
                    exit();
                }
            }
			header("Refresh:0");
		}
	}

	$pageData->content .= "<h3>Objednavka ID: #" . $_GET['adminorder'] . "</h3>";
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
	$sql = "SELECT  id_tovaru, mnozstvo FROM naskladnenytovar WHERE id_naskladnenia = '" . $_GET['storeorder'] . "'";

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

    $sql = "SELECT poznamka, prih_meno, stav FROM naskladnenie WHERE id_naskladnenia = '" . $_GET['storeorder'] . "'";
    if ($result=mysqli_query($db,$sql)) {
    	$row=mysqli_fetch_row($result);
    	$pageData->content .= " | Stav: " . $row[2] . "</center></h3>";
    }
    else {
            echo "Error: " . $sql . "<br>" . $db->error;
            exit();
    }

    $pageData->content .= "
    <div class='login-log'>
    <form name='zmenastavu' method='post'>
    	<select name='stav'>
    		<option value='' style='display:none'>Zvoľte nový stav</option>
  			<option value='Objednané'>Objednané</option>
  			<option value='Naskladnené'>Naskladnené</option>
		</select>
		<input type='submit' name='zmenitstav' class='login login-submit' value='Potvrdiť'>
	</form>";


    $pageData->content .= "<button onclick='javascript:window.print();' class='login login-submit'>Vytlačiť objednávku</button></div>";
    $pageData->content .= "<br><br><font color=white>*Pri zmene stavu na 'Naskladnené' budú dané položky pripočítané do skladu.</font><br>";

}
else {
	$pageData->content .= "Pre nasledujúcu akciu nemáte dostatočné oprávnenia.<br>";
}