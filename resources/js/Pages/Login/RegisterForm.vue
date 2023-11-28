<template>
    <app-layout> </app-layout>

    <div class="w-full text-jost">
        <div class="container mx-auto text-blueGray-800">
            <div
                class="w-96 mx-auto bg-teal-400 hover:bg-teal-500 rounded shadow py-2 my-10 justify-center"
            >
               
            </div>
            <div
                class="w-96 mx-auto bg-gradient-to-br from-cyan-400 via-purple-400 to-cyan-400 rounded shadow py-2 my-10"
            >
                <h1 class="text-jost my-4 text-xl">
                    Register (please fill all fields)
                </h1>

                <form
                    name="student_application"
                    id="student_application"
                    action=""
                >
                    <div class="py-4 px-8">
                        <div class="mb-4 text-left">
                            <label class="block"
                                >Nickname (must be unique):</label
                            >
                            <span class="text-rose-600">{{
                                form.errors.nickname
                            }}</span>
                            <input
                                v-model="form.nickname"
                                class="border rounded w-full py-2 px-3 text-grey-darker"
                                type="text"
                            />
                        </div>
                        <div class="mb-4 text-left">
                            <label class="block">Email (must be unique):</label>
                            <span class="text-red-600">{{
                                form.errors.email
                            }}</span>
                            <input
                                v-model="form.email"
                                class="border rounded w-full py-2 px-3 text-grey-darker"
                                type="text"
                            />
                        </div>

                        <div class="mb-4 text-left">
                            <label class="block"
                                >Password (at least 8 characters):</label
                            >
                            <span class="text-red-600">{{
                                form.errors.password
                            }}</span>
                            <input
                                v-model="form.password"
                                class="border rounded w-full py-2 px-3 text-grey-darker"
                                type="password"
                            />
                        </div>

                        <div class="mb-4 text-left">
                            <label class="block">Repeat password:</label>
                            <span class="text-red-600">{{
                                form.errors.password2
                            }}</span>
                            <input
                                v-model="form.password2"
                                class="border rounded w-full py-2 px-3 text-grey-darker"
                                type="password"
                            />
                        </div>

                        <div class="mb-4 mt-6">
                            <button
                                @click="register"
                                type="button"
                                class="bg-gradient-to-r from-blue-100 to-blue-200 border-1 py-2 px-4 mt-2 rounded-full"
                            >
                                Register
                            </button>
                        </div>

                        <div class="mb-4 mt-4">
                            <span
                                >You will receive an email to activate your
                                user</span
                            >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import Swal from "sweetalert2";

export default {
    name: "Cart",

    components: { AppLayout, JetInputError },

    props: { errors: Object },

    setup() {
        const state = reactive({});

        const form = useForm({
            nickname: null,
            email: null,
            password: null,
            password2: null,
        });

        onMounted(() => {});

        function register() {
            form.post(route("registerUser"), {
                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-blueGray-300">Hecho</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#334155",
                        timer: 1500,
                    });
                },
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
            register,
        };
    },
};
</script>
