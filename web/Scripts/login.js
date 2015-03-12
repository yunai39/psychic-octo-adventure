
var form, elements, formManager;

form 	  = document.querySelector('#login');
elements  = [document.querySelector('#username'), document.querySelector('#password')];
elemBool  = [false, false];

formManager = create_FormManager();

form.addEventListener('submit', function(e) {

	e.preventDefault();
	
	var this_, errorText, account;

	this_ = this;

	for (i = 0; i < elements.length; i++) {

		errorText = elements[i].nextElementSibling;

		if ( formManager.checkEmpty(elements[i]) ) {

			errorText.innerHTML = 'Champ vide';
		} else {

			errorText.innerHTML = '';
			elemBool[i] = true;

			if ( elemBool[0] && elemBool[1] ) {

				this_.submit();
			}
		}
	}

	/* Il n'y a pas encore de page pour vérifier le compte, donc je met en commentaire pour le moment.

	errorText = elements[0].nextElementSibling;

	if ( formManager.checkAccount(elements[0], elements[1], 'page_qui_vérifie_le_compte') ) {

		errorText.innerHTML = 'Mauvaise combinaison';
	} else {

		errorText.innerHTML = '';
		account = true;

		if ( elemBool[0] && elemBool[1] ) {

			this_.submit();
		}
	}

	*/
}, false);