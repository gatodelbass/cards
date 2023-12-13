<template>
    <app-layout> </app-layout>

    <div v-if="$page.props.auth.user.role == 'admin'" class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base">
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-300">
                <div
                    class="flex justify-between items-start p-5 rounded-t border-b"
                >
                    <h3
                        class="text-3xl font-semibold text-gray-900 lg:text-4xl"
                    >
                        Create new avatar
                    </h3>
                </div>
            </div>

            <div class="mx-auto mt-0 bg-gray-50">
                <div class="py-3 mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-wrap">
                     

                        <div class="w-full  mb-4 px-2">
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
                                            (400px x 400px)
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

                       
                    </div>

                    <div
                        v-if="form.image"
                        class="w-64 mx-auto  p-2"
                    >
                       

                        <div class="w-full m-auto p-2 ">
                           
                                <img
                                    :src="showImage(form.image)"
                                    class=" border-teal-500 border-4 rounded-full"
                                />
                           
                        </div>

                       
                    </div>

                    <div
                        class="flex items-center justify-center px-0 my-4 md:gap-8 gap-4 text-white text-lg"
                    >
                        <Link
                            :href="route('avatars.index')"
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
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetLabel from "@/Jetstream/Label.vue";
import Swal from "sweetalert2";

export default {
    name: "OperatorCreate",
    components: {
        AppLayout,
       
        JetLabel,       
    },
    props: {
        collectionId: {
            type: Object,
            default: null,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
          
        });

        const form = useForm({           
            image: null,
        });

        function save() {
            form.post(route("avatars.store"), {
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
