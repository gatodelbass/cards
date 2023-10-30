<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl leading-tight">Details</h2>
            </div>
        </template>
        <div class="bg-blueGray-800 pt-4">
            <div class="justify-center flex flex-wrap px-5 m-2">
                <img
                    :src="'/storage/images/cards/' + card.image"
                    class="border-white border-8"
                />
            </div>

            <div class="justify-center max-w-sm px-5 m-2 text-rose-400">
                <div>
                    ID: <span class="font-semibold">{{ card.id }}</span>
                </div>
                <hr>
                <div>
                    Name: <span class="font-semibold">{{ card.name }}</span>
                </div>
                <p>
                    Rarity: <span class="font-semibold">{{ card.rarity }}</span>
                </p>
                <p>
                    Power: <span class="font-semibold">{{ card.power }}</span>
                </p>
            </div>

            <div
                class="
                    flex
                    items-center
                    justify-center
                    md:gap-8
                    gap-4
                    pt-5
                    pb-5
                "
            >
                <a
                    :href="route('cards.index')"
                    class="
                        w-auto
                        bg-blueGray-800
                        hover:bg-gray-900
                        rounded-sm
                        shadow-xl
                        font-medium
                        text-amber-300
                        px-4
                        py-2
                    "
                    >Volver</a
                >
            </div>
       </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
export default {
    name: "CardShow",
    components: {
        AppLayout,
    },
    props: {
        card: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            edad: 10,
        });

        return {
            state,
        };
    },
};
</script>
