import './bootstrap';
import { createApp } from 'vue';
import VueTheMask from 'vue-the-mask';

import ContactFormComponent from './components/ContactFormComponent.vue';

import MerchesComponent from './components/merches/MerchesComponent.vue';
import CartComponent from './components/merches/CartComponent.vue';
import OrdersComponent from './components/merches/OrdersComponent.vue';
import PaymentsComponent from './components/merches/PaymentsComponent.vue';


const app = createApp( {
	components: {
		ContactFormComponent,

		MerchesComponent,
		CartComponent,
		OrdersComponent,
		PaymentsComponent,
	}
} );

app.use( VueTheMask );

app.mount( '#app' );
























// import vueNumberFormat from 'vue-number-format';
// app.use( vueNumberFormat, {
// 	prefix: '',
// 	suffix: ' руб.',
// 	decimal: ',',
// 	thousand: ' ',
// 	precision: 2,
// 	acceptNegative: true,
// 	isInteger: false
// } );

// import VueTheMask from 'vue-the-mask';
// app.use( VueTheMask );






// import './bootstrap';
// import { createApp } from 'vue';

// const app = createApp( {} );

// import Home from "./components/Home.vue";
// app.component( 'Home', Home );

// import router from "./router";
// app.use( router );

// app.mount( '#app' );






// import Home from "./components/Home.vue";
// import vueNumberFormat from 'vue-number-format';

// const app = createApp( {
// 	el: '#app',
// 	components: {
// 		Home
// 	},
// 	router
// } );

// app.use( vueNumberFormat, {
// 	prefix: '',
// 	suffix: ' руб.',
// 	decimal: ',',
// 	thousand: ' ',
// 	precision: 2,
// 	acceptNegative: true,
// 	isInteger: false
// } );




// import ContactFormComponent from './components/ContactFormComponent.vue';
// app.component( 'ContactFormComponent', ContactFormComponent );

// import ProductsComponent from './components/Products/ProductsComponent.vue';
// app.component( 'ProductsComponent', ProductsComponent );

// app.mount( '#app' );

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











// window.addEventListener( 'scroll', function ()
// {
// 	let header = document.querySelector( 'header' );

// 	if ( header !== null )
// 	{
// 		if ( scrollY > 25 )
// 		{
// 			header.classList.add( '_scroll' );
// 		}
// 		else
// 		{
// 			header.classList.remove( '_scroll' );
// 		}
// 	}
// } );