<template>
	<vue-dadata :token="api_token" :url="api_url[ api_type ]" :modelValue="query" :classes="classes" :debounceWait="'0'" />
</template>

<script lang="ts">
import { defineComponent, ref, reactive, watch } from 'vue';
import { VueDadata } from 'vue-dadata';

export default defineComponent( {
	name: 'DadataComponent',

	components: {
		VueDadata,
	},

	props: {
		type: {
			type: String,
			default: 'fio'
		},

		is_error: {
			type: Boolean,
			default: false
		}
	},

	setup ( props )
	{
		const query = ref( '' );
		const classes = reactive( {
			container: props.is_error ? 'dadata is-invalid' : 'dadata',
			input: props.is_error ? 'form-control is-invalid' : 'form-control',
			suggestions: 'dropdown-menu d-flex flex-column',
			suggestionItem: 'dropdown-item btn',
		} );

		watch( () => props.is_error, () =>
		{
			classes.container = props.is_error ? 'is-invalid' : '';
			classes.input = props.is_error ? 'form-control is-invalid' : 'form-control';
		} );

		return {
			api_token: 'cd1c311a320ddd9809fc52aafe633684ea12ae58',
			api_type: props.type,
			api_url: {
				fio: 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/fio',
				email: 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/email',
				address: 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address'
			},
			query,
			classes
		};
	}
} );
</script>