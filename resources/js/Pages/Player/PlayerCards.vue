<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        My cards
    </h1>

    <div class="flex flex-wrap justify-center mt-2 text-jost">
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.exchange"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">in exchange</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.protected"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">protected</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.star1"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">1 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.star2"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">2 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.star3"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">3 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.star4"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">4 star</span>
        </label>
        <label class="inline-flex items-center m-3">
            <input
                @change="filterPlayerCards()"
                v-model="state.filters.star5"
                type="checkbox"
                class="rounded-sm form-checkbox h-6 w-6"
                checked
            /><span class="ml-2">5 star</span>
        </label>
    </div>

    <div class="flex flex-wrap justify-center mt-4 text-jost">
        <button
            @click="sellSelectedCards()"
            class="px-4 bg-teal-300 py-2 hover:bg-teal-400 mx-1"
        >
            Sell all selected cards
        </button>
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

    <div class="flex flex-wrap justify-center">
        <div v-for="userCard in state.userCards" :key="userCard.id" class="">
            <CardBasic
                v-if="
                    userCard.status == 'exchange' ||
                    userCard.status == 'protected' ||
                    userCard.status == 'pasted'
                "
                :card="userCard"
                :exists="true"
            >
            </CardBasic>

            <div class="justify-center flex">
                <div v-if="userCard.status == 'exchange'" class="w-36 mb-1">
                    <img
                        @click="sellUserCard(userCard)"
                        class="w-4 md:w-6 inline-block mx-1 cursor-pointer"
                        :src="'/icons/banknote.svg'"
                    />
                    <img
                        @click="changeStatusUserCard(userCard, 'exchange')"
                        class="w-4 md:w-6 inline-block mx-1 p-0.5 rounded cursor-pointer"
                        :src="'/icons/backpack.svg'"
                        :class="{
                            'bg-amber-200': userCard.status == 'exchange',
                        }"
                    />
                    <img
                        @click="changeStatusUserCard(userCard, 'protected')"
                        class="w-4 md:w-6 inline-block mx-1 cursor-pointer p-0.5"
                        :src="'/icons/unlock.svg'"
                    />
                </div>

                <div
                    v-if="userCard.status == 'protected'"
                    class="w-36 mx-auto p-0.5 mb-1"
                >
                    <img
                        @click="changeStatusUserCard(userCard, 'exchange')"
                        class="w-4 md:w-6 inline-block mx-1 cursor-pointer p-0.5 rounded bg-amber-200"
                        :src="'/icons/lock.svg'"
                    />
                </div>

                <div
                    v-if="userCard.status == 'pasted'"
                    class="w-36 mx-auto mb-1"
                >
                    <img
                        class="w-4 md:w-6 inline-block mx-1 p-0.5 rounded-full bg-teal-300"
                        :src="'/icons/smiley.svg'"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap justify-center mt-4 text-jost">
        <button
            @click="sellSelectedCards()"
            class="px-4 bg-teal-300 py-2 hover:bg-teal-400 mx-1"
        >
            Sell all selected cards
        </button>
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
import Swal from "sweetalert2";

import { usePage } from "@inertiajs/vue3";

import CardBasic from "../Collection/CardBasic.vue";
import Button from "../../Jetstream/Button.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardBasic,
        Button,
    },

    props: {
        userCards: {
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
            userCards: {},
            filters: {
                exchange: true,
                protected: true,
                pasted: false,
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
            state.userCards = props.userCards;
            state.filters.currentPage = props.currentPage;
            state.filters.totalPages = props.totalPages;
        });

        function goToPage(page) {
            state.filters.currentPage = page;
            filterPlayerCards();
        }

        async function sellUserCard(userCard) {
            await axios
                .get(route("sellUserCard", userCard.id))
                .then(function (response) {
                    usePage().props.auth.user.gold =
                        usePage().props.auth.user.gold +
                        response.data.goldObtained;

                    userCard.status = "sold";

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-gray-300">Done!</p>',
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

        async function sellCardsByStatus(status) {
            await axios
                .get(route("sellCardsByStatus", status))
                .then(function (response) {
                    usePage().props.auth.user.gold =
                        usePage().props.auth.user.gold +
                        response.data.goldObtained;

                    state.userCards = response.data.userCards;

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-gray-300">Done!</p>',
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

        function filterPlayerCards() {
            axios
                .post(route("filterPlayerCards", { params: state.filters }))
                .then(function (response) {
                    state.userCards = response.data.userCards;
                    state.filters.currentPage = response.data.currentPage;
                    state.filters.totalPages = response.data.totalPages;
                })
                .catch(function (error) {});
        }

        async function changeStatusUserCard(userCard, statusToChange) {
            await axios
                .get(
                    route("changeStatusUserCard", [userCard.id, statusToChange])
                )
                .then(function (response) {
                    userCard.status = statusToChange;

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-gray-300">Done!</p>',
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
            sellUserCard,
            changeStatusUserCard,
            filterPlayerCards,
            sellCardsByStatus,
            goToPage,
            state,
        };
    },
};
</script>
