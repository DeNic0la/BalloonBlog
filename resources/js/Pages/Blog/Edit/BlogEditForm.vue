<template>
    <post-form :post="post" @input="post = $event" :button-name="'Save'" v-on:formButtonClick="saveForm" />
</template>

<script>
import PostForm from "../Form/PostForm";

export default {
    name: "BlogEditForm",
    methods: {
        saveForm(){
            let data = {}
            if (this.oldPost.header !== this.post.header){
                data.header = this.post.header;
            }
            if (this.oldPost.subHeader !== this.post.subHeader){
                data.subHeader = this.post.subHeader;
            }
            if (this.oldPost.mainText !== this.post.mainText){
                data.mainText = this.post.mainText;
            }
            data.postId = this.post.id;


            axios.post('/blog/update', data)
                .then(response =>{
                    if (response.status === 200){

                    }
                });
            if (this.post.image !== null ){
                let imgData = new FormData();
                imgData.append('file',this.post.image);
                axios.post('/blog/add/image/'+this.post.id, imgData , this.imgConfig).then(res => {
                    window.location.href = "/blog";
                });
            }
            else {
                setTimeout(()=> {window.location.href = "/blog"},1000);
            }



        }
    },
    data(){
        return{
            imgConfig: {headers: {'content-type': 'multipart/form-data'}},
            oldPost: null,
        }
    },
    components:{
        PostForm,
    },
    props:['post'],
    mounted() {
        this.oldPost = Object.create(this.post);
        this.oldPost.header = this.post.header
        this.oldPost.subHeader = this.post.subHeader
        this.oldPost.mainText = this.post.mainText
        this.post.image = null;
    }
}
</script>

<style scoped>

</style>
