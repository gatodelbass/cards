<template>
    <div
        class="w-44 h-60  mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
    >
        <div class="rounded-sm">
            <div
                class="flex my-1 py-0.5 text-center items-center justify-center border-1 border-gray-400 mx-1 text-base bg-gradient-to-r from-gray-900 via-gray-500 to-gray-900"
            >
                ⭐
            </div>
            <div
                class="relative p-1 h-40 bg-gradient-to-br from-gray-900 via-gray-700 to-gray-900 rounded-sm m-1 border-1 border-gray-400"
            >
                <img
                    class="max-h-full min-h-full object-contain mx-auto rounded-sm"
                    alt="img"
                    :src="card.image"
                />
                <p
                    v-if="true"
                    class="z-10 absolute bottom-1 left-1 bg-yellow-200 text-gray-700 md:font-semibold px-1 rounded-sm truncate ... mx-auto"
                ></p>
            </div>
            <div
                class="flex my-1 text-center items-center justify-center border-1 border-gray-400 mx-1 text-yellow-200"
            >
                <p class="px-1 py-0.5 truncate ...">{{ card.name }}</p>
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
    },

    setup(props, { emit }) {
        const state = reactive({});

        return {
            state,
        };
    },
};
</script>
