<template>
  <div class="wrap">
    <language></language>
    <div class="heading">
      <h2>{{ translate['home_title'] }}</h2>
      <p>{{ translate['home_description'] }}</p>
    </div>
    <!-- start questions -->

    <template v-if="quiz.start">
      <form action="#!" @submit.prevent="submit_answers">
        <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
          <div class="au-card-inner">
            <div class="questions-wrap">
              <div class="questions">
                <div class="question" v-for="(q, index) in questions" :key="index">
                  <div class="question-number">
                    <h4>#{{ index + 1 }}</h4>
                  </div>
                  <div class="question-info">
                    <p style="white-space: normal;">{{ q.title[lang] }}</p>
                    <div class="question-answers">
                      <div
                        class="form-check-inline"
                        v-for="(answer,
                                            idx) in default_answers"
                        :key="index + '_' + idx"
                      >
                        <label class="form-check-label">
                          <input
                            v-model="answers[q.id]"
                            :value="answer"
                            type="radio"
                            class="form-check-input"
                            :name="'radio_' + q.id"
                            @click="
                                                        select_answer(
                                                            q.id,
                                                            answer
                                                        )
                                                    "
                            required
                          />
                          {{ translate[answer] }}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end questions -->
        <div>
          <button type="submit" class="btn btn-primary btn-lg btn-block">
            {{ translate['submit'] }} &nbsp;
            <div class="spinner-border" v-show="is_loading"></div>
          </button>
        </div>
      </form>
    </template>
    <template v-else>
      <button class="btn btn-primary btn-lg" @click="start_quiz(true)">{{ translate['start_new_quiz'] }}</button>
      <button
        class="btn btn-primary btn-lg"
        @click="start_quiz(false)"
        v-show="quiz.resume"
      >{{ translate['resume_quiz'] }}</button>
    </template>
    <div class="spinner-border" v-show="main_loading"></div>
  </div>
</template>

<script>
import language from './Language'
import translates from './../Translates'
export default {
  data() {
    return {
      lang: window.lang,
      translate: translates[lang],
      quiz: {
        start: false,
        resume: false,
      },
      default_answers: ["yes", "no", "maybe"],
      questions: [],
      answers: {},
      is_loading: false,
      main_loading: true,
    };
  },

  created() {
    this.fetchData();
  },

  methods: {
    fetchData() {
      axios
        .get("/questions/json")
        .then((res) => {
          this.main_loading = false;
          this.questions = res.data;
          let local = this.get_localstorage("quiz_answers");
          if (Object.keys(local).length !== 0) {
            this.quiz.resume = true;
            this.answers = local;
          }
        })
        .catch((err) => {
          this.main_loading = false;
          alert("Server error");
        });
    },

    start_quiz(new_quiz) {
      if (new_quiz) {
        this.set_localstorage("quiz_answers", {});
        this.answers = {};
      }
      this.quiz.start = true;
    },

    set_localstorage(key, answers) {
      let local = localStorage.getItem(key) || {};
      localStorage.setItem(key, JSON.stringify(answers));
    },

    get_localstorage(key) {
      let local = localStorage.getItem(key);
      if (local) return JSON.parse(local);
      return {};
    },

    select_answer(question_id, answer) {
      this.answers[question_id] = answer;
      this.set_localstorage("quiz_answers", this.answers);
    },

    submit_answers() {
      this.is_loading = true;
      axios.post("/quizzes/create", { answers: this.answers }).then((res) => {
        this.is_loading = false;
        if (res.data.status) {
          this.set_localstorage("quiz_answers", {});
          this.$router.push("/result/" + window.lang +"?token=" + res.data.data.token);
        }
      });
    },
  },

  components: {
    language
  }
};
</script>

<style lang="scss" scoped>
.question {
  display: flex;

  .question-number {
    border-inline-end: 2px solid #fff;
    padding-inline-end: 15px;
    margin-inline-end: 15px;
    h4 {
      font-size: 20px;
      color: #ccc;
      width: 45px;
    }
  }

  .question-info {
    p,
    label {
      color: #fff;
    }
    p {
      margin-bottom: 10px;
    }
  }

  .form-check-inline {
    margin-inline-end: 30px;
    margin-right: 0;
  }

  &:not(:last-child) {
    .question-answers {
      padding-bottom: 50px;
    }
  }
}

@media (max-width: 600px) {
  .question {
    .question-number h4 {
      font-size: 16px;
      width: 30px;
    }
    .form-check-inline {
      margin-right: 15px;
    }
    .question-info p,
    .question-info label {
      font-size: 14px;
    }
  }

  .au-card-top-countries {
    padding: 25px;
  }
}
</style>
