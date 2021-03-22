<template>
<div>
 <app-dropdown v-if="!retweeted">
          <template slot="trigger">
              <app-tweet-retweet-action-button :tweet="tweet" />
          </template>
        <app-dropdown-item @click.prevent="retweetOrUnretweet">
            Retweet
        </app-dropdown-item>
       <app-dropdown-item>
            Retweet with comment
        </app-dropdown-item>
      </app-dropdown>                    
    <app-tweet-retweet-action-button @click.prevent="retweetOrUnretweet" :tweet="tweet" v-else />
</div>
     
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    props: {
        tweet: {
            required: true,
            type: Object
        }
    },
    computed: {
        ...mapGetters({
            retweets: 'retweets/retweets'
        }),
        retweeted() {
            return this.retweets.includes(this.tweet.id)
        }
    },
    methods: {
        ...mapActions({
            retweetTweet: 'retweets/retweetTweet',
            unretweetTweet: 'retweets/unretweetTweet'
        }),
        retweetOrUnretweet() {
           if(this.retweeted) {
               this.unretweetTweet(this.tweet)
               return
           }
            this.retweetTweet(this.tweet)
        }
    }
}
</script>