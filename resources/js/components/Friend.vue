<template>
    
    <div>

        <p class="text-center" v-if="loading">
            Loading...
        </p>

        <p class="text-center" v-if="!loading">

            <button class="btn btn-success" v-if="status == 0" @click="add_friend">Add Friend</button>
            <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend">Accept Friend</button>
            <span class="text-success" v-if="status == 'waiting'">Waiting for response</span>
            <span class="text-success" v-if="status == 'friends'">Friends</span>

        </p>    


    </div>


</template>

<script>
export default {
    
    props: ['profile_user_id'],

    data(){

        return{

            status:'',
            loading: true

        }

    },

    mounted(){

        axios.get('/check_relationship_status/' + this.profile_user_id)
        .then(response => {
            console.log(response)
            this.status = response.data.status
            this.loading = false

        })

    },
    methods:{

        add_friend(){
            
            this.loading = true
            axios.get('/add_friend/' + this.profile_user_id)
            .then(response => {

                if(response.data == 1){    
                    
                    // response.data == 1 mean true
                    this.status = 'waiting'

                    this.$toast.success("Friend request sent .", {
                        timeout: 2000
                    });
                    
                    this.loading = false

                }

            })

        },
        accept_friend(){

            this.loading = true
            axios.get('/accept_friend/' + this.profile_user_id)
            .then(response => {

                if(response.data == 1){    
                    
                    // response.data == 1 mean true
                    this.status = 'friends'

                    this.$toast.success("You are now friend. Go ahead and hangout .", {
                        timeout: 2000
                    });

                    this.loading = false

                }

            })

        },


    }

}
</script>