<template>
    <div
        class="w-24 md:w-36 mx-auto bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 p-1 md:p-2 "
    >
        <div class="flex">
            <div class="w-1/3 text-left -mt-1">
                <img
                    :src="'/icons/' + card.collection.category.icon"
                    class="w-6 inline-block bg-amber-200 p-1 rounded-full"
                />
            </div>
            <div class="w-2/3 text-right">
                <span
                    class="bg-amber-200 rounded-sm px-2 text-xs md:text-sm text-lobster text-gray-700"
                    >#{{ card.id }}</span
                >
            </div>
        </div>

        <div
            v-bind:class="{
                'bg-gradient-to-r from-gray-500 via-gray-400 to-gray-300':
                    card.rarity == null,
                'bg-gradient-to-r from-red-800 via-red-700 to-red-500':
                    card.rarity == 5,
                'bg-gradient-to-r from-sky-900 via-sky-700 to-sky-500':
                    card.rarity == 4,
                'bg-gradient-to-r from-violet-800 via-violet-600 to-violet-500':
                    card.rarity == 3,
                'bg-gradient-to-r from-teal-700 via-teal-600 to-teal-500':
                    card.rarity == 2,
                ' bg-gradient-to-r from-yellow-700 via-yellow-600 to-yellow-500':
                    card.rarity == 1,
            }"
            class="w-full m-auto p-0.5 rounded-sm h-6 md:h-8"
        >
            <span v-for="n in card.rarity" :key="n">
                <img
                    class="inline-block align-top md:align-middle w-3 md:w-4 m-1"
                    :src="'/icons/starHueso.svg'"
                />
            </span>
        </div>

        <div class="w-full m-auto p-1">
            <div class="relative h-28 md:h-44">
                <div
                    v-if="!exists"
                    class="bottom-0 py-4 z-10 px-1 absolute w-full bg-amber-200 text-gray-700 animate-pulse text-lobster"
                >
                    New!
                </div>

                <img
                    :src="'/storage/' + card.image"
                    class="z-0 absolute border-white border-2 md:border-4"
                />
            </div>
        </div>

        <div
            class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-500 rounded-sm w-full text-cyan-200 mt-1"
        >
            <p class="text-jost text-xs align-middle h-8 leading-4 my-auto">
                {{ card.name }}
            </p>
        </div>

        <div class="text-teal-100 mt-1 text-xs">
            <p class="inline-block ml-1 text-jost">$ {{ card.cost }}</p>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import { reactive } from "vue";
import Swal from "sweetalert2";

import { Inertia } from "@inertiajs/inertia";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
    },
    props: {
        card: {
            type: Object,
            default: {},
        },
        exists: {
            type: String,
            default: "",
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        return {
            state,
        };
    },
};
</script>
