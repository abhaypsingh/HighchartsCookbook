var twitter = require('twitter');
client = new twitter({
    consumer_key: 'zUUFoRSQNsK4Ld3i4Gyhrg',
    consumer_secret: 'bejoU67eUVrPHEuvcuUJCp9noMdIjeOMBegk4CpIjg',
    access_token_key: '210869304-PphNafEKSOSVE5OjicTfbw7qUuwBSLDFKMHALTMw',
    access_token_secret: 'rg20JJBSrTgZhoVcY8TEzEEhgmiO1n4QOPSBSaR983tQT'
});

var express = require('express');
var app = express();
app.use(express.json());
app.use(express.static(__dirname));

var underscore = require('underscore');
app.get('/tweets/summary', function(request, response) {
    client.get('/statuses/user_timeline.json', {
        screen_name: 'nt3rp',
        include_entities: false,
        count: 200,
        trim_user: 1,
        include_rts: false
    }, function(data) {
        var tweets;
        
        // Simplify / clean-up data
        tweets = underscore.map(data, function(tweet) {
            return {
                created: new Date(tweet.created_at),
                text: tweet.text
            }
        });
        
        // Group commits by day
        tweets = underscore.countBy(tweets, function(tweet) {
            var date = tweet.created;
            var day = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            return day.getTime();
        });
                
        // Convert to list of lists
        tweets = underscore.pairs(tweets)
        
        // JSON can't have integer keys; convert string keys to ints again
        tweets = underscore.map(tweets, function(tweetSummary) {
            var date, monthYear, day;
        
            timestamp = parseInt(tweetSummary[0]);
            count = tweetSummary[1];
            
            date = new Date(timestamp);
            monthYear = (
                new Date(date.getFullYear(), date.getMonth(), 1)
            ).getTime();
            day = date.getDate();
            
            return [monthYear, day, count];
        });
        
        // Sort the dates; Highcharts has problems with unsorted data
        tweets = underscore.sortBy(tweets, function(x) {
            return x[0];
        });
        
        // Respond with result
        response.json(tweets);
    });
});

app.get('/tweets/summary', function(request, response) {
    client.get('/statuses/user_timeline.json', {
        screen_name: 'nt3rp',
        include_entities: false,
        count: 200,
        trim_user: 1,
        include_rts: false
    }, function(data) {
        response.json(data);
    });
});

app.listen(8888);
console.log('Listening on port 8888');
