<template>
    <app-layout></app-layout>

    <!-- component -->
    <!-- This is an example component -->

     <div class="w-full bg-grey-500">
        <div class="container mx-auto py-4">
            <div class="w-96 mx-auto bg-blueGray-800 rounded shadow">
                <div class="py-4 px-8 text-salsa">
                    <div class="mb-4 text-left">
                        <label class="block text-lg text-salsa text-yellow-500">Password:</label>
                        <span class="text-rose-400">{{ form.errors.password }}</span>
                        <input v-model="form.password" class="border rounded w-full py-2 px-3 text-grey-darker" type="password" />
                    </div>

                    <div class="mb-4 text-left">
                        <label class="block text-lg text-salsa text-yellow-500">Repeat password:</label>
                        <span class="text-rose-400">{{ form.errors.password2 }}</span>
                        <input v-model="form.password2" class="border rounded w-full py-2 px-3 text-grey-darker" type="password" />
                    </div>

                    <div class="mb-4 mt-6">
                        <button
                            @click="changePasswordLogued"
                            type="button"
                            class="hover:text-blueGray-900 py-2 px-4 border-2 mt-2 border-yellow-500 bg-yellow-500 flex text-lg text-salsa text-blueGray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            Change my password
                        </button>
                    </div>     
                    <div class="mb-4 mt-4">
                        <span class="text-white text-salsa mt-10">You have to login again.</span>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

import { useForm } from "@inertiajs/vue3";
import JetInputError from "@/Jetstream/InputError.vue";

export default {
    name: "ProductCard",

    components: { AppLayout,
    JetInputError },

    props: {
        record: {
            type: Object,
        },
    },

    setup(props, { emit }) {
        
        const state = reactive({
            backgroundImageLinkores: "icons/bottle2Icon.svg",
        });

        const form = useForm({            
            password: "",
            password2: "",
        });


        async function changePasswordLogued() {
            form.processing = true;

            await axios
                .post(route("changePasswordLogued"), form)
                .then(function (response) {                   
                    form.clearErrors();
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
                })
                .catch(function (error) {
                    form.errors.password = error.response.data.errors.password;
                    form.processing = false;

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

                    //form.errors = serverErrorHandling(error);
                });
        }
        return {
            
           
            state,            
            form,
            changePasswordLogued,
        };
    },
};
</script>
