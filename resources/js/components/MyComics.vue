<template>
    <div class="container main-dashboard-card">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div
                        class="card-header comic-list-header"
                    >
                        <div>
                            Available Comics
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary">Manage My List</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="card-body-main col-md-4"> -->
                        <div class="card-body-main">
                            <comic
                                v-for="(comic, index) in comics"
                                v-bind:key="index"
                                class="comic-wrapper"
                                :comic="comic"
                            >
                            </comic>
                        </div>
                    </div>
                    <div
                        class="card-footer"
                        :id="'list-footer'"
                    >

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import comic from './Comic';
    export default {
        components: {
            comic
        },
        props: {

        },
        data() {
            return {
                messages: [],
                comics: [],
            }
        },
        methods: {
            // fetchBaseBookData () {
            //     axios.get('/api/comic-list')
            //         .then(response => {
            //             this.comics = response.data
            //         })
            //         .catch(error => {
            //             console.log('fetching books error')
            //         });
            // }
            fetchFromState () {
                console.log('were getting your comics from state');
            }
        },
        mounted() {
            this.fetchFromState();
        }
    }
</script>
