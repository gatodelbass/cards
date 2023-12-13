<template>
    <app-layout> </app-layout>

    <div class="w-full text-jost">
        <div class="container mx-auto text-blueGray-800">
            <div
                class="w-96 mx-auto bg-teal-400 hover:bg-teal-500 rounded shadow py-2 my-10 justify-center"
            >
               here go to landing page
            </div>

            <div
                class="w-96 mx-auto bg-gradient-to-br from-purple-100 via-teal-50 to-purple-100 rounded shadow-xl py-2 my-5"
            >
                <h1 class="text-jost my-4 text-xl">Login</h1>

                <form
                    name="student_application"
                    id="student_application"
                    action=""
                >
                    <div class="py-4 px-8">
                        <div class="mb-4 text-left">
                            <label class="block">Email:</label>
                            <span class="text-red-500">{{
                                form.errors.email
                            }}</span>
                            <input
                                v-model="form.email"
                                class="border rounded w-full py-2 px-3 text-grey-darker"
                                type="text"
                            />
                        </div>

                        <div class="mb-4 text-left">
                            <label class="block">Password:</label>
                            <span class="text-red-500">{{
                                form.errors.password
                            }}</span>
                            <input
                                v-model="form.password"
                                class="border rounded w-full py-2 px-3 text-grey-darker"
                                type="password"
                            />
                        </div>

                        <div class="mb-4 mt-6">
                            <button
                                @click="login"
                                type="button"
                                class="bg-gradient-to-r from-purple-200 to-teal-300 border-1 border-teal-300 py-2 px-4 mt-2 rounded-full w-full hover:shadow-xl "
                            >
                                Login
                            </button>
                        </div>

                        <div class="mb-4 mt-4">
                            <Link
                                class="mx-3 cursor-pointer"
                                :href="route('forgotPassword')"
                                >Forgot my password</Link
                            >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    name: "Cart",

    components: { AppLayout },

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
