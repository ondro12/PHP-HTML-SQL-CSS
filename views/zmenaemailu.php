<?php

if(isset($_SESSION['login'][$nick])) {
	$pageData->content .= "<h2><center>Zmeniť email</center></h2>";
	$pageData->content .= "<div class='login-log' style='width:550px'><form name='zmenaemailu' method='post'>
                                    <input name='stare' type='text' value='' Placeholder='Pôvodný email'/><br>
                                    <input name='nove' type='text' value='' Placeholder='Nový email'/><br>
                                    <input name='nove_check' type='text' value='' Placeholder='Potvrdenie nového emailu'/><br>
                                    <p>Heslo:</p>
                                    <input name='heslo' type='password' value=''/><br>
                                    <input type='submit' name='emailchange' class='login login-submit' value='Zmeniť'/>
                                </form></div>";
}
else {
	$pageData->content .= "Je nutné prihlásenie.";
}