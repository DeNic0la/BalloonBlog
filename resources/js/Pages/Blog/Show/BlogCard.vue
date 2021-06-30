<template>
    <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="md:flex">
            <div class="md:flex-shrink-0">
                <img class="h-48 w-full object-cover md:w-48"
                     :src="imgSrc ?? 'https://images.unsplash.com/photo-1478098711619-5ab0b478d6e6?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=448&q=80'"
                     alt="Blog Image">
            </div>
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{subHeader ?? 'SubHeader'}}</div>
                <div class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{header ?? 'Header'}}</div>
                <p class="mt-2 text-gray-500">{{mainText ?? 'LoremIpsum'}}</p>
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
