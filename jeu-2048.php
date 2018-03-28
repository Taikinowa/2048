<!doctype HTML>
<?php $score ?>
<?php $grille ?>
<?php require_once 'fonctions-2048.php'; ?>
<?php fichier_vers_matrice();?>
<html>
 <head>
        <?php
         $TITRE = "2048"
        ?>
        <title>
         <?php echo $TITRE; ?>
        </title>
 </head>
 <body>
        <h2>Bienvenue dans le jeu 2048 !</h2>
<br><br>
<details>
<summary><u>Règles du jeu : </u></summary>
<p>
<br>
Le but du jeu est de faire glisser des tuiles sur une grille, pour combiner les tuiles de mêmes valeurs et créer ainsi une tuile portant le nombre 2048.
<br>
Le joueur peut toutefois continuer à jouer après cet objectif atteint pour faire le meilleur score possible.
<br><br>
Le jeu se présente sous la forme d'une grille 4*4.<br>
Au début de la partie, deux cases contiennent un chiffre (2 ou 4).<br>
Les nombres peuvent se déplacer à droite, à gauche, en haut ou en bas. <br>
Quand deux cases de même valeur se rencontrent, elles fusionnent en une case qui vaut la somme des 2 cases fusionnées.<br>
Après chaque action du joueur, une nouvelle case apparaît avec pour valeur 2 ou 4.
<br><br>
Le but est donc d'obtenir une case valant 2048 avant que la grille ne soit pleine et qu'aucun mouvement ne soit plus possible. <br>
Si plus aucun mouvement n'est possible, la partie est perdue.
</p>

</details>
<br><br>

<div class="JeuComplet">

        <nav style="margin:auto;">
<div style="font-family:aerosol;color:black;font-weight:bold;text-align:center;
animation:anima 4s linear 1;animation-delay:1s;font-size:18px">
        <?php fichier_vers_matrice() ?>
</div>
<br>
<form name="jeu-2048" method="get" action="jeu-2048.php">
        <input class="Up" type="submit" value="X" name="action-joueur" />
        <br>
        <input class="Left" type="submit" value="Y" name="action-joueur" />
        <input class="Right" type="submit" value="A" name="action-joueur" />
        <br>
        <input class="Down" type="submit"  value="B" name="action-joueur" />
</form>
</nav>

<table>
        <caption>
        <form name="jeu-2048" method="get" action="jeu-2048.php">
                <input type="submit" class="Play" name="action-joueur" value="Jouer"/>

                <div class="score" ><?php affiche_score(); ?> </div>
                 <?php write_log('Le joueur a cliqué sur '.$_GET['action-joueur']);?>
        </form>
                <?php action();?>

        </caption>
        <tr>
                <?php affichev2(0,0); ?>
                <?php affichev2(0,1); ?>
                <?php affichev2(0,2); ?>
                <?php affichev2(0,3); ?>
        </tr>
        <tr>
                <?php affichev2(1,0); ?>
                <?php affichev2(1,1); ?>
                <?php affichev2(1,2); ?>
                <?php affichev2(1,3); ?>
        </tr>
        <tr>
                <?php affichev2(2,0); ?>
                <?php affichev2(2,1); ?>
                <?php affichev2(2,2); ?>
                <?php affichev2(2,3); ?>
        </tr>
        <tr>
                <?php affichev2(3,0); ?>
                <?php affichev2(3,1); ?>
                <?php affichev2(3,2); ?>
                <?php affichev2(3,3); ?>
        </tr>
</table>
<br><br>

</div>
<br><br>
<footer>
        <a style="font-weight:bold;" target="_blank" href="http://perso.univ-lyon1.fr/olivier.gluck/supports_enseig.html#LIFASR2">
        Supports de l'Unité d'enseignement
        </a>
</footer>
        </body>
</html>

<style>
.c2
{
background-color:rgb(245,222,179);
}

.c4
{
background-color:rgb(222,184,135);
}

.c8
{
background-color:rgb(210,180,140);
}

.c16
{
background-color:rgb(244,164,96);
}

.c32
{
background-color:rgb(255,165,0);
}

.c64
{
background-color:rgb(255,140,0);
}

.c128
{
background-color:rgb(210,105,30);
}

.c256
{
background-color:rgb(205,133,63);
}

.c512
{
background-color:rgb(160,82,45);
}

.c1024
{
background-color:rgb(139,69,19);
color:white;
}

.c2048
{
background-color:rgb(139,69,19);
color:white;
}

.c4096
{
background-color:black;
color:white;
}

