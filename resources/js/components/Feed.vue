<template>
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-lg-offset-1">
                    <div class="card mb-3" v-for="post in posts" :key="post.id">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">

                                <div>
                                    <img :src="post.user.avatar" alt="" width="40px" 
                                        height="40px" class="avatar-feed">
                                    {{ post.user.name }}

                                </div>

                                <span class="pull-right">
                                    {{ post.created_at | moment }}
                                </span>


                            </div>

                        </div>

                        <div class="card-body">
                            <p class="">
                                {{ post.content }}
                            </p>
                            <div class="flex">

                                <like :id="post.id"></like>

                            </div>

                        </div>
                    </div>
                        
                </div>
            </div>
        </div>


</template>

<script>

import Like from './Like.vue'

export default {
    
        mounted() {
            this.get_feed()
        },

        components:{

            Like    

        },
        methods: {
            get_feed() {
                axios.get('/feed')
                    .then( (response) => {
                        response.data.forEach( (post) => {
                            this.$store.commit('add_post', post)
                        })
                    })
            }
        },
        
        computed: {
            posts() {
                return this.$store.getters.all_posts
                        // this.posts = response.data

            }
        },


}
</script>

<style>
    .avatar-feed{
        border-radius: 50%;
    }
</style>