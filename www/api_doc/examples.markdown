# API examples #

 Version: 29.06.12 23:26:47

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBADJUOZCLgTXLZCJWpfrZA8wv3g9ZATMKsnkRV5yaQPXmS1ZCiSMJxaC3EjKsEvKk0HRrVZBaGwRqLV1hK8LaivOZAdkcnThVUbTceEOGVpG"
    }

Response: 

    {
      "sessid":"jpmr9m0kbo48bcqdk2gm5seb14",
      "user":{
        "ctime":1341001582,
        "fb_name":"foo",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_timezone":"3",
        "fb_uid":"100004010804750",
        "id":1,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341001582
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/1/create`

Request: 

    {
      "text":"lepoji"
    }

Response: 

    {
      "day_id":null,
      "text":"lepoji",
      "ctime":1341001586,
      "id":1
    }

## Complaints - Display ##

`POST {{host}}/complaints/`

Request: `empty`

Response: 

    [
      {
        "id":1,
        "day_id":1,
        "ctime":1341001587,
        "text":"xikenatosapinovivarehudanirawaronazagosuvekezavohibilasupecijoduvaxawixiwewukorobofivukefivigujubezuwukodemixafutejifoxefoxerekomelefuyeciwumuwejavixoxajoluzopidateworubiwikotowifodaviweluzuhazuluratolifugunalotivibosilolovesafeguyomamozuseseyixucilihufafugedihadodikapamemisekoyogapigohidiyimadirisapakapakuwesalenocudagarodojohuxufexokeremejuruporoxuwipugusixijawatekelutovepebeducukowinicibelunacupitehiruxocupaxuwonegiweyefimekavajaruyiramagedacomegeranorubabudeyojuhuxodacefaxonaxagiyukuxevutotanuzetanujobehijasipiku"
      }
    ]

## Day - Begin ##

`POST {{host}}days/begin`

Request: 

    {
      "title":"kuso",
      "description":"bihahice",
      "time_offset":1341001589,
      "occupation":"royuha",
      "age":7,
      "type":2
    }

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"kuso",
      "description":"bihahice",
      "time_offset":"1341001589",
      "occupation":"royuha",
      "age":"7",
      "type":"2",
      "likes_count":null,
      "ctime":1341001589,
      "utime":1341001589,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/1/item`

Request: `empty`

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"miravisinokaxijabatazipo",
      "description":"nubusicekabewenoximutenipabikuzututimutuxodocojugutugeluhijokenajenucesuzosalazoworazaxenexunizusisovesodevijogalugiyasijihubetovekisajukakowiyemasehevizalukasanatedabidehuzafijuwihodetigatuhezulabirawucobegefayiraserukewonusuyokiwakuzigatefowutidemisefe",
      "time_offset":0,
      "occupation":"todabuyuvajudijixilugoke",
      "age":3,
      "type":10,
      "likes_count":0,
      "ctime":1341001589,
      "utime":1341001589,
      "is_ended":null,
      "moments":[
        {
          "id":1,
          "day_id":1,
          "description":"description macepuhusiyujetacuhubibofeyanazugagubiroxinexekudowaduvecojoverukuwijidezoluyuwamogomuxiseginulusekasigogonamegubipilicasene",
          "img_url":"",
          "likes_count":0,
          "ctime":1341001589
        },
        {
          "id":2,
          "day_id":1,
          "description":"description wikanagatusegibalobekuficiwaguhaloduwecifoyehunonizumalitesudubiraminibojuciwohefejolofazufawesilaxusuruwopokucidefidevaguga",
          "img_url":"",
          "likes_count":0,
          "ctime":1341001589
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/1;2;838/item`

Request: `empty`

Response: 

    {
      "1":{
        "id":1,
        "user_id":1,
        "title":"josaxeluyirixosepurireyo",
        "description":"xapuvujovojuwaxulukexokujicawogovonipujerofisajayolojuvojuvanuwevewedatovugiyipufurivefafugoyazojubizohopidizojatutihuriwufoxakezituduromofimiralesogedadevalaheruhozulisoxadikixagajefipumafokotonorudepamonuhiyipewotiteluzotomelagikupunatupojaxaxinowupote",
        "time_offset":0,
        "occupation":"mecirufifitawewohelokano",
        "age":4,
        "type":4,
        "likes_count":0,
        "ctime":1341001591,
        "utime":1341001591,
        "is_ended":null,
        "moments":[
          {
            "id":1,
            "day_id":1,
            "description":"description dowupadomefasegamahisevacagapicokupuzoriyuridusizudohuseyulinifukovemiwegizekoyerazuzohupokagiyojobodufejatowobivukororalaho",
            "img_url":"",
            "likes_count":0,
            "ctime":1341001591
          }
        ]
      },
      "2":{
        "id":2,
        "user_id":2,
        "title":"reloruyosaberegopewohosu",
        "description":"heguzigefanahusodajicotuyihemotobusulujizuseteyukekizahumifufutaxefehixehimuxewerasohupomotoriwiwuvalojofosafihutumuxatewibixuzowoxelazizosagubuxixopodecawubosunidutanovaxuduxakowukujidalazaziramedudufuxeyokepahudilevukoyegikozisalucegucohovirudaduxirowu",
        "time_offset":0,
        "occupation":"seyubixuwomiwixakewivowa",
        "age":7,
        "type":3,
        "likes_count":0,
        "ctime":1341001591,
        "utime":1341001591,
        "is_ended":null,
        "moments":[
          {
            "id":2,
            "day_id":2,
            "description":"description xidicayujozusovesuyopizenuyaserisozowutanobakukavevewopepinevatixogoruwaruhusocizuvopedawojivabovejifanuzuwomucituhefelaboru",
            "img_url":"",
            "likes_count":0,
            "ctime":1341001591
          }
        ]
      },
      "838":null
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

`POST {{host}}days/1/add_moment`

Request: 

    {
      "description":"fakohivowalufijocezoxalimumurogowopagexapebovemutiriradaxixihajatuguhazulapakacaposatohokafohiwakayofunizavefulopayeyaxejayonoruvipumanigevidedojazegunixifefojujuyubihetasuhunoxiwajesevururuzuwuwukafa",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"fakohivowalufijocezoxalimumurogowopagexapebovemutiriradaxixihajatuguhazulapakacaposatohokafohiwakayofunizavefulopayeyaxejayonoruvipumanigevidedojazegunixifefojujuyubihetasuhunoxiwajesevururuzuwuwukafa",
      "img_url":"\/media\/1\/day\/1\/3be2bf26d78895e6327c58ab29561c9217e3caa0.png",
      "likes_count":null,
      "ctime":1341001593
    }

## Day - Comment ##

`POST {{host}}days/1/comment`

Request: 

    {
      "text":"vomayomejopakukotorehukobixegekacudunihuhuyorekebupewuyupofudiwalufuniwuhomubuhawukoxemicohagakobiriyikafudasigihidaxorujufizigucupuhufiverisuzumafevojariribupatacucelupaheyegeketafagonukitusicolabuziyewunafulubozelicocovogumobimucehugoyisejozezewafuxusa"
    }

Response: 

    {
      "text":"vomayomejopakukotorehukobixegekacudunihuhuyorekebupewuyupofudiwalufuniwuhomubuhawukoxemicohagakobiriyikafudasigihidaxorujufizigucupuhufiverisuzumafevojariribupatacucelupaheyegeketafagonukitusicolabuziyewunafulubozelicocovogumobimucehugoyisejozezewafuxusa",
      "day":{
        "id":1,
        "user_id":1,
        "title":"pobikuxayuyidonacamehunu",
        "occupation":"saxuboberowunawewozaxedu",
        "age":5,
        "type":1,
        "is_ended":null,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341001594,
        "utime":1341001594,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBADJUOZCLgTXLZCJWpfrZA8wv3g9ZATMKsnkRV5yaQPXmS1ZCiSMJxaC3EjKsEvKk0HRrVZBaGwRqLV1hK8LaivOZAdkcnThVUbTceEOGVpG",
        "ctime":1341001594,
        "utime":1341001594,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "day_id":1,
      "ctime":1341001595,
      "utime":1341001595,
      "id":1
    }

## Day - End ##

`POST {{host}}days/1/end`

Request: `empty`

Response: 

    null

## Day - End ##

`POST {{host}}days/1/add_moment`

Request: 

    {
      "description":"vejotudamuteluburirefucutivopigesidinemufahoberotewudutulimuyojogibotisusunogajukaxibihicolumopogokudaxubinepuhuzalutolomuvurepubuwabozadikojorevajitojarademodisurosivodalivavicacowezimasuvukivudipufo",
      "image_name":"jicuta",
      "image_content":"kisoye"
    }

Response: 

    null

## Day - Share ##

`POST {{host}}days/1/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_106773516133008"
    }

## Me - Days ##

`POST {{host}}me/days/`

Request: `empty`

Response: 

    [
      
    ]

## Me - FiendsWithApp ##

`POST {{host}}me/friends_in_app`

Request: `empty`

Response: 

    [
      {
        "ctime":1341001599,
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
        "utime":1341001599
      }
    ]

## Moments - Update ##

`POST {{host}}moments/1/update`

Request: 

    {
      "description":"yinipagovuzuyonucukigikixamivelozudizejojereyafucinecuvuyekorukividowipatekokisidatabicuvirejuzamaxepilesozajoniverovotifeyijupobiciyixogusilazemibehovidoxirigoxehovakuzapihirodoyekowiloyadataluvadafagonihagivavaxisehikitalacekakihojodiyezomoxekiroducuci"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"yinipagovuzuyonucukigikixamivelozudizejojereyafucinecuvuyekorukividowipatekokisidatabicuvirejuzamaxepilesozajoniverovotifeyijupobiciyixogusilazemibehovidoxirigoxehovakuzapihirodoyekowiloyadataluvadafagonihagivavaxisehikitalacekakihojodiyezomoxekiroducuci",
      "img_url":"",
      "likes_count":0,
      "ctime":1341001600
    }

## Moments - Delete ##

`POST {{host}}moments/1/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/1/comment`

Request: 

    {
      "text":"foyanuxadowulawiwetonupecamopazoyuwiyopakizonokecacozowatevemobisuxonisuxosilavifudanugehunotifekabupovihiwopofomeyahahidojuhigorenaxepavixebacilanofogenicucemonawijirawilurikaputoruzanabokijumakupayipehaxoginudaxakifecixemenufaxapilupenovatugobibezavume"
    }

Response: 

    {
      "text":"foyanuxadowulawiwetonupecamopazoyuwiyopakizonokecacozowatevemobisuxonisuxosilavifudanugehunotifekabupovihiwopofomeyahahidojuhigorenaxepavixebacilanofogenicucemonawijirawilurikaputoruzanabokijumakupayipehaxoginudaxakifecixemenufaxapilupenovatugobibezavume",
      "moment":{
        "id":1,
        "day_id":1,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341001602,
        "utime":1341001602,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBADJUOZCLgTXLZCJWpfrZA8wv3g9ZATMKsnkRV5yaQPXmS1ZCiSMJxaC3EjKsEvKk0HRrVZBaGwRqLV1hK8LaivOZAdkcnThVUbTceEOGVpG",
        "ctime":1341001602,
        "utime":1341001602,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "moment_id":1,
      "ctime":1341001603,
      "utime":1341001603,
      "id":1
    }

## Moments - Share ##

`POST {{host}}moments/1/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_106773592799667"
    }

## User - Days ##

`POST {{host}}users/1/days`

Request: `empty`

Response: 

    [
      
    ]

