<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title> test uballers</title>
		<link rel="stylesheet" href="Content/css/home.css"/>
	</head>
	<body>

		<header>
      <form class="login" action="?controller=User&action=login" method="post">
      <span>
        <label for="login">Adresse e-mail ou mobile</label><br>
        <input type="text" name="login" placeholder="Votre login"><br>
      </span>
      <span>
        <label for="pass-login">Mot de passe</label><br>
        <input type="password" name="pass-login" placeholder="Votre mot de passe">
      </span>

        <button type="submit" name="submit-login" class="submit-login" value="Connexion">Connexion</button>
        <br>
      <a id="account-info" href="#">Informations de compte oubliées ?</a>
			<br><br>
			<?php echo e($msgForm1) ?>
      </form>

		</header>

		<main>

      <h1 class="title">Inscription</h1>
      <h2 class="sub-title">C'est gratuit (et ça le restera toujours)</h2>

      <form id="register" class="register" action="?controller=User&action=registration" method="post">
				<span class="form-control">
					<input id="first" placeholder="Prénom" name="register-name" type="text" class="name-field"  required/>
	 				<small>Error message</small>
			 </span>
			 <span class="form-control">
			 	<input id="last" placeholder="Nom de famille" name="register-lastname" type="text" class="name-field" required />
			 	<small>Error message</small>
			 </span>

       <br>
			 <div class="form-control">
				 <input id="mail-mobile" placeholder="Numéro de mobile ou email" name="mail" type="text" class="mail-field" required/>
				 <small>Error message</small>
	       <br>
			 </div>
			 <div class="form-control">
				 <input id="verif" placeholder="Confirmer numéro de mobile ou email" name="mail-verif" type="text" class="mail-field"  required/>
				 <small>Error message</small>
	       <br>
			 </div>
			 <div class="form-control">
				 <input id="password" placeholder="Nouveau mot de passe" name="pass-register" type="password" id="pass-field"  required/>
				 <small>Error message</small>
			 </div>

       <br>

       <h2>Date de naissance</h2>

			 <div class="birthdate form-control">

				 <select id="day" name="day" required>
						 <option value="">Jour</option>
						 <?php
								 for ($i=1; $i<=31; $i++){
										 echo '<option value="',$i,'"','>',$i,'</option>';
								 }
						 ?>
				 </select>
				 <select id="month"name="month" required>
						 <option value="">Mois</option>
						 <?php
								 for ($i=1; $i<=12; $i++){
										 echo '<option value="',$i,'"','>',$i,'</option>';
								 }
						 ?>
				 </select>
				 <select id="year"name="year" required>
						 <option value="">Année</option>
						 <?php
								 for ($i=1902; $i<=date('Y'); $i++){
										 echo '<option value="',$i,'"','>',$i,'</option>';
								 }
						 ?>
				 </select>
       	<a href="#" id="date-info">Pourquoi indiquer ma date de <br>naissance ?</a>
				 <small>Error message</small>

			 </div>



       <br><br>

     	 <input type="radio" id="rb" name="gender" value="female" required /><span class="gender">Femme</span>
     	 <input type="radio" id="rb" name="gender" value="male" required/><span class="gender">Homme</span>
       <br><br>

     	 <p id="terms-info"> En cliquant sur inscription, vous acceptez nos <a href="#">Conditions</a> et </br> indiquez que vous avez lu notre <a href="#">Politique d'utilisation des </br> données</a>
        , y compris notre <a href="#">Utilisation des cookies</a>. Vous </br> pourrez recevoir des notifications par texto de la part de </br>
       Facebook et pouvez vous désabonner à tout moment. </br></p>

     	 <input type="submit" name="submit-register" id="button-register" value="Inscription" />
     	 <br>
			 <br><br>
			 <?php echo e($msgForm2) ?>
      </form>

    </main>

    <footer>


    </footer>
		<script src="JS/home.js"></script>
  </body>


</html>
