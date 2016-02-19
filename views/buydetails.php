<?php

if(isset($_SESSION['login'][$nick])) {
	$pageData->content .= 
	"<div class='login-log' style='width:570px'>
	<form name='buy' method='post'>
		<textarea name='poznamka' cols='40' rows='5' placeholder='Poznámka'></textarea><br>
		<select name='stavdorucenia'>
    		<option value='' style='display:none'>Voľba spósobu doručenia</option>
  			<option value='pošta'>Poštou</option>
  			<option value='kuriér'>Kuriérom</option>
		</select>
		<select name='stavplatby'>
    		<option value='' style='display:none'>Platba</option>
  			<option value='prevod'>Na účet</option>
  			<option value='dobierka'>Dobierkou</option>
		</select>

		<input type='submit' name='buy' class='login login-submit' value='Dokončiť objednávku.'>
	</form></div>";
}
else {
	$pageData->content .= "Je nutné prihlásenie.";
}