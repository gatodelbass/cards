<template>
    <app-layout></app-layout>

    <div class="w-full text-jost">
        <div
            class="container flex flex-wrap mx-auto text-blueGray-800 p-2 md:p-10 text-sm md:text-base justify-center"
        >   
            
             <inertia-link :href="route('submittedCollections')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl"
                >
                    <img class="w-10 mx-auto" :src="'/icons/list.svg'" />
                    <p class="my-2">Submitted collections</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('categories.index')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl"
                >
                    <img class="w-10 mx-auto" :src="'/icons/book.svg'" />
                    <p class="my-2">categories</p>
                </div>
            </inertia-link>

            <div
                class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl"
            >
                <img class="w-10 mx-auto" :src="'/icons/user.svg'" />
                <p class="my-2">users</p>
            </div>

            <inertia-link :href="route('avatars.index')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl"
                >
                    <img class="w-10 mx-auto" :src="'/icons/user.svg'" />
                    <p class="my-2">avatars</p>
                </div>
            </inertia-link>

             <inertia-link :href="route('emoji')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl"
                >
                    <img class="w-10 mx-auto" :src="'/icons/emoji.svg'" />
                    <p class="my-2">emoji</p>
                </div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    name: "ProductCard",

    components: { AppLayout },

    props: {
        record: {
            type: Object,
        },
    },

    setup(props, { emit }) {
        onMounted(() => {});

        const formatter = new Intl.NumberFormat("en-US", {
            style: "currency",
            currency: "USD",
            minimumFractionDigits: 0,
        });

        function formatCost(cost) {
            return formatter.format(cost);
        }

        return {
            formatCost,
        };
    },
};
</script>
