var request = require('request');
var cheerio = require('cheerio');
var mysql 	= require('mysql');;                                               
var iconv 	= require('iconv');    

//Conexión con base de datos
var pool  = mysql.createPool({
	host            : 'localhost',
	user            : 'root',
	password        : 'diezdiez',
	database		: 'WebScrap'
});

//Seleccionar páginas
pool.getConnection(function(err, connection) {
	var queryNewsCategories='SELECT idNews, nameNews, siteNews, localizedNews, idCat, nameCat, siteCat, enabledCat, fkNewspapersCat FROM newspapers , categories WHERE idNews = fkNewspapersCat';
	connection.query( queryNewsCategories, function(err, rows) {
		if (err) throw err;
		pool.getConnection(function(err, connection) {
			for (var index = 0; index <= rows.length - 1; index++) {
				option = JSON.parse(JSON.stringify(rows[index]["idCat"]));
				now = new Date();
				year = "" + now.getFullYear();
				month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
				day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
				hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
				minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
				second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
				var ahora = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
				//console.log(ahora);

				switch (option){
			/*
					case 1: // EMOL Nacional
						var link = JSON.parse(JSON.stringify(rows[0]["siteCat"]));
						request({url: link, chatset: 'utf-8'}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var $ = cheerio.load(body);
								
								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px h2 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Titulares EMOL Nacional");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(40);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Nacional");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 1 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Nacional");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;

					case 2: // EMOL Internacional
						var link = JSON.parse(JSON.stringify(rows[1]["siteCat"]));
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
								console.log();
								console.log("Titulares EMOL Internacional");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(40);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Internacional");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 2 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Internacional");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
					
					case 3: // EMOL Tecnología
						var link = JSON.parse(JSON.stringify(rows[2]["siteCat"]));
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
								console.log();
								console.log("Titulares EMOL Tecnología");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(40);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Tecnología");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 3 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Tecnología");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
						
					case 4: // EMOL Educación
						var link = JSON.parse(JSON.stringify(rows[3]["siteCat"]));
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
								console.log();
								console.log("Titulares EMOL Educación");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia_txt .col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(40);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Educación");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 4 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Educación");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
						
					case 5: // EMOL Economía
						var link = JSON.parse(JSON.stringify(rows[4]["siteCat"]));
						request({url: link, encoding: 'utf8'}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var $ = cheerio.load(body);

								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.col_center_noticia2-390px h3 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Titulares EMOL Economía");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(50);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Economía");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 5 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Economía");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;

					case 6: // EMOL Deporte
						var link = JSON.parse(JSON.stringify(rows[5]["siteCat"]));
						request({url: link, encoding: 'utf8'}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var $ = cheerio.load(body);

								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.col_center_noticia2-390px h3 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Titulares EMOL Deporte");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_noticia2-390px p').each(function(){
									descripcion[i] = $(this).html().toString().slice(50);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Deporte");
								console.log(descripcion);
								console.log();
	
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 6 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Deporte");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;

					case 7: // EMOL Multimedia
						var link = JSON.parse(JSON.stringify(rows[6]["siteCat"]));
						request({url: link, encoding: 'utf8'}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var $ = cheerio.load(body);

								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.col_center_txt h1 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Titulares EMOL Multimedia");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col_center_txt p').each(function(){
									descripcion[i] = $(this).html().toString().slice(0,-63);
									i++;
									});
								console.log();
								console.log("Descripción EMOL Multimedia");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 7 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en EMOL Multimedia");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;

					case 8: // EMOL Tendencias
						var link = JSON.parse(JSON.stringify(rows[7]["siteCat"]));
						request({url: link, encoding: 'utf8'}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var $ = cheerio.load(body);

								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.cont_378_e_2015 .dest_ten_cent h2 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Titulares EMOL Tendencias");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.cont_378_e_2015 .dest_ten_cent p').each(function(){
									descripcion[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Descripción EMOL Tendencias");
								console.log(descripcion);
								console.log();

								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											//console.log ("j: "+j);
											var newQueryInsert = queryInsert + "("+1+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
											//console.log(newQueryInsert);
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 8 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
													//console.log(results);
												});
											});
										}
									});
								}
								else{ 
									console.log("no se guarda en EMOL Tendencias");}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
		*/
					case 9: // LA TERCERA Nacional
						var link = JSON.parse(JSON.stringify(rows[8]["siteCat"]));
						request({url: link,encoding: null }, function(err, resp, body){
							if(!err && resp.statusCode == 200){ 

								//var $ = iconv.decode(new Buffer(body), "ISO-8859-1"); 
								//console.log($);

								var ic = new iconv.Iconv('iso-8859-1', 'utf-8');                              
								var buf = ic.convert(body);                                                   
								var utf8String = buf.toString('utf-8');  
								var $ = cheerio.load(utf8String)


								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.col13of31inside13 .notatipo h2 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Titulares LA TERCERA Nacional");
								console.log(titulo);
								console.log();

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.col13of31inside13 .notatipo p').each(function(){
									descripcion[i] = $(this).html().toString();
									i++;
									});
								console.log();
								console.log("Descripción LA TERCERA Nacional");
								console.log(descripcion);
								console.log();
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+2+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j].replace('&#xFFFD;',' ')+"' , '"+titulo[j].replace('&#xFFFD;',' ')+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 1 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en opcion: "+option);}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
					case 10: // LA TERCERA Internacional
						break;

					case 11: // LA TERCERA Deporte
						break;

					case 12: // LA TERCERA Tendencias
						break;

					case 13: // LA TERCERA Cultura
						break;

					case 14: // LA TERCERA Política
						break;

					case 15: // LA TERCERA Economía
						break;

			/*		case 16: // LA CUARTA Internacional
						var link = JSON.parse(JSON.stringify(rows[15]["siteCat"]));
						console.log(link);
						request({url: link, decoding: null}, function(err, resp, body){
							if(!err && resp.statusCode == 200){                                                   
								var ic = new iconv.Iconv('iso-8859-1', 'utf-8');                              
								var buf = ic.convert(body);                                                   
								var utf8String = buf.toString('utf-8');  

								var $ = cheerio.load(utf8String);
								
								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.trecientos_canal .L4ta_canalGene h3 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								console.log(titulo);

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.trecientos_canal .L4ta_canalGene p').each(function(){
									descripcion[i] = $(this).html().toString();
									i++;
									});
								console.log(descripcion);
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+4+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 2 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en opcion: "+option);}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break; */
/*
					case 17: // LA CUARTA Deporte
						var link = JSON.parse(JSON.stringify(rows[16]["siteCat"]));
						request({url: link, encoding: null}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var ic = new iconv.Iconv('iso-8859-1', 'utf-8');                              
								var buf = ic.convert(body);                                                   
								var utf8String = buf.toString('utf-8'); 

								var $ = cheerio.load(utf8String);
								
								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.trecientos_canal .L4ta_canalGene h3 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								//console.log(titulo);

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.trecientos_canal .L4ta_canalGene p').each(function(){
									descripcion[i] = $(this).html().toString();
									i++;
									});
								//console.log(descripcion);
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+4+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 1 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en opcion: "+option);}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
*/  /*
					case 18: // LA CUARTA Nacional
						var link = JSON.parse(JSON.stringify(rows[17]["siteCat"]));
						request({url: link, encoding:null}, function(err, resp, body){
							if(!err && resp.statusCode == 200){
								var ic = new iconv.Iconv('iso-8859-1', 'utf-8');                              
								var buf = ic.convert(body);                                                   
								var utf8String = buf.toString('utf-8'); 

								var $ = cheerio.load(utf8String);
								
								//Titulares
								var i = 0;
								var titulo = new Array();
								$('.trecientos_canal .L4ta_canalGene h3 a').each(function(){
									titulo[i] = $(this).html().toString();
									i++;
									});
								//console.log(titulo);

								//Descripción
								var i = 0;
								var descripcion = new Array();
								$('.trecientos_canal .L4ta_canalGene p').each(function(){
									descripcion[i] = $(this).html().toString();
									i++;
									});
								//console.log(descripcion);
								
								if (titulo.length == descripcion.length) {
									var queryCountNews='select max(substring(guid,21)) as maximo from wp_posts';
									connection.query( queryCountNews, function(err, rows) {
										if (err) throw err;
										var valor = parseInt(JSON.parse(JSON.stringify(rows[0]["maximo"])))+1;
										var queryInsert="INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ";
										for (var j = 0; j < titulo.length; j++) {
											var newQueryInsert = queryInsert + "("+4+",'"+ahora+"', '"+ahora+"' , '"+descripcion[j]+"' , '"+titulo[j]+"' ,'','publish','open','open','','prueba1','','', '"+ahora+"' , '"+ahora+"' ,'',"+0+",'http://localhost/?p="+(valor)+"',"+0+",'post','',"+0+")";
											valor++;
		  									connection.query(newQueryInsert  , function(err, results){
												if(err) throw err;
												var queryInsertCategories = "INSERT INTO `wp_term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES ("+results.insertId+"," + 1 + "," + 0 + ")";
												connection.query(queryInsertCategories  , function(err, results){
													if(err) throw err;
												});
											});
										}
									});
								}
								else{ console.log("no se guarda en opcion: "+option);}
							}
							else{
								console.log("Error de extracción");
							}
						});
						break;
				*/	
					default:
						//console.log("nueva opcion");
						break;
				}
			}
		});
	});
});
//process.exit();

