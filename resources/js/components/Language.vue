<template>
  <div style="text-align: end">
    <select @change="select_language">
      <option value="ar" :selected="current_lang == 'ar'">العربية</option> 
      <option value="he" :selected="current_lang == 'he'">עברית</option> 
      <option value="en" :selected="current_lang == 'en'">English</option> 
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      languages: ['ar','en','he'],
      current_lang: window.lang
    }
  },

  created() {
    this.current_lang = this.get_localstorage('quiz_answers_lang');
  },

  methods: {
    select_language(e) {
      this.current_lang = e.target.value;
      window.lang = e.target.value;
      this.set_localstorage('quiz_answers_lang', this.current_lang);

      let path = this.$route.path;
      path = path.replace('/ar', '');
      path = path.replace('/he', '');
      path = path.replace('/en', '');
      if(path.length == 1) path = '';
      console.log(path);
      window.location.href = path + '/' + this.current_lang;
    },

    set_localstorage(key, lang) {
      localStorage.setItem(key, lang);
    },

    get_localstorage(key) {
      return localStorage.getItem(key);
    },
  }
}
</script>