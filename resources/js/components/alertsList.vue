<template>
	<div>
		<alert v-for="alert in alerts" :key="alert.id" :alertData="alert" />
	</div>
</template>
<script>
import { mapState } from 'vuex'
import alert from './alert'
export default {
	name: 'alertsList',
	components: {
		alert
	},
	computed: mapState(['alerts'])
}
</script>
<style scoped>
</style>
