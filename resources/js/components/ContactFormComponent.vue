<template>
	<div class="contacts-form">
		<div class="field-input name" :class=" [ errors.name ? 'border border-danger border-2' : '' ] ">
			<span class="field-icon"><i class="fas fa-user"></i></span>
			<input type="text" name="name" autocomplete="on" placeholder="Ваше Имя *" v-model=" data.name " @focus="errors.name = null" />
			<span class="field-error" v-if=" errors.name ">
				<span class="field-error-icon"><i class="fa-solid fa-triangle-exclamation m-0 p-0 text-danger"></i></span>
				<span class="field-error-message text-danger">{{ this.errors.name[ 0 ] }}</span>
			</span>
		</div>
		<div class="field-input email" :class=" [ errors.email ? 'border border-danger border-2' : '' ] ">
			<span class="field-icon"><i class="fas fa-at"></i></span>
			<input type="text" name="email" autocomplete="on" placeholder="Ваш E-Mail *" v-model=" data.email " @focus="errors.email = null" />
			<span class="field-error" v-if=" errors.email ">
				<span class="field-error-icon"><i class="fa-solid fa-triangle-exclamation m-0 p-0 text-danger"></i></span>
				<span class="field-error-message text-danger">{{ this.errors.email[ 0 ] }}</span>
			</span>
		</div>
		<div class="field-input subject w-100" :class=" [ errors.subject ? 'border border-danger border-2' : '' ] ">
			<span class="field-icon"><i class="fas fa-envelope"></i></span>
			<input type="text" name="subject" autocomplete="on" placeholder="Тема сообщения *" v-model=" data.subject " @focus="errors.subject = null" />
			<span class="field-error" v-if=" errors.subject ">
				<span class="field-error-icon"><i class="fa-solid fa-triangle-exclamation m-0 p-0 text-danger"></i></span>
				<span class="field-error-message text-danger">{{ this.errors.subject[ 0 ] }}</span>
			</span>
		</div>
		<div class="field-input message" :class=" [ errors.message ? 'border border-danger border-2' : '' ] ">
			<span class="field-icon"><i class="fas fa-message"></i></span>
			<textarea name="message" placeholder="Ваше сообщение *" v-model=" data.message " @focus="errors.message = null"></textarea>
			<span class="field-error" v-if=" errors.message ">
				<span class="field-error-icon"><i class="fa-solid fa-triangle-exclamation m-0 p-0 text-danger"></i></span>
				<span class="field-error-message text-danger">{{ this.errors.message[ 0 ] }}</span>
			</span>
		</div>

		<button type="submit" class="submit" :disabled=" is_sent " :class=" [ is_sent ? 'bg-success' : '' ] " @click.prevent=" SendMessage ">{{ is_sent ? 'Отправлено' : 'Отправить' }} <i v-if=" is_load " class="fa-regular fa-hourglass"></i></button>
	</div>
</template>
	
<script>
import axios from 'axios';

export default {
	name: 'ContactFormComponent',

	data ()
	{
		return {
			data: {
				name: null,
				email: null,
				subject: null,
				message: null
			},

			errors: {
				name: null,
				email: null,
				subject: null,
				message: null
			},

			is_load: false,
			is_sent: false
		}
	},

	methods: {
		SendMessage ()
		{
			this.is_load = true;

			axios
				.post( '/api/contacts', {
					name: this.data.name,
					email: this.data.email,
					subject: this.data.subject,
					message: this.data.message
				} )
				.then( response =>
				{
					this.data.name = null;
					this.data.email = null;
					this.data.subject = null;
					this.data.message = null;

					this.errors.name = null;
					this.errors.email = null;
					this.errors.subject = null;
					this.errors.message = null;

					this.is_sent = true;

					console.log( response.data );
				} )
				.catch( error =>
				{
					if ( error.response.status === 422 )
					{
						this.errors.name = error.response.data.errors.name;
						this.errors.email = error.response.data.errors.email;
						this.errors.subject = error.response.data.errors.subject;
						this.errors.message = error.response.data.errors.message;
					}

					console.log( error.response.data );
				} )
				.finally( response =>
				{
					this.is_load = false;
				} );
		}
	}
}
</script>

<style lang="scss" scoped>
@import '../../sass/import/_mixins';

.contacts-form {
	text-align: center;

	.field-input {
		position: relative;
		display: flex;
		border: 2px solid #f1f1f1;
		@include border-radius(15px);
		background-color: #f1f1f1;
		box-shadow: 0 2px 10px #ccc;
		max-width: 400px;
		height: 52px;
		padding: 0 10px;
		margin-bottom: 25px;

		.field-icon {
			position: relative;
			top: 50%;
			@include transform(translate(0, -50%));

			font-size: 32px;

			i {
				padding-right: 15px;
			}
		}

		input {
			width: 100%;
			font-size: 18px;
			letter-spacing: 1px;
			background-color: transparent;
			border: none;
			outline: none;
		}

		textarea {
			width: 100%;
			height: 100%;
			font-size: 18px;
			letter-spacing: 1px;
			background-color: transparent;
			border: none;
			outline: none;
		}

		&:has(> textarea) {
			max-width: 100%;
			height: 300px;
		}

		&:has(> input:focus),
		&:has(> textarea:focus) {
			border: 2px solid #888888;
			@include transition(all 0.3s);
		}

		&.w-100 {
			max-width: 100%;
		}

		.field-error {
			.field-error-icon {
				position: absolute;
				top: -1px;
				right: 10px;

				font-size: 32px;
			}

			.field-error-message {
				position: absolute;
				bottom: -24px;
				right: 10px;

				font-size: 14px;
			}
		}

	}

	.submit {
		position: relative;
		font-size: 20px;
		letter-spacing: 1px;
		margin-top: 25px;
		padding: 10px 80px;
		border: none;
		@include border-radius(15px);
		color: #fff;
		box-shadow: 0 0 10px 0 rgba(5, 140, 221, .8);
		background-color: #0071f0;
		outline: none;
		cursor: pointer;
		text-transform: uppercase;
		@include transition(all 0.3s);

		&:hover {
			box-shadow: 0 0 15px 5px rgba(5, 140, 221, .8);
			background-color: #0077ff;
		}

		i {
			position: absolute;
			right: 20px;
			font-size: 30px;

			animation: 3s linear infinite rotate;

			@keyframes rotate {
				from {
					@include transform(rotate(0deg));
				}

				to {
					@include transform(rotate(360deg));
				}
			}
		}
	}
}
</style>