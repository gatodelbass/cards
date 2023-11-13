<template>
    <app-layout></app-layout>
    <h1 class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700">Redeem boxes</h1>

    <div v-if="$page.props.auth.user.boxes == 0" class="my-4 text-jost ">You don't have any boxes! You will get a daily box by login</div>

    <button
        v-if="$page.props.auth.user.boxes > 0"
        class="bg-teal-300 m-2 px-2 py-1 border-1 border-teal-400 shadow text-jost"
        @click="redeemBox"
    >
        <span class="w-full">Redeem one box</span>
        <div>
            <span v-for="n in 1" :key="n">
                <img class="inline-block w-5 mx-1" :src="'/icons/box2.svg'" />
            </span>
        </div>
    </button>

    <div v-if="state.obtainedBox.tickets != null" class="text-jost text-xl">
        You just got:
    </div>

    <div class="flex flex-wrap justify-center text-jost">
        <div
            v-if="state.obtainedBox.avatar"
            class="w-28 h-28 border-1 border-gray-500 bg-gradient-to-tr from-sky-400 via-teal-400 to-sky-400 p-1 m-2 rounded shadow-xl"
        >
            <p class="my-1">1 avatar!</p>
            <img
                class="w-14 inline-block rounded-full border-gray-50 border-2"
                :src="'/storage/' + state.obtainedBox.avatar.image"
            />
        </div>

        <div
            v-if="state.obtainedBox.tickets"
            class="w-28 h-28 border-1 border-amber-300 bg-amber-200 p-1 m-2 rounded shadow-xl"
        >
            <p class="my-1">{{ state.obtainedBox.tickets }} tickets</p>

            <span v-for="n in state.obtainedBox.tickets" :key="n">
                <img
                    class="inline-block w-4 mx-0.5"
                    :src="'/icons/cards.svg'"
                />
            </span>
        </div>

        <div
            v-if="state.obtainedBox.gold"
            class="w-28 h-28 border-1 border-amber-300 bg-amber-200 p-1 m-2 rounded shadow-xl"
        >
            <p class="my-1">Gold</p>
            <p class="my-2 text-xl font-semibold">
                ${{ state.obtainedBox.gold }}
            </p>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";

import { usePage } from '@inertiajs/vue3'

import CardSmall from "../Card/CardSmall.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardSmall,
    },
    props: {
        categories: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            obtainedBox: {},
        });

        async function redeemBox() {
            state.obtainedBox = {};

            console.log(usePage());

            await axios
                .get(route("redeemBox"))
                .then(function (response) {
                    state.obtainedBox = response.data.obtainedBox;

                    usePage().props.auth.user.boxes--;
                    usePage().props.auth.user.tickets =
                        usePage().props.auth.user.tickets +
                        response.data.obtainedBox.tickets;
                    usePage().props.auth.user.gold =
                        usePage().props.auth.user.gold +
                        response.data.obtainedBox.gold;

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
            redeemBox,
            state,
        };
    },
};
</script>
