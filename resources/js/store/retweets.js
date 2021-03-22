export default  {
    namespaced: true,

    state: {
        retweets: []
    },
    getters: {
        retweets(state) {
            return state.retweets
        }
    },

    mutations: {
        PUSH_RETWEETS(state, data) {
            state.retweets.push(...data)
        }
    },
    actions: {
        async retweetTweet(_,tweet) {
            await axios.post(`/api/tweets/${tweet.id}/retweets`)
         },
         async unretweetTweet(_,tweet) {
             await axios.delete(`/api/tweets/${tweet.id}/retweets`)
         },
    }
}