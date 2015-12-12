var request = require('request');
var cheerio = require('cheerio');
var mysql 	= require('mysql');

//Conexión con base de datos
var pool  = mysql.createPool({
	host            : 'localhost',
	user            : 'root',
	password        : 'rsu2015',
	database		: 'WebScrap'
});

//Seleccionar páginas
var allCategories = pool.getConnection(function(err, connection) {
	var queryNewsCategories='SELECT idNews, nameNews, siteNews, localizedNews, idCat, nameCat, siteCat, enabledCat, fkNewspapersCat FROM newspapers , categories WHERE idNews = fkNewspapersCat';
	connection.query( queryNewsCategories, function(err, rows) {
		if (err) throw err;
		else{
			return rows;
		}
	});
});
console.log(JSON.parse(JSON.stringify(allCategories[0]["idCat"])));

/*

for (var index = 0; index <= rows.length - 1; index++) {
			option = JSON.parse(JSON.stringify(rows[index]["idCat"]));
			switch (option){

				//----EMOL Nacional----
				case 1:
					pool.getConnection(function(err, connection) {
						now = new Date();
						year = "" + now.getFullYear();
						month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
						day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
						hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
						minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
						second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
						var ahora = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
						console.log(ahora);

						var link = JSON.parse(JSON.stringify(rows[0]["siteCat"]));
						console.log(link);
						request({url: link, encoding: 'utf8'}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var $ = cheerio.load(body);

								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px h2 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								//console.log(titulo);

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(40);
									i++;
									});
								//;
								var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
								connection.query( queryCountNews, function(err, rows) {
									if (err) throw err;
									var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
									var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
									for (var j = 0; j < titulo.length; j++) {
										var newQueryInsert = queryInsert + "("+2+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
										valor++;
										//console.log(newQueryInsert);
	  									connection.query(newQueryInsert  , function(err){
											if(err) throw err;
										});
									}
								});
								
							}
							else{
								console.log("Error de extracción");
							}
						});
					});
					//console.log(titulo);
					break;
				
				default:
					//console.log("nueva opcion");
					break
			}
		}
		*/


