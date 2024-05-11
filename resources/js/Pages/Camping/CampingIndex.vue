<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Home
    </h1>

    <Link
        v-if="$page.props.auth.user.role == 'admin'"
        :href="route('campingItems')"
    >
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
        >
            <img
                class="w-10 mx-auto"
                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2016/240/iconmonstr-weather-8.png"
            />
            <p class="my-2">Create items</p>
        </div>
    </Link>
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
        hasIncomingExchanges: {
            type: Boolean,
        },
    },

    setup(props, { emit }) {
        const page = usePage();
        const state = reactive({
            userData: page.props.auth.user,
        });

        onMounted(() => {});

        return {
            state,
        };
    },
};
</script>
