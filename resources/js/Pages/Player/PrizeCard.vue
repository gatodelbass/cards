<template>
    <div
        v-bind:class="{
            'bg-gradient-to-tr from-gray-500 via-gray-100 to-gray-50':
                prize.type == 'interval',
            ' bg-gradient-to-tr from-sky-600 via-gray-900 to-pink-600':
                prize.type == 'milestone',
        }"
        class="w-20 md:w-28 border-1 border-gray-500 md:border-gray-400 m-0.5 md:m-2 rounded-sm shadow-xl"
    >
        <p class="mb-2 p-1 text-xs bg-gray-700 text-gray-200 truncate">
            {{ prize.prize.type }}
        </p>
        <img class="w-20 mx-auto p-2" :src="'/icons/' + prize.icon" />
        <div class="w-full my-4">
            <span
                class="p-2 text-lobster bg-gray-700 text-amber-300 rounded-full"
                >{{ prize.quantity }}</span
            >
        </div>

        <div class="text-xs">
            <span v-if="prize.redeemed">
                <button
                    class="bg-gray-700 text-gray-200 px-2 py-1 w-full cursor-default"
                >
                    Redeemed
                </button>
            </span>
            <span v-else>
                <button
                    @click="redeemPrizes(prize)"
                    class="bg-amber-300 hover:bg-amber-400 text-gray-700 px-2 py-1 w-full"
                >
                    Redeem
                </button>
            </span>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import { usePage } from '@inertiajs/vue3'

export default {
    name: "PlayerCard",
    components: {},
    props: {
        prize: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        async function redeemPrizes(prize) {
            await axios
                .get(route("redeemPrizes", prize.id))
                .then(function (response) {
                    usePage().props.auth.user.tickets =
                        usePage().props.auth.user.tickets +
                        response.data.ticketsObtained;

                    prize.redeemed = true;

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
            state,
            redeemPrizes,
        };
    },
};
</script>
