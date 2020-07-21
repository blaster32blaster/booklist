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
                        </div>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="sortList"
                            >
                                Sort By Title
                            </button>
                        <div>
                            <button
                                v-show="!myList"
                                type="button"
                                class="btn btn-primary"
                                @click="switchToMyList"
                            >
                                Manage My List
                            </button>
                            <button
                                v-show="myList"
                                type="button"
                                class="btn btn-primary"
                                @click="switchToMainList"
                            >
                                Back to Main List
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body-main">
                            <comic
                                v-for="(comic, index) in comics"
                                v-bind:key="index"
                                class="comic-wrapper"
                                :comic="comic"
                                :canadd="canAdd(comic)"
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
                selectedComics: [],
                comics: [],
                myList: false,
                sort: 'asc',
            }
        },
        methods: {
            fetchBaseBookData () {
                axios.get('/api/comic-list')
                    .then(response => {
                        this.comics = response.data
                    })
                    .catch(error => {
                        console.log('fetching books error')
                    });
            },
            canAdd (comic) {
                return !this.$store.state.comics.comics.includes(comic)
            },
            switchToMyList () {
                this.myList = true;
                this.updateGlobalState('mainList', this.comics);
                this.comics = this.$store.state.comics.comics
            },
            switchToMainList () {
                this.myList = false;
                this.comics = this.$store.state.comics.mainList
            },
            updateGlobalState (key, value) {
                this.$store.commit({
                    type: 'comics/update',
                    item: key,
                    value: value
                })
            },
            sortList () {
                this.comics =  _.orderBy(this.comics, 'title', this.sort);
                if (this.sort === 'desc') {
                    this.sort = 'asc';
                } else {
                    this.sort = 'desc';
                }
            }
        },
        mounted() {
            this.fetchBaseBookData();
            this.selectedComics = this.$store.state.comics
        }
    }
</script>