h2
{
        font-family:DeathNote;
        color:red;
        text-shadow:black 1px 1px, black 1px -1px, black -1px -1px, black -1px 1px;
        margin:auto;text-align:center;
        border:2px solid black;
        border-radius:25px;
        background-image:url('flux.jpeg');
        background-size:cover;
        width:30%;
}

@keyframes anima
{
0%{transform:rotate(0deg);color:black;}
33%{transform:rotate(120deg);color:grey;}
66%{transform:rotate(240deg);color:white;}
100%{transform:rotate(360deg);color:grey;}
}

.Play
{
border: 2px solid black;
border-radius: 50px;
margin-right:0;
margin-left:-15%;
height:0.6cm;
font-size:18px;
padding: 0 30px;
margin-top:0.2cm;
font-family:Alice;
font-weight:bold;
}


.score
{
float:right;
margin-right:25%;
margin-top:0.2cm;
color: yellow;
border:2px solid black;
border-radius:25px;
left:2px;
font-size:18px;
padding: 0 5px;
font-family: Alice;
}


.JeuComplet
{
margin-left:20%;
width:60%;
}

caption
{
background-color: black;
height:0.8cm;
}

nav
{
float: left;
width: 23%;
border:2px solid black;
padding: 15px;
border-radius: 50px;
background-color:lightskyblue;
}

.Left
{
margin-left:-5px;
border-radius:25px 0px 0px 25px;
width:2cm;
height:1cm;
background-color:blue;
}

.Left,.Down,.Right,.Up
{
border: 5px ridge red;
color:white;
text-shadow: black 1px 1px, black 1px -1px, black -1px -1px, black -1px 1px;
font-family:Alice;
}

.Down
{
margin-left:28%;
border-radius:0px 0px 25px 25px;
width:2cm;
height:1cm;
background-color:green;
}

.Up
{
margin-left:28%;
border-radius:25px 25px 0px 0px;
width:2cm;
height:1cm;
background-color:yellow;
}

.Right
{
margin-left:12%;
border-radius:0px 25px 25px 0px;
width:2cm;
height:1cm;
background-color: red;
}

body
{
background-size:cover;
background-repeat: no-repeat;
sbackground-image:url('https://image.noelshack.com/fichiers/2018/12/5/1521836602-font-binaire.png');
sbackground-image:url('https://image.noelshack.com/fichiers/2018/12/6/1521860619-font-binaire2.png');
background-image:url('https://image.noelshack.com/fichiers/2018/12/6/1521860977-font-binaire3.png');
}

h2
{
top:0;
left:0;
right:0;
position:fixed;
}

footer
{
width:83%;
height: 0.6cm;
font-size: 14px;
background-color:brown;
position:fixed;
bottom:0;
left:0;
right:0;
border: 2px solid black;
text-align:center;
margin-left:8%;
margin-right:8%;
font-family:Bellini;
}

a{font-size:18px;}

a:hover
{
color:yellow;
border:1px solid black;
border-radius:25px;
background-color:black;
font-family:Walt;
text-decoration:none;
}

p
{
border: 2px solid black;
border-radius: 25px 0px 25px 0px;
font-size:18px;
color:black;
font-weight:bold;
margin-left:15%;
margin-right:15%;
background-color:rgba(255,127,63,0.5);
text-align: 5px;
}

p:hover
{
font-size:30px;
}

details
{
border: 2px solid black;
font-family:Bellini;
font-size:22px;
background-color: lightgrey;
margin-left: 8%;
margin-right:8%;
}


td,tr
{
width: 2.3cm;
height: 2.3cm;
text-align:center;
border:2px solid black;
border-radius: 25px;
}

td
{
background-color: lightyellow;
font-size: 18px;
font-weight:bold;
color:darkred;
border:0.3em double darkblue;
font-family:Bellini;
}

table
{
margin-left: 32%;
border: 2px solid black!important;
background-color:lightgrey;
}

.Perte
{
        padding: 0 5px;
        font-family: Walt;
        color:blue;
        font-size:80px;
        animation: anima 0.001s linear infinite;
        animation-delay: 2s;
        margin-top: 37%;
        text-shadow: black 1px 1px, black 1px -1px, black -1px -1px, black -1px 1px;
}

@font-face
{
font-family: DeathNote;
src:url('fonts/DN.ttf');
}

@font-face
{
font-family:Bellini;
src:url('fonts/Bellini.ttf');
}

@font-face
{
font-family:aerosol;
src:url('fonts/Aerosol.ttf');
}

@font-face
{
font-family:Alice;
src:url('fonts/AIW.ttf');
}

@font-face
{
font-family:Walt;
src:url('fonts/WD.ttf');

}

</style>