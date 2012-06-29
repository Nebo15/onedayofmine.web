# API examples #

 Version: 29.06.12 21:19:54

## User - Days_CurrentUser ##

POST {{host}}user/days/

Request: `empty`

Response: 
    [
      {
        "id":1,
        "user_id":1,
        "title":"hafotocacekoyamucigegama",
        "description":"titanuxopobuyotiwuwanogosahedugukuyuyonimilidazucoconekekomipojutevocediwiyutuyosakekolokuhurixexozuzalusevegofuvidahixomaratimidinapuyehosimulejikocehilusakaviperafilihazoyezexexuramazagehaxuhibibizenucihasalidasofovibaluxojugehatucugexumemilagowubuzitu",
        "time_offset":0,
        "occupation":"ridisopiyafikoneyoyamire",
        "age":2,
        "type":9,
        "likes_count":0,
        "ctime":1340993816,
        "utime":1340993816,
        "is_ended":null
      }
    ]

## User - Days_AnotherUser ##

POST {{host}}user/days/1

Request: `empty`

Response: 
    [
      {
        "id":1,
        "user_id":1,
        "title":"hafotocacekoyamucigegama",
        "description":"titanuxopobuyotiwuwanogosahedugukuyuyonimilidazucoconekekomipojutevocediwiyutuyosakekolokuhurixexozuzalusevegofuvidahixomaratimidinapuyehosimulejikocehilusakaviperafilihazoyezexexuramazagehaxuhibibizenucihasalidasofovibaluxojugehatucugexumemilagowubuzitu",
        "time_offset":0,
        "occupation":"ridisopiyafikoneyoyamire",
        "age":2,
        "type":9,
        "likes_count":0,
        "ctime":1340993816,
        "utime":1340993816,
        "is_ended":null
      }
    ]

## User - FiendsWithApp ##

POST {{host}}user/friends_in_app

Request: `empty`

Response: 
    [
      {
        "ctime":1340993993,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":null,
        "fb_uid":"100004036783679",
        "id":2,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1340993993
      }
    ]

