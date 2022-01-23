<template>
    <div class="flex items-center justify-center relative">
        <div @click="open = ! open">
            <slot name="trigger"></slot>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false">
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                    class="absolute z-50 mt-2 rounded-md shadow-lg"
                    :class="[widthClass, alignmentClasses]"
                    style="display: none;"
                    @click="open = false">
                <div class="rounded-md shadow-xs" :class="contentClasses">
                    <slot name="content"></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: {
            align: {
                default: 'end'
            },
            width: {
                default: '48'
            },
            contentClasses: {
                default: () => ['py-1', 'bg-white']
            }
        },

        data() {
            return {
                open: false
            }
        },

        created() {
            const closeOnEscape = (e) => {
                if (this.open && e.keyCode === 27) {
                    this.open = false
                }
            }

            this.$once('hook:destroyed', () => {
                document.removeEventListener('keydown', closeOnEscape)
            })

            document.addEventListener('keydown', closeOnEscape)
        },

        computed: {
            widthClass() {
                return {
                    '48': 'w-48',
                }[this.width.toString()]
            },

            alignmentClasses() {
                if (this.align == 'start') {
                    return 'origin-top-start start-0'
                } else if (this.align == 'end') {
                    return 'origin-top-end end-0 top-0 mt-8'
                } else if (this.align == 'top') {
                    return 'bottom-full end-0 me-2 sm:start-0 sm:ms-2 '
                } else {
                    return 'bottom-full end-0 mb-3'
                }
            },
        }
    }
</script>
