<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Explore collections
    </h1>
    <div class="bg-gray-800 py-1 md:py-2 text-jost text-teal-300">
        <h1
            @click="toggleFilter()"
            v-if="state.showFilter == false"
            class="w-full text-lg cursor-pointer"
        >
            Filter collections by category
        </h1>

        <h1
            @click="toggleFilter()"
            v-else
            class="w-full text-lg cursor-pointer"
        >
            Hide
        </h1>

        <div
            v-if="state.showFilter"
            class="flex flex-wrap text-left text-sm mt-2 ml-2"
        >
            <div
                v-for="category in categories"
                :key="category.id"
                class="w-1/2 md:w-1/5 px-2"
            >
                <input
                    @click="selectCategory(category.id)"
                    type="checkbox"
                    class="rounded-sm h-4 w-4 text-blueGray-700 -mt-1 mr-2"
                    v-bind:checked="checkedCategory(category.id)"
                /><img
                    :src="'/icons/' + category.icon"
                    class="w-5 inline-block m-1 bg-white p-0.5 rounded-full"
                />
                <label
                    class="mx-1 cursor-pointer"
                    @click="selectCategory(category.id)"
                    >{{ category.name }}</label
                >
            </div>
        </div>
    </div>

    <div class="flex flex-wrap justify-center">
        <div v-for="collection in state.collections" :key="collection.id">
            <collection-box :collection="collection"> </collection-box>

            <span
                v-if="checkOwnedCollection(collection.id)"
                class="text-jost rounded-r-full rounded-l-full bg-teal-300 text-gray-800 px-3 py-1"
                >Already owned</span
            >

            <span
                v-else-if="
                    $page.props.auth.user.gold >= collection.cards.length * 1000
                "
                @click="buyCollection(collection.id)"
                class="text-jost rounded-r-full rounded-l-full bg-gray-800 text-teal-300 px-3 py-1 cursor-pointer"
            >
                Buy this collection - ${{ collection.cards.length * 1000 }}
            </span>

            <span
                v-else
                class="text-jost rounded-r-full rounded-l-full bg-gray-300 text-gray-800 px-3 py-1"
            >
                Not enough gold!
            </span>
        </div>
    </div>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import CollectionBox from "./CollectionBox.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

import { usePage } from '@inertiajs/vue3'

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCard,
        CollectionBox,
    },
    props: {
        userCollections: {
            type: Object,
            default: {},
        },
        collections: {
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
            showFilter: true,
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
                    usePage().props.auth.user.gold = response.data.gold;

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
