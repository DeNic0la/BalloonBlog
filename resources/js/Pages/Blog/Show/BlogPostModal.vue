<template>
    <modal :show="show??true" >
        <div class="flex flex-col rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg"
            >
                <p class="font-semibold text-gray-800">{{post.header ?? ''}}</p>
                <button @click="$emit('close')">
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50">
                <img v-if="post.image" :src="'/image?name='+post.image" class="max-h-64 object-contain">
                <h1>
                    {{post.subHeader ?? ''}}
                </h1>
                <hr />
                <div>
                    {{post.mainText ?? ''}}
                </div>
            </div>
            <hr />
            <div class="flex flex-row content-evenly z-10" id="socialStuff">

                <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <div class="absolute mx-2" v-show="showCopyMessage">
                        <div class="bg-black text-white text-xs rounded py-1 px-4 right-0 bottom-full">
                            Link Kopiert
                            <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                        </div>
                    </div>
                </transition>
                <button class="h-16 w-16 flex rounded-full place-items-center place-content-around m-3 bg-blue-600 hover:bg-blue-700 shadow-lg" @click="sharePost()">
                    <span class="material-icons z-30">share</span>
                </button>
                <!-- This is Disabled until it Looks better -->
                <button v-if="false" @click="like()" class="h-16 w-16 flex rounded-full place-items-center place-content-around m-3 bg-red-700 hover:bg-red-700 shadow-lg">
                    <span class="material-icons h-16 w-16">{{isLiked?'favorite_balance':'favorite_border'}}</span>
                    {{amountOfLikes}}
                </button>
            </div>
            <hr />

            <div class="flex flex-row bg-gray-200 pt-1" v-if="$page.props.user && $page.props.user.role !== 'none'">
                <inertia-link :href="'/blog/edit?postId='+post.id" class="bg-blue-700 p-2 m-3 rounded">Edit</inertia-link>
                <button class="bg-red-700 p-2 m-3 rounded">Delete</button>
            </div>

        </div>
    </modal>
</template>


<script>
import Modal from "../../../Jetstream/Modal";



export default {
    name: "BlogPostModal",
    components:{Modal},
    props:['post','show'],
    emits:['close'],
    data:() => {
        return{
            showCopyMessage: false,
            isLiked: false,
            amountOfLikes: 0,
        }
    },
    methods:{
        sharePost(){
            const sharable = 'balloon.fioretti.info/blog?postId='+this.post.id;

            let CopyElement = document.createElement('input');
            let socialStuff = document.getElementById('socialStuff');

            CopyElement.value = sharable;
            socialStuff.appendChild(CopyElement);


            CopyElement.select();
            CopyElement.setSelectionRange(0, 99999);

            document.execCommand("copy");

            socialStuff.removeChild(CopyElement);
            this.showCopyMessage = true;
            setTimeout(()=>{
                this.showCopyMessage = false;
            },500);

            },
            like(){
                axios.post('/like', {
                    postId: this.post.id
                })
                .then(res => {
                    console.log(res);
                    try {
                        this.isLiked = res.data.state;
                    }
                    catch(e){

                    }
                })
            },
          },
          watch:{
            post: function(val){
                if (val=== null)
                    return
                axios.post('/like/info', {
                    postId: val.id
                }).then(res => {
                  try {
                      this.amountOfLikes = res.data.likeAmount ?? 0;
                      this.isLiked = res.data.userLike ?? false;
                  }
                  catch(e){

                  }
                });
            },
        },

}
</script>

<style scoped>

</style>
