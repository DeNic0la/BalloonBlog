<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit
            </h2>
        </template>

        <blog-edit-form :post="post" />

    </app-layout>
</template>

<script>
import BlogEditForm from "./BlogEditForm";
import AppLayout from "../../../Layouts/AppLayout";
export default {
    name: "BlogEditContainer",
    components: {BlogEditForm},
    props:['post'],
}
</script>

<style scoped>

</style>
