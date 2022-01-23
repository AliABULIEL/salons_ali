<template>

    <nav class="bg-gray-900 bg-opacity-50 sticky top-0 w-full z-10" style="backdrop-filter: blur(15px);">
        <div class="container mx-auto">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 start-0 flex items-center lg:hidden">
                    <button @click="toggle"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                        aria-label="Main menu"
                        aria-expanded="false"
                    >
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center lg:items-stretch lg:justify-start">
                    <a href="/" class="flex-shrink-0">
                        <img class="block lg:hidden h-12 w-auto" src="/images/logo.png" />
                        <img class="hidden lg:block h-12 w-auto" src="/images/logo.png" alt="Workflow logo" />
                    </a>
                    <div class="hidden lg:flex lg:ms-10">
                        <div class="flex items-center justify-center">
                            <a href="/" class="px-3 py-2 rounded-md font-medium leading-5 text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                                الرئيسية
                            </a>

                            <a @click.prevent="showListSlider = true" href="#" class="ms-4 px-3 py-2 rounded-md font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                                البرامج
                            </a>
                            <a :href="`/${locale}/category`" class="ms-4 px-3 py-2 rounded-md font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                                التسجيلات
                            </a>
                            <a :href="`/${locale}/contact`" class="ms-4 px-3 py-2 rounded-md font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                                الاخبار
                            </a>
                            <a :href="`/${locale}/blog`" class="ms-4 px-3 py-2 rounded-md font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                                تواصل معنا
                            </a>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-y-0 end-0 flex items-center lg:static lg:inset-auto lg:ms-6 lg:pe-0">
                    <button class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out" aria-label="Notifications">
                      <!-- Heroicon name: bell -->
                      <svg class="h-6 w-6 dont-flip" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'max-h-screen': showMobileNavigation}" class="max-h-0 overflow-hidden transition-all duration-500 ease-out-in">
            <div class="px-2 pt-2 pb-3">
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                    الرئيسية
                </a>
                <a @click.prevent="showListSlider = true;" href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                    البرامج
                </a>
                <a :href="`/${locale}/category`" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                    التسجيلات
                </a>
                <a :href="`/${locale}/contact`" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                    الاخبار
                </a>
                <a :href="`/${locale}/blog`" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                    تواصل معنا
                </a>
            </div>
        </div>

        <slide-over direction="start" :show="showListSlider" @close="showListSlider = false" maxWidth="xl">
            <slot></slot>
        </slide-over>
    </nav>
</template>

<script>
    export default {
        props: ['locale'],
        data() {
            return {
                showMobileNavigation: false,
                showListSlider: false,
            }
        },
        methods: {
            toggle() {
                this.showMobileNavigation = !this.showMobileNavigation;
            },
        }
    }
</script>
