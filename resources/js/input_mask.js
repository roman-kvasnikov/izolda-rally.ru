import 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js';
import 'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js';

$( document ).ready( function ()
{
	$( '.phone' ).inputmask( '+7 (999) 999-99-99' );
} );