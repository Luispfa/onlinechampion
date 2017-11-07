
<!DOCTYPE html>
<html>
    <head>
        <title>onlinechampion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                background-color: lightblue;
            }

            #team{
                display: none !important;
            }

            #update{
                display: none !important;
            }
        </style>
    </head>
    <body>
        <form  class="contact_form" action="indexHandler.php" id="contact_form" method="post">
            <div>
                <ul>
                    <li>
                        <h2>OnlineChampion</h2>
                    </li>
                    <li>
                        <label for="action">Acción</label>
                        <input list="action" name="action" placeholder="-- Acción --"  autocomplete="off"/>
                        <datalist id="action">
                            <option label="ver Equipo" value="show">
                            <option label="Actualizar Equipo" value="update">
                        </datalist>
                    </li>
                    <li id="team">
                        <label for="equipo">Equipo:</label>
                        <input type="text" id="equipo" name="equipo" placeholder="" required />
                    </li>
                    <li id="update">
                        <label for="newname">Nuevo nombre:</label>
                        <input type="text" id="newname" name="newname" placeholder="" required value=""/>
                    </li>
                    <li>
                        <button class="submit" type="submit">Enviar</button>
                    </li>
                </ul>
            </div>
        </form>
        <div>
            <table border="1">
              
            </table> 
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="assets/js.js"></script>
    </body>
</html>
