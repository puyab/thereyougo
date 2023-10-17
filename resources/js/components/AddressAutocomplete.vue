<script setup lang="ts">
import {inject, onMounted, ref} from "vue";

let input = ref(null);
const geocoder = new window.google.maps.Geocoder

const {form, name} = defineProps({
  name: {
    type: String,
    required: true
  },
  placeholder: {
    type: String,
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
})

const Splade = inject("$splade");


onMounted(() => {
  const autocomplete = new window.google.maps.places.Autocomplete(input.value);
  autocomplete.addListener('place_changed', () => {
    const place = autocomplete.getPlace();
    geocoder.geocode({placeId: place.place_id}, (results, status) => {
      if (status === window.google.maps.GeocoderStatus.OK) {
        const result = results[0];
        form.latitude = result.geometry.location.lat();
        form.longitude = result.geometry.location.lng();
        form.location = place.formatted_address
      }
    })
  })
})
</script>

<template>
  <div
    class="w-full h-max flex flex-col gap-2"
  >
    <input :id="name" :name="name" ref="input" type="text"
           class='w-full bg-transparent border-0 border-b-[1px] border-b-black placeholder:text-black text-3xl font-light'
           :placeholder="placeholder"
           :value="form.location"
    />
    <span class="text-red-500 font-semibold text-lg" v-show="form.errors.location"
          v-text="form.errors.location"></span>
    <span class="text-red-500 font-semibold text-lg" v-show="form.errors.longitude"
          v-text="form.errors.longitude"></span>
    <span class="text-red-500 font-semibold text-lg"
          v-show="form.errors.latitude"
          v-text="form.errors.latitude"></span>
  </div>
</template>

<style scoped>

</style>
