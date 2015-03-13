
(function() {

	var form, formContent, formManager;

	form = document.querySelector('#login');

	formContent = {
		username : {elem : document.querySelector('#username'), bool : false},
		password : {elem : document.querySelector('#password'), bool : false}
	};

	formManager = create_FormManager();
	
	form.addEventListener('submit', function(e) {

		e.preventDefault();
		
		var this_, prop, element, errorText, account;

		this_ = this;

		for ( prop in formContent ) {

			element   = formContent[prop];
			errorText = element['elem'].nextElementSibling;

			if ( formManager.checkEmpty(element.elem) ) {

				errorText.innerHTML = 'Champ vide';
			} else {

				errorText.innerHTML = '';
				element.bool = true;

				if ( formContent.username.bool && formContent.password.bool/* && account*/ ) {

					this_.submit();
				}
			}
		}

		/*

		errorText = formContent.username.elem.nextElementSibling;

		if ( formManager.checkAccount(formContent.username.elem, formContent.password.elem, 'index.php?page=log_check') ) {

			if ( formContent.username.bool && formContent.password.bool ) {

				errorText.innerHTML = 'Mauvaise combinaison';
			}
		} else {

			errorText.innerHTML = '';
			account = true;

			if ( formContent.username.bool && formContent.password.bool ) {

				this_.submit();
			}
		}

		*/
	}, false);

	form = document.querySelector('#forget');

	form.addEventListener('submit', function(e) {

		e.preventDefault();
		
		var element, errorText;

		element   = document.querySelector('#email');
		errorText = element.nextElementSibling;

		if ( formManager.checkEmail(element) ) {

			errorText.innerHTML = 'Saisissez une adresse email correcte';
		} else {

			errorText.innerHTML = '';
			form.submit();
		}
	}, false);
}());