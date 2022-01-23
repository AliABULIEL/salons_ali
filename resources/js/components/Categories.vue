<template>
    <div class="w-full mt-10 p-4 lg:p-0">
        <div class="border-b border-gray-700 w-full">
            <div class="space-y-4 sm:flex sm:items-baseline sm:space-y-0 sm:space-x-10">
                <h3 class="text-lg leading-6 font-medium text-gray-100 me-10">
                    اخر المقالات
                </h3>
                <div>
                    <nav class="-mb-px flex space-x-8">
                        <!-- <a href="#" class="whitespace-no-wrap pb-4 px-1 border-b-2 border-green-500 font-medium text-sm leading-5 text-green-600 focus:outline-none focus:text-green-800 focus:border-green-700 me-8" aria-current="page">
                            الكل
                        </a> -->

                        <button v-for="category in categories"
                            @click.prevent="activeCategory = category"
                            class="whitespace-no-wrap pb-4 px-1 border-b-2 font-medium text-sm leading-5 focus:outline-none me-8"
                            :class="activeCategory != category ? 
                                'border-transparent text-gray-500 hover:text-gray-400 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' :
                                'border-green-500 text-green-600 focus:text-green-800 focus:border-green-700'"
                        >
                            {{ category.name }}
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <section class="text-gray-400 bg-gray-900 body-font mt-5">
            <div class="flex flex-wrap -m-2">
                <div v-for="article in activeCategory.articles" :key="article.id" class="p-2 md:w-1/4">
                    
                    <slide-over :show="activeArticle == article" @close="activeArticle = null"> 
                        <div v-if="activeArticle">
                            <img 
                                class="w-full object-cover object-center" 
                                :src="'/images/large/' + activeArticle.image" :alt="activeArticle.title" 
                            />
                            <div class="px-4 py-5">
                                <h2 class="text-xl mb-4">{{ activeArticle.title }}</h2>
                                <p class="text-gray-600" v-html="activeArticle.content"></p>
                            </div>
                        </div>
                    </slide-over>

                   
                    <div @click="activeArticle = article" class="bg-black cursor-pointer h-full overflow-hidden rounded-lg">
                        <img 
                            class="w-full object-cover object-center" 
                            :src="'/images/large/' + article.image" :alt="article.title" 
                        />

                        <div class="px-3 py-2">
                            <h1 class="title-font leading-7 font-medium text-white mb-3">
                                {{ article.title }}
                            </h1>
                            <div class="flex items-center flex-wrap text-xs">
                                <a class="text-green-400 inline-flex items-center md:mb-2 lg:mb-0">
                                    المزيد
                                    <svg class="w-4 h-4 ms-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <span class="text-gray-500 me-3 inline-flex items-center lg:ms-auto md:ms-0 ms-auto leading-none text-sm pe-3 py-1 border-e-2 border-gray-800">
                                    <svg class="w-4 h-4 me-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    1.2K
                                </span>
                                <span class="text-gray-500 inline-flex items-center leading-none text-sm">
                                    <svg class="w-4 h-4 me-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>
                                    6
                                </span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: [
            'categories'
        ],

        data() {
            return {
                activeCategory: null,
                activeArticle: null,
            }
        },

        created() {
            this.activeCategory = this.categories[0];
        },

        methods: {
          playAudio() {
              this.$refs.audio.play();
          }
        }
    }
</script>
