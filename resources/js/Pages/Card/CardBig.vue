<template>
    <div
        class="w-full md:w-96 p-1 bg-gradient-to-r from-gray-900 to-gray-600 rounded cursor-pointer"
    >
        <span
            class="bg-amber-200 rounded-sm px-2 py-0 mx-0 text-base text-lobster text-blueGray-700"
            >card #{{ card.id }}</span
        >
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
            class="b rounded align-middle text-center p-2 w-full h-12 m-0 text-hueso-500"
        >
            <span v-for="n in card.rarity" :key="n">
                <img
                    class="inline-block align-middle w-6 m-1"
                    :src="'/icons/starHueso.svg'"
                />
            </span>
        </div>

        <div class="bg-lightBlue-300 my-1 relative mx-0 h-100">
            <img
                :src="'/storage/' + card.image"
                class="z-10 absolute border-white border-8"
            />
            <img
                v-if="card.top_filter != 'none'"
                :src="'/filters/' + card.top_filter"
                class="z-20 absolute border-white border-8"
            />
            <img
                v-if="card.bottom_filter != 'none'"
                :src="'/filters/' + card.bottom_filter"
                class="z-0 absolute border-white border-8"
            />
        </div>
        <div
            class="bg-gradient-to-r from-cyan-900 via-cyan-700 to-cyan-500 rounded align-middle text-center p-2 w-full text-cyan-200 text-jost font-semibold"
        >
            <b>{{ card.name }}</b>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    name: "CardBig",
    components: {},
    props: {
        card: {
            type: Object,
            default: {},
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
