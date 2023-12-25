<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Incoming exchanges for me
    </h1>

    <div class="flex flex-wrap justify-center">
        <div v-for="trade in state.incomingExchanges" :key="trade.id">
            <div v-if="trade.status == 'offered'" class="mb-2">
                <div
                    class="flex flex-wrap m-1 mb-0.5 md:m-2 bg-amber-100 p-1 md:p-2 border-1 border-gray-800 rounded-sm"
                >
                    <div class="mx-0.5">
                        <div class="text-xs bg-amber-200 py-0.5 mx-2 w-44 truncate ...">
                            <img
                                class="w-5 inline-block p-0.5"
                                :src="'/icons/user.svg'"
                            />
                            {{ trade.ownercard.user.nickname }}
                        </div>
                        <CardBasic :card="trade.ownercard.card" :exists="true">
                        </CardBasic>
                    </div>

                    <div class="mx-1">
                        <div class="text-xs bg-amber-200 py-0.5 mx-2 w-44 truncate ...">
                            <img
                                class="w-5 inline-block px-0.5"
                                :src="'/icons/user.svg'"
                            />
                            {{ trade.playercard.user.nickname }}
                        </div>
                        <CardBasic :card="trade.playercard.card" :exists="true">
                        </CardBasic>
                    </div>
                </div>

                <div class="px-1 md:px-2 text-sm">
                    <div class="flex flex-wrap ">
                        <div class="w-1/2 ">
                            <button
                                @click="acceptExchange(trade)"
                                class="w-full bg-teal-300 hover:bg-teal-400 p-0 border-1 border-gray-500  "
                            >
                                <img
                                    class="w-7 md:w-7 rounded-sm p-2  mx-auto"
                                    :src="'/icons/check.svg'"
                                />
                            </button>
                        </div>
                        <div class="w-1/2 ">
                            <button
                                @click="acceptExchange(trade)"
                                class="w-full bg-red-300 hover:bg-red-400 p-0 border-1 border-gray-500 "
                            >
                                <img
                                    class="w-7 md:w-7 rounded-sm p-2  mx-auto"
                                    :src="'/icons/cross.svg'"
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";

import CardBag from "../Card/CardBag.vue";
import CardBasic from "../Collection/CardBasic.vue";
import Button from "../../Jetstream/Button.vue";
import Swal from "sweetalert2";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardBasic,
    },

    props: {
        incomingExchanges: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            incomingExchanges: null,
        });

        onMounted(() => {
            state.incomingExchanges = props.incomingExchanges;
        });

        async function acceptExchange(trade) {
            await axios
                .get(route("acceptExchange", trade.id))
                .then(function (response) {
                    state.incomingExchanges = response.data.incomingExchanges;
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Done!</p>',
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

        async function rejectExchange(trade) {
            await axios
                .get(route("rejectExchange", trade.id))
                .then(function (response) {
                    state.incomingExchanges = response.data.incomingExchanges;
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Rejected!</p>',
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

        return {
            state,
            acceptExchange,
            rejectExchange,
        };
    },
};
</script>
