<?php

return '
switch ($_GET["err"]) {
                            case 1:
                                $msg = "nebol zadany email";
                                break;
                            case 2:
                                $msg = "email nebol najdeny v databaze";
                                break;                                                 
                            default:
                                $msg = "";
                                break;
                        }
                        if(isset($_GET["err"])) echo "<p>Chyba: ".$msg.".</p>";
                        ?>
                             <div class="login-log" style="width:550px">
                                <h2>Zabunuté heslo</h2>
                                <p>Zadajte email , ktorý bol uvedený pri registrácii:</p>
                               
                                    <form action="_heslo.php" method="post">                            
                                        <input type="text" name="email" value="" Placeholder="Email"/><br>
                                        <input type="submit" class="login login-submit" value="Odeslat"/>
                                    </form>
                                </div>
';