<template>
    <post-form :post="post" @input="post = $event" v-on:formButtonClick="createForm" />
</template>

<script>
import PostForm from "../Form/PostForm";

export default {
    name: "BlogCreateForm",
    components:{
        PostForm,
    },
    methods: {
        createForm(){
            let data = {}
            data.header = this.post.header;
            data.subHeader = this.post.subHeader;
            data.mainText = this.post.mainText;

            axios.post('/blog/add', data)
                .then(response =>{
                    if (response.status === 201){
                        //this.imgConfig.params.postId = response.data.id;
                        let data = new FormData();
                        data.append('file',this.post.image);
                        axios.post('/blog/add/image/'+response.data.id, data , this.imgConfig).then(res => {
                            window.location.href = "/blog";
                        });

                        //TODO Clean Redirect to Post
                        //
                        //this.$inertia.visit('/blog');
                        //this.$router.push('/blog');
                    }
                });
        }
    },
    data(){
        return{
            post: {subHeader: '', header: '', mainText:'', image: null},
            imgConfig: {headers: {'content-type': 'multipart/form-data'}},
        }
    },
    beforeCreated(){

    }
}
</script>

<style scoped>

</style>
