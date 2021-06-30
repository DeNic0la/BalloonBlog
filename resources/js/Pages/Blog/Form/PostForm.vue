<template>
    <div class="min-h-screen bg-gray-100 p-0 sm:p-12">
        <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl" v-if="post">
            <h1 class="text-2xl font-bold mb-8">Header</h1>

                <form-input label-name="Header" :input-value="post.header" @change="newInputValue('header', $event)" error-message="Dies ist ein Pflichtfeld" :has-error="false" />

                <form-input label-name="Subheader" :input-value="post.subHeader" @change="newInputValue('subHeader', $event)" error-message="Dies ist ein Pflichtfeld" :has-error="false" />

                <form-input label-name="Text" :input-value="post.mainText" @change="newInputValue('mainText', $event)" error-message="Dies ist ein Pflichtfeld" :has-error="false" />

                <input type="file" class="form-control" v-on:change="fileChanged">

                <button
                    id="button"
                    type="button"
                    v-show="allFieldsAreFilled"
                    @click="$emit('formButtonClick')"
                    class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
                >
                    {{buttonName ?? 'Done'}}
                </button>
        </div>
    </div>
</template>

<script>
import FormInput from "./FormInput";

export default {
    name: "PostForm",
    components:{
        FormInput,
    },
    data: function (){
        return {

        }
    },
    methods:{
        newInputValue(field,value){
            this.post[field] = value;
            this.$emit('input',this.post);
        },
        fileChanged(e){
            this.post.image = e.target.files[0];
            this.$emit('input',this.post);
        }
    },
    computed:{
        allFieldsAreFilled(){
            return this.post.header.length > 0 &&
                this.post.subHeader.length > 0 &&
                this.post.mainText.length > 0;

        }
    },
    props:['post','buttonName'],
    emits: ['formButtonClick','input']
}
</script>

<!--style>
.-z-1 {
    z-index: -1;
}

.origin-0 {
    transform-origin: 0%;
}

input:focus ~ label,
input:not(:placeholder-shown) ~ label,
textarea:focus ~ label,
textarea:not(:placeholder-shown) ~ label,
select:focus ~ label,
select:not([value='']):valid ~ label {
    /* @apply transform; scale-75; -translate-y-6; */
    --tw-translate-x: 0;
    --tw-translate-y: 0;
    --tw-rotate: 0;
    --tw-skew-x: 0;
    --tw-skew-y: 0;
    transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate))
    skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    --tw-scale-x: 0.75;
    --tw-scale-y: 0.75;
    --tw-translate-y: -1.5rem;
}

input:focus ~ label,
select:focus ~ label {
    /* @apply text-black; left-0; */
    --tw-text-opacity: 1;
    color: rgba(0, 0, 0, var(--tw-text-opacity));
    left: 0px;
}
</style-->
