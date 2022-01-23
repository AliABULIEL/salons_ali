<template>
    <swiper class="swiper" :options="swiperOption">
        <swiper-slide v-for="(brand, index) in brands" :key="index">
            <a :href="`/${locale}/brand/${brand.id}`" class="bg-gray-100 p-6 rounded-md flex items-center justify-center h-32 sm:h-48 mb-8 hover:bg-gray-200">
                <img class="max-h-full" :src="brand.image ? brand.image['file_path'] : '' ">
            </a>
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
    </swiper>
</template>

<script>
    export default {
        props: ['locale', 'brands'],
        data() {
            return {
                swiperOption: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                    loop: true,

                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true
                    },

                    breakpoints: {
                        1024: {
                          slidesPerView: 5,
                          spaceBetween: 40
                        },
                        768: {
                          slidesPerView: 4,
                          spaceBetween: 30
                        },
                        640: {
                          slidesPerView: 3,
                          spaceBetween: 20
                        },
                        320: {
                          slidesPerView: 2,
                          spaceBetween: 10
                        }
                    }
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
</style>
