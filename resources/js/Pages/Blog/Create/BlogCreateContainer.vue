<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Post
            </h2>
        </template>

        <blog-create-form />

    </app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
import BlogCreateForm from "./BlogCreateForm";

export default {
    name: "BlogCreateContainer",
    components:{
        AppLayout,
        BlogCreateForm,
    },
}
</script>

<style scoped>

</style>
