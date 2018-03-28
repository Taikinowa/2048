<?php
function affiche_sept_variables ()
{
        echo "HTTP_USER_AGENT="; echo $_SERVER['HTTP_USER_AGENT']; echo "<br />";
        echo "HTTP_HOST="; echo $_SERVER['HTTP_HOST']; echo "<br />";
        echo "DOCUMENT_ROOT="; echo $_SERVER['DOCUMENT_ROOT']; echo "<br />";
        echo "SCRIPT_FILENAME="; echo $_SERVER['SCRIPT_FILENAME']; echo "<br />";
        echo "PHP_SELF="; echo $_SERVER['PHP_SELF']; echo "<br />";
        echo "REQUEST_URI="; echo $_SERVER['REQUEST_URI']; echo "<br />";
        echo "action-joueur="; echo $_GET['action-joueur']; echo "<br />";
}

function write_log($mesg)
{
        file_put_contents('logs_2048.txt', $mesg."\n", FILE_APPEND);
}

function affiche_logs($nbl)
{
        $fic="logs_2048.txt";
        $logs=file($fic);
        $A=sizeof($logs)-$nbl;
        $B=sizeof($logs)-50;
        for ($i=$A+1; $i <= sizeof($logs); $i++)
        {
                echo "Action ".$i." : ".htmlspecialchars($logs[$i-1]).'<br/>';
        }
        if(sizeof($logs)>50)
        {
                for($j=$B;$j<=sizeof($logs);$j++)
                {
                        $D="Action ".$j." : ".htmlspecialchars($logs[$j-1]).'<br>';
                        file_put_contents($fic,$D);
                }
        }
}


function affiche_score()
{
        global $score;
        fichier_vers_score();
        if($score <= 1)
        {
                echo "Score : ".$score." pt";
        }
        if($score >= 2)
        {
                echo "Score : ".$score." pts";
        }
}

function score_vers_fichier()
{
        global $score;
        file_put_contents("score.txt",$score);
}

function fichier_vers_score()
{
        global $score;
        $score=file_get_contents("score.txt");
}

function nouvelle_partie()
{
        global $score;
        $score=0;
        global $grille;
        $grille=array_fill(0,4,array_fill(0,4,0));
        $tab=tirage_position_vide();
        $grille[$tab[0]][$tab[1]]=2;
        $tab=tirage_position_vide();
        $grille[$tab[0]][$tab[1]]=2;
        score_vers_fichier();
        matrice_vers_fichier();
}

function matrice_vers_fichier()
{
        global $grille;
        file_put_contents('grille.txt',"");
        $chaine=file_get_contents("grille.txt");
        $chaine=str_replace("\n"," ", $chaine);
        $valeurs=explode(' ', $chaine);
        for($i=0;$i<4;$i++)
        {
                for($j=0;$j<4;$j++)
                {
                        file_put_contents("grille.txt",$grille[$i][$j]." ",FILE_APPEND);
                }
        }
}

function fichier_vers_matrice()
{
        global $grille;
        $chaine=file_get_contents("grille.txt");
        $chaine=str_replace("\n"," ", $chaine);
        $valeurs=explode(' ', $chaine);
        $n=0;
        for($i=0;$i<4;$i++)
        {
                for($j=0;$j<4;$j++)
                {
                        $grille[$i][$j]=(int)($valeurs[$n]);
                        $n++;
                }
        }
}

function affiche_case($i,$j)
{
        global $grille;
        if($grille[$i][$j]!=0)
        {
                echo $grille[$i][$j];
        }
}

function affichev2($i,$j)
{
        global $grille;
        switch ($grille[$i][$j])
        {
                case 0:
                        echo "<td></td>";
                        break;
                case 2:
                        echo "<td class='c2'> 2 </td>";
                        break;
                case 4:
                        echo "<td class='c4'> 4 </td>";
                        break;
                case 8:
                        echo "<td class='c8'> 8 </td>";
                        break;
                case 16:
                        echo "<td class='c16'> 16 </td>";
                        break;
                case 32:
                        echo "<td class='c32'> 32 </td>";
                        break;
                case 64:
                        echo "<td class='c64'> 64 </td>";
                        break;
                case 128:
                        echo "<td class='c128'> 128 </td>";
                        break;
                case 256:
                        echo "<td class='c256'> 256 </td>";
                        break;
                case 512:
                        echo "<td class='c512'> 512 </td>";
                        break;
                case 1024:
                        echo "<td class='c1024'> 1024 </td>";
                        break;
                case 2048:
                        echo "<td class='c2048'> 2048 </td>";
                        break;
                case 4096:
                        echo "<td class='c4096'> 4096 </td>";
                        break;
                default:
                        echo "<td style='background-color: lightskyblue;color:yellow;'>$grille[$i][$j]</td>";
        }
}

