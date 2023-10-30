<template>
    <app-layout></app-layout>
        

        <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
            <h1 class="w-full">CATEGORIES</h1>
            
           
            <inertia-link               
                :href="route('categories.create')"
                class="px-4 bg-lightBlue-500 py-2 rounded-sm hover:bg-lightBlue-600 my-4 text-white  mx-2"
            >
                Create new category
            </inertia-link>

            <table class="min-w-full table-auto">
                <thead class="justify-between">
                    <tr class="bg-gray-800 text-gray-300">
                        <th class="px-2 py-2">
                            <span class="">ID</span>
                        </th>

                        <th class="px-2 py-2">
                            <span class="">Nombre</span>
                        </th>

                        <th class="px-2 py-2">
                            <span class="">Logo</span>
                        </th>
                       
                        <th class="px-2 py-2">
                            <span class="">Opciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200 text-center">
                    <tr
                        v-for="category in categories"
                        :key="category.id"
                        class="bg-white border-1 border-gray-200"
                    >
                        <td class="px-4 py-1">
                            {{ category.id }}
                        </td>

                        <td class="px-4 py-1">
                            {{ category.name }}
                        </td>

                        <td class="px-4 py-1">
                            <img class="w-6 mx-auto" :src="'/icons/' + category.icon" />
                            
                        </td>

                        
                        
                        <td class="px-4 py-1">
                            <inertia-link
                                :href="route('categories.show', category.id)"
                                
                            >
                                <img
                                    :src="'/icons/eyeIcon.svg'"
                                    class="w-6 rounded border-gray-400 border-1 bg-gray-100 p-1 mx-1 inline-block hover:bg-lightBlue-400"
                                    data-bs-toggle="tooltip"
                                    title="Ver detalle"
                                />
                            </inertia-link>

                            <inertia-link
                                :href="route('categories.edit', category.id)"
                                
                            >
                                <img
                                    :src="'/icons/pencilIcon.svg'"
                                    class="w-6 rounded border-gray-400 border-1 bg-gray-100 p-1 mx-1 inline-block hover:bg-lightBlue-400"
                                    data-bs-toggle="tooltip"
                                    title="Editar operario"
                                />
                            </inertia-link>                            

                           
                        </td>

                        
                    </tr>
                </tbody>
            </table>
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
       
        categories: {
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
