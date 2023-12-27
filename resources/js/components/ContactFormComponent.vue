<template>
	<div class="contacts-form">
		<div class="input name" :class="{ 'error': errors.name }">
			<span><i class="fas fa-user"></i></span>
			<input type="text" name="name" autocomplete="on" placeholder="Ваше Имя *" v-model="data.name" />
		</div>
		<div class="input email" :class="{ 'error': errors.email }">
			<span><i class="fas fa-at"></i></span>
			<input type="text" name="email" autocomplete="on" placeholder="Ваш E-Mail *" v-model="data.email" />
		</div>
		<div class="input subject w-100" :class="{ 'error': errors.subject }">
			<span><i class="fas fa-envelope"></i></span>
			<input type="text" name="subject" autocomplete="on" placeholder="Тема сообщения *" v-model="data.subject" />
		</div>
		<div class="input message" :class="{ 'error': errors.message }">
			<span><i class="fas fa-message"></i></span>
			<textarea name="message" placeholder="Ваше сообщение *" v-model="data.message"></textarea>
		</div>

		<button type="submit" class="submit" @click.prevent="SendMessage">Отправить</button>
	</div>
</template>
	
<script>
import axios from 'axios';

export default {
	name: 'ContactFormComponent',

	data() {
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
			}
		}
	},

	methods: {
		SendMessage() {
			axios
				.post('/api/contacts', {
					name: this.data.name,
					email: this.data.email,
					subject: this.data.subject,
					message: this.data.message
				})
				.then(response => {
					console.log(response);
				})
				.catch(error => {
					if (error.response.status === 422) {
						this.errors.name = error.response.data.errors.name;
						this.errors.email = error.response.data.errors.email;
						this.errors.subject = error.response.data.errors.subject;
						this.errors.message = error.response.data.errors.message;
					}
				})
				.finally({});
		}
	}
}
</script>

<style scoped>
.contacts-form {}

.contacts-form .input {
	position: relative;
	display: flex;
	background-color: #f1f1f1;
	box-shadow: 0 2px 10px #ccc;
	max-width: 400px;
	height: 50px;
	border: 2px solid #f1f1f1;
	border-radius: 20px;
	padding: 0 15px;
	margin-bottom: 25px;
}

.contacts-form .input.w-100 {
	max-width: 100%;
}

.contacts-form .input i {
	font-size: 30px;
	padding-right: 15px;

	position: relative;
	top: 50%;
	transform: translate(0, -50%);
}

.contacts-form .input input {
	width: 100%;
	font-size: 18px;
	letter-spacing: 1px;
	background-color: transparent;
	border: none;
	outline: none;
}

.contacts-form .input textarea {
	width: 100%;
	height: 100%;
	font-size: 18px;
	letter-spacing: 1px;
	background-color: transparent;
	border: none;
	outline: none;
}

.contacts-form .input:has(> textarea) {
	max-width: 100%;
	height: 300px;
	padding: 5px 15px;
}

.contacts-form .input:has(> textarea) i {
	position: relative;
	top: 20px;
}

.contacts-form .input:has(> input:focus),
.contacts-form .input:has(> textarea:focus) {
	border: 2px solid #888888;
	transition: 0.3s;
}

.contacts-form .submit {
	font-size: 20px;
	letter-spacing: 1px;
	margin-top: 25px;
	padding: 10px 80px;
	border: none;
	border-radius: 20px;
	color: #fff;
	box-shadow: 0 0 10px 0 rgba(5, 140, 221, .8);
	background-color: #0071f0;
	outline: none;
	cursor: pointer;
	text-transform: uppercase;
	transition: 0.2s;
}

.contacts-form .submit:hover {
	box-shadow: 0 0 15px 5px rgba(5, 140, 221, .8);
	background-color: #0077ff;
}

.error {
	border: 2px solid #F00 !important;
}
</style>