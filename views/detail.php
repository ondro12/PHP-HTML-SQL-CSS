<?php

if(isset($_POST['registration'])) {
	header("Location: index.php?reg");
}

switch ($_GET["err"]) 
    {
        case 1:
            $msg = "Nevyplnili ste meno.";
            break;
        case 2:
            $msg = "Nevyplnili ste email.";
            break;
        case 3:
            $msg = "Nezadali ste žiaden text.";
            break;
        case 4:
            $msg = "K produktu ste nepridali vaše hodnotenie.";
            break;                
        default:
            $msg = "";
            break;
    }
if(isset($_GET["err"])) {
	$pageData->content .= "<p>Chyba: ". $msg .".</p>";
	exit();
}

$id = $_GET['id'];
$_SESSION['returnpage'] = "id=" . $id . "&action=detail";
$sql = "SELECT * FROM tovar WHERE id_tovaru = '$id'";

if ($result=mysqli_query($db,$sql)) {
	if($row=mysqli_fetch_row($result)) {
		$pageData->content .= "<div class='productdetail'><h2>" . $row[1] . "</h2>";
		$pageData->content .= "<div class='productdetailcontent-left'><img src='images/$row[6]' alt='$row[6]' height='120' width='70'><br></div>"; //obrazok
		$pageData->content .= "<div class='productdetailcontent-right'><p style='font-size:18px'><b>Suma: $row[5]€</b></p>";
		$pageData->content .= "<b>Na sklade: </b>";
		if($row[7] == 0) {
			$sql = "SELECT casdorucenia FROM dodavatelia WHERE id_dodavatela = '$row[3]'";
			$dodavatelia=mysqli_query($db,$sql);
			$dodaciadoba=mysqli_fetch_row($dodavatelia);
			$pageData->content .= "<font color='yellow'>Tovar je momentálne nedostupný. Približná doba dodania " . $dodaciadoba[0] . "</font><br>";
		}
		else $pageData->content .= "<font color='blue'>" . $row[7] . " ks</font><br>";

		if(isset($_SESSION['login'][$nick]) && $_SESSION['prava'] == '1') {
			$pageData->content .= "<nav><a href='index.php?id=$row[0]&action=add'>Doobjednať</a></nav></div>";
			$pageData->content .= "<br><div class='productdetailcontent'><h3>Detail produktu</h3><p>" . $row[4]."</p>";
		}
		else
			$pageData->content .= "<nav><a href='index.php?id=$row[0]&action=add'>Vložiť do košíka</a></nav></div>";

			$pageData->content .= "<br><div class='productdetailcontent'><h3>Informácie o produkte</h3><p>" . $row[4]."</p>";
    		$pageData->content .= "<h3>Hodnotenie</h3></div></div>";
    		$pageData->content .= "
			<div class='login-log' style='width:570px'>						
				<form name='komentar' method='get'> 				     	
					<input type='text' name='meno' placeholder='*Meno'/>
					<input type='email' name='email' placeholder='*E-mail'/>
					<textarea id='message' name='text' placeholder='*Text'></textarea>
					<h3 style='float:left;margin:1px 5px 0 0'>Hodnotenie:</h3>
					<div class='starRating'>
						<div>
    						<div>
      							<div>
       								 <div>
 										<input id='rating1' type='radio' name='hodn' value='1'>
          								<label for='rating1'><span>1</span></label>
        							</div>
        							<input id='rating2' type='radio' name='hodn' value='2'>
        							<label for='rating2'><span>2</span></label>
      							</div>
      							<input id='rating3' type='radio' name='hodn' value='3'>
      							<label for='rating3'><span>3</span></label>
    						</div>
    						<input id='rating4' type='radio' name='hodn' value='4'>
    						<label for='rating4'><span>4</span></label>
  						</div>
  						<input id='rating5' type='radio' name='hodn' value='5'>
  						<label for='rating5'><span>5</span></label>
					</div>
					<label>
						<input type='hidden' name='typ' value='t'/>
						<input type='hidden' name='id' value='".$id."'/>
						<input type='submit' name='komentovat' class='login login-submit' value='Odoslať'/> 
					</label>    
				</form>
			</div>";
			$komentare = mysqli_query($db, "SELECT * FROM recenziehodnotenia WHERE produkt='$id' ORDER BY datum DESC");
			while($row=mysqli_fetch_array($komentare)) {
			$pageData->content .= "<div class='hodnkom'><p>
						<b>".$row['meno'].' | '.$row['email'].' | '.$row['datum'].' | '.$row['hodnotenie']."</b></br>
						".$row['recenzie']."
						</p></div>";
			}
	} else $pageData->content .= "Zle ID produktu.";
}