<template>
<section class="text-gray-700 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -m-4">
      <div v-for="post in card.content" class="p-4 w-1/4">
        <div class="h-full rounded-lg overflow-hidden card">
          <img class="lg:h-48 md:h-36 w-full object-cover object-center" :src="'/image/medium/' + post.image" alt="blog">
          <div class="p-6">
            
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                {{ post.title }}
            </h1>

            <div class="flex items-center flex-wrap ">
                <router-link :to="`/resources/posts/${post.id}`" class="no-underline font-bold dim text-primary">
                    קרא עוד
                    <svg style="transform: scaleX(-1)" class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M5 12h14"></path>
                      <path d="M12 5l7 7-7 7"></path>
                    </svg>
                </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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

    mounted() {
        //
    },
}
</script>
