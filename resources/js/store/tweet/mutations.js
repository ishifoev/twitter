import { get } from 'lodash';
export default {
        PUSH_TWEETS(state, data) {
            state.tweets.push(...data.filter((tweet)=>{
                return !state.tweets.map((t) => t.id).includes(tweet.id)
            }));
        },
        POP_TWEET(state, id) {
          state.tweets = state.tweets.filter((t) => {
             return t.id !== id
          })
        },
        SET_LIKES(state, {id,count}) {
           state.tweets = state.tweets.map((t) => {
              if(t.id === id) {
                  t.likes_count = count
              }
              if(get(t.originalTweet, 'id') === id) {
                  t.originalTweet.likes_count = count
              }
              return t
           })
        },

        SET_RETWEETS(state, {id,count}) {
            state.tweets = state.tweets.map((t) => {
               if(t.id === id) {
                   t.retweets_count = count
               }
               if(get(t.originalTweet, 'id') === id) {
                   t.originalTweet.retweets_count = count
               }
               return t
            })
         },
         SET_REPLIES(state, {id,count}) {
            state.tweets = state.tweets.map((t) => {
               if(t.id === id) {
                   t.replies_count = count
               }
               if(get(t.originalTweet, 'id') === id) {
                   t.originalTweet.replies_count = count
               }
               return t
            })
         }
    }