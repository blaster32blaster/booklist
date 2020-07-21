<template>
    <div class="main-comic-wrapper">
        <div class="col-md-12">
            <div class="card" :id="'list-'+comic.id">
                <div
                    @click="getComicDetails"
                    class="card-header comic-header"
                    :id="'list-'+comic.id+'-header'"
                >
                    {{ comic.title }}
                </div>
                <div
                    @click="getComicDetails"
                    class="card-body comic-body"
                    :id="'list-'+comic.id+'-body'"
                >
                    <img :src="''+ comic.thumbnail.path + ''+ '.' + comic.thumbnail.extension" />
                </div>
                <div class="card-footer list-actions-wrapper" :id="'list-'+comic.id+'-footer'">
                    <itemActions
                        :comic="comic"
                        :canadd="canadd"
                        @itemAdded="itemAdded"
                    >
                    </itemActions>
                </div>
            </div>
            <modal
                :name="''+ comic.id+'' + '-modal'"
                :width="modalWidth"
                :height="modalHeight"
                :adaptive="true"
            >
                <comicDetails
                    :comic="comic"
                    :canadd="canadd"
                    @itemAdded="itemAdded"
                >
                </comicDetails>
            </modal>
        </div>
    </div>
</template>

<script>
    import comicDetails from "./ComicDetails";
    import itemActions from "./ItemActions";
    export default {
        components: {
            comicDetails,
            itemActions
        },
        props: {
            comic: {
                default: function () { return {} },
                type: Object
            },
            canadd: {
                default: false,
                type: Boolean
            }
        },
        data() {
            return {
                modalHeight: '100%',
                modalWidth: '80%',
            }
        },
        methods: {
            getComicDetails () {
                this.$modal.show(''+ this.comic.id+'' + '-modal');
            },
            itemAdded () {
                this.$emit('itemAdded')
            }
        },
        mounted() {
        }
    }
</script>
