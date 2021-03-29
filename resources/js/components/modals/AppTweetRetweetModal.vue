<template>
    <div>
        <app-tweet-compose />
      <component class="border border-gray-700 rounded-lg mt-4 p-4" v-if="tweet" :is="`app-tweet-variant-${tweet.type}`" :tweet="tweet" />
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