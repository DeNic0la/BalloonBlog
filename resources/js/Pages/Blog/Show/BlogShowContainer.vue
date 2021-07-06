<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog
            </h2>
        </template>
        <div class="flex flex-col gap-2">
            <button v-for="post in posts" class="px-5 py-2" @click="showPost(post)">
                <blog-card :subHeader="post.subHeader" :header="post.header" :mainText="post.mainText" :img-src="post.image?'/image?name='+post.image:null"/>
            </button>
        </div>

        <blog-post-modal :show="modalPost !== null" :post="modalPost" @close="modalPost = null"/>



        <inertia-link v-if="$page.props.user && $page.props.user.role !== 'none'" href="/blog/create" class="fixed z-40 right-0 bottom-0 pr-5 pb-5">
            <blog-add-button />
        </inertia-link>

    </app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
import BlogCard from "./BlogCard";
import BlogAddButton from "./BlogAddButton";
import BlogPostModal from "./BlogPostModal";

export default {
    name: "BlogShowController",
    components:{
        AppLayout,
        BlogCard,
        BlogAddButton,
        BlogPostModal,
    },
    data:function () {
        return{
            modalPost: null,
        }
    },
    props:['posts','selectedPost'],
    methods: {
        showPost(post){
            this.modalPost = post;
        }
    },
    beforeMount() {
        this.modalPost = this.selectedPost??null;
    }
}
</script>

<style scoped>

</style>
