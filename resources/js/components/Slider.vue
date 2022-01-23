<template>
  <swiper class="swiper" :options="swiperOption">
    <swiper-slide v-for="(slide, index) in slides" :key="index">
        <div class="slide flex items-center justify-center flex-col mb-8" :style="{backgroundImage: 'url(' + slide.image + ')'}">
            <h2 class="px-4 text-2xl text-yellow-500 font-extrabold text-shadow sm:text-4xl">{{ slide.title || '' }}</h2>
            <h5 class="px-4 mt-3 text-lg text-white font-bold text-shadow sm:text-2xl">{{  slide.description || '' }}.</h5>
        </div>
    </swiper-slide>
    <!-- <swiper-slide>
        <div class="slide" style="background-image: url(/images/slides/2.jpg)"></div>
    </swiper-slide>-->
    <!-- <swiper-slide>
        <div class="slide" style="background-image: url(/images/slides/1.jpg)"></div>
    </swiper-slide> -->

    <div class="swiper-pagination" slot="pagination"></div>
  </swiper>
</template>

<script>
    export default {
        props: ['slides'],
        data() {
            return {
                swiperOption: {
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true
                    },
                }
            }
        }
    }
</script>

<style scoped>
    .slide {
        height: 700px;
        background-size: cover;
        background-position: center 40%;
    }

    @media only screen and (max-width: 600px) {
        .slide {
            height: 350px;
        }
    }
</style>
