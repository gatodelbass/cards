<template>
    <app-layout> </app-layout>
    <div
        v-if="$page.props.auth.user.role == 'admin'"
        class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base"
    >
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-300">
                <div
                    class="flex justify-between items-start p-5 rounded-t border-b"
                >
                    <h3
                        class="text-3xl font-semibold text-gray-900 lg:text-4xl"
                    >
                        Edit collection
                    </h3>
                    
                </div>
            </div>

            <div class="mx-auto mt-0 bg-gray-50">
                <div class="py-3 mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-wrap">
                        <div class="w-full mb-4 px-2">
                            <jet-label for="name"
                                >Collection name (max 50):
                            </jet-label>
                            <jet-input
                                id="other_position"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                            />
                            <jet-input-error
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full mb-4 px-2">
                            <jet-label for="criteria"
                                >Description text for your collection (max 200):
                            </jet-label>
                            <jet-text-area
                                v-model="form.text"
                                type="text"
                                class="mt-1 block w-full text-sm md:text-base"
                            />
                            <jet-input-error
                                :message="form.errors.text"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full mb-4 px-2">
                            <jet-label for="category_id"
                                >Select the category for your collection:
                            </jet-label>
                            <jet-input-error
                                :message="form.errors.category_id"
                                class="mt-2"
                            />
                        </div>

                        <div
                            class="flex flex-wrap mx-auto sm:px-6 lg:px-8 justify-center"
                        >
                            <div
                                v-for="category in categories"
                                :key="category.id"
                                class="mx-2 my-1 cursor-pointer"
                            >
                                <div
                                    v-if="form.category_id == category.id"
                                    class="border-emerald-400 border-6 rounded p-1"
                                >
                                    <img
                                        @click="selectCategory(category.id)"
                                        :src="'/icons/' + category.icon"
                                        class="w-12"
                                    />{{ category.name }}
                                </div>

                                <div v-else>
                                    <img
                                        @click="selectCategory(category.id)"
                                        :src="'/icons/' + category.icon"
                                        class="w-12"
                                    />{{ category.name }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-center px-0 my-4 md:gap-8 gap-4 text-white text-lg"
                    >
                        <Link
                            :href="route('login.index')"
                            class="w-auto bg-orange-500 hover:bg-orange-600 rounded-sm shadow-xl px-4 py-2"
                        >
                            Go back
                        </Link>

                        <button
                            @click="edit()"
                            class="w-auto bg-sky-500 hover:bg-sky-600 rounded-sm shadow-xl px-4 py-2 text-josefin"
                        >
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { reactive, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetTextArea from "@/Jetstream/Textarea.vue";

import Swal from "sweetalert2";

export default {
    name: "OperatorEdit",
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetTextArea,
    },
    props: {
        collection: {
            type: Object,
            default: null,
        },
        categories: {
            type: Object,
            default: null,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            selectedFile: null,
            positions: {
                "Jefe de taller": "Jefe de taller",
                "Gerente comercial": "Gerente comercial",
                "Coordinador de calidad": "Coordinador de calidad",
                "Coordinador de taller": "Coordinador de taller",
            },
        });

        const form = useForm({
            name: null,
            text: null,
            category_id: null,
            user_id: null,
            status: null,
        });

        onMounted(() => {
            form.reset();
            form.collection_id = props.collection.collection_id;
            form.name = props.collection.name;
            form.text = props.collection.text;
            form.user_id = props.collection.user_id;
            form.status = props.collection.status;
            form.category_id = props.collection.category_id;
        });

        function edit() {
            form.put(route("collections.update", props.collection.id), {
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
            edit,
            form,
            state,
            selectCategory,
        };
    },
};
</script>