function tirage_position_vide()
{
        global $grille;
        do
        {
                $i=rand(0,3);
                $j=rand(0,3);
        }while($grille[$i][$j]!= 0);
        return array($i,$j);
}

function grille_pleine()
{
        global $grille;
        for($i=0;$i<4;$i++)
        {
                for($j=0;$j<4;$j++)
                {
                        if($grille[$i][$j]==0)
                        {
                                return false;
                        }
                }
        }
        return true;
}

function tirage_2ou4()
{
        return 2*rand(1,2);
}

function place_nouveau_nb()
{
        global $grille;
        if(!grille_pleine())
        {
                $tab=tirage_position_vide();
                $x=tirage_2ou4();
                $grille [$tab[0]] [$tab[1]] = $x;
        }
        matrice_vers_fichier();
}

function decale_ligne_gauche($l)
{
        global $grille;
        $ligne=array_fill(0,4,0);
        $j=0;
        for ($i=0; $i<4; $i++)
        {
                if ($grille[$l][$i]!=0)
                {
                        $ligne[$j] = $grille[$l][$i];
                        $j++;
                }
        }
        $grille[$l] = $ligne;
}

function decale_ligne_droite($l)
{
        global $grille;
        $ligne=array_fill(0,4,0);
        $j=3;
        for ($i=3; $i>=0; $i--)
        {
                if ($grille[$l][$i]!=0)
                {
                        $ligne[$j] = $grille[$l][$i];
                        $j--;
                }
        }
        $grille[$l] = $ligne;
}

function decale_ligne_haut($c)
{
        global $grille;
        $colonne=array_fill(0,4,0);
        $j=0;
        for ($i=0; $i<4; $i++)
        {
                if ($grille[$i][$c]!=0)
                {
                        $colonne[$j] = $grille[$i][$c];
                        $j++;
                }
        }
        for ($co=0 ; $co<4 ; $co++)
        {
                $grille[$co][$c]=$colonne[$co];
        }
}

function decale_ligne_bas($c)
{
        global $grille;
        $colonne=array_fill(0,4,0);
        $j=3;
        for ($i=3; $i>=0; $i--)
        {
                if ($grille[$i][$c]!=0)
                {
                        $colonne[$j] = $grille[$i][$c];
                        $j--;
                }
        }
        for ($co=0 ; $co<4 ; $co++)
        {
                $grille[$co][$c]=$colonne[$co];
        }
}

function fusion_ligne_gauche($l)
{
        global $grille;
        global $score;
        if ($grille[$l][0] == $grille[$l][1])
        {
                $grille[$l][0] = 2 * $grille[$l][0];
                $score+=$grille[$l][0];
                $grille[$l][1] = 0;
                if ($grille[$l][2] == $grille[$l][3])
                {
                        $grille[$l][2] = 2 * $grille[$l][2];
                        $score+=$grille[$l][2];
                        $grille[$l][3] = 0;
                }
        }
        else if ($grille[$l][1] == $grille[$l][2])
        {
                $grille[$l][1] = 2 * $grille[$l][1];
                $score+=$grille[$l][1];
                $grille[$l][2] = 0;
        }
        else if ($grille[$l][2] == $grille[$l][3])
        {
                $grille[$l][2] = 2 * $grille[$l][2];
                $score+=$grille[$l][2];
                $grille[$l][3] = 0;
        }
}

function fusion_ligne_droite($l)
{
        global $grille;
        global $score;
        if ($grille[$l][3] == $grille[$l][2])
        {
                $grille[$l][3] = 2 * $grille[$l][3];
                $score+=$grille[$l][3] ;
                $grille[$l][2] = 0;
                if ($grille[$l][1] == $grille[$l][0])
                {
                        $grille[$l][1] = 2 * $grille[$l][1];
                        $score+=$grille[$l][1];
                        $grille[$l][0] = 0;
                }
        }
        else if ($grille[$l][2] == $grille[$l][1])
        {
                $grille[$l][2] = 2 * $grille[$l][2];
                $score+=$grille[$l][2];
                $grille[$l][1] = 0;
        }
        else if ($grille[$l][1] == $grille[$l][0])
        {
                $grille[$l][1] = 2 * $grille[$l][1];
                $score+=$grille[$l][1];
                $grille[$l][0] = 0;
        }
}

