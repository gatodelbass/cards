<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Buy tickets
    </h1>

    <div v-if="$page.props.auth.user.gold < 10000" class="my-4 text-jost">
        You don't have enough gold! Get gold by selling repeated cards or
        avatars, also redeeming boxes
    </div>

    <button
        v-if="$page.props.auth.user.gold >= 10000"
        class="bg-teal-300 m-2 px-4 py-2 border-1 border-teal-400 shadow text-jost"
        @click="redeemGold(1)"
    >
        <span class="w-full">Buy 1 ticket</span>
        <div>
            <span v-for="n in 1" :key="n">
                <img
                    class="inline-block w-5 mx-1"
                    :src="'/icons/ticket2.svg'"
                />
            </span>
        </div>
    </button>

    <button
        v-if="$page.props.auth.user.gold >= 100000"
        class="bg-teal-300 m-2 px-4 py-2 border-1 border-teal-400 shadow text-jost"
        @click="redeemGold(10)"
    >
        <span class="w-full">Buy 10 tickets</span>
        <div>
            <span v-for="n in 10" :key="n">
                <img
                    class="inline-block w-5 mx-1"
                    :src="'/icons/ticket2.svg'"
                />
            </span>
        </div>
    </button>

    <button
        v-if="$page.props.auth.user.gold >= 200000"
        class="bg-teal-300 m-2 px-4 py-2 border-1 border-teal-400 shadow text-jost"
        @click="redeemGold(20)"
    >
        <span class="w-full">Buy 20 tickets</span>
        <div>
            <span v-for="n in 20" :key="n">
                <img
                    class="inline-block w-5 mx-1"
                    :src="'/icons/ticket2.svg'"
                />
            </span>
        </div>
    </button>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";

import { usePage } from '@inertiajs/vue3'

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
    },
    props: {},

    setup(props, { emit }) {
        const state = reactive({});

        async function redeemGold(quantity) {
            await axios
                .get(route("buyTickets", quantity))
                .then(function (response) {
                    usePage().props.auth.user.tickets = response.data.tickets;
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
            redeemGold,
            state,
        };
    },
};
</script>
