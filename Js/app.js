var request = require('request'),
cheerio = require('cheerio');

request({url: 'http://thehackernews.com/', encoding: 'utf8'}, function(err, resp, body){
	if(!err && resp.statusCode == 200){
		//console.log(body);
		var $ = cheerio.load(body);
		$('.blog-posts .hnews h2 a').each(function(){
										var titulo = $(this).html();
										console.log(titulo+' \ ');
										});
	}
});