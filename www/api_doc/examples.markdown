# API examples #

 Version: 03.07.12 00:40:53

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAMQ7ESdKt2SOgYaAnBAZABlrbIBgcSWTaDpXgfgDH5xGXouCSpxwCJvZC232Dhdyp2X7NHzKCr9f8XKJisZAyZAiZBs7FfG2BLf9vRDbl"
    }

Response: 

    {
      "sessid":"7s9mkn8ktllkvqdjnj5qhd8ua3",
      "user":{
        "ctime":1341265202,
        "fb_name":"foo",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_timezone":"3",
        "fb_uid":"100004010804750",
        "id":764,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341265202
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/160/create`

Request: 

    {
      "text":"hiwiju"
    }

Response: 

    {
      "day_id":null,
      "text":"hiwiju",
      "ctime":1341265214,
      "id":18
    }

## Complaints - Display ##

`POST {{host}}/complaints/`

Request: `empty`

Response: 

    [
      {
        "id":19,
        "day_id":161,
        "ctime":1341265216,
        "text":"gomemotomipuleyopileganefidufuyereradewivimaveweyetaheliwihukajupubojuhajohafamajahokocagedininamiwolawoxaxagedimefucebenawarefayuwecoduvuyahapolopizivitopezokutegoxesojotisejaburumemazamuwuwidahakusonijesojonutujefehoganapocusivefetinidudoturabojelikururovefirexewivuguruvebubedizililagejiwuvojodapebekuliriwoyogejoliyozotolakifuyefebovocikajokohugapexezekexijuwifudunemugupomulobazukugojajozafabedinimolakuxuruxovepazufepamokicibocikinokirahirasadocezonikuyijubemixafeluhohuvudurahiwoberusuxokedekenodumevejugucinugiduno"
      }
    ]

## Day - CurrentUserDays ##

`POST {{host}}my/days/`

Request: `empty`

Response: 

    [
      
    ]

## Day - Begin ##

`POST {{host}}days/begin`

Request: 

    {
      "title":"sesa",
      "description":"wuvakuha",
      "time_offset":1341265222,
      "occupation":"cupola",
      "age":6,
      "type":8
    }

Response: 

    {
      "id":162,
      "user_id":775,
      "title":"sesa",
      "description":"wuvakuha",
      "time_offset":"1341265222",
      "occupation":"cupola",
      "age":"6",
      "type":"8",
      "likes_count":null,
      "ctime":1341265222,
      "utime":1341265222,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/163/item`

Request: `empty`

Response: 

    {
      "id":163,
      "user_id":776,
      "title":"yubotapomegugebefilujevi",
      "description":"damurirojujomohapuremerubepiduhexofifugitihahigupufaduxacirakumesovumukanokuhosumuxosovoheyoheyubowiseseyacasobanutesiyuxupagicefuvudidanagaxejidaropitikepovoxupowoduvoduxagelehacuruhucupumiwadoverizonutobabegaduyewagixoxovujihudesocikapilunisiyimayexubo",
      "time_offset":0,
      "occupation":"bosefuxicokocegotohotuyo",
      "age":5,
      "type":8,
      "likes_count":0,
      "ctime":1341265222,
      "utime":1341265222,
      "is_ended":0,
      "moments":[
        {
          "id":95,
          "day_id":163,
          "description":"description xepadogehifuhugeletirewameyiciwusebucecewegabikivaxilopuyikuyayipulogizasadopideruwasezixeponijalotogotuxupiloxasodebayulisu",
          "img_url":"",
          "likes_count":0,
          "ctime":1341265222
        },
        {
          "id":96,
          "day_id":163,
          "description":"description rojufilipajekebuwivoyifaleroyujipolocuhozoxewufokujeniluxatubakirokorojiheyadavibavirepihejehoxumerayutadojetatodijotugufihi",
          "img_url":"",
          "likes_count":0,
          "ctime":1341265222
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/165;166;881/item`

Request: `empty`

Response: 

    {
      "165":{
        "id":165,
        "user_id":780,
        "title":"rohuwewojemahozadovelufo",
        "description":"gahexuyoxomuhoxejuvesutimalurigurihimajewohanajucadozujibojohimubolixowomawahawegucaverofukimujipocilufubayeforetonidahecotinadavarecudawakuvakituzubedazutixurobewabufuzixopehecefapegidubuvoroxixulavipofawimutobeyevagoculovedofituzenamepugererimepofosiji",
        "time_offset":0,
        "occupation":"xasokizoxecuzivadusacexu",
        "age":1,
        "type":5,
        "likes_count":0,
        "ctime":1341265226,
        "utime":1341265226,
        "is_ended":0,
        "moments":[
          {
            "id":97,
            "day_id":165,
            "description":"description gamoporihuyepemuditiwitihadiwuzazisigefifatojesivexowobasaridonacesepuwozinewavonogegemulaliturofecofumanamefezoxadalobutiki",
            "img_url":"",
            "likes_count":0,
            "ctime":1341265226
          }
        ]
      },
      "166":{
        "id":166,
        "user_id":781,
        "title":"genutexicipohuxowacivura",
        "description":"nudubunifawiwazowinesakepusurikapidikodixuyodulukudabihilunapugaletobujuvepudawibumanoruvazebemipagobinuvatufijanugapuzeyusufakohijeduduzuvakajuyiyikuxewiguritufagexefufubibeluxelegenawocijokiwiwoyupayoruyaxukeciririjoyomedexuzoyixufiwanoyuculopaduvanejo",
        "time_offset":0,
        "occupation":"tetogurehekudeyidijevawu",
        "age":1,
        "type":5,
        "likes_count":0,
        "ctime":1341265226,
        "utime":1341265226,
        "is_ended":0,
        "moments":[
          {
            "id":98,
            "day_id":166,
            "description":"description hapefuhemubehobebazalebinemezuweyepakulusifugegekajumekusujotaxonivuhasupuwodabigehototinacefuyolopoxepidigeletosaketawedume",
            "img_url":"",
            "likes_count":0,
            "ctime":1341265226
          }
        ]
      },
      "881":null
    }

## Day - Update ##

`POST {{host}}days/42/update`

Request: 

    {
      "tags":[
        "tag1",
        "tag2"
      ],
      "top_moment_id":111
    }

Response: 

    null

## Day - AddMoment ##

`POST {{host}}days/167/add_moment`

Request: 

    {
      "description":"rowotajubehorekuharafurikugadivodiluvosodunofutiyepafasidutejiyicehudureyababopubabejowipirubihayizapijitesobetakojomadaroxohavevohejoxaziwavicajewonuwasowuxifohizodusajicacagipafabagosaripufujamizane",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":99,
      "day_id":167,
      "description":"rowotajubehorekuharafurikugadivodiluvosodunofutiyepafasidutejiyicehudureyababopubabejowipirubihayizapijitesobetakojomadaroxohavevohejoxaziwavicajewonuwasowuxifohizodusajicacagipafabagosaripufujamizane",
      "img_url":"\/media\/784\/day\/167\/fdce9ffa4870a3268bf2a15d74764be0ff167e2a.png",
      "likes_count":null,
      "ctime":1341265232
    }

## Day - Comment ##

`POST {{host}}days/169/comment`

Request: 

    {
      "text":"covatosusuxohosajikanasecimirupomevacidolakotaxanegalugikozanivayiguzetekadafudogevofuditaperehixipuwegakehijejisaducemojabulemevadijevosajulomatobowipanoduyigorehusatedajisosikofefolokiredubofetujifimibagopoloxinehuvuguverunevuvujekelobuhitabemefegifusu"
    }

Response: 

    {
      "text":"covatosusuxohosajikanasecimirupomevacidolakotaxanegalugikozanivayiguzetekadafudogevofuditaperehixipuwegakehijejisaducemojabulemevadijevosajulomatobowipanoduyigorehusatedajisosikofefolokiredubofetujifimibagopoloxinehuvuguverunevuvujekelobuhitabemefegifusu",
      "day":{
        "id":169,
        "user_id":787,
        "title":"yezipunowejuwewezuwowowu",
        "occupation":"vozazodokapepuliyehaxogi",
        "age":1,
        "type":7,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341265233,
        "utime":1341265233,
        "cip":0
      },
      "user":{
        "id":787,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAMQ7ESdKt2SOgYaAnBAZABlrbIBgcSWTaDpXgfgDH5xGXouCSpxwCJvZC232Dhdyp2X7NHzKCr9f8XKJisZAyZAiZBs7FfG2BLf9vRDbl",
        "ctime":1341265233,
        "utime":1341265233,
        "cip":0
      },
      "cip":2130706433,
      "user_id":787,
      "day_id":169,
      "ctime":1341265235,
      "utime":1341265235,
      "id":7
    }

## Day - End ##

`POST {{host}}days/170/end`

Request: `empty`

Response: 

    null

## Day - End ##

`POST {{host}}days/170/add_moment`

Request: 

    {
      "description":"mikuzuvelinaceruzehahonutubigokodosatijaxujucutahufitoniniyogenecalopoxipakodariduyunijabewepeponukateneluyicizakubukezerupafavodavukedugakepemugixoxuzisisutinupesuruwuxafinolofekafepuxetosemepagezacu",
      "image_name":"basamu",
      "image_content":"cikifa"
    }

Response: 

    null

## Day - Delete ##

`POST {{host}}days/171/delete`

Request: `empty`

Response: 

    null

## Day - Share ##

`POST {{host}}days/172/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_109434669200226"
    }

## Moments - Update ##

`POST {{host}}moments/101/update`

Request: 

    {
      "description":"xibiyajibecewariwurorodedokutavopudiziyuwagogudasotemusonalefewocugalabegezicanowezecozirivurinonovuzohebesahawakumimibawuyiliguhuyevamokaxohowonedutacibubimekogezulivunonukemupoxewuwuzugicofexajepafavoyazicibuxuyosunujoniyeretejujapehisecojuperefadivobo"
    }

Response: 

    {
      "id":101,
      "day_id":173,
      "description":"xibiyajibecewariwurorodedokutavopudiziyuwagogudasotemusonalefewocugalabegezicanowezecozirivurinonovuzohebesahawakumimibawuyiliguhuyevamokaxohowonedutacibubimekogezulivunonukemupoxewuwuzugicofexajepafavoyazicibuxuyosunujoniyeretejujapehisecojuperefadivobo",
      "img_url":"",
      "likes_count":0,
      "ctime":1341265243
    }

## Moments - Delete ##

`POST {{host}}moments/102/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/103/comment`

Request: 

    {
      "text":"vihacibepiluguhapociyakafisireliyonacijodopetukerivinaposejepovileniwufusoherosedivorekeporalesurejicilohodukufihufujiguhubofonuyuhalovokurotuhuwiyacazezabatizolesuyinejacabebuxuzucugayefovajejubelipotovoburuvivumawihudadihikesuxepoyekufavupitapimupoxoba"
    }

Response: 

    {
      "text":"vihacibepiluguhapociyakafisireliyonacijodopetukerivinaposejepovileniwufusoherosedivorekeporalesurejicilohodukufihufujiguhubofonuyuhalovokurotuhuwiyacazezabatizolesuyinejacabebuxuzucugayefovajejubelipotovoburuvivumawihudadihikesuxepoyekufavupitapimupoxoba",
      "moment":{
        "id":103,
        "day_id":175,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341265246,
        "utime":1341265246,
        "cip":0
      },
      "user":{
        "id":794,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAMQ7ESdKt2SOgYaAnBAZABlrbIBgcSWTaDpXgfgDH5xGXouCSpxwCJvZC232Dhdyp2X7NHzKCr9f8XKJisZAyZAiZBs7FfG2BLf9vRDbl",
        "ctime":1341265246,
        "utime":1341265246,
        "cip":0
      },
      "cip":2130706433,
      "user_id":794,
      "moment_id":103,
      "ctime":1341265248,
      "utime":1341265248,
      "id":3
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "ctime":1341265248,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":null,
        "fb_uid":"100004036783679",
        "id":796,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341265248
      }
    ]

