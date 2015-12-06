var request = require('request');
var cheerio = require('cheerio');
var mysql 	= require('mysql');

//Conexión con base de datos
var connection = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: 'rsu2015',
	database: 'WebScrap'
});

//Conocer si existe conexión
connection.connect(function(error){
	if(error){
		throw error;
	}else{
		console.log('Conexion correcta.');
	}
});

//Seleccionar páginas
var queryNewsCategories='SELECT idNews, nameNews, siteNews, localizedNews, idCat, nameCat, siteCat, enabledCat, fkNewspapersCat FROM newspapers , categories WHERE idNews = fkNewspapersCat';
var query = connection.query(queryNewsCategories, function(error, result){
	if(error){
		console.log("Error en la sintaxis de SQL");
	}else{
		for (var i = 0; i <= result.length - 1; i++) {
			//console.log(i);
			//console.log(JSON.stringify(result[i]["siteCat"]));
		};
			var link = JSON.parse(JSON.stringify(result[0]["siteCat"]));
			console.log(link);
			request({url: link, encoding: 'utf8'}, function(err, resp, body){
				if(!err && resp.statusCode == 200){
					var $ = cheerio.load(body);
					console.log(body);
					$('.blog-posts .hnews h2 a').each(function(){
													var titulo = $(this).html();
													//console.log(titulo+' \ ');
													});
				}
				else{
					console.log("Error de extracción");
				}
			});
	}
	}
);


//web Scraping
/*
request({url: 'http://thehackernews.com/', encoding: 'utf8'}, function(err, resp, body){
	if(!err && resp.statusCode == 200){
		//console.log(body);
		var $ = cheerio.load(body);
		$('.blog-posts .hnews h2 a').each(function(){
										var titulo = $(this).html();
										console.log(titulo+' \ ');
										});
	}
	else{
		console.log("Error de extracción");
	}
});
*/

connection.end();