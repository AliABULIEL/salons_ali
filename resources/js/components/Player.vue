<template>
    <swiper class="rotate" ref="swiper" :options="swiperOption">
        <swiper-slide>
            <div class="bg-black text-white rounded-lg shadow-lg w-full flex flex-col overflow-hidden">   
                <div class="relative">
                    <img @click="play" class="cursor-pointer object-cover object-center w-full" src="https://scontent.ftlv1-1.fna.fbcdn.net/v/t1.0-9/100734376_162143648620715_5219129225990111232_o.jpg?_nc_cat=111&ccb=2&_nc_sid=e3f864&_nc_ohc=e3JoQLW-QeYAX-H04e1&_nc_ht=scontent.ftlv1-1.fna&oh=4ce27a830cc66c2aa17d6c7397ce2e11&oe=6019F377">

                    <div class="absolute bg-gradient-to-b bottom-0 from-transparent h-3/4 opacity-75 to-black w-full"></div>

                    <div class="absolute bottom-0 w-full flex justify-center">
                        <bars ref="bars" :src="stream"></bars>
                    </div>
                </div>

                <div class="swiper-no-swiping2 min-w-0 flex flex-1 px-6 py-8 items-center">
                    <svg @click="play" class="cursor-pointer border-2 border-white flex-shrink-0 h-16 p-4 rounded-full w-16" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none"></rect><path d="M232.3125,114.34375,88.34375,26.35937A15.99781,15.99781,0,0,0,64,40.00781V215.99219a16.00521,16.00521,0,0,0,24.34375,13.64843L232.3125,141.65625a16.00727,16.00727,0,0,0,0-27.3125Z"></path>
                    </svg>

                    <div class="ms-6">
                        <div class="text-xl leading-7 font-medium text-gray-200 truncate">بالمختص المفيد</div>
                        <div class="mt-3 flex items-center text-sm leading-5 text-gray-400">
                            <svg class="flex-shrink-0 me-1 h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"></path>
                            </svg>

                            <span class="font-light">منى العمري</span>

                            <svg class="ms-6 flex-shrink-0 me-1 h-4 w-4 text-gray-300 dont-flip" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>

                            <span class="font-light">اليوم</span>
                        </div>
                        <p class="mt-2 text-gray-300 leading-5 font-light">
                            لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه
                        </p>
                    </div>
                </div>
            </div>
        </swiper-slide>

        <swiper-slide>
            <div class="bg-black text-white rounded-lg w-full flex flex-col overflow-hidden">   
                <div class="relative">
                    <img class="object-cover object-center w-full" src="/images/categories/1.jpg">
                    <div class="absolute bg-gradient-to-b bottom-0 from-transparent h-3/4 opacity-75 to-black w-full"></div>

                    <div class="absolute bottom-0 w-full flex justify-center">
                        <bars :src="stream"></bars>
                    </div>
                </div>

                <div class="min-w-0 flex flex-1 px-6 py-8 items-center">
                    <svg @click="play" class="border-2 border-white flex-shrink-0 h-16 p-4 rounded-full w-16" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none"></rect><path d="M232.3125,114.34375,88.34375,26.35937A15.99781,15.99781,0,0,0,64,40.00781V215.99219a16.00521,16.00521,0,0,0,24.34375,13.64843L232.3125,141.65625a16.00727,16.00727,0,0,0,0-27.3125Z"></path>
                    </svg>

                    <div class="ms-6">
                        <div class="text-xl leading-7 font-medium text-gray-200 truncate">بالمختص المفيد</div>
                        <div class="mt-3 flex items-center text-sm leading-5 text-gray-400">
                            <svg class="flex-shrink-0 me-1 h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"></path>
                            </svg>

                            <span class="font-light">منى العمري</span>

                            <svg class="ms-6 flex-shrink-0 me-1 h-4 w-4 text-gray-300 dont-flip" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>

                            <span class="font-light">اليوم</span>
                        </div>
                        <p class="mt-2 text-gray-300 leading-5 font-light">
                            لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه
                        </p>
                    </div>
                </div>
            </div>
        </swiper-slide>

        <!-- <div class="swiper-pagination" slot="pagination"></div> -->
    </swiper>
</template>

<script>
    export default {
        data() {
            return {
                stream: 'https://cdna.streamgates.net/RadioNas/Live-Audio/icecast.audio',
                showSwiper: true,

                swiperOption: {
                    effect: 'cube',
                    grabCursor: false,
                    cubeEffect: {
                        shadow: true,
                        slideShadows: true,
                        shadowOffset: 20,
                        shadowScale: 0.94
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        dynamicBullets: true,
                        clickable: true,
                    }
                }
            }
        },
        mounted() {
            // setTimeout(() => {
            //     this.width = document.querySelector(".swiper").offsetWidth + 'px';
            //     this.height = document.querySelector(".swiper").offsetHeight + 140 +  'px';
            //     this.showSwiper = true;        
            // }, 500)
        },
        methods: {
            play() {
                console.log(1);
                this.$refs.bars.playAudio();
            }
        }
    }
</script>

<style scoped>
    @media (min-width: 1024px) {
        .rotate {
            transform: perspective(1000px) rotateY(-14deg) scaleY(0.94) scaleX(1.04) translateX(-2%);
        }
    }
</style>
