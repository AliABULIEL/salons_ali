<template>
    <section v-cloak :class="{ rtl: lang!='en' }">
        <div class="container">
            <router-view></router-view>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            lang: window.lang
        }
    }
};
</script>

<style lang="scss">
.rtl{
    direction: rtl;
    text-align: right;
}
.wrap {
    max-width: 992px;
    width: 100%;
    margin: 30px auto 30px auto;
    padding: 30px;
    background-color: #eee;
    border-radius: 4px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
.heading {
    padding: 30px 0;
}

@keyframes spinner-border {
    to {
        transform: rotate(360deg);
    }
}

.spinner-border {
    position: relative;
    display: inline-block;
    width: 2rem;
    height: 2rem;
    overflow: hidden;
    text-indent: -999em;
    vertical-align: text-bottom;
    border: 0.25em solid;
    border-color: currentColor transparent currentColor currentColor;
    border-radius: 50%;
    animation-name: spinner-border;
    animation-duration: 0.75s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
    border-width: 0.2em;

    &.spinner-border-reverse::after {
        border-width: 0.2em;
    }
}

@media (max-width: 600px) {
    .wrap {
        padding: 15px;
    }
}
</style>
