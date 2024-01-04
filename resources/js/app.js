/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp( {} );

import ContactFormComponent from './components/ContactFormComponent.vue';
app.component( 'contact-form-component', ContactFormComponent );

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount( '#app' );

/**
 * The next is custom JavaScript from developer
 */

// Make header decrease after the scrolling //


// let minSize = 50,
// 	el = document.querySelector( 'header .logo' ),
// 	height = {
// 		el: el.offsetHeight - minSize,
// 		page: 20
// }

// window.addEventListener( 'scroll', () =>
// {
// 	let st = scrollY;
// 	let cur;

// if ( st > 25 )
// {
// 	cur = cur - st + 25;
// 	el.style.width = cur + 'px';

// 	// el.style.width = height.el - value + minSize + 'px'

// 	console.log( el.style.width );
// }


// 	if ( st >= height.page ) return
// 	let percent = height.page / st,
// 		value = height.el / percent



// 	el.style.width = height.el - value + minSize + 'px'

// 	console.log( height.el, value, minSize );

// } );











window.addEventListener( 'scroll', function ()
{
	let header = document.querySelector( 'header' );

	if ( header !== null )
	{
		if ( scrollY > 25 )
		{
			header.classList.add( '_scroll' );
		}
		else
		{
			header.classList.remove( '_scroll' );
		}
	}
} );