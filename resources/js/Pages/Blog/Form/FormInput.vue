<template>
    <div class="relative z-0 w-full mb-5">
        <input
            type="text"
            placeholder=" "
            v-model="inputValue"
            v-on:change="$emit('change', $event.target.value)"
            name="{{labelName}}"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
            :class="{hasError: 'border-red-600'}"
        />
        <label for="{{labelName}}" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500" :class="{hasError: 'text-red-600'}">{{labelName ?? 'Feld'}}</label>
        <span v-show="hasError" class="text-sm text-red-600">{{errorMessage ?? ''}}</span>
    </div>
</template>

<script>
export default {
    name: "FormInput",
    props:['hasError','inputValue','errorMessage','labelName'],
    emits: ['change']

}
</script>

<style>
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
</style>
