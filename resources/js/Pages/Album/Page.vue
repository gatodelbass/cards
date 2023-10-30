<template>
    <app-layout></app-layout>

    <div
        v-if="state.showModal"
        id="overlay"
        class="fixed z-50 w-screen h-screen inset-0 bg-gray-900 bg-opacity-90"
    ></div>

    <!-- The dialog -->
    <div
        v-if="state.showModal"
        id="dialog"
        class="fixed z-50 md:top-1/4 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/3 w-full md:w-1/2 rounded-md px-8 py-0 drop-shadow-lg justify-center flex"
    >
        <card-big @click="closeModal" :card="state.showCard"> </card-big>
    </div>

    <div
        class="w-full justify-center flex flex-wrap"
        :class="bg(collection.category.id)"
    >
        <div
            class="mb-2 text-center space-x-4 w-full sticky top-24 z-40 md:hidden"
        >
            <div v-if="state.nextCard" class="flex w-full text-gray-700">
                <div class="w-2/3 text-left">
                    <inertia-link :href="route('albumIndex')">
                        <button
                            @click="closeModal"
                            class="mb-2 md:mb-0 bg-teal-400 px-4 py-4 text-lg text-jost shadow-sm w-full text-gray-700 rounded-sm hover:shadow-lg hover:bg-amber-400"
                        >
                            Go back
                        </button>
                    </inertia-link>
                </div>
                <div class="w-1/3 text-right">
                    <button
                        @click="closeModal"
                        class="mb-2 md:mb-0 bg-amber-200 px-4 py-4 text-lg text-jost shadow-sm w-full text-gray-700 rounded-sm hover:shadow-lg hover:bg-amber-400"
                    >
                        <a
                            v-if="state.nextCard"
                            :href="'#' + state.nextCard"
                            class=""
                            >Next</a
                        >
                    </button>
                </div>
            </div>

            <div v-else class="flex w-full text-gray-700">
                <div class="w-full text-center">
                    <inertia-link :href="route('albumIndex')">
                        <button
                            @click="closeModal"
                            class="mb-2 md:mb-0 bg-teal-400 px-4 py-4 text-lg text-jost shadow-sm w-full text-gray-700 rounded-sm hover:shadow-lg hover:bg-amber-400"
                        >
                            Go back
                        </button>
                    </inertia-link>
                </div>
            </div>
        </div>

        <div class="mb-2 text-center space-x-4 w-full hidden md:block">
            <inertia-link :href="route('albumIndex')">
                <button
                    @click="closeModal"
                    class="mb-2 md:mb-0 bg-teal-400 px-5 py-4 text-xl text-jost shadow-sm w-full text-gray-700 rounded-sm hover:shadow-lg hover:bg-amber-400"
                >
                    Go back
                </button>
            </inertia-link>
        </div>
        <div
            class="text-amber-200 text-center text-6xl w-full text-lobster mb-2"
        >
            <p class="text-2xl md:text-6xl">{{ collection.name }}</p>

            <p class="text-sm md:text-2xl text-teal-400 mt-0">
                <img
                    :src="'/icons/' + collection.category.icon"
                    class="w-6 inline-block m-1 bg-teal-400 p-0.5 rounded-full"
                />
                {{ collection.category.name }}
            </p>

            <p class="text-sm md:text-base text-gray-300 text-jost">
                Created by: {{ collection.user.nickname }}
            </p>
        </div>

        <div class="w-full justify-center flex flex-wrap text-hueso-600">
            <div
                :key="card.id"
                v-for="card in state.collection.cards"
                class="w-96 h-96 mx-0 my-8 transform rotate-3"
            >
                <div :id="card.id">&nbsp;</div>

                <div
                    @click="showModal(card)"
                    v-if="state.pastedUserCards.includes(card.id)"
                >
                    <div
                        v-if="card.layout == 'Horizontal'"
                        class="cursor-pointer"
                    >
                        <AlbumCardAddedHorizontal
                            :card="card"
                        ></AlbumCardAddedHorizontal>
                    </div>
                    <div v-else class="cursor-pointer">
                        <AlbumCardAddedVertical
                            :card="card"
                        ></AlbumCardAddedVertical>
                    </div>
                </div>
                <div v-else>
                    <div v-if="card.layout == 'Horizontal'">
                        <AlbumCardEmptyHorizontal
                            :card="card"
                            :availableCard="
                                availableUserCards.includes(card.id)
                            "
                            @refreshAlbumPage="refreshAlbumPage"
                        ></AlbumCardEmptyHorizontal>
                    </div>
                    <div v-else>
                        <AlbumCardEmptyVertical
                            :card="card"
                            :availableCard="
                                availableUserCards.includes(card.id)
                            "
                            @refreshAlbumPage="refreshAlbumPage"
                        ></AlbumCardEmptyVertical>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-2 text-center space-x-4 md:block w-full">
            <inertia-link :href="route('albumIndex')">
                <button
                    @click="closeModal"
                    class="mb-2 md:mb-0 bg-teal-400 px-5 py-4 text-xl text-jost shadow-sm w-full text-gray-700 rounded-sm hover:shadow-lg hover:bg-amber-400"
                >
                    Go back
                </button>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

