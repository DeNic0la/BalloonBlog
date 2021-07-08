<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Statistiken
            </h2>
        </template>
        <vueper-slides :breakpoints="breakpoints" :dragging-distance="50">
            <vueper-slide v-for="(image, i) in images" :key="i" :image="baseUrl+image" />
        </vueper-slides>




    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import { VueperSlides, VueperSlide } from 'vueperslides';
import 'vueperslides/dist/vueperslides.css';

export default {
    name: "StatsContainer",
    components:{
        AppLayout, VueperSlides, VueperSlide
    },
    props:['images'],
    data: function(){
        return {
            baseUrl: process.env.MIX_APP_URL+'/stats/image?name=',
            breakpoints: {
                5000: {
                    slideRatio: 2 / 3
                },
                2000: {
                    slideRatio: 1 / 2
                },
                1200: {
                    slideRatio: 1 / 4
                },
                1100: {
                    slideRatio: 1 / 3
                },
                900: {
                    slideRatio: 1 / 2
                },
                600: {
                    slideRatio: 1 / 1,
                    arrows: false,
                    bulletsOutside: true
                },
            },
        }
    }
}
</script>

<style>
.vueperslides__arrow {color: black}
.vueperslides__arrow svg {stroke-width: 2}


.vueperslides__bullet .default {
    background-color: rgba(0, 0, 0, 0.3);
    border: none;
    box-shadow: none;
    transition: 1.0s;
    width: 16px;
    height: 16px;
}
.vueperslides__bullet--active .default {background-color: #000000;}

</style>



