import axios from 'axios';
import { get } from 'lodash';
export default {
    namespaced: true,
    state: {
        tweets: []
    },
    getters: {
       tweets(state) {
           return state.tweets.sort((a,b) => b.created_at - a.created_at)
       }
    },
    mutations: {
        PUSH_TWEETS(state, data) {
            state.tweets.push(...data.filter((tweet)=>{
                return !state.tweets.map((t) => t.id).includes(tweet.id)
            }));
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
         }
    },
    actions: {
        async getTweets({ commit }, url) {
            let response = await axios.get(url)
            commit('PUSH_TWEETS', response.data.data)
            commit('likes/PUSH_LIKES', response.data.meta.likes, {root: true})
            commit('retweets/PUSH_RETWEETS', response.data.meta.retweets, {root: true})
            return response
         }
    }
}