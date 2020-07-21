<template>
    <div class="container main-item-actions-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div :id="'actions-'+comic.id+'-wrapper'" class="item-actions-content">
                    <button
                        type="button"
                        class="btn btn-primary btn-add"
                        @click="addComicToList"
                        v-show="canadd"
                    >
                        Add to comic list
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary btn-remove"
                        @click="removeComicFromList"
                        v-show="!canadd"
                    >
                        Remove from comic list
                    </button>
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
            },
            canadd: {
                default: false,
                type: Boolean
            }
        },
        data() {
            return {
                selectedComics: this.$store.state.comics.comics
            }
        },
        methods: {
            addComicToList () {
                if (!this.selectedComics.includes(this.comic)) {
                    this.addToGlobalState('comics', this.comic);
                    this.$emit('itemAdded')
                }

            },
            removeComicFromList () {
                if (this.selectedComics.includes(this.comic)) {
                    this.removeFromGlobalState('comics', this.comic);
                }
            },
            addToGlobalState (key, value) {
                this.$store.commit({
                    type: 'comics/addItem',
                    item: key,
                    value: value
                })
            },
            removeFromGlobalState (key, value) {
                this.$store.commit({
                    type: 'comics/removeItem',
                    item: key,
                    value: value
                })
            }
        },
        mounted() {
        }
    }
</script>
