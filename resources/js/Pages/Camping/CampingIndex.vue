<template>
    <app-layout></app-layout>
    <h1 class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700">
        Home
    </h1>

    <Link v-if="$page.props.auth.user.role == 'admin'" :href="route('createCampingItem')">
    <div
        class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400">
        <img class="w-10 mx-auto"
            src="https://cdns.iconmonstr.com/wp-content/releases/preview/2016/240/iconmonstr-weather-8.png" />
        <p class="my-2">Create items</p>
    </div>
    </Link>
    <Link v-if="$page.props.auth.user.role == 'admin'" :href="route('campingPlay')">
    <div
        class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400">
        <img class="w-10 mx-auto"
            src="https://cdns.iconmonstr.com/wp-content/releases/preview/2016/240/iconmonstr-weather-8.png" />
        <p class="my-2">Play</p>
    </div>
    </Link>

    <div class="flex flex-wrap">

        <div v-for="item in campingItems" class="w-64 border border-gray-300  p-1 m-1">
            <div class="w-full p-0.5 border text-left bg-teal-200 border-gray-300">{{ item.name }}</div>

            <div class="w-full p-0.5 my-2"><img :src="item.image" class="" /></div>
            <div class="w-full p-0.5 border">price: <b>${{ item.price }}</b></div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

export default {
    name: "LoginIndex",

    components: { AppLayout },

    props: {
        campingItems: Object
    },

    setup(props, { emit }) {
        const page = usePage();
        const state = reactive({
            userData: page.props.auth.user,
        });

        onMounted(() => { });

        return {
            state,
        };
    },
};
</script>
