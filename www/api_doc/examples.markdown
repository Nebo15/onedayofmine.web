# API examples #

 Version: 02.07.12 12:56:25

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBACCdgjAA4iM5W53ynzvvfjLBSOFgKYXR1AKSgKyhHard8xi5ej36VxHtsdrcvwBqUvptGRDZAgPDgBGz1pNMvUPCZBlyXQuuFGsDHM"
    }

Response: 

    {
      "sessid":"nfpt6jeoi8hjr9kcuqus1u1hn0",
      "user":{
        "ctime":1341222963,
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
        "utime":1341222963
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/1/create`

Request: 

    {
      "text":"bafixi"
    }

Response: 

    {
      "day_id":null,
      "text":"bafixi",
      "ctime":1341222967,
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
        "ctime":1341222968,
        "text":"cehabutokogogamegayalahozoyefozebejadatiwugabokevehamiyifuseporizupazepohowelenapukakelifaxovijokuvehedicuvifesocavikezijujahovopicuxajufamekadihuxocugisimuderoxonoyutazelelivolojimiyabidasoximijehalehupokekuzojigererolemexuvajagohirufadiwagapikatuxahemajejohilibajabisunuzakehajagonovuxanarusozuvalixukucogewimadasuyizitoligikamumevugurigizolatacotafisoxubexicexugaturujorotexubiwebiwukudekarebulotarareverofogawenofunedumofipigerujecarotojuwagewegesehacipobubosexolimahodazekuvifiyipaxasuzonobekiwurarododilucojacububowa"
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
      "title":"some",
      "description":"kubawofe",
      "time_offset":1341222971,
      "occupation":"kilewu",
      "age":3,
      "type":10
    }

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"some",
      "description":"kubawofe",
      "time_offset":"1341222971",
      "occupation":"kilewu",
      "age":"3",
      "type":"10",
      "likes_count":null,
      "ctime":1341222971,
      "utime":1341222971,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/1/item`

Request: `empty`

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"hiwebomodewikayalecewosu",
      "description":"tenuzaxijahuzixabiyosabukurizawokepejiyonerisinozinomirulejijafomocufamogafunoridadosomabopeyocelafifohitijefuweduyosiyogibagamohogijiwazajadaneciboxumaligorojukijocatajagigosegocarihacitogaropuhodatiduxetipugodugexewozasisenuyobodaralepajusisuvidofatute",
      "time_offset":0,
      "occupation":"zikemabovugurexeciyamura",
      "age":5,
      "type":6,
      "likes_count":0,
      "ctime":1341222971,
      "utime":1341222971,
      "is_ended":0,
      "moments":[
        {
          "id":1,
          "day_id":1,
          "description":"description mupodizegivamuhubuhivegisagacogimufikawirivamacibebuvekikirifuzosahajarusecalasinogeyotegevigocuxeyamidazahejuwusafituxugoji",
          "img_url":"",
          "likes_count":0,
          "ctime":1341222971
        },
        {
          "id":2,
          "day_id":1,
          "description":"description litaperovobecivisijayadepaxawopecejorumesitobifozixunufafadusogobimonubaloyihafepafabegalefaceyayevijoromigorizelajipisayufa",
          "img_url":"",
          "likes_count":0,
          "ctime":1341222971
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/1;2;845/item`

Request: `empty`

Response: 

    {
      "1":{
        "id":1,
        "user_id":1,
        "title":"guwetusayayabonubagiraza",
        "description":"rodocazegofasufijebuyapicoceyapitogovecuxeciheconapicazawanodajuvirivonoyofaxevijexenunezadadiyuzimogakarikitayanolasulobitayodugorirasenategojolowatevotiyofapeseweginoneboyenedemuneretiyurihetapurasakoyeciratacejopagizubefokosuwefacalamakedinidanepigiti",
        "time_offset":0,
        "occupation":"biturutakuseyefigijofame",
        "age":8,
        "type":4,
        "likes_count":0,
        "ctime":1341222972,
        "utime":1341222972,
        "is_ended":0,
        "moments":[
          {
            "id":1,
            "day_id":1,
            "description":"description mosuhesitipelutonekarobatidumacuvoxacinuzadeyucifimogizuzavigukureboviporofinebotinubixurokunowazuyolinafosozologureligafixo",
            "img_url":"",
            "likes_count":0,
            "ctime":1341222972
          }
        ]
      },
      "2":{
        "id":2,
        "user_id":2,
        "title":"cagelizamiwuwipukigetume",
        "description":"beluyanawohusicidajuxucohapayazukewenelecokohigirigimefoloyewujehanomufisijubikodofiyejecetudafegofosehexikudonekowebasakebilaxoxajijiyafebebinegesenekusikaretihabisuvugudekorobexipeletokebavefuyuvorunoguluniciyosezidetamimojimadacoxenedasemoyayupagegovo",
        "time_offset":0,
        "occupation":"gibegagofazezerutudawete",
        "age":3,
        "type":9,
        "likes_count":0,
        "ctime":1341222972,
        "utime":1341222972,
        "is_ended":0,
        "moments":[
          {
            "id":2,
            "day_id":2,
            "description":"description hayuzusafedudewufenapabesehobeselodeponodosebicexihivetiracokoyolafuxotukigexepoxufofucoyaleyecelejezajemisewedodekegibarili",
            "img_url":"",
            "likes_count":0,
            "ctime":1341222972
          }
        ]
      },
      "845":null
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
      "description":"wafifugavoyelokucocamapicixusocixezadeguzadeyikajigurojokepazonuyizavayojadepijuyitijahogutemedewalogekikixuzawutilanotomizuvakodogediziculabexotetezibiyaloduhepirocifaligiwadiluwejuxeyexacahosukomiyu",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"wafifugavoyelokucocamapicixusocixezadeguzadeyikajigurojokepazonuyizavayojadepijuyitijahogutemedewalogekikixuzawutilanotomizuvakodogediziculabexotetezibiyaloduhepirocifaligiwadiluwejuxeyexacahosukomiyu",
      "img_url":"\/media\/1\/day\/1\/3be2bf26d78895e6327c58ab29561c9217e3caa0.png",
      "likes_count":null,
      "ctime":1341222975
    }

## Day - Comment ##

`POST {{host}}days/1/comment`

Request: 

    {
      "text":"nagipojemebogufiyefowowohifunacakepuyufefecicebanavezozedadohevonepifowebuwafudobucumagodehipacajonimeyigopenocipanadosecutozotemexupokomufarenalagivuwuxinujefunatavaxecahojuxoxajobanutatajuxuyoxovozuwenadiyuperolanagefidajasevizohucubagudugoloyutafurezu"
    }

Response: 

    {
      "text":"nagipojemebogufiyefowowohifunacakepuyufefecicebanavezozedadohevonepifowebuwafudobucumagodehipacajonimeyigopenocipanadosecutozotemexupokomufarenalagivuwuxinujefunatavaxecahojuxoxajobanutatajuxuyoxovozuwenadiyuperolanagefidajasevizohucubagudugoloyutafurezu",
      "day":{
        "id":1,
        "user_id":1,
        "title":"rusadatusoxivewemepajedo",
        "occupation":"nedotewumecutoxenihinexi",
        "age":4,
        "type":9,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341222976,
        "utime":1341222976,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBACCdgjAA4iM5W53ynzvvfjLBSOFgKYXR1AKSgKyhHard8xi5ej36VxHtsdrcvwBqUvptGRDZAgPDgBGz1pNMvUPCZBlyXQuuFGsDHM",
        "ctime":1341222976,
        "utime":1341222976,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "day_id":1,
      "ctime":1341222976,
      "utime":1341222976,
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
      "description":"lafenozadihodoreyudesisajujopokatijehelixofamuhesireyekedoxoletavalakumepohamilazamujufipadahugaxodeninagodokiwepehufijolivohavasulemujovilazeminolodoligejigasuzadicifuwoyoxijedocenixotaguhuxebutaluye",
      "image_name":"zeledu",
      "image_content":"dilide"
    }

Response: 

    null

## Day - Delete ##

`POST {{host}}days/1/delete`

Request: `empty`

Response: 

    null

## Day - Share ##

`POST {{host}}days/1/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_108916902585336"
    }

## Moments - Update ##

`POST {{host}}moments/1/update`

Request: 

    {
      "description":"tojisesomidosuwiwayukalisovoneyecesopekavisimiyesucacipogelosezonomazugokudukadayedutosubatololukucetebafazigasajocamobixofenogumegarehulelojavoxuterowiputapuzajahulivuvemajevacimojefuhuzuxuzadedituliduridirezayekagozepufizetaxibezafopecanahijomijituhuke"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"tojisesomidosuwiwayukalisovoneyecesopekavisimiyesucacipogelosezonomazugokudukadayedutosubatololukucetebafazigasajocamobixofenogumegarehulelojavoxuterowiputapuzajahulivuvemajevacimojefuhuzuxuzadedituliduridirezayekagozepufizetaxibezafopecanahijomijituhuke",
      "img_url":"",
      "likes_count":0,
      "ctime":1341222981
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
      "text":"lewupicemefatomejavehomuworumohuyawiruvadujuroguyahavofipukanozivuyitonusuveruhibitojukutoyelusatopijajazajicodafuyivelibewihirademijuleyoxakadixacojigexawanifosocanijihamofohasevaxukobexitafiveletotayetawufijunayuyudomuxogoxoyokosexemojogorowiromonunepo"
    }

Response: 

    {
      "text":"lewupicemefatomejavehomuworumohuyawiruvadujuroguyahavofipukanozivuyitonusuveruhibitojukutoyelusatopijajazajicodafuyivelibewihirademijuleyoxakadixacojigexawanifosocanijihamofohasevaxukobexitafiveletotayetawufijunayuyudomuxogoxoyokosexemojogorowiromonunepo",
      "moment":{
        "id":1,
        "day_id":1,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341222982,
        "utime":1341222982,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBACCdgjAA4iM5W53ynzvvfjLBSOFgKYXR1AKSgKyhHard8xi5ej36VxHtsdrcvwBqUvptGRDZAgPDgBGz1pNMvUPCZBlyXQuuFGsDHM",
        "ctime":1341222982,
        "utime":1341222982,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "moment_id":1,
      "ctime":1341222983,
      "utime":1341222983,
      "id":1
    }

## User - Days ##

`POST {{host}}users/1/days`

Request: `empty`

Response: 

    [
      
    ]

