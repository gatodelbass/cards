<template>
    <div
        class="w-44 h-78 my-2 mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
    >
        <div class="text-xs bg-amber-200">
            <img class="w-5 inline-block p-0.5" :src="'/icons/user.svg'" />
            {{ owner }}
        </div>

        <div class="rounded-sm">
            <div class="flex my-1">
                <div class="w-3/10 mx-1 ml-2">
                    <img
                        src="https://cdns.iconmonstr.com/wp-content/releases/preview/2018/96/iconmonstr-soccer-1.png"
                        class="w-5 inline-block bg-yellow-200 p-0.5 rounded-full border-1 border-gray-100"
                    />
                    &nbsp;
                </div>

                <div class="w-4/10 mx-auto text-right text-lobster">
                    <span class="rounded-sm px-1 text-yellow-200 bg-gray-800"
                        >#
                        <span class="font-extrabold">{{
                            card.collection_id
                        }}</span>
                        - {{ card.order }}</span
                    >
                </div>
            </div>
            <div
                class="flex my-1 py-0.5 text-center items-center justify-center border-1 border-gray-400 mx-1 text-base bg-gradient-to-r from-gray-900 via-gray-500 to-gray-900"
            >
                <span v-for="n in card.rarity" :key="n"> ⭐ </span>
            </div>
            <div
                class="relative p-1 h-40 bg-gradient-to-br from-gray-900 via-gray-700 to-gray-900 rounded-sm m-1 border-1 border-gray-400"
            >
                <div
                    v-if="!exists"
                    class="top-0 left-0 py-4 z-10 px-1 absolute w-full bg-amber-200 text-gray-700 text-xl animate-pulse text-lobster"
                >
                    New!
                </div>

                <img
                    class="max-h-full min-h-full object-contain mx-auto rounded-sm z-0"
                    alt="img"
                    :src="card.image"
                />
                <p
                    v-if="true"
                    class="z-10 absolute bottom-1 left-1 bg-yellow-200 text-gray-700 md:font-semibold px-1 rounded-sm truncate ... mx-auto"
                >
                    {{ card.cost }}
                </p>
            </div>
            <div
                class="flex my-1 text-center items-center justify-center border-1 border-gray-400 mx-1 text-yellow-200"
            >
                <p class="px-1 py-0.5 truncate ...">{{ card.name }}</p>
            </div>

            <div class="flex mb-1">
                <div class="w-1/2 text-center">
                    <p class="px-1 font-semibold text-yellow-200">
                        ATK: {{ card.atk }}
                    </p>
                </div>

                <div class="w-1/2 text-center">
                    <p class="px-1 font-semibold text-yellow-200">
                        DEF: {{ card.def }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    name: "CardBasic",
    components: {},
    props: {
        card: {
            type: Object,
            default: {},
        },
        exists: {
            type: String,
            default: "",
        },
        owner: {
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
