<template>
<app-layout>
<template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Home
    </h2>
</template>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <home-center-section />
        </div>
    </div>
</div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import HomeCenterSection from './HomeCenterSection';
export default {
    name: "HomeContainer",
    components:{AppLayout,HomeCenterSection}
}
</script>

<style scoped>

</style>
