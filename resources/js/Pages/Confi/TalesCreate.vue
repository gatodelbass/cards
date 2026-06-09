<template>
    <app-layout></app-layout>

  
        <div class="">
            <div class="w-1/2 p-5">
                <div class="my-2 text-2xl font-bold">Agregar punto</div>
                <div class="my-2">
                    <Link :href="route('talesIndex')" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1"> Volver </Link>
                </div>
                <div class="my-0.5 w-full md:w-1/3">
                    <jet-input-error :message="form.errors.layout" class="mt-2" />
                </div>

                <div class="my-0.5 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">name</label>
                        <input
                            v-model="form.name"
                            type="text"
                            id="first_name"
                            class="block w-full rounded-sm border border-gray-300 bg-gray-50 p-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            required
                        />
                    </div>
                   
                </div>

                 <div>
                      
                       <textarea    v-model="form.text" class="border w-full"></textarea>
                       
                       
                     
                    </div>
              

                <button @click="save()" class="mt-2 rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1">Agregar punto</button>
            </div>
        </div>
  
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
    },
    props: {
        presentations: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        const form = useForm({
            name: null,
            text: null,
           
        });

        function save() {
            form.post(route('taleStore'), {
                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Hecho</p>',
                        showClass: { popup: '' },
                        position: 'top-end',
                        showConfirmButton: false,
                        icon: 'success',
                        background: '#6EE7B7',
                        timer: 1500,
                    });
                },
                onError: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Error</p>',
                        showClass: { popup: '' },
                        position: 'top-end',
                        showConfirmButton: false,
                        icon: 'error',
                        background: '#F97316',
                        timer: 1500,
                    });
                },
            });
        }

        return {
            state,
            save,
            form,
        };
    },
};
</script>
