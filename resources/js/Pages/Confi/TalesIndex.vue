<template>
    <app-layout></app-layout>

   
 <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de puntos</div>
                <div class="my-2">
                    <Link :href="route('talesCreate')"
                        class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1 mx-1">
                        Agregar punto
                    </Link>

                    <InertiaLink :href="route('talesIndex')"
                        class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1 mx-1">
                        Mapa efectivos
                    </InertiaLink>
                    <InertiaLink :href="route('talesIndex')"
                        class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1 mx-1">
                        Mapa condiciones
                    </InertiaLink>
                </div>

                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">name</th>
                            <th scope="col" class="px-6 py-3">text</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tale in tales" :key="tale.id" class="border border-gray-200 bg-white">
                            <th scope="row"
                                class="px-6 py-2 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                {{ tale.id }}
                            </th>
                            <td class="px-6 py-2">
                                {{ tale.name }}
                            </td>
                            <td class="px-6 py-2 border">
                                <pre> {{ tale.text }}</pre>
                               
                            </td>
                           

                            <td class="px-6 py-2">
<!--
                                <inertia-link :href="route('mapEdit', tale.id)"
                                    class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0">
                                    editar
                                </inertia-link>

                                   <button @click="eliminar(tale.id)"
                                    class="mx-1 rounded border-1 border-red-400 bg-red-200 px-1 py-0">
                                    eliminar
                                </button>

                                -->

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

</template>

<script>
import { onMounted, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { router } from '@inertiajs/vue3'

export default {
    name: "ProductCard",

    components: { AppLayout },

    props: {
        tales: {
            type: Object,
        },
    },

    setup(props, { emit }) {
        onMounted(() => {});

        const formatter = new Intl.NumberFormat("en-US", {
            style: "currency",
            currency: "USD",
            minimumFractionDigits: 0,
        });

        function formatCost(cost) {
            return formatter.format(cost);
        }

        return {
            formatCost,
        };
    },
};
</script>
