<?php

if(isset($_SESSION['login'][$nick])) {
	$pageData->content .= "<h2><center>Zmeniť heslo</center></h2>";
	$pageData->content .= "<div class='login-log' style='width:550px'><form name='zmenahesla' method='post'>
                                    <input name='stare' type='password' value='' Placeholder='Pôvodné heslo'/><br>
                                    <input name='nove' type='password' value='' Placeholder='Nové heslo'/><br>
                                    <input name='nove_check' type='password' value='' Placeholder='Potvrdenie nového hesla'/><br>
                                    <input type='submit' name='pwchange' class='login login-submit' value='Zmeniť'/>
                                </form></div>";
}
else {
	$pageData->content .= "Je nutné prihlásenie.";
}