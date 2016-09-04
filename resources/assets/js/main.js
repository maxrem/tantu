Vue.config.debug = true;


new Vue({
    el: '#app',

    data: {
        query: '',
        results: []
    },

    methods: {
        searchTweets: function() {
            var resource = this.$resource('/api/twitter/search_tweets/' + encodeURI(this.query));
            resource.get()
                .then((response) => {
                    this.$set('results', response.json())
                }, (response) => {
                    console.error(response);
            });
        }
    }
});

