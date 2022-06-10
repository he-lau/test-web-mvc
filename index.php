<?php

session_start();

//Pour avoir la fonction e()
require_once "Utils/functions.php";
//Inclusion du modèle
require_once "Models/Model.php";
//Inclusion de la classe Controller
require_once "Controllers/Controller.php";

//Liste des contrôleurs
$controllers = ["User","toto"];
//Nom du contrôleur par défaut
$controller_default = "User";

//On teste si le paramètre controller existe et correspond à un contrôleur de la liste $controllers
if (isset($_GET['controller']) and in_array($_GET['controller'], $controllers)) {
    // change le controller (donc la page à afficher)
    $nom_controller = $_GET['controller'];
} else {
    $nom_controller = $controller_default;
}

//On détermine le nom de la classe du contrôleur
// ex : Controllers/Controller_home.php
$nom_classe = $nom_controller . 'Controller';

//On détermine le nom du fichier contenant la définition du contrôleur
$nom_fichier = 'Controllers/' . $nom_classe . '.php';



//Si le fichier existe et est accessible en lecture
if (is_readable($nom_fichier)) {
    //On l'inclut et on instancie un objet de cette classe
    include_once $nom_fichier;
    new $nom_classe();
} else {
  // ex : ?controller=toto
    die("Error 404: not found!");
}
