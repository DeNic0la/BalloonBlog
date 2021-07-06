<template>
    <post-form v-if="!isLoading" :post="post" @input="post = $event" :button-name="'Post'" v-on:formButtonClick="createForm" />
    <div v-else class="flex justify-center my-20">
        <div class="text-gray-800">
            {{loadingMessage}}
        </div>
    </div>
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
            this.isLoading = true;
            let data = {}
            data.header = this.post.header;
            data.subHeader = this.post.subHeader;
            data.mainText = this.post.mainText;


            axios.post('/blog/add', data)
                .then(response =>{
                    if (response.status === 201){
                        if (this.post.image === null){
                            window.location.href = "/blog";
                            this.loadingMessage = 'Fertig!';
                        }
                        else{
                            this.loadingMessage = 'Bild wird Hochgeladen...';
                            let data = new FormData();
                            data.append('file',this.post.image);
                            axios.post('/blog/add/image/'+response.data.id, data , this.imgConfig).then(res => {
                                window.location.href = "/blog";
                                this.loadingMessage = 'Fertig!';
                            }).catch(()=>{
                                this.onUploadError();
                            });
                        }
                    }
                })
                .catch(()=>{
                    this.onUploadError();
                });
        },
        onUploadError(){
            this.loadingMessage = 'Es ist ein Fehler aufgetretten! Du wirst Weitergeleitet';
            setTimeout(()=>{
                //window.location.href = "/blog";
            },5000)
        }
    },
    data(){
        return{
            post: {subHeader: '', header: '', mainText:'', image: null},
            imgConfig: {headers: {'content-type': 'multipart/form-data'}},
            isLoading: false,
            loadingMessage: 'Uploading...'
        }
    },
    beforeCreated(){

    }
}
</script>

<style scoped>

</style>
