# API examples #

 Version: 29.06.12 20:54:21

## Moment - Update ##

POST {{host}}moment/update

Request: 
```json
{
  "moment_id":1,
  "description":"tavihipopizoxamiherafufusutobedojuhojujukenekavohivihukuyarulotosajuxoyezinemezotogavozotorakewakabewunokadukasayuconajesujajacojazabizinahuguyaxavecapoduvicudizapupilarobusuzizoyayivalimimoyitilebuloninekivehokagagotodaharanajixogiforijixodewekayatajacu"
}
```

Response: 
```
{
  "id":1,
  "day_id":1,
  "description":"tavihipopizoxamiherafufusutobedojuhojujukenekavohivihukuyarulotosajuxoyezinemezotogavozotorakewakabewunokadukasayuconajesujajacojazabizinahuguyaxavecapoduvicudizapupilarobusuzizoyayivalimimoyitilebuloninekivehokagagotodaharanajixogiforijixodewekayatajacu",
  "img_url":"",
  "likes_count":0,
  "ctime":1340992456
}
```

## Moment - Delete ##

POST {{host}}moment/delete

Request: `empty`
Response: 
```
null
```

## Moment - Comment ##

POST {{host}}moment/comment

Request: 
```json
{
  "moment_id":1,
  "text":"zunuwicuganusotosiwazuceyavapobirikicikerugemudanuhiyevuliwuhunukujilovapakazigilibewodehugiwomasosamifanicibeziwuvotuxaxapoxaxiwitecujilibivuxizogopatigedahasarekohogofefugamatoxewitaxudayohidofelecirenuhacatuhipapixoromuhonibuxanijakobiroluhayulunapuyu"
}
```

Response: 
```
{
  "text":"zunuwicuganusotosiwazuceyavapobirikicikerugemudanuhiyevuliwuhunukujilovapakazigilibewodehugiwomasosamifanicibeziwuvotuxaxapoxaxiwitecujilibivuxizogopatigedahasarekohogofefugamatoxewitaxudayohidofelecirenuhacatuhipapixoromuhonibuxanijakobiroluhayulunapuyu",
  "moment":{
    "id":1,
    "day_id":1,
    "image_ext":"",
    "fb_id":"",
    "likes_count":0,
    "ctime":1340992458,
    "utime":1340992458,
    "cip":0
  },
  "user":{
    "id":1,
    "fb_uid":"100004010804750",
    "fb_access_token":"AAAFnVo0zuqkBAGnPZC4q8oFwk1YQko9YYJSNi3MHdk5JxUY3735n3sq9a6Us3itsQmoAv6fUPQHMINH8wcEhxWKZCQLir9XraZCCzlALYWSnw7F3ZAGH",
    "ctime":1340992458,
    "utime":1340992458,
    "cip":0
  },
  "cip":2130706433,
  "user_id":1,
  "moment_id":1,
  "ctime":1340992458,
  "utime":1340992458,
  "id":1
}
```

## Moment - Share ##

POST {{host}}moment/share

Request: 
```json
{
  "moment_id":1
}
```

Response: 
```
{
  "id":"100004010804750_106673349476358"
}
```

