
function create_FormManager() {

	var formManager = {};

	formManager.checkEmpty = function( element ) {

		if ( element.value === '' ) {

			return true;
		} else {

			return false;
		}
	};

	formManager.checkLength = function( element, lengthMin, lengthMax ) {

		if ( element.value.length < lengthMin || element.value.length > lengthMax ) {

			return true;
		} else {

			return false;
		}
	};

	formManager.checkSpecialChars = function( element ) {

		if ( /[\!\^\$\(\)\[\]\{\}\?\+\*\.\/\\\|]/.test(element.value) ) {

			return true;
		} else {

			return false;
		}
	};

	formManager.checkEquality = function( element1, element2 ) {

		if ( element1.value !== element2.value ) {

			return true;
		} else {

			return false;
		}
	};

	formManager.checkEmail = function( element ) {

		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;

		if ( !regex.test(element.value) ) {

			return true;
		} else {

			return false;
		}
	};

	formManager.checkAccount = function( Elogin, Epassword, page ) {

		var login, password, request, user;

		login 	 = Elogin.value;
		password = Epassword.value;

		request  = new XMLHttpRequest();

		request.open('POST', page, true);

		request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = function() {

			if (request.readyState === 4) {

				console.log(request.responseText);

				/*user = request.responseText;

				return ( !user ) ? true : false;*/
			}
		}

		request.send( 'login=' + login + '&password=' + password );
	};

	return formManager;
}