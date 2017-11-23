<!DOCTYPE html>
<html>
    <meta charset="utf-8" />
    <title>Scan de codes barres</title>
    <link rel="stylesheet" href="MEP.css" media="screen" type="text/css"/>
    <link rel="stylesheet" href="cssPrint.css" media="print" type="text/css"/>
    <!--<script src="Javascript.js" type="text/javascript"></script> Fichier css (MiseEnPage)-->
    
    
    <?php                                                   //Définition des variables 
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
    $reponse = $bdd->query('SELECT nom FROM jeux_video ORDER BY `jeux_video`.`ID` DESC LIMIT 0,20');
    date_default_timezone_set('Europe/Paris'); 
    //$code = $_POST['code']; 
    //$lencode = strlen($code); 
    $Date = date("H:i:s");
    $DateCode = "";
    $TextCodeDate = "";
    
    
    ?>
    
    
    <body>
      
        
       <div id="Conteneur">
         
        <form method = "post" >
            
            <h1>Entrez votre code barre</h1>
            
            <input type="text" id="code" name="code" required = "required" onkeyup="Text();" onClick="BDD();"/>                 <!--Penser à utiliser htmlspecialchars -->
            
            <form>
                 <script type="text/javascript" >
                     function Text() //fonction qui détecte des entrées de texte
                     {  
                         var key = document.getElementById('code').value;
                         document.getElementById("IdUP").innerHTML = "";
                         document.getElementById("IdUP").innerHTML += key;
                         if (key.length === 6)          //Pour 6 caractères, le traitement s'effectue sauf si la valeur précédente est la même.
                             {
                                 if (previous !== key) 
                                    {
                                        document.getElementById("Done").innerHTML += "<li>C'est fait</li>";        //Commande mise dans la table de récap
                                        document.getElementById("code").value = "";
                                        var previous = key;
                                    }
                                 
                                 
                             }
                         if (document.getElementById('code').value === "")          //Si il n'y a rien dans le champ input, aucune valeur n'est stockée dans key.
                             {
                                 key = "";
                                 document.getElementById("IdUP").innerHTML = "";
                             }
                     }
                     
                     function BDD();
                     {
                         <?php $bdd->exec('INSERT INTO `jeux_video`(`nom`) VALUES (\'Salope\')'); ?>
                     }
                     </script>     
                              
            </form>
            
        </form>
        
            <div class="Recap">                                             <!--Liste récap des actions effectuées avec la date (partie bdd)-->
                <h2>Dernières commandes tapées:</h2> <br/>
                
                <?php while ($donnees = $reponse->fetch())

                    {
                    echo $donnees['nom'] . '<br />';
                    } 
                $reponse->closeCursor();
                ?>
                    
                <p> <span class ="CodeBold" id="IdUP"> effectué à <?php echo $Date ?></span></p>
                
                
                <div id="Done"></div>
                
                
                
            </div>
           
        </div>
        
    </body>    
    
</html>