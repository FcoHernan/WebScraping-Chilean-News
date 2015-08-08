# -*- coding: utf-8 -*- 

import urllib
import MySQLdb
import pprint
import js2py


DB_HOST = 'localhost' 
DB_USER = 'root' 
DB_PASS = 'rsu2015' 
DB_NAME = 'WebScrap' 

def run_query(query=''): 
    datos = [DB_HOST, DB_USER, DB_PASS, DB_NAME] 
    conn = MySQLdb.connect(*datos) # Conectar a la base de datos 
    cursor = conn.cursor()         # Crear un cursor 
    cursor.execute(query)          # Ejecutar una consulta 
    if query.upper().startswith('SELECT'): 
        data = cursor.fetchall()   # Traer los resultados de un select 
    else: 
        conn.commit()              # Hacer efectiva la escritura de datos 
        data = None
        
    cursor.close()                 # Cerrar el cursor 
    conn.close()                   # Cerrar la conexión 
    return data

query = "SELECT * FROM newspapers" 
result = run_query(query) 
pprint.pprint(result[0][2])

try:
	htmlfile = urllib.urlopen(result[0][2])
	htmltext = htmlfile.read()
	#print htmltext
except Exception, e:
	print "aaaaaaaaa" 



js = """
function escramble_758(){
var a,b,c
a='+1 '
b='84-'
a+='425-'
b+='7450'
c='9'
document.write(a+c+b)
}
escramble_758()
""".replace("document.write", "return ")

result = js2py.eval_js(js).to_python()  # executing JavaScript and converting the result to python string 
print result