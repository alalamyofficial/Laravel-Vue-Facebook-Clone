<template>

    <div class="container">
        <div class="row justify-content-center">
                <div class="col-lg-6 col-lg-offset-3">
                    <input type="text" class="form-control" 
                        placeholder="search for other users"
                        v-model="query"
                    >   
                    <i class="bi bi-search" @click="search()"
                        style="position: relative; left: 505px; top: -27px;"
                        data-toggle="modal" data-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </i>
                    <br>
                </div>
                

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">

                    <div class="row">
                        <div class="text-center" v-for="user in results" :key="user.id">
                            <div class="m-7 p-3">
                                <img :src="user.avatar" alt="" width="50px" height="50px" class="searched-user">
                                <a :href="/profile/ + user.slug">
                                    <h4 class="text-center">{{ user.name }}</h4>
                                </a>

                                <br>
                            </div> 
                        </div>
                    </div>

                    </div>

                </div>
            </div>
            </div>


        </div>
    </div>

</template>

<script>
    
    const algoliasearch = require('algoliasearch');
    const client = algoliasearch('V4YMX325ZM','d321306a45f0939d8bb8e562fd280e97');
    const index = client.initIndex('users');

export default {
        mounted(){

            // index.search('ja').then(({ hits }) => {
            // console.log(hits);
            // });

        },
        data() {
            return {
                query: '',
                results: []
            }
        },
        methods: {
            search() {
                index.search(this.query).then(({ hits }) => {
                    console.log(hits);
                    this.results = hits
                });
            }
        },


    }




</script>

<style>
      .searched-user{
            border-radius: 50%;
      }
</style>