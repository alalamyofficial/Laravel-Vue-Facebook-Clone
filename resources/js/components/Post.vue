<template>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <textarea name="" cols="10" class="form-control" v-model="content"></textarea>
                        <br>
                        <button class="btn btn-success pull-right" 
                        :disabled="not_working" @click="create_post()">
                            Create a post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    
    data() {
        return {
            content: '',
            not_working: true
        }
    },
    methods: {
        create_post() {
            axios.post('/create/post', { content: this.content })
                .then((response) => {
                        this.content = ''
                        this.$toast.success("Your post has been published !", {
                            timeout: 2000
                        });
                        console.log(response)
                })
        }
    },
    watch: {
        content() {
                if(this.content.length > 0)
                    this.not_working = false
                else
                    this.not_working = true
        }
    }

}
</script>