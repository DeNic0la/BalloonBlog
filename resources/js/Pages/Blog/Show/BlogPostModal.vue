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
                <img :src="post.image?'/image?name='+post.image:'https://images.pexels.com/photos/5913195/pexels-photo-5913195.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500'" class="max-h-64 object-contain">
                <h1>
                    {{post.subHeader ?? ''}}
                </h1>
                <hr />
                <div>
                    {{post.mainText ?? ''}}
                </div>
            </div>
            <hr />
            <div class="flex flex-row content-evenly">
                <div class="h-16 w-16 flex place-items-center rounded-full content-center m-3 bg-red-700">
                    <span class="material-icons">share</span>
                </div>
                <button @click="like()" class="h-16 w-16 flex rounded-full place-items-center place-content-around m-3 bg-red-700 hover:bg-red-700 shadow-lg">
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

<script>import Modal from "../../../Jetstream/Modal";
import Button from "../../../Jetstream/Button";

export default {
    name: "BlogPostModal",
    components:{Button, Modal},
    props:['post','show'],
    emits:['close'],
    data:function () {
        return{
            isLiked: false,
            amountOfLikes: 0,
        }
    },
    methods: {
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
    mounted() {

    }
}
</script>

<style scoped>

</style>
