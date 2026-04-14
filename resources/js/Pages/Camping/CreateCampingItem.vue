<template>
    <app-layout> </app-layout>
    <div v-if="$page.props.auth.user.role == 'admin'" class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base">
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-300">
                <div class="flex justify-between items-start p-5 rounded-t border-b">
                    <h3 class="text-3xl font-semibold text-gray-900 lg:text-4xl">
                        Create new camping item
                    </h3>
                </div>
            </div>

            <div class="mx-auto mt-0 bg-gray-50">
                <div class="py-3 mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-wrap">
                        <div class="w-full mb-4 px-2">
                            <jet-label for="name">item
                            </jet-label>
                            <jet-input id="other_position" type="text" class="mt-1 block w-full" v-model="form.name" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="w-full mb-4 px-2">
                            <jet-label for="criteria">image URL
                            </jet-label>
                            <jet-input id="other_position" type="text" class="mt-1 block w-full" v-model="form.image" />
                            <jet-input-error :message="form.errors.criteria" class="mt-2" />
                        </div>

                        <div class="w-full mb-4 px-2">
                            <jet-label for="criteria">price
                            </jet-label>
                            <jet-input id="other_position" type="text" class="mt-1 block w-full" v-model="form.price" />
                            <jet-input-error :message="form.errors.price" class="mt-2" />
                        </div>




                        <div class="flex items-center justify-center px-0 my-4 md:gap-8 gap-4 text-white text-lg">
                            <Link :href="route('login.index')"
                                class="w-auto bg-orange-500 hover:bg-orange-600 rounded-sm shadow-xl px-4 py-2">
                            Go back
                            </Link>

                            <button @click="save()"
                                class="w-auto bg-sky-500 hover:bg-sky-600 rounded-sm shadow-xl px-4 py-2 text-josefin">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";

import JetTextArea from "@/Jetstream/Textarea.vue";
import Swal from "sweetalert2";
import { usePage } from '@inertiajs/vue3'

export default {
    name: "OperatorCreate",
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,

        JetTextArea,
    },
    props: {
        categories: {
            type: Object,
            default: null,
        },
    },

    setup(props, { emit }) {
        const page = usePage();
        const state = reactive({
            userData: page.props.auth.user,
        });

        const form = useForm({
            name: null,
            image: null,
            price: null
        });

        function save() {
            form.post(route("storeCampingitem"), {
                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Hecho</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#6EE7B7",
                        timer: 1500,
                    });
                },
                onError: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Error</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "error",
                        background: "#F97316",
                        timer: 1500,
                    });
                },
            });
        }

        function selectCategory(category_id) {
            form.category_id = category_id;
        }

        return {
            save,
            form,
            state,
            selectCategory,
        };
    },
};
</script>
