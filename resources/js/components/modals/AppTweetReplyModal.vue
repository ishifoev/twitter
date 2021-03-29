<template>
    <div>
       <component class="mb-4" v-if="tweet" :is="`app-tweet-variant-${tweet.type}`" :tweet="tweet" />
       <app-tweet-reply-compose @success="$emit('close')" v-if="tweet" :tweet="tweet" />
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