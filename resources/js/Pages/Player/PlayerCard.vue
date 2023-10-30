<template>
    <!-- component -->

    

    <div
        class="m-2 text-jost relative w-72  mt-36  break-words bg-gradient-to-br from-gray-400 via-sky-100 to-gray-400  shadow-lg rounded border-1 border-gray-400"
    >
        <div class="px-0">
            <div class="flex flex-wrap justify-center">
                <div class="w-full flex justify-center">
                    <div class="relative">
                        <img
                            :src="'/storage/' + player.avatar"
                            class="border-8 border-amber-200 rounded-full align-middle absolute -m-16 -ml-20 lg:-ml-16 max-w-[150px]"
                        />
                    </div>
                </div>

                <div class="w-full text-center mt-20"></div>

                <!--
                <div class="w-full text-center mt-20">
                    <div class="flex justify-center lg:pt-4 pt-8 pb-0">
                        <div class="p-3 text-center">
                            <span
                                class="text-xl font-bold block uppercase tracking-wide text-slate-700"
                                >3,360</span
                            >
                            <span class="text-sm text-slate-400">Photos</span>
                        </div>
                        <div class="p-3 text-center">
                            <span
                                class="text-xl font-bold block uppercase tracking-wide text-slate-700"
                                >2,454</span
                            >
                            <span class="text-sm text-slate-400"
                                >Followers</span
                            >
                        </div>

                        <div class="p-3 text-center">
                            <span
                                class="text-xl font-bold block uppercase tracking-wide text-slate-700"
                                >564</span
                            >
                            <span class="text-sm text-slate-400"
                                >Following</span
                            >
                        </div>
                    </div>
                </div>
                -->
            </div>
            <div class="text-center mt-2">
                <h3
                    class="text-2xl text-slate-700 font-bold leading-normal mb-1"
                >
                    <span class="text-2xl">{{ player.nickname }}</span>
                </h3>
            </div>

            <div
                class="mt-2 py-4 border-t border-slate-200 text-center text-sm"
            >
                <div
                    class="flex flex-wrap justify-center w-full px-2 text-gray-700 py-1 bg-amber-100"
                >
                    <div class="w-1/6 text-left">
                        <img
                            class="w-5 inline-block"
                            :src="'/icons/cardObtained.svg'"
                        />
                    </div>
                    <div class="w-3/6 text-left">Cards obtained</div>
                    <div class="w-2/6 text-right">
                        {{ state.playerData.cards_obtained }}
                    </div>
                </div>

                <div
                    class="flex flex-wrap justify-center w-full px-2 text-gray-700 py-1"
                >
                    <div class="w-1/6 text-left">
                        <img
                            class="w-5 inline-block"
                            :src="'/icons/cardPasted.svg'"
                        />
                    </div>
                    <div class="w-3/6 text-left">Cards pasted</div>
                    <div class="w-2/6 text-right">
                        {{ state.playerData.cards_pasted }}
                    </div>
                </div>
                <div
                    class="flex flex-wrap justify-center w-full px-2 text-gray-700 py-1 bg-amber-100"
                >
                    <div class="w-1/6 text-left">
                        <img class="w-5 inline-block" :src="'/icons/in.svg'" />
                    </div>
                    <div class="w-3/6 text-left">Exchanges accepted</div>
                    <div class="w-2/6 text-right">
                        {{ state.playerData.exchanges_accepted }}
                    </div>
                </div>
                <div
                    class="flex flex-wrap justify-center w-full px-2 text-gray-700 py-1"
                >
                    <div class="w-1/6 text-left">
                        <img
                            class="w-5 inline-block"
                            :src="'/icons/avatarObtained.svg'"
                        />
                    </div>
                    <div class="w-3/6 text-left">Avatars obtained</div>
                    <div class="w-2/6 text-right">
                        {{ state.playerData.avatars_obtained }}
                    </div>
                </div>

                <div
                    class="flex flex-wrap justify-center w-full px-2 text-gray-700 py-1 bg-amber-100"
                >
                    <div class="w-1/6 text-left">
                        <img
                            class="w-5 inline-block"
                            :src="'/icons/box2.svg'"
                        />
                    </div>
                    <div class="w-3/6 text-left">Boxes obtained</div>
                    <div class="w-2/6 text-right">
                        {{ state.playerData.boxes_obtained }}
                    </div>
                </div>

                <div
                    class="flex flex-wrap justify-center w-full px-2 text-gray-700 py-1"
                >
                    <div class="w-1/6 text-left">
                        <img
                            class="w-5 inline-block"
                            :src="'/icons/coin3.svg'"
                        />
                    </div>
                    <div class="w-3/6 text-left">Gold obtained</div>
                    <div class="w-2/6 text-right">
                        {{ state.playerData.gold_obtained }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--

    <div
        class="m-2 border-1 border-gray-500 text-jost text-xs md:text-sm w-56 md:w-64 text-teal-300 bg-gradient-to-tr from-gray-900 via-gray-800 to-teal-700 rounded-xl shadow-md"
    >
        <div class="w-full py-5">
            <div class="flex justify-center">
                <img
                    class="w-24 md:w-32 inline-block rounded-full border-amber-200 border-3"
                    :src="'/storage/' + player.avatar"
                />
            </div>

            <div class="flex flex-col text-center mt-3 mb-4">
                <span class="text-2xl">{{ player.nickname }}</span>
            </div>

            <div
                class="flex flex-wrap justify-center w-full bg-amber-200 px-2 text-gray-700 py-1"
            >
                <div class="w-2/3 text-left">Cards obtained</div>
                <div class="w-1/3 text-right">
                    {{ state.playerData.cards_obtained }}
                </div>
            </div>
            <div
                class="flex flex-wrap justify-center w-full bg-gray-800 px-2 text-teal-300 py-1"
            >
                <div class="w-2/3 text-left">Cards pasted</div>
                <div class="w-1/3 text-right">
                    {{ state.playerData.cards_pasted }}
                </div>
            </div>
            <div
                class="flex flex-wrap justify-center w-full bg-amber-200 px-2 text-gray-700 py-1"
            >
                <div class="w-2/3 text-left">Exchanges accepted</div>
                <div class="w-1/3 text-right">
                    {{ state.playerData.exchanges_accepted }}
                </div>
            </div>
            <div
                class="flex flex-wrap justify-center w-full bg-gray-800 px-2 text-teal-300 py-1"
            >
                <div class="w-2/3 text-left">Avatars obtained</div>
                <div class="w-1/3 text-right">
                    {{ state.playerData.avatars_obtained }}
                </div>
            </div>
            <div
                class="flex flex-wrap justify-center w-full bg-amber-200 px-2 text-gray-700 py-1"
            >
                <div class="w-2/3 text-left">Boxes obtained</div>
                <div class="w-1/3 text-right">
                    {{ state.playerData.boxes_obtained }}
                </div>
            </div>
            <div
                class="flex flex-wrap justify-center w-full bg-gray-800 px-2 text-teal-300 py-1"
            >
                <div class="w-2/3 text-left">Gold obtained</div>
                <div class="w-1/3 text-right">
                    {{ state.playerData.gold_obtained }}
                </div>
            </div>
        </div>
    </div>

    -->
</template>

<script>
import { reactive } from "vue";

export default {
    name: "PlayerCard",
    components: {},
    props: {
        player: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            playerData: JSON.parse(props.player.data),
        });

        return {
            state,
        };
    },
};
</script>
