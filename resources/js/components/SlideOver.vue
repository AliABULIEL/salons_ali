<template>
	<portal to="modals">
		<transition leave-active-class="duration-300">
			<div v-show="show" class="fixed inset-0 flex z-10">
			    <div class="absolute inset-0 overflow-hidden">
				    <transition
				      enter-active-class="ease-in-out duration-200"
				      enter-class="opacity-0"
				      enter-to-class="opacity-100"
				      leave-active-class="ease-in-out duration-200"
				      leave-class="opacity-100"
				      leave-to-class="opacity-0"
				    >
				        <div @click="close" v-show="show"  class="absolute inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>
				    </transition>

			        <section class="absolute inset-y-0 max-w-full flex" 
                        :class="direction + '-0'">

                        <!-- :enter-class="direction == 'end' && 'ltr' ? 'translate-x-full' : '-translate-x-full'" -->
                        <!-- :enter-class="direction == 'end' && 'rtl' ? '-translate-x-full' : 'translate-x-full'" -->

					    <transition
					      enter-active-class="transition ease-in-out duration-300 sm:duration-700 transform"
					      :enter-class="enterClass"
					      enter-to-class="translate-x-0"
					      leave-active-class="transform transition ease-in-out duration-300 sm:duration-700"
					      leave-class="translate-x-0"
					      :leave-to-class="enterClass"
					    >
				            <div v-show="show" class="flex w-screen " :class="[maxWidthClass, {'flex-row-reverse' : direction == 'start'}]">
                                <div @click="close" class="p-1 flex">
                                    <button  aria-label="Close sidebar" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"><svg stroke="currentColor" fill="none" viewBox="0 0 24 24" class="h-6 w-6 text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
				                <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll w-full">
				                    <slot></slot>
				                </div>

				            </div>
				        </transition>

			        </section>
			    </div>
			</div>
		</transition>
	</portal>
</template>

<script>
    export default {
        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
            direction: {
                default: 'end',
            },
        },

        data() {
            return {
                dir: '',
            }
        },

        mounted() {
            this.dir = document.body.dir;
        },

        methods: {
            close() {
                if (this.closeable) {
                    this.$emit('close')
                }
            }
        },

        watch: {
            show: {
                immediate: true,
                handler: (show) => {
                    if (show) {
                        document.body.style.overflow = 'hidden'
                    } else {
                        document.body.style.overflow = null
                    }
                }
            }
        },

        created() {
            const closeOnEscape = (e) => {
                if (e.key === 'Escape' && this.show) {
                    this.close()
                }
            }

            document.addEventListener('keydown', closeOnEscape)

            this.$once('hook:destroyed', () => {
                document.removeEventListener('keydown', closeOnEscape)
            })
        },

        computed: {
            maxWidthClass() {
                return {
                    'sm': 'max-w-sm',
                    'md': 'max-w-md',
                    'lg': 'max-w-lg',
                    'xl': 'max-w-xl',
                    '2xl': 'max-w-2xl',
                    '4xl': 'max-w-4xl'
                }[this.maxWidth]
            },

            enterClass() {
                if (this.direction == 'end') {
                    return this.dir == 'rtl' ? '-translate-x-full' : 'translate-x-full';
                }
                else {
                    return this.dir == 'rtl' ? 'translate-x-full' : '-translate-x-full';
                }
            },
        }
    }
</script>
