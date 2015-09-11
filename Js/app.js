var request = require('request');
var cheerio = require('cheerio');

var mysql = require('mysql');
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
var query = connection.query('SELECT name, site FROM newspapers WHERE enabled="1"', function(error, result){
	if(error){
		throw error;
	}else{
		if(result.length > 0){
			console.log(result);
			console.log('\nSe encontraron '+result.length+' resultados\n');
		}else{
			console.log('Registro no encontrado');
		}
	}
	}
);



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



connection.end();