<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Submitted collections
    </h1>   

    <div class="flex flex-wrap justify-center">
        <collection-card-submitted
            v-for="collection in submittedCollections"
            :key="collection.id"
            :collection="collection"
        >
        </collection-card-submitted>
    </div>

   
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCardSubmitted from "../Collection/CollectionCardSubmitted.vue";

import { reactive } from "vue";
import Swal from "sweetalert2";

import { Inertia } from "@inertiajs/inertia";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCardSubmitted,
       
    },
    props: {
        submittedCollections: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            color: "red",

            backgroundImage:
                "http://karta.local/storage/cards/vnDUkhcN9fbA3lOv4tslmpbc5xazg8rtZ0WXiziy.png",
        });

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