import AlbumCardEmptyVertical from "../Card/AlbumCardEmptyVertical.vue";
import AlbumCardEmptyHorizontal from "../Card/AlbumCardEmptyHorizontal.vue";
import AlbumCardAddedVertical from "../Card/AlbumCardAddedVertical.vue";
import AlbumCardAddedHorizontal from "../Card/AlbumCardAddedHorizontal.vue";
import CardBig from "../Card/CardBig.vue";

export default {
    components: {
        AlbumCardEmptyVertical,
        AlbumCardEmptyHorizontal,
        AlbumCardAddedVertical,
        AlbumCardAddedHorizontal,
        CardBig,
        AppLayout,
    },

    name: "Page",

    props: {
        collection: {
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
    },

    setup(props, { emit }) {
        const state = reactive({
            collection: props.collection,
            availableUserCards: props.availableUserCards,
            pastedUserCards: props.pastedUserCards,
            showModal: false,
            showCard: true,
            nextCard: null,
        });

        onMounted(() => {
            state.nextCard = state.availableUserCards[0];
        });

        async function refreshAlbumPage() {
            await axios
                .get(route("refreshAlbumPage", state.collection.id))
                .then(function (response) {
                    state.collection = response.data.collection;
                    state.availableUserCards = response.data.availableUserCards;
                    state.pastedUserCards = response.data.pastedUserCards;

                    state.nextCard = state.availableUserCards[0];
                })
                .catch(function (error) {});
        }

        function showModal(card) {
            state.showCard = card;

            state.showModal = true;
        }

        function closeModal() {
            state.showModal = false;
        }

        function bg(param) {
            switch (param) {
                case 1:
                    return "bg-gradient-to-tr from-green-500 via-gray-800 to-green-500";
                case 2:
                    return "bg-gradient-to-tr from-indigo-800 via-gray-800 to-indigo-800";
                case 3:
                    return "bg-gradient-to-tr from-pink-400 via-gray-800 to-pink-400";
                case 4:
                    return "bg-gradient-to-tr from-red-700 via-gray-800 to-red-700";
                case 5:
                    return "bg-gradient-to-tr from-rose-300 via-gray-800 to-rose-300";
                case 6:
                    return "bg-gradient-to-tr from-orange-500 via-gray-800 to-orange-500";
                case 7:
                    return "bg-gradient-to-tr from-blue-500 via-gray-800 to-blue-500";
                case 8:
                    return "bg-gradient-to-tr from-cyan-300 via-gray-800 to-cyan-300";
                case 9:
                    return "bg-gradient-to-tr from-violet-300 via-gray-800 to-violet-300";
                case 10:
                    return "bg-gradient-to-tr from-gray-500 via-gray-800 to-gray-500";
                case 11:
                    return "bg-gradient-to-tr from-orange-300 via-gray-800 to-orange-300";
                case 12:
                    return "bg-gradient-to-tr from-gray-700 via-gray-800 to-gray-700";

                default:
                    break;
            }
        }

        return {
            state,
            refreshAlbumPage,
            bg,
            showModal,
            closeModal,
        };
    },
};
</script>
