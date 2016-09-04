// Vue.config.debug = true;

new Vue({
    el: '#app',

    data: {
        query: '',
        results: []
    },

    methods: {
        searchTweets: function() {

            $('#spinner').spin('flower');

            var resource = this.$resource('/api/twitter/search_tweets/' + encodeURI(this.query));
            resource.get()
                .then((response) => {
                    this.$set('results', response.json());
                    $('#spinner').spin(false);
                }, (response) => {
                    $('#spinner').spin(false);
                    console.error(response);
            });
        }
    }
});