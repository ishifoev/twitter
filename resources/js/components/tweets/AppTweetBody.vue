<template>
    <p class="text-gray-300 whitespace-pre-wrap">
        <component :is="body" />
    </p>
</template>
<script>
export default {
    props: {
        tweet: {
            required: true,
            type: Object
        }
    },
    computed: {
        body() {
            return {
                'template': `<div>${this.tweet.body} <app-tweet-hashtag-entity /></div>`
            }
        }
    }
}
</script>