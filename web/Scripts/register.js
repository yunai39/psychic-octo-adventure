
var contentForm = document.querySelector('.content_form'),
	previous 	= document.querySelector('.previous'),
	next 		= previous.nextElementSibling;

next.addEventListener('click', function() {

	var position = parseInt(getComputedStyle(contentForm).left);
	
	if ( position === 0 || position === -400 || position === -800 ) {

		move( contentForm, -400 );
	}
}, false);

previous.addEventListener('click', function() {

	var position = parseInt(getComputedStyle(contentForm).left);

	if ( position === 0 || position === -400 || position === -800 ) {

		move( contentForm, 400 );
	}
}, false);

function move( element2Move, value ) {

	var position, move;

	position = getComputedStyle(element2Move).left;
	position = parseInt(position);

	move = position + value;

	if ( move < -800 || move > 0 ) return 0;

	design(move);

	element2Move.style.left = move + 'px';
}

function design( position ) {

	var step , circles;

	step 	= document.querySelector('.step');
	circles = step.querySelectorAll('.circle');

	if ( position === 0 ) { /* J'abuse ? */

		circles[0].style.background = '#2895f1';
		circles[1].style.background = 'gainsboro';
		circles[2].style.background = 'gainsboro';
		previous.style.color = 'gainsboro';
		next.style.color = '#2895f1';
	} else if ( position === -400 ) {

		circles[0].style.background = '#2895f1';
		circles[1].style.background = '#2895f1';
		circles[2].style.background = 'gainsboro';
		previous.style.color = '#2895f1';
		next.style.color = '#2895f1';
	} else if ( position === -800 ) {

		circles[0].style.background = '#2895f1';
		circles[1].style.background = '#2895f1';
		circles[2].style.background = '#2895f1';
		previous.style.color = '#2895f1';
		next.style.color = 'gainsboro';
	}
}