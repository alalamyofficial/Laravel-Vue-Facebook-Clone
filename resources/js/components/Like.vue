<template>
    <div>

        <br><hr>
        <p v-for="like in post.likes" :key="like.id">

            <!-- post in our computed property -->
            <section>
                <img :src="like.user.avatar" alt="" width="40px" height="40px" class="avatar-like">
            </section>

        </p>
        <hr>

        <button v-if="!auth_user_likes_post" @click="like()">
            <i class="fas fa-thumbs-up mr-3"></i>
        </button>
        <button v-else @click="unlike()">
            <i class="fas fa-thumbs-down"></i>
        </button>

    </div>
</template>

<script>
export default {
    
    props: ['id'],

    computed:{

        likers() {
            var likers = []
            
            this.post.likes.forEach( (like) => {
                    likers.push(like.user.id)
                    // post in our computed property
            })
            return likers
        },
        auth_user_likes_post() {
            var check_index = this.likers.indexOf( 
                    this.$store.state.auth_user.id
                )
                if (check_index === -1)
                    return false
            else 
                    return true

            //The indexOf method is used to search an specified item in array and 
            // returns the position of item. This method returns -1 if item is not found else the position of 
            // an item. If occurrence of item is more than once, it will return the index of first index. 
        },

        post(){

            return this.$store.state.posts.find( (post) => {

                return post.id === this.id

            })
        }

    },
    methods:{

        like() {
            axios.get('/like/' + this.id)
                .then( (response) => {
                    this.$store.commit('update_post_likes', {
                        id: this.id,
                        like: response.data
                    })
                    this.$toast.success("You successfully liked the post!", {
                        timeout: 2000
                    });
                })
        },
        
        unlike() {
            axios.get('/unlike/' + this.id)
                .then( (response) => {
                    this.$store.commit('unlike_post', {
                        post_id: this.id,
                        like_id: response.data
                    })
                    this.$toast.error("You successfully unliked the post!", {
                        timeout: 2000
                    });
                })
        }

    }

}
</script>

<style>
      .avatar-like{
            border-radius: 50%;
      }
</style>