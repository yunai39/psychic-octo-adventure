
function createConnectionManager( usernameE, passwordE ) {

	var connectionManager;

	connectionManager = {};

	connectionManager.username = usernameE;
	connectionManager.password = passwordE;

	connectionManager.error_code = {

		'FIELD_EMPTY' 		: 'Champ vide',
		'BAD_COMBINATION' 	: 'Mauvaise combinaison'
	};

	connectionManager.check_empty = function( element, callBack ) {

		if (element.value === '') {

			callBack(true, 'FIELD_EMPTY');
		} else {

			callBack(false, '');
		}
	};

	connectionManager.check_account = function( callBack ) {

		var username, password, request, user;

		username = this.username;
		password = this.password;

		request  = new XMLHttpRequest();

		request.open('POST', 'php/check_users.php', true);

		request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = function() {

			if (request.readyState === 4) {

				user = request.responseText;

				if (user) {

					callBack(false, '');
				} else {

					callBack(true, 'BAD_COMBINATION');
				}
			}
		}

		request.send( 'username=' + username.value + '&password=' + password.value );
	};

	return connectionManager;
}