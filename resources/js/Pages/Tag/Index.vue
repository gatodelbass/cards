<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    ></h1>

    <div
        v-if="$page.props.auth.user.role == 'admin'"
        class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base"
    >
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto mt-0 bg-gray-50">
                <div class="flex flex-wrap">
                    <div class="w-10/12">
                        <jet-input
                            type="text"
                            class="w-full mx-2"
                            v-model="form.name"
                        />
                    </div>

                    <div class="w-2/12 mt-1">
                        <button
                            @click="addTag()"
                            class="bg-sky-400 hover:bg-sky-500 px-2 py-1"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-2">
            <span
                v-for="tag in tags"
                :key="tag.id"
                class="bg-gray-200 py-1 px-2 rounded-full mx-1 border-1 border-gray-300 text-lg"
                >{{ tag.name }}</span
            >
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "OperatorShow",
    components: {
        AppLayout,
        JetInput,
        JetLabel,
    },
    props: {
        tags: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        const form = useForm({
            name: null,
        });

        function addTag() {
            form.get(route("addNewTag"), {
                onSuccess: (response) => {},
                onError: () => {},
            });
        }

        return {
            state,
            addTag,
            form,
        };
    },
};
</script>
