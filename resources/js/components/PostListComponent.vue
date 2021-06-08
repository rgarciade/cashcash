<template>
    <div>
        <div class="card" style="" v-for="post in posts" :key="post.nombre">
            <h5 class="card-title"> {{post.nombre}}</h5>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                posts:[]
            }

        },
        created() {
            this.getPosts()
        },
        methods:{
            openModal(post){
                this.postSelected = post
            },
            getPosts(){
                this.posts = [
                    {
                        'nombre' : 'nombre1'
                    },
                    {
                        'nombre' : 'nombre2'
                    }
                ]
            }
        }
    }
</script>