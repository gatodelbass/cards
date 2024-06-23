<template>
    <app-layout></app-layout>

    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
        <h1 class="w-full">avatars</h1>

        <Link
            v-if="$page.props.auth.user.role == 'admin'"
            :href="route('avatars.create')"
        >
            <button
                class="bg-teal-300 m-2 px-2 py-1 border-1 border-teal-400 shadow text-jost"
            >
                <span class="w-full">Create new avatar</span>
            </button>
        </Link>
    </div>

    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
        <div v-for="avatar in avatars" :key="avatar.id">
            <label
                @click="setId(avatar.id)"
                class="flex flex-col border-4 border-dashed w-full hover:bg-sky-200 hover:border-sky-300 group rounded-full"
            >
                <img
                    :src="'/storage/' + avatar.image"
                    class="border-teal-300 border-2 md:border-4 w-40 rounded-full m-2"
                />
                <input type="file" class="hidden" @change="onFileSelected" />
            </label>
            <button
                v-if="avatar.id == form.id"
                @click="saveButton"
                class="px-2 py-1 bg-teal-400 m-1"
            >
                save
            </button>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
    },
    props: {
        avatars: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        const form = useForm({
            id: null,
            image: null,
            _method: "PUT",
        });

        function save() {
            console.log("dvfdfgd");

            form.post(route("avatars.update", form.id), {
                onSuccess: () => {
                    form.id = null;
                    form.image = null;

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
            console.log(event);

            form.image = event.target.files[0];
        }

        function saveButton() {
            save();
        }

        function remove(id) {
            Swal.fire({
                title: "Desea eliminar el registro?",
                showDenyButton: true,
                confirmButtonText: `Si`,
                denyButtonText: `No`,

                confirmButtonColor: "#22C55E",
                showClass: { popup: "" },

                customClass: {
                    confirmButton: "order-2",
                    denyButton: "order-3",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(route("categories.destroy", id));

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
                }
            });
        }

        function setId(id) {
            form.id = id;
        }

        return {
            onFileSelected,
            save,
            saveButton,
            remove,
            state,
            form,
            setId,
        };
    },
};
</script>
