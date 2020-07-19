<template>
    <div class="container main-comic-details-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" :id="'list-'+comic.id">
                    <div
                        class="card-header comic-details-head"
                        :id="'detail-'+comic.id+'-header'"
                    >
                        {{ comic.title }}
                    </div>
                    <div
                        class="card-body comic-details-body"
                        :id="'detail-'+comic.id+'-body'"
                    >
                        <img
                            v-if="comic.images && comic.images.length > 0"
                            :src="''+ comic.images[0].path + ''+ '.' + comic.images[0].extension"
                        />
                        <img
                            v-else
                            :src="''+ comic.thumbnail.path + ''+ '.' + comic.thumbnail.extension"
                        />

                    </div>
                    <div class="comic-details-body-description">
                        <p v-show="comic.description">
                            {{ comic.description }}
                        </p>
                        <p v-show="comic.prices && comic.prices.length > 0">
                            Price :  ${{ comic.prices[0].price }}
                            <!-- {{ comic[0].urls.url }} -->
                        </p>
                    </div>
                    <div
                        class="card-footer comic-details-footer"
                        :id="'detail-'+comic.id+'-footer'"
                    >
                        <itemActions
                            :comic="comic"
                        >
                        </itemActions>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import itemActions from "./ItemActions";
    export default {
        components: {
            itemActions
        },
        props: {
            comic: {
                default: function () { return {} },
                type: Object
            }
        },
        data() {
            return {

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
        },
        mounted() {
            // this.fetchBaseBookData();
        }
    }
</script>
