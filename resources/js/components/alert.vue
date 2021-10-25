<template>
	<div>
		<v-alert
			border="left"
			margin-left="20%"
			:value="true"
			:type="[`alertData.type`]"
		>
			{{ alertData.message }}
		</v-alert>
	</div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
	name: 'alert',
	props: ['alertData'],
	data() {
		return {
			msgActive: false,
			close: false
		}
	},
	methods: mapActions(['removeAlert']),
	computed: {
		typeClass() {
			return `alert-${this.alert.type}`
		}
	},
	created() {
		this.timeout = setTimeout(
			() => {
				this.removeAlert(this.alertData.id)
			},
			this.alertData.message.length > 60 ? 10000 : 3000
		)
	},
	beforeDestroy() {
		clearTimeout(this.timeout)
	}
}
</script>
<style scoped>
</style>
