<template>
    <div class="flex w-full">
          <div class="mr-3">
              <img :src="tweet.user.avatar" class="w-12 rounded-full">
          </div>
          <div class="flex-grow">
              <app-tweet-username :user="tweet.user"/>
              <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>
              <component :is="`app-tweet-variant-${tweet.originalTweet.type}`" class="border border-gray-700 rounded-lg mt-4" :tweet="tweet.originalTweet"/>
          </div>
       </div>
</template>
<script>
export default {
    props: {
        tweet: {
            required: true,
            type: Object
        }
    }
}
</script>