function fusion_ligne_haut($l)
{
        global $grille;
        global $score;
        if ($grille[0][$l] == $grille[1][$l])
        {
                $grille[0][$l] = 2 * $grille[0][$l];
                $score+=$grille[0][$l];
                $grille[1][$l] = 0;
                if ($grille[2][$l] == $grille[3][$l])
                {
                        $grille[2][$l] = 2 * $grille[2][$l];
                        $score+=$grille[2][$l];
                        $grille[3][$l] = 0;
                }
        }
        else if ($grille[1][$l] == $grille[2][$l])
        {
                $grille[1][$l] = 2 * $grille[1][$l];
                $score+=$grille[1][$l];
                $grille[2][$l] = 0;
        }
        else if ($grille[2][$l] == $grille[3][$l])
        {
                $grille[2][$l] = 2 * $grille[2][$l];
                $score+=$grille[2][$l];
                $grille[3][$l] = 0;
        }
}

function fusion_ligne_bas($l)
{
        global $grille;
        global $score;
        if ($grille[3][$l] == $grille[2][$l])
        {
                $grille[3][$l] = 2 * $grille[3][$l];
                $score+=$grille[3][$l];
                $grille[2][$l] = 0;
                if ($grille[1][$l] == $grille[0][$l])
                {
                        $grille[1][$l] = 2 * $grille[1][$l];
                        $score+=$grille[1][$l];
                        $grille[0][$l] = 0;
                }
        }
        else if ($grille[2][$l] == $grille[1][$l])
        {
                $grille[2][$l] = 2 * $grille[2][$l];
                $score+=$grille[2][$l];
                $grille[1][$l] = 0;
        }
        else if ($grille[1][$l] == $grille[0][$l])
        {
                $grille[1][$l] = 2 * $grille[1][$l];
                $score+=$grille[1][$l];
                $grille[0][$l] = 0;
        }
}

function Madagascar()
{
        global $grille;
        $copy=$grille;
        for($a=0;$a<4;$a++)
        {
                decale_ligne_haut($a);
                fusion_ligne_haut($a);
                decale_ligne_haut($a);
                if($grille!=$copy)
                {
                        $grille=$copy;
                        return true;
                }

                decale_ligne_bas($a);
                fusion_ligne_bas($a);
                decale_ligne_bas($a);
                if($grille!=$copy)
                {
                        $grille=$copy;
                        return true;
                }

                decale_ligne_gauche($a);
                fusion_ligne_gauche($a);
                decale_ligne_gauche($a);
                if($grille!=$copy)
                {
                        $grille=$copy;
                        return true;
                }

                decale_ligne_droite($a);
                fusion_ligne_droite($a);
                decale_ligne_droite($a);
                if($grille!=$copy)
                {
                        $grille=$copy;
                        return true;
                }
        }
        return false;

}

function action()
{
        switch ($_GET['action-joueur'])
        {
                case "Jouer":
                        nouvelle_partie();
                        break;
                case "X":
                if(!grille_pleine() or Madagascar())
                {
                        for($a=0;$a<4;$a++)
                        {
                                decale_ligne_haut($a);
                                fusion_ligne_haut($a);
                                decale_ligne_haut($a);
                        }
                        score_vers_fichier();
                        place_nouveau_nb();
                        break;
                }
                case "B":
                if(!grille_pleine()or Madagascar())
                {
                        for($a=0;$a<4;$a++)
                        {
                                decale_ligne_bas($a);
                                fusion_ligne_bas($a);
                                decale_ligne_bas($a);
                        }
                        score_vers_fichier();
                        place_nouveau_nb();
                        break;
                }
                case "A":
                if(!grille_pleine() or Madagascar())
                {
                        for($a=0;$a<4;$a++)
                        {
                                decale_ligne_droite($a);
                                fusion_ligne_droite($a);
                                decale_ligne_droite($a);
                        }
                        score_vers_fichier();
                        place_nouveau_nb();
                        break;
                }
                case "Y":
                if(!grille_pleine() or Madagascar())
                {
                        for($a=0;$a<4;$a++)
                        {
                                decale_ligne_gauche($a);
                                fusion_ligne_gauche($a);
                                decale_ligne_gauche($a);
                        }
                        score_vers_fichier();
                        place_nouveau_nb();
                        break;
                }
        }
        if(!Madagascar())
        {
                echo "<div class='Perte'>Perdu</div>";
                echo "<audio src=\"Perdu.mp3\" autoplay />";
        }
}