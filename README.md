# test-web-mvc

## Les étapes pour exécuter la page en local 

1. Avoir installé un serveur local
2. Mettre en place la base de données, en exécutant le script sql `uballers.sql` avec la commande `source` sous Mysql
3. Modifier la valeur des variables dans le fichier `Models/credentials.php` pour pouvoir se connecter à la base de données créées :
- `$dsn` : le DSN suit une syntaxe spécifique. ("pilote:host=serveur;dbname=nomBd")
- `$login` : l'identifiant de l'utilisateur
- `$mdp` : mot de passe de l'utilisateur
4. Lancer votre serveur local et accéder au repértoire contenant le site : `http://localhost/test-web-mvc/`

## Le temps passé sur chaque langage (conception, documentation, développement)

- HTML/ CSS : 4 h
- SQL : 20 min
- PHP : 6 h
- JS : 4 h
