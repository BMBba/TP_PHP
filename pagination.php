                              
<?php
/*---------------------------------------------------------------*/
/*
    Titre : [PHP/SQL] Script de pagination (un modèle)                                                                    
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=522
    Auteur           : poujolrost-mathias                                                                                 
    Date édition     : 23 Juil 2009                                                                                       
*/
/*---------------------------------------------------------------*/

/* Script PHP por afficher des élements, en les paginant */

/* DEBUT recuperation du nombre par page */
if (isset($_GET['nombre'])) 
{ 
    $nombreDeElementsParPage = (int) $_GET['nombre'];
    if ($nombreDeElementsParPage < 5)
            { $nombreDeElementsParPage = 5; } 
            // par défaut
} 
else 
{   $nombreDeElementsParPage = 5;    } // par défaut
/* FIN recuperation du nombre par page */

/* DEBUT recuperation du numéro de page courante */
if (isset($_GET['page']))
    { $page = (int) $_GET['page']; } 
else // La variable n'existe pas, c'est la première fois qu'on charge la page
    { $page = 1;} // On se met sur la page 1 (par défaut)
/* FIN recuperation du numéro de page courante */

/* On calcule le numéro du premier élément qu'on prend pour le LIMIT de MySQL */
$premierElementAAfficher = ($page - 1) * $nombreDeElementsParPage;

/* requête pour le nombre total de la sélection */
$reqNbrTotal = "SELECT COUNT(*) AS nbr FROM latable WHERE $where"; 
$resNbrTotal = mysql_query($reqNbrTotal); 
$nbr = mysql_fetch_assoc($resNbrTotal); 
$nombreLignes = $nbr['nbr']; // total pour la requete = pas que sur cette page

/* req. propre à cette page */
$requete = "SELECT * 
        FROM latable 
        WHERE $where 
        ORDER BY ordre ASC 
        LIMIT $premierElementAAfficher, $nombreDeElementsParPage"; 
$resultat = mysql_query($requete); 
$nombreDeElementsSurCettePage = mysql_num_rows($resultat); 
 
/* nombre de page, par arrondi à l'inférieur */
$nombreDePages  = ceil($nombreLignes / $nombreDeElementsParPage); 

/* DEBUT rédaction paragraphe de pagination */
$pagination = "Page : ";
    
if ($page != 1) // si on n'est pas sur la n°1 (= pas de précédente)
{
    $pagination .= ' <a href="?nombre='.$nombreDeElementsParPage.'&amp;page=' . 
($page - 1) . '#resultats" title="page '.($page - 1).
'"><abbr title="page pr&eacute;c&eacute;dente">Pr&eacute;c.</abbr></a> ';
}
if ($page != $nombreDePages) 
// si on n'est pas sur la dernière (= pas de suivante)
{
    $pagination .= ' <a href="?nombre='.$nombreDeElementsParPage.'&amp;page=' . 
($page + 1) . '#resultats" title="page '.($page + 1).
'"><abbr title="page suivante">Suiv.</abbr></a> ';
}
for ($i = 1 ; $i <= $nombreDePages ; $i++) 
{
    if ($i == $page) // si on est sur la page actuelle
    {
        $pagination .= '<strong title="page actuelle">&nbsp;'. $i .'/'.
$nombreDePages.'&nbsp;</strong>';
    }
    else
    {
        $pagination .= ' <a href="?nombre='.$nombreDeElementsParPage.
'&amp;page=' . $i . '#resultats" title="page '.$i.' sur '.$nombreDePages.
'">&nbsp;'. $i .'&nbsp;</a> ';
    } 
}
$difference = ($nombreLignes%$nombreDePages) +1;
$pagination .= "(affichage des résultats "; 
$pagination .=  $premierElementAAfficher+1; 
$pagination .=  " &agrave; ";  
if( ($premierElementAAfficher+$nombreDeElementsSurCettePage) != ($page*
$nombreDeElementsParPage) )
{ 
    $pagination .= $premierElementAAfficher+$nombreDeElementsSurCettePage; 
}
else
    {   $pagination .= $premierElementAAfficher+$nombreDeElementsParPage;   }

$pagination .= " sur un total de $nombreLignes pour cette s&eacute;lection)."; 
/* FIN rédaction paragraphe de pagination */ 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Touts les éléments</title>
</head>

<body>

<form action="#resultats" method="get" id="form">
    <p>ici vos critères de sélection, tri...</p>
    <label for="l_nombre">Nombre par page</label> <input type="text"
 name="nombre" id="l_nombre" value="<?php echo @rappel($nombreDeElementsParPage)
; ?>" size="2" maxlength="2" /> 
    <input type="submit" value="Afficher les elementss" /></p>
</form>

<?php

if (!$resultat) 
{
    echo 
"<p>&Eacute;chec lors de la lecture de la table. <strong><a" .
" href=\"lapage.php\">Retour &agrave; cette page (avec les param&egrave;tres" .
" par d&eacute;faut)</a></strong>.</p>";
} 
elseif ($nombreDeElementsSurCettePage == 0)
{
    echo 
"<p>Il n'y a aucun élément correspondant à cette sélection <em>ou</em> des" .
" param&egrave;tres de l'URL sont incorrects. <strong><a href=\"lapage.php\">R" .
"etour &agrave; cette page (avec les param&egrave;tres par d&eacute;faut)</a><" .
"/strong>.";
}
else 
{
    echo "<p id=\"resultats\">$pagination</p>" ;
    
        /* DEBUT de la boucle */
        while ($ligne = mysql_fetch_object($resultat))
    {
        
        echo "<h3>$ligne->ref</h3>\n";
        echo 
"<p><img class=\"vignette\" src=\"../img/$ligne->vignette\"" .
" alt=\"$ligne->alt\" /></p>";
    } 
        /* FIN de la boucle */
    mysql_free_result($resultat);
        
    echo 
"<p style=\"clear: both; margin-top: 1em;\">$pagination <a" .
" href=\"#form\">Retour au formulaire</a>.</p>" ;

}// FIN du else
?>
</body> 
</html>


?>