<template>
    <div class="space3d mx-20 mb-20 text-jost mt-10">
        <div class="_3dbox -ml-10">
            <div
                class="_3dface _3dface--front p-2 rounded-sm"
                :class="bg(collection.category_id, 'front')"
            >
                <div class="justify-center mx-auto flex">
                    <div class="border-1 border-white rounded-sm">
                        <img
                            class="w-full border-gray-900 border-1 rounded-sm"
                            :src="collection.cover_card"
                            alt="image"
                        />
                    </div>
                </div>
                <div>
                    <p class="text-white mt-2 text-lg tracking-wider">
                        {{ collection.name }}
                    </p>
                </div>
            </div>
            <div
                class="_3dface _3dface--top rounded-sm align-middle"
                :class="bg(collection.category_id, 'top')"
            >
                <img
                    :src="'/icons/' + collection.category.icon"
                    class="w-12 inline-block bg-white p-1 rounded-full mt-6"
                />
            </div>
            <div
                class="_3dface _3dface--left text-white rounded-sm"
                :class="bg(collection.category_id, 'left')"
            >
                <p
                    class="text-teal-300 text-3xl mt-8 font-semibold tracking-wide rotate-270"
                >
                    {{ collection.cards.length }}
                </p>
                <p
                    class="text-teal-300 text-2xl mt-0 font-semibold tracking-wide rotate-270"
                >
                    cards
                </p>
            </div>
        </div>
    </div>
</template>

<script>

import { reactive } from "vue";



export default {
    name: "CollectionCard",
    components: {
       
    },
    props: {
        collection: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
       // const { background } = useBackground();

        const state = reactive({
            color: "yellow",
        });

        function bg(param, face) {
            switch (face) {
                case "front":
                    switch (param) {
                        case 1:
                            return "bg-gradient-to-tr from-green-400 via-gray-800 to-green-400";
                        case 2:
                            return "bg-gradient-to-tr from-indigo-800 via-gray-800 to-indigo-800";
                        case 3:
                            return "bg-gradient-to-tr from-pink-400 via-gray-800 to-pink-400";
                        case 4:
                            return "bg-gradient-to-tr from-red-600 via-gray-800 to-red-600";
                        case 5:
                            return "bg-gradient-to-tr from-rose-300 via-gray-800 to-rose-300";
                        case 6:
                            return "bg-gradient-to-tr from-orange-500 via-gray-800 to-orange-500";
                        case 7:
                            return "bg-gradient-to-tr from-blue-400 via-gray-800 to-blue-400";
                        case 8:
                            return "bg-gradient-to-tr from-cyan-300 via-gray-800 to-cyan-300";
                        case 9:
                            return "bg-gradient-to-tr from-violet-300 via-gray-800 to-violet-300";
                        case 10:
                            return "bg-gradient-to-tr from-gray-400 via-gray-800 to-gray-400";
                        case 11:
                            return "bg-gradient-to-tr from-orange-300 via-gray-800 to-orange-300";
                        case 12:
                            return "bg-gradient-to-tr from-gray-300 via-gray-800 to-gray-300";

                        default:
                            break;
                    }

                case "top":
                    switch (param) {
                        case 1:
                            return "bg-gradient-to-l from-green-400 via-gray-800 to-gray-900";
                        case 2:
                            return "bg-gradient-to-l from-indigo-800 via-gray-800 to-gray-900";
                        case 3:
                            return "bg-gradient-to-l from-pink-400 via-gray-800 to-gray-900";
                        case 4:
                            return "bg-gradient-to-l from-red-600 via-gray-800 to-gray-900";
                        case 5:
                            return "bg-gradient-to-l from-rose-300 via-gray-800 to-gray-900";
                        case 6:
                            return "bg-gradient-to-l from-orange-500 via-gray-800 to-gray-900";
                        case 7:
                            return "bg-gradient-to-l from-blue-400 via-gray-800 to-gray-900";
                        case 8:
                            return "bg-gradient-to-l from-cyan-300 via-gray-800 to-gray-900";
                        case 9:
                            return "bg-gradient-to-l from-violet-300 via-gray-800 to-gray-900";
                        case 10:
                            return "bg-gradient-to-l from-gray-400 via-gray-800 to-gray-900";
                        case 11:
                            return "bg-gradient-to-l from-orange-300 via-gray-800 to-gray-900";
                        case 12:
                            return "bg-gradient-to-l from-gray-300 via-gray-800 to-gray-900";

                        default:
                            break;
                    }

                    break;

                case "left":
                    switch (param) {
                        case 1:
                            return "bg-gradient-to-t from-green-400 via-gray-800 to-gray-900";
                        case 2:
                            return "bg-gradient-to-t from-indigo-800 via-gray-800 to-gray-900";
                        case 3:
                            return "bg-gradient-to-t from-pink-400 via-gray-800 to-gray-900";
                        case 4:
                            return "bg-gradient-to-t from-red-600 via-gray-800 to-gray-900";
                        case 5:
                            return "bg-gradient-to-t from-rose-300 via-gray-800 to-gray-900";
                        case 6:
                            return "bg-gradient-to-t from-orange-500 via-gray-800 to-gray-900";
                        case 7:
                            return "bg-gradient-to-t from-blue-400 via-gray-800 to-gray-900";
                        case 8:
                            return "bg-gradient-to-t from-cyan-300 via-gray-800 to-gray-900";
                        case 9:
                            return "bg-gradient-to-t from-violet-300 via-gray-800 to-gray-900";
                        case 10:
                            return "bg-gradient-to-t from-gray-400 via-gray-800 to-gray-900";
                        case 11:
                            return "bg-gradient-to-t from-orange-300 via-gray-800 to-gray-900";
                        case 12:
                            return "bg-gradient-to-t from-gray-600 via-gray-800 to-gray-900";

                        default:
                            break;
                    }

                    break;

                default:
                    break;
            }
        }

        return {
            state,
            //background,
            bg,
        };
    },
};
</script>


<style>
/* 3D Cube */
.space3d {
    perspective: 2000px;
    width: 200px;
    height: 300px;
}

._3dbox {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transform: rotateX(-25deg) rotateY(30deg);
}

._3dface {
    position: absolute;
}

._3dface--top {
    width: 200px;
    height: 100px;
    transform: rotateX(90deg) translate3d(0, 70px, 50px);
}

._3dface--front {
    width: 200px;
    height: 300px;
    transform: translate3d(0, 0, 120px);
}

._3dface--left {
    width: 100px;
    height: 300px;

    transform: rotateY(-90deg) translate3d(70px, 0, 50px);
}
</style>
