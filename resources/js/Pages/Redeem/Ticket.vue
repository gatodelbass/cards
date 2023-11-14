<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Redeem tickets
    </h1>

    <div v-if="$page.props.auth.user.tickets == 0" class="my-4 text-jost">
        You don't have any tickets! Redeem boxes or buy tickets with gold
    </div>

    <button
        v-if="$page.props.auth.user.tickets >= 1"
        class="bg-teal-300 m-2 px-4 py-2 border-1 border-teal-400 shadow text-jost"
        @click="redeemCards(1)"
    >
        <span class="w-full">Redeem 1 ticket</span>
        <div>
            <span v-for="n in 1" :key="n">
                <img class="inline-block w-5 mx-1" :src="'/icons/cards.svg'" />
            </span>
        </div>
    </button>

    <button
        v-if="$page.props.auth.user.tickets >= 10"
        class="bg-teal-300 m-2 px-4 py-2 border-1 border-teal-400 shadow text-jost"
        @click="redeemCards(10)"
    >
        <span class="w-full">Redeem 10 tickets</span>
        <div>
            <span v-for="n in 10" :key="n">
                <img class="inline-block w-5 mx-1" :src="'/icons/cards.svg'" />
            </span>
        </div>
    </button>

    <button
        v-if="$page.props.auth.user.tickets >= 20"
        class="bg-teal-300 m-2 px-4 py-2 border-1 border-teal-400 shadow text-jost"
        @click="redeemCards(20)"
    >
        <span class="w-full">Redeem 20 tickets</span>
        <div>
            <span v-for="n in 20" :key="n">
                <img class="inline-block w-5 mx-1" :src="'/icons/cards.svg'" />
            </span>
        </div>
    </button>

    <div class="flex flex-wrap justify-center">
        <div v-for="card in state.obtainedCards" :key="card.id" class="m-1">
            <CardRedeem :card="card.randomCard" :exists="card.exists">
            </CardRedeem>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";

import { usePage } from '@inertiajs/vue3'


import CardRedeem from "../Card/CardRedeem.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardRedeem,
    },
    props: {
        categories: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            obtainedCards: {},
        });

        async function redeemCards(quantity) {

            state.obtainedCards = {};

            await axios
                .get(route("redeemCards", quantity))
                .then(function (response) {
                    state.obtainedCards = {};

                   // console.log(usePage().props.auth.user.tickets);
                    console.log(response);

                    //$page.props.auth.user

                    usePage().props.auth.user.tickets = response.data.tickets;
                    state.obtainedCards = response.data.obtainedCards;

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
            redeemCards,
            state,
        };
    },
};
</script>
