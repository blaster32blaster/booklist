<template>
    <div class="container main-item-actions-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div :id="'actions-'+comic.id+'-wrapper'" class="item-actions-content">
                    <button type="button" class="btn btn-primary btn-add">Add to comic list</button>
                    <button type="button" class="btn btn-primary btn-remove">Remove from comic list</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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
            updateGlobalState (key, value) {
                this.$store.commit({
                    type: 'comics/update',
                    item: key,
                    value: value
                })
            },
        },
        mounted() {
            // this.fetchBaseBookData();
        }
    }
</script>
