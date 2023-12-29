<template>
    <div
        class="max-w-md rounded shadow-md m-4 p-2 text-jost text-sm md:text-base text-gray-300 bg-gray-900"
    >
        <div
            v-bind:class="{
                'bg-gray-400': collection.status == 'created',
                'bg-amber-200': collection.status == 'submitted',
                'bg-emerald-400': collection.status == 'active',
                'bg-orange-400': collection.status == 'errors',
                'bg-red-400': collection.status == 'rejected',
            }"
            class="w-full mb-2 py-1 text-gray-800"
        >
            {{ collection.status }} (Id {{collection.id}})
        </div>

        <div
            v-if="collection.errors != '' && collection.errors != null"
            class="w-full mb-2 py-1 text-gray-400"
        >
            <jet-text-area
                v-model="collection.errors"
                disabled
                type="text"
                class="mt-1 block w-full text-sm md:text-base text-gray-800"
            />
        </div>

        <div class="flex">
            <div class="w-1/3">
                <div class="border-4 border-white">
                    <img
                        class="border-gray-900 border-4"
                        :src="collection.cover_card"
                        alt="image"
                    />
                </div>
            </div>

            <div
                class="px-6 py-2 w-2/3 bg-gradient-to-tl from-black via-gray-800 to-gray-700 ml-4 rounded text-sm"
            >
                <h4 class="my-2 font-semibold">{{ collection.name }}</h4>
                <p class="text-justify text-emerald-300">
                    <img
                        :src="'/icons/' + collection.category.icon"
                        class="w-6 inline-block m-1 bg-white p-0.5 rounded-full"
                    />
                    {{ collection.category.name }}
                </p>
                <p class="text-justify">
                    Created at: {{ collection.created_at }}
                </p>
                <p class="text-justify">Active since:</p>
                <p class="text-justify">
                    Number of cards: <span class="text-teal-400 font-semibold">{{ collection.cards.length }}</span>
                </p>

                <Link :href="route('addCards', collection.id)">
                    <button
                        class="px-4 my-0.5 shadow w-full bg-gray-400 text-gray-700 hover:bg-emerald-400"
                    >
                        Add cards
                    </button>
                </Link>

                <Link :href="route('manageCards', collection.id)">
                    <button
                        class="px-4 my-0.5 shadow w-full bg-gray-400 text-gray-700 hover:bg-emerald-400"
                    >
                        Manage cards
                    </button>
                </Link>

                <Link :href="route('manageCollection', collection.id)">
                    <button
                        class="px-4 my-0.5 shadow w-full bg-gray-400 text-gray-700 hover:bg-emerald-400"
                    >
                        Manage collection rarity
                    </button>
                </Link>
                <Link :href="route('createFromDirectory', collection.id)">
                    <button
                        class="px-4 my-0.5 shadow w-full bg-gray-400 text-gray-700 hover:bg-emerald-400"
                    >
                        Create from directory
                    </button>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    name: "CollectionCard",
    components: {},
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
