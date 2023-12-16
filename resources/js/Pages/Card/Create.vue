<template>
    <app-layout> </app-layout>
    <div class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base">
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-300">
                <div
                    class="flex justify-between items-start p-5 rounded-t border-b"
                >
                    <h3
                        class="text-3xl font-semibold text-gray-900 lg:text-4xl"
                    >
                        Create new card
                    </h3>
                </div>
            </div>

            <div class="mx-auto mt-0 bg-gray-50">
                <div class="py-3 mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-label for="name"
                                >Card name (max 20):
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

                        <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-label for="name">Layout: </jet-label>
                            <jet-select
                                v-model="form.layout"
                                v-model:options="state.layouts"
                                :value="form.layout"
                                class="mt-1 block w-full"
                                required
                            />
                            <jet-input-error
                                :message="form.errors.layout"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-label for="name">Image: </jet-label>
                            <div
                                class="flex items-center justify-center w-full mt-1"
                            >
                                <label
                                    class="flex flex-col border-4 border-dashed w-full hover:bg-sky-200 hover:border-sky-300 group"
                                >
                                    <div
                                        class="flex items-center justify-center"
                                    >
                                        <img
                                            :src="'/icons/imageIcon.svg'"
                                            class="w-8 rounded px-0 mx-2 "
                                        />

                                        <p
                                            class="lowercase text-sm text-gray-400 group-hover:text-gray-600 pt-1 tracking-wider inline-block"
                                        >
                                            (400px x 600px)
                                        </p>
                                    </div>
                                    <input
                                        type="file"
                                        class="hidden"
                                        @change="onFileSelected"
                                    />
                                </label>
                            </div>

                            <jet-input-error
                                :message="form.errors.layout"
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
                                :message="form.errors.criteria"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div
                        v-if="form.image"
                        class="w-64 mx-auto bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 p-2"
                    >
                        <div class="w-full m-auto p-2 bg-red-400 rounded-t">
                            
                            <img
                                class="inline-block align-middle w-6 m-1"
                                :src="'/icons/starHueso.svg'"
                            />
                            <p class="inline-block">here goes the rarity</p>
                            <img
                                class="inline-block align-middle w-6 m-1"
                                :src="'/icons/starHueso.svg'"
                            />
                        </div>

                        <div class="w-full m-auto p-2">
                            <div class="relative h-80">
                                <img
                                    :src="showImage(form.image)"
                                    class="z-0 absolute border-white border-8"
                                />
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-r from-cyan-900 via-cyan-800 to-cyan-500 rounded-sm align-middle text-center p-2 w-full text-cyan-200 mt-2"
                        >
                            <p class="text-rye">{{ form.name }}</p>
                        </div>

                        <div
                            class="align-middle text-center text-cyan-200 mt-1"
                        >
                            <img
                                :src="'/icons/coinCyan.svg'"
                                class="w-4 inline-block"
                            />
                            <p
                                class="inline-block ml-1 align-middle text-lobster"
                            >
                                0
                            </p>
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
                            @click="save()"
                            class="w-auto bg-sky-500 hover:bg-sky-600 rounded-sm shadow-xl px-4 py-2 text-josefin"
                        >
                            Create
                        </button>
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
        collectionId: {
            type: Object,
            default: null,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            layouts: {
                Vertical: "Vertical",
                Horizontal: "Horizontal",
            },
        });

        const form = useForm({
            name: null,
            layout: "Vertical",
            text: null,
            image: null,
            collection_id: props.collectionId,
            status: "created",
        });

        function save() {
            form.post(route("cards.store"), {
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

        function onFileSelected(event) {
            form.image = event.target.files[0];
        }

        function showImage(image) {
            return URL.createObjectURL(image);
        }

        return {
            save,
            form,
            state,
            showImage,
            onFileSelected,
        };
    },
};
</script>
