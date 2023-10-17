import "./bootstrap";
import "../css/main.scss";
import "@protonemedia/laravel-splade/dist/style.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import FileInput from "@/components/FileInput.vue";

import 'swiper/css/bundle';
import {Autoplay} from "swiper/modules"

import vClickOutside from "click-outside-vue3";

import {Swiper,  SwiperSlide} from "swiper/vue"
import AddressAutocomplete from "@/components/AddressAutocomplete.vue";

const el = document.getElementById("app");

const app = createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true,
        "suppress_compile_errors": true,
        components: {
            Swiper,
            SwiperSlide,
            'file-input': FileInput,
            'address-input': AddressAutocomplete

        },
    }).use(vClickOutside);
app.config.globalProperties.window = window;
app.config.globalProperties.SwiperModules = [Autoplay];
app.mount(el)
