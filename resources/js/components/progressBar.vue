<template>
	<v-progress-linear
		indeterminate
		:active="this.progresActive"
		color="secondary"
		height="5"
	></v-progress-linear>
</template>
<script>
import { mapState } from 'vuex'
export default {
	name: 'progressBar',
	computed: mapState(['progresActive'])
}
</script>
<style>
.v-progress-linear {
	margin: 0;
	z-index: 999;
}
</style>