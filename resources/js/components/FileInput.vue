<script setup>
import {ref} from "vue";

defineProps({
    name: {
        type: String,
        required: true
    },
    title: {
        type: String,
        default: 'Your place',
        required: true,
    },
    data: {
        type: Object,
        required: true,
    },
    form: {
        type: Object,
        required: true,
    },
    max: {
      type: Number,
      required: false,
      default: '425px'
    }
})
let input = ref(null)
let currentImageUrl = ref('')

</script>

<template>
    <div class="w-full h-full min-w-[364px] min-h-[202px]" :style="{maxHeight: max}">
        <input :id="name" :name="name" ref="input" type="file" :data-validation-key="name" class="hidden"
               @change="(event) => {form[name] = event.target.files[0]; currentImageUrl = window.URL.createObjectURL(event.target.files[0])}"
        />
        <div v-if="Boolean(data[name]) || Boolean(currentImageUrl)"
             @click="input.click()"
             class="relative w-full h-full bg-[#f1f1f1] border-[0.75px] border-black transition-colors duration-300 hover:bg-gray-200 flex flex-col items-center justify-center gap-6 cursor-pointer">
            <img class="w-full h-full object-fill"
                 :src="data[name] && !currentImageUrl? data[name] : currentImageUrl" alt=""/>
        </div>
        <div
            @click="input.click()"
            v-else
            class="w-full h-full bg-[#f1f1f1] border-[0.75px] border-black transition-colors duration-300 hover:bg-gray-200 flex flex-col items-center justify-center gap-6 cursor-pointer">

            <span class="font-light text-[#292D32] text-xl">{{ title }}</span>
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_672_462" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30"
                      height="30">
                    <rect width="30" height="30" fill="#D9D9D9"/>
                </mask>
                <g mask="url(#mask0_672_462)">
                    <path
                        d="M8.125 25C6.22917 25 4.60938 24.3438 3.26562 23.0312C1.92188 21.7188 1.25 20.1146 1.25 18.2188C1.25 16.5938 1.73958 15.1458 2.71875 13.875C3.69792 12.6042 4.97917 11.7917 6.5625 11.4375C7.08333 9.52083 8.125 7.96875 9.6875 6.78125C11.25 5.59375 13.0208 5 15 5C17.4375 5 19.5052 5.84896 21.2031 7.54688C22.901 9.24479 23.75 11.3125 23.75 13.75C25.1875 13.9167 26.3802 14.5365 27.3281 15.6094C28.276 16.6823 28.75 17.9375 28.75 19.375C28.75 20.9375 28.2031 22.2656 27.1094 23.3594C26.0156 24.4531 24.6875 25 23.125 25H16.25C15.5625 25 14.974 24.7552 14.4844 24.2656C13.9948 23.776 13.75 23.1875 13.75 22.5V16.0625L11.75 18L10 16.25L15 11.25L20 16.25L18.25 18L16.25 16.0625V22.5H23.125C24 22.5 24.7396 22.1979 25.3438 21.5938C25.9479 20.9896 26.25 20.25 26.25 19.375C26.25 18.5 25.9479 17.7604 25.3438 17.1562C24.7396 16.5521 24 16.25 23.125 16.25H21.25V13.75C21.25 12.0208 20.6406 10.5469 19.4219 9.32812C18.2031 8.10938 16.7292 7.5 15 7.5C13.2708 7.5 11.7969 8.10938 10.5781 9.32812C9.35938 10.5469 8.75 12.0208 8.75 13.75H8.125C6.91667 13.75 5.88542 14.1771 5.03125 15.0313C4.17708 15.8854 3.75 16.9167 3.75 18.125C3.75 19.3333 4.17708 20.3646 5.03125 21.2188C5.88542 22.0729 6.91667 22.5 8.125 22.5H11.25V25H8.125Z"
                        fill="#1C1B1F"/>
                </g>
            </svg>
        </div>
    </div>
</template>

<style scoped>

</style>
