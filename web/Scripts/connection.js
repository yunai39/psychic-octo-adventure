
var form, elements, connectionManager;

form 	 = document.querySelector('.login');
elements = [document.querySelector('#username'), document.querySelector('#password')];

connectionManager = createConnectionManager( elements[0], elements[1] );

form.addEventListener('submit', function(e) {

	e.preventDefault();
	
	var this_, empty, combination;

	this_ = this;

	for (i = 0; i < elements.length; i++) {

		connectionManager.check_empty( elements[i], function( bool, error_code ) {

			var error_text = elements[i].nextElementSibling;

			if ( bool ) {

				error_text.innerHTML = connectionManager.error_code[error_code];
			} else {

				error_text.innerHTML = '';
				empty = true;

				if ( combination ) {

					this_.submit();
				}
			}
		});
	}

	connectionManager.check_account( function( bool, error_code ) {

		var error_text = elements[0].nextElementSibling;

		if ( bool ) {

			if ( empty ) { 
				
				error_text.innerHTML = connectionManager.error_code[error_code];
			}
		} else {

			error_text.innerHTML = '';
			combination = true;

			if (empty) {

				this_.submit();
			}
		}
	});
}, false);