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
  // Use the connection
  connection.query( 'SELECT nameNews FROM newspapers', function(err, rows) {
    // And done with the connection.
    if (err) throw err;
    console.log(rows[0]);
    //connection.release();

    connection.query( 'SELECT nameNews FROM newspapers', function(err, rows) {
    if (err) throw err;
    console.log(rows[1]);
    connection.destroy();
  });
  });
});