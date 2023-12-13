<template>
    <app-layout> </app-layout>

    <div class="flex flex-wrap justify-center  bg-gradient-to-tr from-gray-900 via-gray-700 to bg-gray-800 h-screen">
        <Link :href="route('welcome')">
            <div
                class="w-full md:w-96 p-1 bg-gradient-to-r from-gray-900 to-gray-600 rounded cursor-pointer m-2 md:m-10"
            >
                <span
                    class="bg-amber-200 rounded-sm px-2 py-0 mx-0 text-base text-lobster text-blueGray-700"
                    >card #404</span
                >
                <div
                    class="bg-gray-700 rounded align-middle text-center p-2 w-full h-12 m-0 text-hueso-500"
                >
                    <span v-for="n in 3" :key="n">
                        <img
                            class="inline-block align-middle w-6 m-1"
                            :src="'/icons/starHueso.svg'"
                        />
                    </span>
                </div>

                <div
                    class="my-2 bg-gray-700 rounded align-middle text-center p-2 w-full h-12 m-0 text-hueso-500 text-teal-500 text-jost text-2xl"
                >
                   Click here to return!
                </div>

                <div class="bg-lightBlue-300 my-20 mx-0">
                    <img
                        :src="'https://stories.freepiklabs.com/storage/54585/404-error-with-a-cute-animal-pana-2853.png'"
                        class="z-10 border-gray-700 border-8"
                    />
                </div>
                <div
                    class="bg-gradient-to-r from-cyan-900 via-cyan-700 to-cyan-500 rounded align-middle text-center p-2 w-full text-cyan-200 text-rye"
                >
                    <b>404 Not found</b>
                </div>
            </div>
        </Link>
    </div>
</template>

<script>
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import CardBig from "../Card/CardBig.vue";

export default {
    name: "Cart",

    components: { AppLayout, CardBig },

    props: {},

    setup() {
        const state = reactive({});

        const form = useForm({
            email: "",
            password: "",
        });

        function login() {
            form.post(route("loginUser"), {
                onSuccess: () => {},
                onError: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl">Error</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "error",
                        background: "#fddf7f",
                        timer: 1500,
                    });
                },
            });
        }
        return {
            state,
            form,
            login,
        };
    },
};
</script>
