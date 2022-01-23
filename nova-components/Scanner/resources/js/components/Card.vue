<template>
    <loading-card class="px-6 py-8" :loading="loading">
            <h1 class="text-3xl text-90 font-normal">Order Check</h1>
            <p class="mb-3 text-70 font-normal text-xl mt-3 mb-6">Enter the order code:</p>

            <CodeInput :key="show" :loading="false" class="input" v-on:complete="onComplete" ref="input" />
    </loading-card>
</template>

<script>
import CodeInput from "vue-verification-code-input";

export default {
    components: {
        CodeInput
    },
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    data() {
        return {
            code: '',
            loading: false,
            show: 1,
        }
    },

    mounted() {
        //
    },

    methods: {
        onComplete(v) {
            this.scan(v);
        },

        scan(code) {
            this.loading = true;

            Nova.request().post('/nova-vendor/scanner/scan', {
                code: code
            }).then(response => {
                this.loading = false;
                this.$toasted.show(response.data.message, { type: response.data.status });

                this.$nextTick(() => {
                    this.show++;
                })
            }).catch(error => {
                this.loading = false;
            });
        }
    }
}
</script>

<style>
    .react-code-input>input{
        font-family: inherit !important;
    }
</style>
