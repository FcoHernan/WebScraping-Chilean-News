var request = require('request');
var cheerio = require('cheerio');
var mysql 	= require('mysql');

//_--------------------------------------------------------------------
//Conexión con base de datos
var pool  = mysql.createPool({
  host            : 'localhost',
  user            : 'root',
  password        : 'rsu2015',
  database		  : 'WebScrap'
});

/*
//Seleccionar páginas
var queryNewsCategories='SELECT nameNews FROM newspapers';
pool.query(queryNewsCategories, function(err, rows, fields){
	if (err) throw err;
	console.log('The solution is: ', rows[0]);

});*/


pool.getConnection(function(err, connection) {
  var queryNewsCategories='SELECT idNews, nameNews, siteNews, localizedNews, idCat, nameCat, siteCat, enabledCat, fkNewspapersCat FROM newspapers , categories WHERE idNews = fkNewspapersCat';
  connection.query( queryNewsCategories, function(err, rows) {
    if (err) throw err;
    // Use the connection
    var queryInsert="INSERT INTO `newspapers`(`nameNews`, `siteNews`, `enabledNews`, `localizedNews`) VALUES ('ahora', 'url', "+1+", 'puente')";
    //for (var j = 0; j < titulo.length; j++) {
      
      //valor++;
      /*connection.query( queryInsert, function(err, info) {
        if (err) throw err;
        console.log(err);
        connection.destroy();
      });*/
    //}
    console.log(queryInsert);
    connection.query(queryInsert  , function(err){
      if(err) throw err;
      connection.destroy();
    });
  });
});