<template>
	<div>
		<div>
			<v-icon large color="orange darken-2">
				mdi-arrow-up-bold-box-outline
			</v-icon>
			<div>
				aaa--
				<router-link :to="{ name: 'aaa' }">
					<v-icon large color="orange darken-2">
						mdi-arrow-up-bold-box-outline
					</v-icon> </router-link
				>---aaa
			</div>
		</div>
		<div class="card" style="" v-for="post in posts" :key="post.nombre">
			<h5 class="card-title">{{ post.nombre }}</h5>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			posts: [],
			text: 'afsafasfafs'
		}
	},
	created() {
		this.getPosts()
	},
	methods: {
		openModal(post) {
			this.postSelected = post
		},
		getPosts() {
			this.posts = [
				{
					nombre: 'nombre1'
				},
				{
					nombre: 'nombre2'
				}
			]
		}
	}
}
</script>