<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        The exchange bag
    </h1>

    <div
        v-if="state.showModal"
        class="text-jost min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover p-1 md:p-10"
    >
        <div
            @click="closeModal"
            class="absolute bg-sky-900 opacity-95 inset-0 z-0"
        ></div>
        <div
            class="w-full p-1 relative mx-auto my-auto rounded shadow-lg bg-gray-800 opacity-80"
        >
            <div class="p-2 mt-2 text-center space-x-4 md:block">
                <button
                    @click="closeModal"
                    class="mb-2 md:mb-0 bg-teal-400 px-5 py-2 text-sm shadow-sm w-full text-blueGray-600 rounded-sm hover:shadow-lg hover:bg-amber-400"
                >
                    Close
                </button>
            </div>
            <div class="">
                <div class="justify-center flex flex-wrap bg p-1">
                    <div v-if="state.playerCard">
                        <CardBasic :card="state.playerCard.card" :exists="true">
                        </CardBasic>
                    </div>
                    <button
                        @click="makeOffer(state.playerCard.id, state.myCard.id)"
                        v-if="state.playerCard && state.myCard"
                        class="bg-teal-400 mt-20 py-5 md:py-10 align-middle mx-1 px-2 rounded-sm text-sm md:text-xl hover:bg-amber-400 animate-pulse"
                    >
                        Make offer!
                    </button>

                    <div v-if="state.myCard">
                        <CardBasic :card="state.myCard.card" :exists="true">
                        </CardBasic>
                    </div>
                </div>

                <div
                    v-if="state.availableCards != null"
                    class="overflow-auto h-80 mt-2 border-1 border-gray-200 rounded bg-gradient-to-tr from-sky-900 via-sky-800 to-sky-500"
                >
                    <div class="w-full text-gray-200 my-1">
                        My available cards
                    </div>

                    <div
                        v-for="cardx in state.availableCards"
                        :key="cardx.id"
                        class="inline-block m-1"
                    >
                        <span v-if="state.ownerCards.includes(cardx.card.id)"
                            ><img
                                class="w-6 inline-block mx-1 p-0.5 rounded-full bg-gray-300"
                                :src="'/icons/serious.svg'"
                        /></span>

                        <span v-else
                            ><img
                                class="w-6 inline-block mx-1 p-0.5 rounded-full bg-teal-300"
                                :src="'/icons/smiley.svg'"
                        /></span>
                        <CardBasic
                            @click="offerCard(cardx)"
                            :card="cardx.card"
                            :exists="true"
                        >
                        </CardBasic>
                    </div>
                </div>

                <div class="p-2 mt-2 text-center space-x-4 md:block">
                    <button
                        @click="closeModal"
                        class="mb-2 md:mb-0 bg-teal-400 px-5 py-2 text-sm shadow-sm w-full text-blueGray-600 rounded-sm hover:shadow-lg hover:bg-amber-400"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 text-jost">
        <input
            @change="filterBagCards()"
            class="ml-5 mr-2"
            type="radio"
            id="all"
            value="all"
            v-model="state.filters.filter"
        />
        <label for="all">All cards</label>

        <input
            @change="filterBagCards()"
            class="ml-5 mr-2"
            type="radio"
            id="missing"
            value="missing"
            v-model="state.filters.filter"
        />
        <label for="missing">Only the missing ones</label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterBagCards()"
                v-model="state.filters.star1"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">1 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterBagCards()"
                v-model="state.filters.star2"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">2 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterBagCards()"
                v-model="state.filters.star3"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">3 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterBagCards()"
                v-model="state.filters.star4"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">4 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterBagCards()"
                v-model="state.filters.star5"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">5 star</span>
        </label>
    </div>

    <div class="flex flex-wrap justify-center">
        <div v-for="bagCard in state.bagCards" :key="bagCard.id" class="">
            {{ bagCard.user_id }}
            <CardBag
                @click="showTradeModal(bagCard)"
                :card="bagCard"
                :exists="true"
                :owner="bagCard.nickname"
            >
            </CardBag>
        </div>
    </div>
    <div class="flex flex-wrap justify-center my-4">
        <span
            v-for="n in state.filters.totalPages"
            :key="n"
            @click="goToPage(n)"
            :class="{
                'bg-teal-300': state.filters.currentPage == n,
            }"
            class="flex items-center justify-center px-3 h-8 m-0.5 text-lobster text-gray-500 border-gray-300 border-1 hover:bg-amber-200"
            >{{ n }}</span
        >
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";
import CardBag from "../Card/CardBag.vue";
import CardBasic from "../Collection/CardBasic.vue";
import Swal from "sweetalert2";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardBag,
        CardBasic,
    },

    props: {
        bagCards: {
            type: Object,
            default: {},
        },
        currentPage: {
            type: Number,
        },
        totalPages: {
            type: Number,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            bagCards: {},
            showCardDetail: false,
            playerCard: null,
            myCard: null,
            availableCards: null,
            ownerCards: null,
            showModal: false,
            filters: {
                filter: "all",
                currentPage: 1,
                totalPages: 0,
                star1: true,
                star2: true,
                star3: true,
                star4: true,
                star5: true,
            },
        });

        onMounted(() => {
            state.bagCards = props.bagCards;

            state.filters.currentPage = props.currentPage;
            state.filters.totalPages = props.totalPages;
        });

        function showTradeModal(bagCard) {
            state.playerCard = null;
            state.myCard = null;
            state.availableCards = null;
            state.showModal = true;
            getAvailableCards(bagCard.id);
            state.playerCard = playerCard;
            state.showCardDetail = true;
        }

        function offerCard(myCard) {
            state.myCard = myCard;
        }

        async function getAvailableCards(playerCardId) {

            alert(playerCardId);

            await axios
                .get(route("getAvailableCards", playerCardId))
                .then(function (response) {
                    state.availableCards = response.data.availableCards;
                    state.ownerCards = response.data.ownerCards;
                })
                .catch(function (error) {});
        }

        function closeModal() {
            state.showModal = false;
        }

        async function makeOffer() {
            await axios
                .get(
                    route("createTrade", [state.playerCard.id, state.myCard.id])
                )
                .then(function (response) {
                    state.showModal = false;
                    state.availableCards = null;

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Offer set!</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#6EE7B7",
                        timer: 1500,
                    });
                })
                .catch(function (error) {});
        }

        async function getExchangeCards() {
            await axios
                .get(route("getExchangeCards", state.filter))
                .then(function (response) {
                    state.bagCards = response.data.bagCards;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        function filterBagCards() {
            axios
                .post(route("exchangeBag", { params: state.filters }))
                .then(function (response) {
                    state.bagCards = response.data.bagCards;
                    state.filters.currentPage = response.data.currentPage;
                    state.filters.totalPages = response.data.totalPages;
                })
                .catch(function (error) {});
        }

        function goToPage(page) {
            state.filters.currentPage = page;
            filterBagCards();
        }

        return {
            state,
            showTradeModal,
            offerCard,
            getAvailableCards,
            closeModal,
            makeOffer,
            getExchangeCards,
            filterBagCards,
            goToPage,
        };
    },
};
</script>
