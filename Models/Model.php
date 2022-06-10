<?php

class Model
{
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $mdp);
        // communique avec la base de données en utf-8
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // en cas d’erreur, une exception doit être levée, ce qui arrête le script en affichant l’erreur
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
    * Indique si les infos de connexion sont bon
    * @param string $login login entré
    * @param string $password Mot de passe fourni
    * @param bool $type Type du $login
    * @return bool True si la connexion réussi, false sinon
    */
    public function matchUser($login,$password,$type) {
      // mail
      if ($type) {
        $requete = $this->bd->prepare('SELECT * FROM users WHERE email=:email AND password=:password');
        $requete->bindValue(':email', $login);
        $requete->bindValue(':password', $password);
        $requete->execute();

        return (bool) $requete->rowCount();
      }
      // mobile
      else {
        $requete = $this->bd->prepare('SELECT COUNT(*) AS bool FROM users WHERE mobile=:mobile AND password=:password');
        $requete->bindValue(':mobile', $login);
        $requete->bindValue(':password', $password);
        $requete->execute();

        return (bool) $requete->rowCount();
      }
    }

    public function getUserInformation($login,$type) {
      if ($type) {
        $requete = $this->bd->prepare('SELECT * FROM users WHERE email=:email');
        $requete->bindValue(':email', $login);
        $requete->execute();
        $res = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $res[0];
      }
      else {
        $requete = $this->bd->prepare('SELECT * FROM users WHERE mobile=:mobile');
        $requete->bindValue(':mobile', $login);
        $requete->execute();
        $res = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $res[0];
      }
    }

    public function addUser($user,$type) {
      //Préparation des requêtes
      $requete_mobile = $this->bd->prepare('INSERT INTO users(first_name,last_name,mobile,birthday,gender,password) VALUES(:first_name,:last_name,:mobile,:birthday,:gender,:password)');
      $requete_mail = $this->bd->prepare('INSERT INTO users(first_name,last_name,email,birthday,gender,password) VALUES(:first_name,:last_name,:email,:birthday,:gender,:password)');

      // mail
      if ($type) {

        $requete_mail->bindValue(':first_name', $user['first_name']);
        $requete_mail->bindValue(':last_name', $user['last_name']);
        $requete_mail->bindValue(':email', $user['email']);
        $requete_mail->bindValue(':birthday', $user['birthday']);
        // Insert BIT value in MySQL using PDO Prepared Statements
        $requete_mail->bindValue(':gender', (int)$user['gender'], PDO::PARAM_INT);
        $requete_mail->bindValue(':password', $user['password']);

        //Exécution de la requête
        $requete_mail->execute();

        //return (bool) $requete_mail->rowCount();
      }
      // mobile
      else {

        $requete_mobile->bindValue(':first_name', $user['first_name']);
        $requete_mobile->bindValue(':last_name', $user['last_name']);
        $requete_mobile->bindValue(':mobile', $user['mobile']);
        $requete_mobile->bindValue(':birthday', $user['birthday']);
        // Insert BIT value in MySQL using PDO Prepared Statements
        $requete_mobile->bindValue(':gender', (int)$user['gender'], PDO::PARAM_INT);
        $requete_mobile->bindValue(':password', $user['password']);
        //Exécution de la requête
        $requete_mobile->execute();

        //return (bool) $requete_mobile->rowCount();
      }

    }





}
