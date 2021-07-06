<template>
    <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="md:flex">
            <div class="md:flex-shrink-0" v-if="imgSrc">
                <img class="h-48 w-full object-cover md:w-48"
                     :src="imgSrc ?? ''"
                     alt="Blog Image">
            </div>
            <div class="p-8 flex flex-col justify-center text-left">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{subHeader ?? 'SubHeader'}}</div>
                <div class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{header ?? 'Header'}}</div>
                <p class="mt-2 text-gray-500">{{ (mainText.length > 500 ? mainText.substring(0,500)+"..." : mainText) ?? 'LoremIpsum'}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogCard",
    props: ['subHeader','header','mainText','imgSrc'],
}
</script>

<style scoped>

</style>
