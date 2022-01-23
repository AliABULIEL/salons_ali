<template>
    <div class="wrap">
        <div class="heading">
            <a :href="'/'+lang"><i class="fa fa-arrow-right"></i></a>
            <h2>{{ translate['quiz_results'] }}</h2>
            <p>{{ translate['quiz_results_description'] }}</p>
        </div>

        <template v-if="is_loading">
            <div class="spinner-border" ></div>    
        </template>
        <template v-else>
            <div class="trends-wrap">
                <div class="trends">
                    <div
                        class="trend"
                        v-for="(trend, index) in trends"
                        :key="index"
                    >
                        <div class="trend-number">
                            <h4>#{{ index + 1 }}</h4>
                        </div>
                        <div class="trend-body">
                            <h2>{{ trend.title[lang] }}</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit. Architecto omnis blanditiis pariatur molestias
                                dolorem, qui facilis error amet repellat animi
                                dolores nostrum. Dolores laudantium suscipit
                                tempora, eum laboriosam est libero.
                            </p>

                            <div class="professions">
                                <h5>{{ translate['professions'] }}:</h5>
                                <ul>
                                    <li
                                        v-for="(profession,
                                        idx) in trend.professions"
                                        :key="idx"
                                    >
                                        {{ profession.title[lang] }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import translates from './../Translates'
export default {
    data() {
        return {
            lang: window.lang,
            translate: translates[window.lang],
            trends: [],
            is_loading: true
        };
    },

    created() {
        if(!this.$route.query.hasOwnProperty('token')) {
            this.$router.push('/');
            return;
        }

        this.fetchData();
    },

    methods: {
        fetchData() {
        axios
            .post("/quizzes/json", {token: this.$route.query.token})
            .then((res) => {
                this.is_loading = false;
                if(res.data.status) {
                    this.trends = res.data.data.trends;
                } else {
                    alert(res.data.message);
                    this.$router.push('/');
                }
            })
            .catch((err) => {
                this.is_loading = false;
                alert("Server error");
            });
        },
    }
};
</script>

<style lang="scss" scoped>
.trend {
    display: flex;
    .trend-number {
        border-inline-end: 2px solid #999;
        padding-inline-end: 15px;
        margin-inline-end: 15px;
        h4 {
            font-size: 36px;
            color: #999;
            width: 60px;
        }
    }
    .trend-body {
        h2 {
            color: #2054a2;
            font-size: 36px;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 15px;
        }
    }
    .professions {
        padding-bottom: 50px;
        ul {
            padding-inline-start: 20px;
        }
    }
}

@media (max-width: 600px) {
    .trend {
        .trend-number h4 {
            font-size: 24px;
            width: 35px;
        }
        .trend-body {
            h2 {
                font-size: 24px;
            }
        }
    }
}
</style>
