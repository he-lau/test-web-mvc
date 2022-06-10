/*
  validation form :

- nom et prenom ne doivent pas contenir de chiffre ou de caractere speciaux
- verifier format mail/ mobile
- mail/ mobile identique (vérification)
- mdp min de 3 caracteres

*/



// Vanilla
document.addEventListener("DOMContentLoaded", function() {

  const form_registration = document.getElementById('register');
  const first_name = document.getElementById('first');
  const last_name = document.getElementById('last');
  const mail_mobile = document.getElementById('mail-mobile');
  const verification = document.getElementById('verif');
  const password = document.getElementById('password');

  // Ecouteur
  form_registration.addEventListener('submit', e => {

    // pas executer par defaut
  	e.preventDefault();

  	checkFields();
  });


  function checkFields() {

  	const first_val = first_name.value.trim();
    const last_val = last_name.value.trim();
    const mail_mobile_val = mail_mobile.value.trim();
    const verification_val = verification.value.trim();
    const password_val = password.value.trim();

    let validate = [false,false,false,false,false];

    let checker = arr => arr.every(v => v === true);

    console.log(checker(validate));

    // prenom
  	if(first_val === '') {
      //validate[0] = false;
  		setError(first_name, 'Champ vide');
  	} else if (! (/^[a-zA-Z]+$/.test(first_val))) {
      setError(first_name, 'Caracteres speciaux non admis');
    } else {
  		setSuccess(first_name);
      validate[0] = true;
  	}

    // nom
    if(last_val === '') {
      setError(last_name, 'Champ vide');
    } else if (! (/^[a-zA-Z]+$/.test(last_val))) {
      setError(last_name, 'Caracteres speciaux non admis');
    } else {
      setSuccess(last_name);
      validate[1] = true;
    }

    // mail_mobile
    if(mail_mobile_val === '') {
      setError(mail_mobile, 'Champ vide');
    } else if (! /(^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$)|((0|\\+33|0033)[1-9][0-9]{8})/.test(mail_mobile_val)) {
      setError(mail_mobile, 'Format incorrecte');
    } else {
      setSuccess(mail_mobile);
      validate[2] = true;
    }

    // verif
    if(verification_val === '') {
      setError(verification, 'Champ vide');
    } else if (! verification_val.localeCompare(mail_mobile_val) == 0) {
      setError(verification, 'Les informations doivent être identiques');
    } else {
      setSuccess(verification);
      validate[3] = true;
    }

    // pass
    if(password_val === '') {
      setError(password, 'Champ vide');
    } else if (! (password_val.length >= 4)) {
      setError(password, 'Trops court >= 4');
    } else {
      setSuccess(password);
      validate[4] = true;
    }

    // si tout les champs sont valides
    if (checker(validate)) {
          form_registration.submit();
    }

  }

  function setError(input, message) {
  	const formControl = input.parentElement;
  	const small = formControl.querySelector('small');
  	formControl.className = 'form-control error';
    small.style.position = "static";
  	small.innerText = message;
  }

  function setSuccess(input) {
  	const formControl = input.parentElement;
  	formControl.className = 'form-control success';
  }

});
