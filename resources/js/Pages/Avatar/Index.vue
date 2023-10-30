<template>
    <app-layout></app-layout>

    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
        <h1 class="w-full">avatars</h1>

        <inertia-link v-if="$page.props.auth.user.role == 'admin'" :href="route('avatars.create')">
            <button
                
                class="bg-teal-300 m-2 px-2 py-1 border-1 border-teal-400 shadow text-jost"
            >
                <span class="w-full">Create new avatar</span>
               
            </button>
        </inertia-link>
    </div>

    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
        <div v-for="avatar in avatars" :key="avatar.id">
            <img
                :src="'/storage/' + avatar.image"
                class="border-teal-300 border-2 md:border-4 w-40 rounded-full m-2"
            />
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";

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

        return {
            remove,
            state,
        };
    },
};
</script>
