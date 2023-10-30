<template>
    <app-layout> </app-layout>

    <h1 class="text-jost text-xl my-2">Forgot my password</h1>   

    <div class="w-full bg-grey-500">
        <div class="container mx-auto py-4">
            <div v-if="state.passwordOk == true" class="w-96 mx-auto  rounded shadow">
                <div class="py-4 px-8 text-jost">
                    <label class="mb-4 block text-xl text-jost text-gray-700">Perfect! You changed your password succesfully</label>
                    <inertia-link :href="route('loginForm')"
                        ><button
                            type="button"
                            class="text-jost hover:text-emerald-400 py-1 px-3 flex text-xl text-gray-700 rounded-full border-amber-300 bg-amber-200"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            Go to login
                        </button></inertia-link
                    >
                </div>
            </div>

            <div v-else class="w-96 mx-auto  rounded shadow">
                <div class="py-4 px-8 text-jost">
                    <div class="mb-4 text-left">
                        <label class="block text-lg text-gray-700">Your email:</label>
                        <span class="text-red-500">{{ form.errors.email }}</span>
                        <input
                            :disabled="state.emailOk == true"
                            v-model="form.email"
                            class="border rounded w-full py-2 px-3 text-grey-darker"
                            type="text"
                            required
                        />
                    </div>

                    <div v-if="state.emailOk == false" class="mb-4 mt-6">
                        <button
                            @click="sendPasswordCode"
                            type="button"
                            class="hover:text-blueGray-900 py-2 px-4 border-2 mt-2 border-amber-300 bg-amber-200 flex text-lg text-jost text-blueGray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            Send code to my email
                        </button>
                    </div>
                </div>

                <div v-if="state.emailOk" class="py-4 px-8 text-jost">
                    <div class="mb-4 text-left">
                        <label class="block text-lg text-jost text-gray-700">Enter the code received in your email:</label>
                        <span class="text-red-500">{{ form.errors.code }}</span>
                        <input
                            :disabled="state.rememberCodeOk == true"
                            v-model="form.code"
                            class="border rounded w-full py-2 px-3 text-grey-darker"
                            type="text"
                        />
                    </div>
                    <div v-if="state.rememberCodeOk == false" class="mb-4 mt-6">
                        <button
                            @click="checkRememberCode"
                            type="button"
                            class="hover:text-blueGray-900 py-2 px-4 border-2 mt-2 border-amber-200 bg-amber-200 flex text-lg text-jost text-blueGray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            Continuar
                        </button>
                    </div>
                </div>

                <div v-if="state.rememberCodeOk" class="py-4 px-8 text-jost">
                    <div class="mb-4 text-left">
                        <label class="block text-lg text-jost text-gray-700">Password:</label>
                        <span class="text-red-500">{{ form.errors.password }}</span>
                        <input v-model="form.password" class="border rounded w-full py-2 px-3 text-grey-darker" type="password" />
                    </div>

                    <div class="mb-4 text-left">
                        <label class="block text-lg text-jost text-gray-700">Repeat password:</label>
                        <span class="text-red-500">{{ form.errors.password2 }}</span>
                        <input v-model="form.password2" class="border rounded w-full py-2 px-3 text-grey-darker" type="password" />
                    </div>

                    <div class="mb-4 mt-6">
                        <button
                            @click="changePassword"
                            type="button"
                            class="hover:text-blueGray-900 py-2 px-4 border-2 mt-2 border-amber-200 bg-amber-200 flex text-lg text-jost text-blueGray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            Change my password
                        </button>
                    </div>

                    <div class="mb-4 mt-4">
                        <span class="text-white text-jost mt-10">Once changed you can login with your new password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Application Details End -->
</template>

<script>
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    name: "Cart",

    components: { AppLayout },

    props: { errors: Object },

    setup(props, { emit }) {
        const state = reactive({
            emailOk: false,
            rememberCodeOk: false,
            passwordOk: false,
        });

        const form = useForm({
            email: "",
            code: "",
            password: "",
            password2: "",
        });

        async function sendPasswordCode() {
            form.processing = true;

            await axios
                .post(route("sendPasswordCode"), form)
                .then(function (response) {
                    state.emailOk = true;
                    form.clearErrors();
                })
                .catch(function (error) {
                    form.errors.email = error.response.data.errors.email;
                    form.processing = false;

                    //form.errors = serverErrorHandling(error);
                });
        }

        async function checkRememberCode() {
            form.processing = true;

            await axios
                .post(route("checkRememberCode"), form)
                .then(function (response) {
                    state.rememberCodeOk = true;
                    form.clearErrors();
                })
                .catch(function (error) {
                    form.errors.code = error.response.data.errors.code;
                    form.processing = false;

                    //form.errors = serverErrorHandling(error);
                });
        }

        async function changePassword() {
            form.processing = true;

            await axios
                .post(route("changePassword"), form)
                .then(function (response) {
                    state.passwordOk = true;
                    form.clearErrors();
                })
                .catch(function (error) {
                    form.errors.password = error.response.data.errors.password;
                    form.processing = false;

                    //form.errors = serverErrorHandling(error);
                });
        }

        function sendPasswordCode2() {
            form.post(route("sendPasswordCode"), {
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
            sendPasswordCode,
            checkRememberCode,
            changePassword,
        };
    },
};
</script>
