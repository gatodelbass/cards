<template>
    <div
        class="max-w-md rounded shadow-md flex m-4 p-4 text-jost text-sm md:text-base text-gray-300"
    >
        <div class="w-1/3">
            <img class="" src="2022-06-09_10-54.png" alt="image" />
        </div>

        <div
            class="px-6 py-2 w-2/3 bg-gradient-to-tl from-black via-gray-800 to-gray-700 ml-4 rounded"
        >
            <h4 class="my-2 font-semibold">{{ collection.name }}</h4>
            <p class="text-justify text-emerald-300">
                <img
                    :src="'/icons/' + collection.category.icon"
                    class="w-6 inline-block m-1 bg-white p-0.5 rounded-full"
                />
                {{ collection.category.name }}
            </p>
            <p class="text-justify">Created at: {{ collection.created_at }}</p>
            <p class="text-justify">Active since:</p>
            <p class="text-justify"># cards:</p>

            <Link :href="route('manageCollection', collection.id)">

            <button
                class="px-4 py-1 my-1 shadow w-full bg-gray-400 text-gray-700 hover:bg-emerald-400"
            >
                Manage collection
            </button>
            </Link>

            <Link :href="route('manageCards', collection.id)">
                <button
                    class="px-4 py-1 my-1 shadow w-full bg-gray-400 text-gray-700 hover:bg-emerald-400"
                >
                    Manage cards
                </button>
            </Link>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";

export default {
    name: "CollectionCard",
    components: {
        AppLayout,
    },
    props: {
        collection: {
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
