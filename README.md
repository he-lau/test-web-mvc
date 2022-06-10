# test-web-mvc

## Les étapes pour exécuter la page en local 

1. Avoir installé un serveur local
2. Mettre en place la base de données, en exécutant le script sql `uballers.sql` avec la commande `source` sous Mysql
3. Modifier la valeur des variables dans le fichier `Models/credentials.php` pour pouvoir se connecter à la base de données créées :
- `$dsn` : le DSN suit une syntaxe spécifique. ("pilote:host=serveur;dbname=nomBd") **Avec dbname=uballers !**
- `$login` : l'identifiant de l'utilisateur
- `$mdp` : mot de passe de l'utilisateur
4. Lancer votre serveur local et accéder au repértoire contenant le site : `http://localhost/test-web-mvc/`

## Le temps passé sur chaque langage (conception, documentation, développement)

- HTML/ CSS : 4 h
- SQL : 20 min
- PHP : 6 h
- JS : 4 h

## Résultat


![screencapture-localhost-uballers-test-register-mvc-2022-06-10-21_29_51](https://user-images.githubusercontent.com/65168751/173136899-88516a0f-38cd-43fc-a6e0-a45ba1b00a94.png)
![screencapture-localhost-uballers-test-register-mvc-2022-06-10-21_30_59](https://user-images.githubusercontent.com/65168751/173137035-18b961ce-b008-48a5-bef7-ecb445c4b94a.png)
![screencapture-localhost-uballers-test-register-mvc-2022-06-10-21_39_44](https://user-images.githubusercontent.com/65168751/173138539-a5fd0291-46de-481d-bbd4-357dbc04bba6.png)
