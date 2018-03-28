<?php require_once 'fonctions-2048.php';?>
<html>

        <head>
                <meta charset="utf-8"/>
                <meta http-equiv="refresh" content="5" />
        </head>

        <body>
                <h1>Liste d'actions :</h1>
                <fieldset>
                        <?php
                        affiche_logs(5);
                        ?>
                </fieldset>
        </body>
</html>

<style>
h1
{
color: red;
text-decoration: underline blue;
margin:auto;
text-align:center;
}

</style>