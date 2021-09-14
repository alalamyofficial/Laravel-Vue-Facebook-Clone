<template>
    <div>

    </div>
</template>

<script>
export default {
    
    mounted(){

        this.listen()

    },
    props:['id'],

    methods:{

        listen(){

            Echo.private('App.User.' + this.id)
            .notification( (notification) => {
                // this.$toast.success(notification.name + notification.message, {
                //     timeout: 2000
                // });
                // this.$store.commit('add_not', notification)
                alert("New Notification")
                console.log(notification)
            })

        }

    }
    

}
</script>