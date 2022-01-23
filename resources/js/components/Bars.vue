<template>
    <div>
        <audio v-show="false" crossorigin="anonymous" controls ref="audio">
            <source :src="src">
        </audio>

        <av-bars 
            :canv-width="690"
            :canv-height="70"
            caps-color="#cffd52"
            bar-color="#fff"
            :caps-height="4" 
            :bar-width="4"
            :bar-space="5"
            :fft-size="1024 * 2"
            :symmetric="false"
            :cors-anonym="true"
            ref-link="audio"
        />
    </div>
</template>

<script>
    export default {
        props: ['src'],

        data() {
            return {
                isPlaying: false
            }
        },

        methods: {
            playAudio() {
                if (this.isPlaying) {
                    this.$refs.audio.pause();
                    this.isPlaying = false;
                }

                else {
                    this.$refs.audio.play();
                    this.isPlaying = true;
                }

            }
        }
    }
</script>
