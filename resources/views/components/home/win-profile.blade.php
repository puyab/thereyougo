<x-splade-data default="{open: false}">
    <div @click="data.open = true">
    
        <div class="w-full h-full inset-0 flex items-center justify-center cursor-pointer">
            <div
                class="w-max h-max flex items-center justify-center bg-white rounded-[4999px] border-[1px] border-black py-1.5 px-3.5 md:py-3 md:px-7">
                <span class="text-black text-[8px] sm:text-sm font-inter lg:text-base font-semibold">Watch the
                    video</span>
            </div>
        </div>
    </div>
    <div v-if="data.open" class="fixed inset-0 bg-black/30 z-50 flex items-center justify-center">
        <iframe class="w-11/12 h-5/6 border-none outline-none rounded-xl z-10"
            src="https://www.youtube.com/embed/1wLEL4w7Zuc?si=0hnMcOOhEoMI_Jmu&amp;controls=0"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
        <div class="absolute inset-0 bg-transparent z-0" @click="data.open = false"></div>
    </div>
</x-splade-data>