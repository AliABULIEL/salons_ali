<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3">
            <h1 class="text-center text-xl text-80 font-light">
                לפי התוכנית אליה הנך משויך, אתה רשאי לפרסם הנחה אחת <span>{{ plan }}</span>
            </h1>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    data() {
        return {
            lang: {
                every_day: 'כל יום',
                every_week: 'כל שבוע',
                every_month: 'כל חודש',
                unlimited: 'בלי הגבלה',
            }
        }
    },

    mounted() {
        //
    },

    computed: {
        plan() {
            return this.lang[this.card.type];
        },
    }
}
</script>
