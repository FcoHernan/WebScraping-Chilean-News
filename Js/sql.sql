INSERT INTO `categories`(`nameCat`, `siteCat`, `enabledCat`, `fkNewspapersCat`) 
VALUES 
("Nacional","http://www.emol.com/nacional/",1,1),
("Internacional","http://www.emol.com/internacional/",1,1),
("Tecnología","http://www.emol.com/tecnologia/",1,1),
("Educación","http://www.emol.com/educacion/",1,1),
("Economía","http://www.emol.com/economia/",1,1),
("Deporte","http://www.emol.com/deportes/",1,1),
("Multimedia","http://www.emol.com/multimedia/",1,1),
("Tendencias","http://www.emol.com/tendencias/",1,1)

INSERT INTO `categories`(`nameCat`, `siteCat`, `enabledCat`, `fkNewspapersCat`) 
VALUES 
("Nacional","http://www.latercera.com/canal/nacional/680.html",1,2),
("Internacional","http://www.latercera.com/canal/mundo/678.html",1,2),
("Deporte","http://www.latercera.com/canal/deportes/656.html",1,2),
("Tendencias","http://www.latercera.com/canal/tendencias/659.html",1,2),
("Cultura","http://www.latercera.com/canal/cultura/1453.html",1,2),
("Politica","http://www.latercera.com/canal/politica/674.html",1,2)
("Politica","http://www.latercera.com/canal/negocios/655.html",1,2)

INSERT INTO `categories`(`nameCat`, `siteCat`, `enabledCat`, `fkNewspapersCat`) 
VALUES 
("Nacional","http://www.lacuarta.com/canal/espectacular/65.html",1,4),
("Internacional","http://www.lacuarta.com/canal/mundo/66.html",1,4),
("Deporte","http://www.lacuarta.com/canal/deportiva/64.html",1,4)


INSERT INTO `wp_posts`(`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) 
VALUES (2,'2011-11-22 23:59:59','2011-11-22 23:59:59','lanza &quot;Constitucionario&quot;','Ampl&#xED;an','','publish','open','open','','prueba1','','','2011-11-22 23:59:59','2011-11-22 23:59:59','',0,'http://localhost/?p=3',0,'post','',0)





INSERT INTO `categories`(`nameCat`, `siteCat`, `enabledCat`, `fkNewspapersCat`) 
VALUES 
("Nacional","",1,),
("Internacional","",1,),
("Tecnología","",1,),
("Educación","",1,),
("Economía","",1,),
("Deporte","",1,),
("Multimedia","",1,),
("Tendencias","",1,),
("Cultura","",1,),
("Politica","",1,)

-- Todos las paginas con sus categorias para extraer
SELECT idNews, nameNews, siteNews, localizedNews, idCat, nameCat, siteCat, enabledCat, fkNewspapersCat
FROM newspapers , categories   
WHERE idNews = fkNewspapersCat

-- Diario sin categoría
SELECT *
FROM newspapers
LEFT JOIN categories
ON idNews = fkNewspapersCat
WHERE idCat is null


SELECT *
FROM wp_posts
WHERE post_author = 1 and ID in (	SELECT distinct object_id
						FROM wp_term_relationships
						WHERE term_taxonomy_id = 1)