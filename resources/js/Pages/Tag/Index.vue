<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    ></h1>

    <div
        v-if="$page.props.auth.user.role == 'admin'"
        class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base"
    >
        {{ state.editMode }}
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto mt-0 bg-gray-50">
                <div class="flex flex-wrap">
                    <div class="w-10/12">
                        <jet-input
                            @keyup="filterTags"
                            type="text"
                            class="w-full mx-2"
                            v-model="form.name"
                        />
                    </div>

                    <div class="w-2/12 mt-1">
                        <button
                            v-if="form.name"
                            @click="buttonClick"
                            class="bg-sky-400 hover:bg-sky-500 px-2 py-1"
                        >
                            <span v-if="state.editMode">Editing</span>
                            <span v-else>Adding</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-2">
        <span
            @click="editMode(tag.name)"
            v-for="tag in state.tags"
            :key="tag.id"
            class="bg-gray-200 py-1 px-2 rounded-full mx-1 border-1 border-gray-300 text-lg cursor-pointer"
            >{{ tag.name }}</span
        >
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

import { reactive, onMounted } from "vue";
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
        const state = reactive({
            tags: null,
            editMode: false,
        });

        const form = useForm({
            name: "",
            oldName: "",
        });

        onMounted(() => {
            state.tags = props.tags;
        });

        function filterTags() {
            if (form.name != "") {
                axios.get(route("filterTags", form.name)).then((response) => {
                    state.tags = response.data.tags;
                });
            } else {
                state.tags = props.tags;
                state.editMode = false;
            }
        }

        function editMode(tag) {
            state.editMode = true;
            form.name = tag;
            form.oldName = tag;
        }

        function buttonClick() {
            if (state.edit == true) {
                editTag();
            } else {
                addTag();
            }
        }

        function addTag() {
            form.get(route("addNewTag"), {
                onSuccess: (response) => {},
                onError: () => {},
            });
        }

        function editTag() {
            form.get(route("editTag"), {
                onSuccess: (response) => {
                    state.editMode = false;
                    form.name = "";
                },
                onError: () => {},
            });
        }

        return {
            state,
            addTag,
            form,
            filterTags,
            editMode,
            buttonClick,
        };
    },
};
</script>
