INFORMATIONS

GET 
an : 		http://localhost/OBIS/REST/api/info/read.php?an=true
locatii : 	http://localhost/OBIS/REST/api/info/read.php?locatie=true
raspuns : 	http://localhost/OBIS/REST/api/info/read.php?raspuns=true
categorie : 	http://localhost/OBIS/REST/api/info/read.php?categorie=true
general : 	http://localhost/OBIS/REST/api/info/read.php?an=2018&locatie=Wisconsin&raspuns=RESP040&categorie=CAT5
// zic sa punem pe check box id-ul la raspuns si categorie pentru usurinta
// cererile se fac la substantivul info cu predicatul get
POST
http://localhost/OBIS/REST/api/info/create.php
PUT
http://localhost/OBIS/REST/api/info/update.php
DELETE
http://localhost/OBIS/REST/api/info/delete.php

USERS

GET(login)
http://localhost/OBIS/REST/api/user/read.php?username=ivascu&password=vlad
POST(sign up)
http://localhost/OBIS/REST/api/user/create.php