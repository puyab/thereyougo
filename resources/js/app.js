import "./bootstrap";
import "../css/main.scss";
import "@protonemedia/laravel-splade/dist/style.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import FileInput from "@/components/FileInput.vue";

const el = document.getElementById("app");

const app = createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true,
        components: {
            'file-input': FileInput
        }
    });
app.config.globalProperties.window = window;
app.mount(el)
