<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Statistiken
            </h2>
        </template>
        <vueper-slides :breakpoints="breakpoints" :dragging-distance="50">
            <vueper-slide v-for="(slide, i) in images" :key="i" :image="baseUrl+slide.src" />
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
    data: function(){
        return {
            images:[
                {
                    src: 'Test.JPG',
                },
                {
                    src: 'VeryStats.JPG',
                },
                {
                    src: 'YES.JPG',
                },
                {
                    src: 'work.JPG',
                },
            ],
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

<style scoped>

</style>



