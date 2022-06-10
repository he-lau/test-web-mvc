<?php

class UserController extends Controller
{
    public function action_home()
    {
      $data = [
          "msgForm1" => "",
          "msgForm2" => "",
      ];
        // On récupère le modèle
        $m = Model::getModel();
        $this->render("home",$data);
    }

    // appellée à l'instanciation du controller
    public function action_default()
    {
        $this->action_home();
    }

    public function action_login() {

      $m = Model::getModel();

      $type = 1; // true : mail

      $data = [
          "msgForm1" => "Connexion échouée, réessayer",
          "msgForm2" => "",
      ];

      // si les champs sont non vides (on peut aussi rajouter l'attribut required sur HTML)
      if (isset($_POST['login']) and ! preg_match("/^ *$/", $_POST["login"])
      and isset($_POST['pass-login']) and ! preg_match("/^ *$/", $_POST["pass-login"])) {
        // si login est un mail
        if (preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/", $_POST['login'])) {
          // si les entrées sont correctes (db)
          if ($m->matchUser($_POST['login'],$_POST['pass-login'],$type)) {
            // charge les infos de l'utilisateur depuis db
            $user = $m->getUserInformation($_POST['login'],$type);
            //var_dump($user);
            $data = [
                "id" => $user['user_id'],
                "first" => $user['first_name'],
                "last" => $user['last_name'],
                "date" => $user['birthday'],
            ];
            $this->render("login_completed", $data);
          }

        }
        // si login est un mobile
        if (preg_match("#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#", $_POST['login'])) {
          $type = 0;
          // si les entrées sont correctes
          if ($m->matchUser($_POST['login'],$_POST['pass-login'],$type)) {
            $user = $m->getUserInformation($_POST['login'],$type);
            //var_dump($user);
            $data = [
                "id" => $user['user_id'],
                "first" => $user['first_name'],
                "last" => $user['last_name'],
                "date" => $user['birthday'],
            ];
            $this->render("login_completed", $data);
          }
        }
      }
      // charge page acceuil
      $this->render("home",$data);
    }
    /*



    */
    public function action_registration() {
/*
      var_dump($_POST['register-name']);
      var_dump($_POST['register-lastname']);
      var_dump($_POST['mail']);
      var_dump($_POST['mail-verif']);
      var_dump($_POST['pass-register']);
      var_dump($_POST['day']);
      var_dump($_POST['month']);
      var_dump($_POST['year']);
      var_dump($_POST['gender']); // value male/ female
*/
      // string(3) "aaa" string(1) "b" string(1) "c" string(1) "d" string(1) "e" string(2) "16" string(1) "6" string(4) "1917" string(4) "male"
      $m = Model::getModel();

      $msgForm = 'Inscription échouée, réessayer';
      // format pour l'injection SQL ex: '1900-12-31'
      $birthdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];

      $data = [
          "msgForm1" => "",
          "msgForm2" => $msgForm,
      ];

      if ($_POST["gender"]=="male") {
          $gender = 1;
      }
      elseif ($_POST["gender"]=="female") {
        $gender = 0;
      }

      // nom et prenom ne doivent pas contenir de chiffre ou de caractere speciaux
      if (preg_match("/^[a-zA-Z]+$/", $_POST['register-name'])
      and preg_match("/^[a-zA-Z]+$/", $_POST['register-lastname'])
      // date valide
      // checkdate ( $month, $day, $year )
      and checkdate($_POST['month'],$_POST['day'],$_POST['year'])
      // mail/ mobile identique
      and (strcmp($_POST['mail'],$_POST['mail-verif']) == 0)
      // mdp min de 3 caracteres
      and (strlen($_POST['pass-register']>=3))
      ) {

        // on détermine maintenant si il s'agit d'un mail ou d'un numéro mobile
        if (preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/", $_POST['mail'])) {
          $type = 1;
          $user = [
            // col => tuple (sql)
            "first_name" => $_POST['register-name'],
            "last_name" => $_POST['register-name'],
            "email" => $_POST['mail'],
            "birthday" => $birthdate,
            "gender" => $gender,
            "password" => $_POST['pass-register'],
          ];
          // ajout à la base
          $m->addUser($user,$type);
          // affiche page d'inscription réussie
          $this->render("registration_completed");
        }
        // mobile
        elseif (preg_match("#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#", $_POST['mail'])) {
          $type = 0;

          $user = [
            // col => tuple (sql)
            "first_name" => $_POST['register-name'],
            "last_name" => $_POST['register-name'],
            "mobile" => $_POST['mail'],
            "birthday" => $birthdate,
            "gender" => $gender,
            "password" => $_POST['pass-register'],
          ];
          // ajout à la base
          $m->addUser($user,$type);
          // affiche page d'inscription réussie
          $this->render("registration_completed");
        }
      }

      $this->render("home",$data);

    }

}
