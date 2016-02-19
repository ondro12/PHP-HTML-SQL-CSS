<?
//definícia chybových výpisov
    switch ($_GET["err"]) 
    {        
        case 1:
            $msg = "Prihlasovacie meno musí byť v dĺžke 5-25 znakov maximálne";
            break;
        case 2:
            $msg = "Prihlasovacie meno je už obsadené";
            break;
        case 3:
            $msg = "Heslo musí byť v dlžke 6-32 znakov maximálne";
            break;
        case 4:
            $msg = "Heslá niesú nezhodné";
            break;
        case 5:
            $msg = "Emain nebol zadaný";
            break;
        case 6:
            $msg = "Daná emailová adresa už bola zabraná";
            break;                         
        default:
            $msg = "";
            break;
    }
// chybový výpis
    if(isset($_GET["err"])) $pageData->content .= "<p>Chyba: ". $msg .".</p>";
//formulár registrácie
    $pageData->content .= "<h2><center>Registrovanie</center></h2>";
    $pageData->content .= '<div class="login-log" style="width:550px"><form name="registration" method="post">
        <input type="text" class="long" placeholder="Názov firmy" name="company" value="' . $_GET["company"] . '"/><br>
        <input type="text" class="long" maxlength="15" placeholder="IČO" name="ico"  value="' . $_GET["ico"] . '"/><br>
        <input type="text" class="long" maxlength="15" placeholder="DIČ" name="dic"  value="' . $_GET["dic"] . '"/><br>
        <input type="text" class="long" placeholder="Meno a priezvisko" name="meno_priezvisko"  value="' . $_GET["meno_priezvisko"] . '"/><br>
        <input type="text" class="long" maxlength="15" placeholder="Telefónne číslo" name="phone"  value="' . $_GET["phone"] . '"/><br>
        <input type="text" class="long2" placeholder="Adresa" name="address" value="' . $_GET["address"] . '"/><br>
        <label style="color:white"/><b><center>Prihlasovacie údaje</b></center></label><br>
        <input type="text" class="long" placeholder="*Prihlasovacie meno" name="prih_meno" value="' . $_GET["prih_meno"] . '"/><br>
        <input type="text" class="long" placeholder="*Email" name="email" value="' . $_GET["email"] . '"/><br>
        <input type="password" class="long" placeholder="*Prihlasovacie heslo" name="pass"/><br>
        <input type="password" class="long" placeholder="*Porvrdenie prihlasovacieho hesla" name="pass_check"/><br>                
        <input type="submit" name="register" class="login login-submit" value="Registrovať">
    </form></div>';
    $pageData->content .= "<font color=white>Hviezdičko(*) označené položky sú povinné.</font>";