<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        The album
    </h1>
    <div class="flex flex-wrap justify-center">
        <div v-for="userCollection in userCollections" :key="userCollection.id">
            <Link :href="route('albumPage', userCollection.collection.id)">
                <album-collection-card
                    :collection="userCollection.collection"
                    :available="availableUserCards"
                    :pasted="pastedUserCards"
                >
                </album-collection-card>
            </Link>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AlbumCollectionCard from "../Collection/AlbumCollectionCard.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        AlbumCollectionCard,
    },
    props: {
        userCollections: {
            type: Object,
            default: {},
        },
        availableUserCards: {
            type: Object,
            default: {},
        },
        pastedUserCards: {
            type: Object,
            default: {},
        },
        categories: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            selectedCategories: [],
            showFilter: false,
            collections: {},
            userCollections: [],
        });

        onMounted(() => {
            state.collections = props.collections;

            props.categories.forEach((category) => {
                state.selectedCategories.push(category.id);
            });

            props.userCollections.forEach((collection) => {
                state.userCollections.push(collection);
            });
        });

        function checkOwnedCollection(collectionId) {
            if (state.userCollections.includes(collectionId)) {
                return true;
            } else {
                return false;
            }
        }

        function selectCategory(categoryId) {
            if (checkedCategory(categoryId)) {
                let index = state.selectedCategories.indexOf(categoryId);
                if (index !== -1) {
                    state.selectedCategories.splice(index, 1);
                }
            } else {
                state.selectedCategories.push(categoryId);
            }

            getResults();
        }

        function checkedCategory(categoryId) {
            if (state.selectedCategories.includes(categoryId)) {
                return true;
            } else {
                return false;
            }
        }

        function toggleFilter() {
            if (state.showFilter) {
                state.showFilter = false;
            } else {
                state.showFilter = true;
            }
        }

        async function getResults() {
            await axios
                .get(route("getResults"), {
                    params: { selectedCategories: state.selectedCategories },
                })
                .then(function (response) {
                    state.collections = response.data.collections;
                })
                .catch(function (error) {
                    alert(error);
                });
        }

        async function buyCollection(collectionId) {
            await axios
                .get(route("buyCollection", [collectionId]))
                .then(function (response) {
                    state.userCollections.push(collectionId);

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-blueGray-300">Done!</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#334155",
                        timer: 1500,
                    });
                })
                .catch(function (error) {});
        }

        return {
            state,
            checkedCategory,
            selectCategory,
            toggleFilter,
            getResults,
            buyCollection,
            checkOwnedCollection,
        };
    },
};
</script>

<style>
/* 3D Cube */
.space3d {
    perspective: 2000px;
    width: 200px;
    height: 300px;
}

._3dbox {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transform: rotateX(-25deg) rotateY(30deg);
}

._3dface {
    position: absolute;
}

._3dface--top {
    width: 200px;
    height: 100px;
    transform: rotateX(90deg) translate3d(0, 70px, 50px);
}

._3dface--front {
    width: 200px;
    height: 300px;
    transform: translate3d(0, 0, 120px);
}

._3dface--left {
    width: 100px;
    height: 300px;

    transform: rotateY(-90deg) translate3d(70px, 0, 50px);
}
</style>
