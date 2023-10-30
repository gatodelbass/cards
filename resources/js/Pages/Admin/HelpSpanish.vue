<template>
    <app-layout></app-layout>

    <div class="text-jost px-4">
        <p class="my-4">
            Go to the
            <span class="text-sky-600 font-semibold tracking-wider">
                <inertia-link :href="route('help')"
                    >english version
                </inertia-link></span
            >
        </p>
        <p class="my-4">
            Hola! también tenemos una pagina en Facebook
            <a
                target="_blank"
                href="https://www.facebook.com/Karta-Card-Trading-Game-105780995533698"
                class="text-sky-600 font-semibold tracking-wider"
            >
                Karta Facebook page
            </a>
            donde publicaremos noticias, nuevas colecciones y otros contenidos.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Guia de ayuda
        </h1>
        <p class="my-2 p-2 text-justify">
            Bienvenid@ a Karta, un sitio web hecho por diversión, para compartir
            con otros jugadores, en donde puedes coleccionar e intercambiar
            cartas de diferentes temas y categorías. Es totalmente gratis y
            también libre de publicidad y anuncios.
        </p>

        <p class="my-2 p-2 text-justify">
            Comenzaremos a explicar cada uno de los elementos en la sección de
            inicio (home).
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Explorar colecciones - Explore collections
        </h1>

        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/compass.svg'" />
            <p class="my-2">Explore collections</p>
        </div>

        <p class="my-2 p-2 text-justify">
            Aqui puedes comprar nuevas colecciones de tu preferencia, ten en
            cuenta que las colecciones cuestan oro. El costo de una colección
            corresponde al número de cartas que posee multiplicado por 1000.
            Tambien puedes filtrar las colecciones por categoría para solo ver
            las que mas te interesen. Una vez hayas comprado una colección, esta
            aparecerá en la sección del album y allí podras pegar las cartas
            correspondientes a esa colección.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Reclamar cajas - Redeem boxes
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/box2.svg'" />
            <p class="my-2">Redeem boxes</p>
        </div>

        <p class="my-2 p-2 text-justify">
            En esta sección puedes reclamar cajas. Un jugador obtiene 2 cajas
            diarias cuando se loguea en la página. Las cajas pueden dar entre 5
            y 15 tiquetes, tambien entre 1000 y 50000 de oro. Una caja tambien
            puede dar un avatar aunque esto no ocurre siempre. Los avatar solo
            pueden ser recolectador redimiendo cajas.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Reclamar tiquetes - Redeem tickets
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/ticket3.svg'" />
            <p class="my-2">Redeem tickets</p>
        </div>

        <p class="my-2 p-2 text-justify">
            En esta sección puedes obtener cartas reclamando tiquetes. Un solo
            tiquete otorga una sola carta, que varia en su rareza y costo.
            Tienes la opción de reclamar 1, 10 o hasta 20 tiquetes en un solo
            intento, dependiendo del número de tiquetes que poseas. Cuando
            obtienes una carta nueva, verás que la palabra "New" en un recuadro
            amarillo que parpadea. Esta carta queda protegida automaticamente
            para evitar que la vendas o la intercambies por accidente y ademas
            esta carta puede ser pegada en la correspondiente colección, siempre
            y cuando ya hayas comprado dicha colección previamente. Si la carta
            obtenida no es nueva automaticamente es colocada en intercambios, en
            donde otros jugadores la pueden ver y ofertar en la bolsa de
            intercambios.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            La bolsa de intercambios - The exchange bag
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/backpack.svg'" />
            <p class="my-2">The exchange bag</p>
        </div>

        <p class="my-2 p-2 text-justify">
            En la bolsa de intercambios encontrarás las cartas de otros
            jugadores, asi puedes ofrecer tus cartas en intercambio. Para hacer
            un intercambio debes ofrecer cartas de igual rareza (número de
            estrellas de la carta) que la carta que quieres obtener. Has click
            en la carta que quieres y se mostrarán tus cartas disponibles para
            intercambio y de igual rareza, luego haces otro click para
            seleccionar una de tus cartas y finalmente haces la oferta de
            intercambio haciendo click en el boton "Make offer!" Importante:
            Cuando estas haciendo un intercambio, tus cartas muestran un smiley
            en la parte superior, si el smiley es gris, significa que el otro
            jugador ya posee esa carta. De lo contrario, si el smiley es verde
            significa que seria una carta nueva para el jugador, asi tienes mas
            oportunidades para que el jugador acepte tu intercambio.
        </p>
        <img class="p-2 mx-auto" :src="'/images/exchange.png'" />

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Mis cartas - My cards
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/cards.svg'" />
            <p class="my-2">My cards</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In esta sección puedes manejar tus cartas, se pueden vender las
            cartas repetidas y tambien proteger las cartas que quieras conservar
            para despues. Las cartas pegadas se verar con un smiley en la parte
            inferior. Tambien se pueden vender todas las cartas en intercambio o
            todas las cartas protegidas mediante los correspondientes botones.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            El album - The album
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/book2.svg'" />
            <p class="my-2">The album</p>
        </div>

        <p class="my-2 p-2 text-justify">
            El album mostrara todas las colecciones que hayas comprado
            previamente. Aqui es donde pegas las cartas nuevas para completar
            las colecciones. Antes de entrar en cualquier colección, se mostrará
            la info de la colección junto con las cartas que posee representadas
            por pequeños cuadrados. Los cuadrados tienen los siguientes colores:
            Gris cuando aún no tienes esa carta. Verde cuando ya pegaste la
            carta. Amarillo parpadeando cuando tienes la carta disponible para
            pegar.
        </p>

        <img class="p-2 mx-auto" :src="'/images/album.png'" />

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Intercambios entrantes - Incoming exchanges
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/cards.svg'" />
            <p class="my-2">Incoming exchanges</p>
        </div>

        <p class="my-2 p-2 text-justify">
            En esta sección aparecen los intercambios que otros jugadores han
            hecho para ti, puedes aceptarlos o rechazarlos pero ten en cuenta
            que aceptar intercambio sube el indice para obtener premios y
            milestones.
        </p>
        <img class="p-2 mx-auto" :src="'/images/help3.png'" />

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Intercambios salientes - Outgoing exchanges
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/out.svg'" />
            <p class="my-2">Outgoing exchanges</p>
        </div>

        <p class="my-2 p-2 text-justify">
            En esta sección encontrarás las ofertas de intercambio realizadas
            por ti, por lo que puedes cancelar una oferta si te parece
            conveniente.
        </p>

           <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Mi perfil - My profile
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/profile.svg'" />
            <p class="my-2">My profile</p>
        </div>

        <p class="my-2 p-2 text-justify">
            Aqui puedes ver tu perfil de jugador, mostrando algunas estadisticas sobre cartas obtenidas, pegadas o intercambios. Cada vez que obtienes o pegas cartas, asi como aceptas intercambios, se suben las estadisticas.
            Cuando un indicador alcanza un numero significativo obtienes un premio. Los premios pueden ser del tipo intervalo o milestone, dependiendo de ello puedes reclamar una cantidad de tiquetes extra mediante dichos premios.
        </p>
        <img class="p-2 mx-auto" :src="'/images/profile.png'" />


        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Comprar tiquetes - Buy tickets
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/ticket3.svg'" />
            <p class="my-2">Buy tickets</p>
        </div>

        <p class="my-2 p-2 text-justify">
            En esta sección puedes comprar tiquetes gastando oro, cada tiquete
            cuesta 10000 de oro. Tienes las opciones de comprar 1, 10 o 20
            tiquetes dependiendo de tu la cantidad de oro que poseas.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Avatares - Avatars
        </h1>

        <p class="my-2 p-2 text-justify">
            Aqui se mostrarán los avatares que hayas obtenido mediante las
            cajas. Puedes cambiar tu imagen de perfil para personalización. Al
            hacer clic en la imagen de tu avatar, puedes seleccionar un avatar
            diferente, el avatar seleccionado se resaltará con un borde color
            verde . También puedes vender avatares repetidos. Cada avatar se
            vende por 10000 de oro.
        </p>
         <img class="p-2 mx-auto" :src="'/images/avatar.png'" />
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    name: "ProductCard",

    components: { AppLayout },

    props: {
        record: {
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
