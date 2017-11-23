<!DOCTYPE html>
<html>
    <meta charset="utf-8" />
    <title>Scan de codes barres</title>
    <link rel="stylesheet" href="MEP.css" media="screen" type="text/css"/>
    <link rel="stylesheet" href="cssPrint.css" media="print" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--<script src="Javascript.js" type="text/javascript"></script> Fichier css (MiseEnPage)-->
    
    
    <?php                                                   //Définition des variables 
    
    date_default_timezone_set('Europe/Paris'); 
    //$code = $_POST['code']; 
    //$lencode = strlen($code); 
    $Date = date("H:i:s");
    $DateCode = "";
    $TextCodeDate = "";
    
    // Actions à effectuer si on passe un code $code en POST
    if (isset($_POST['code'])) {
        // Code PHP pour Ajax ici
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
        
        // On défini la requête à exécuter
        $ans = $bdd->prepare("SELECT * WHERE Code = ?");
        // On l'exécute (de manière sécurisée)
        $ans->execute(array(htmlspecialchars($_POST['code'])));
        // On récupère les données
        while ($data = $ans->fetch()) {
            echo '<h3>' . $data['nom'] . ' - ' . $data['date'] . '</h3><br />';
        }
    }
    ?>
    
    
    <body>
      
        
       <div id="Conteneur">
         
        <form method = "post" >
            
            <h1>Entrez votre code barre</h1>
            
            <input type="text" id="code" name="code" required = "required" onkeyup="Text();" />                 <!--Penser à utiliser htmlspecialchars -->
            
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
                     </script>     
                              
            </form>
            
        </form>
        
            <div class="Recap">                                             <!--Liste récap des actions effectuées avec la date (partie bdd)-->
                <h2>Dernières commandes tapées:</h2> <br/>
                
                <p> <span class ="CodeBold" id="IdUP"> effectué à <?php echo $Date ?></span></p>
                
                
                <div id="Done"></div>
                
                
                
            </div>
           
        </div>
        
    </body>    
    
</html>