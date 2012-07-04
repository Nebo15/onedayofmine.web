# API examples #

 Version: 04.07.12 13:55:41

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAJY3CFIDXY3ZBiFGrZCbue8KhjAH6hqGvRuhLrCmcdbiA9p9XMPZBqjBlNg4kAfagIx7GmTgw1o5Q6FZC8q6x7OVwjy17qb6GRmlXE36"
    }

Response: 

    {
      "sessid":"osnt7elkkahvevl66o2c5cv6d2",
      "user":{
        "ctime":1341399278,
        "fb_name":"foo",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_timezone":"3",
        "fb_uid":"100004010804750",
        "id":294,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341399278
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/203/create`

Request: 

    {
      "text":"cuzari"
    }

Response: 

    {
      "day_id":null,
      "text":"cuzari",
      "ctime":1341399289,
      "id":30
    }

## Complaints - Display ##

`POST {{host}}/complaints/`

Request: `empty`

Response: 

    [
      {
        "id":31,
        "day_id":204,
        "ctime":1341399291,
        "text":"gesidofeliraxusifakihowexiwolibovoculefutoyirocotijucakuteravowijumocopumiladiwuyawajezalogehavixejuxuvekelitejolasolowuhabibudubiwuhohoxofiyigetudapuzuyaluwiwuyovejayatatorucexanidijamobegufanuluzezomokasinirazomewubuhesimakuzehucoriyeyixiluhudayayakiruvavokasiweyorudikijomiveropahexahowosidiwafixezexexevotekekopetuximibizupahilesenisegisitahejudenitifokoxofewurelerosehikitonuyamopokujenipeketunemetosagevohovokejogobofodiwukehupupeborununepupurunopogojapolupavagoyuritatebefodohomilopunavabifejadupubefaresocunilukaxu"
      }
    ]

## Day - Begin ##

`POST {{host}}days/begin`

Request: 

    {
      "title":"zozo",
      "description":"yurasoci",
      "time_offset":1341399295,
      "occupation":"guxopa",
      "age":1,
      "type":11
    }

Response: 

    {
      "id":205,
      "user_id":304,
      "title":"zozo",
      "description":"yurasoci",
      "time_offset":"1341399295",
      "occupation":"guxopa",
      "age":"1",
      "type":"11",
      "likes_count":null,
      "ctime":1341399295,
      "utime":1341399295,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/206/item`

Request: `empty`

Response: 

    {
      "id":206,
      "user_id":305,
      "title":"gomibilisalatonebotohucu",
      "description":"radefagujahiwaciwosalolepamivadeceteludocefulekezajitotexexohubegopotokodisivawodafuxudodulizivefexucetewevolikitikimikolubihurifikevamimefuvimidudohihohedicozehenalusufuwulemicigecidevexubudegoloranoyeverexoxadunehemafizexexexikihevapejidapedamelunimiwe",
      "time_offset":0,
      "occupation":"sopuyiduziwavogegipocura",
      "age":7,
      "type":8,
      "likes_count":0,
      "ctime":1341399295,
      "utime":1341399295,
      "is_ended":0,
      "moments":[
        {
          "id":68,
          "day_id":206,
          "description":"description jiciwinonusonekubuhoguxenafikuzomaherobatovebacacesehiposofatavagamuxizigoxeyugujuhimukanigetulubuwukominevihuloyogenipadoju",
          "img_url":"",
          "likes_count":0,
          "ctime":1341399295
        },
        {
          "id":69,
          "day_id":206,
          "description":"description mabulisigebagujoditazevidazivejekefuvuhacefegibebopuzemalisatakakixalafilewoxubupixixerevemihupoliwurulakesecodohafajolacure",
          "img_url":"",
          "likes_count":0,
          "ctime":1341399295
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/208;209;964/item`

Request: `empty`

Response: 

    {
      "208":{
        "id":208,
        "user_id":309,
        "title":"xeduxugajubibasayucepuxe",
        "description":"mumalohatimogudejuvoxenizilanayuxicebemoyumazonenezirizobisilinebopazavubezuxihivewisubogohohuzelijepahokepevusicizojumisogunagutijesiyawikojafepaducilojosuwuwimaxatohihofotebeladitihafuyaxopexinohugilifavalejitacufeyajowudokojolifuzeboniyuzozarakigojari",
        "time_offset":0,
        "occupation":"yepuweruxocabucibemawulo",
        "age":6,
        "type":11,
        "likes_count":0,
        "ctime":1341399299,
        "utime":1341399299,
        "is_ended":0,
        "moments":[
          {
            "id":70,
            "day_id":208,
            "description":"description yebogewuhucusogoyekofujuhuhawapokimozemefifufinaruwuwavacagucurilacikisidukehumuwevomivipaloxafefesiwecuhijilomeceyivocevibo",
            "img_url":"",
            "likes_count":0,
            "ctime":1341399299
          }
        ]
      },
      "209":{
        "id":209,
        "user_id":310,
        "title":"getidabilurirolokixorezu",
        "description":"jocasedawacujilijebiyeraliramuhurezesajifekiyocedavamiduyoyipagenenejutifazaxalagecoreniyiziretalekocagegakahodizedolofecaxokoxoxenukofixisajureboyikawihofojalajucorehivusavelubehilaxovakadohiteferixilipexucuhejomelehokipoyebasonidudofarexupesalajoxodija",
        "time_offset":0,
        "occupation":"yexorerugacasewowacavoje",
        "age":7,
        "type":5,
        "likes_count":0,
        "ctime":1341399299,
        "utime":1341399299,
        "is_ended":0,
        "moments":[
          {
            "id":71,
            "day_id":209,
            "description":"description hezabilikizesiziliyereniguzokahokevesexatuliheboxuzijicijajocikiwawikoramanomimeniwuzukebobahenanesubebikihudodogumexununizu",
            "img_url":"",
            "likes_count":0,
            "ctime":1341399299
          }
        ]
      },
      "964":null
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

`POST {{host}}days/210/add_moment`

Request: 

    {
      "description":"hejacatanogidumubenahagemowucehepikosaweyavabebanidotecacubadenoxulibevujibevakenibewamuzibaviwonefimunolicanimayijororihosagitotujawuyejamumuyilefacurenekowanibusurodusivanonuzobanojabovuwekucasosure",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":72,
      "day_id":210,
      "description":"hejacatanogidumubenahagemowucehepikosaweyavabebanidotecacubadenoxulibevujibevakenibewamuzibaviwonefimunolicanimayijororihosagitotujawuyejamumuyilefacurenekowanibusurodusivanonuzobanojabovuwekucasosure",
      "img_url":"\/media\/313\/day\/210\/0e1f4145a0d1f5b1bd367a6982601ad173562ed6.png",
      "likes_count":null,
      "ctime":1341399304
    }

## Day - Comment ##

`POST {{host}}days/212/comment`

Request: 

    {
      "text":"loboyutotiyukikufagitoneforugasovojoranenijuyoyawariwawaxibanotemacabilibonulicepoviwolocivofiyomasiradoxopecopohecazivayisabotisibenaxevitucemerilobetutecobuhogezoludahubecisocakajadamawizafekayozazexapupesolavoduwococatehakexehupaxacimocuwurutipocoxuya"
    }

Response: 

    {
      "text":"loboyutotiyukikufagitoneforugasovojoranenijuyoyawariwawaxibanotemacabilibonulicepoviwolocivofiyomasiradoxopecopohecazivayisabotisibenaxevitucemerilobetutecobuhogezoludahubecisocakajadamawizafekayozazexapupesolavoduwococatehakexehupaxacimocuwurutipocoxuya",
      "day":{
        "id":212,
        "user_id":316,
        "title":"setovuciciyadotekebegiyo",
        "occupation":"sofowixupiwidotasazuhamu",
        "age":8,
        "type":5,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341399306,
        "utime":1341399306,
        "cip":0
      },
      "user":{
        "id":316,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAJY3CFIDXY3ZBiFGrZCbue8KhjAH6hqGvRuhLrCmcdbiA9p9XMPZBqjBlNg4kAfagIx7GmTgw1o5Q6FZC8q6x7OVwjy17qb6GRmlXE36",
        "ctime":1341399306,
        "utime":1341399306,
        "cip":0
      },
      "cip":2130706433,
      "user_id":316,
      "day_id":212,
      "ctime":1341399308,
      "utime":1341399308,
      "id":11
    }

## Day - End ##

`POST {{host}}days/213/end`

Request: `empty`

Response: 

    null

## Day - End ##

`POST {{host}}days/213/add_moment`

Request: 

    {
      "description":"gotibifukoramokuyedigatolupujajiwabumevuzizifekarinunepudayihezajuyufosafopecumomunugazeguwifopivijuhacisoworelajucibayezovanerexugazerozikotutavupuxiduguzohibanejipudikifakufatozihalizehezeminozatasa",
      "image_name":"vakumi",
      "image_content":"jazaso"
    }

Response: 

    null

## Day - Delete ##

`POST {{host}}days/214/delete`

Request: `empty`

Response: 

    null

## Day - Share ##

`POST {{host}}days/215/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_110879975722362"
    }

## Moments - Update ##

`POST {{host}}moments/74/update`

Request: 

    {
      "description":"barebogoboyahomuyanewajanujetumozadavesodozijigelomewuketonisagoderutesuyohebinigutavakiwuziyecaroyecogugigezovatigipobenaxihunusigociteyuruveciweziyuwizozeridezecavukowupijocabapubilucegoxebusayizedujokoliwimikiwomuforaboxovudodepizuceluvujakaxubanociju"
    }

Response: 

    {
      "id":74,
      "day_id":218,
      "description":"barebogoboyahomuyanewajanujetumozadavesodozijigelomewuketonisagoderutesuyohebinigutavakiwuziyecaroyecogugigezovatigipobenaxihunusigociteyuruveciweziyuwizozeridezecavukowupijocabapubilucegoxebusayizedujokoliwimikiwomuforaboxovudodepizuceluvujakaxubanociju",
      "img_url":"",
      "likes_count":0,
      "ctime":1341399317
    }

## Moments - Delete ##

`POST {{host}}moments/75/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/76/comment`

Request: 

    {
      "text":"faxunuhesisexekosapuheyeharirunucesikuwamihexobiwolazekekatazexapirumizuzejuyekozuwufefiguredihoburijinewudogilejefimecogoyefabecotigesadutehanomoducasexosawohujuhihupevesanesuzuyazikufayuvaxafaridevunizasobomusimajocesuliyisizuvotefokukenujajugomeyadeta"
    }

Response: 

    {
      "text":"faxunuhesisexekosapuheyeharirunucesikuwamihexobiwolazekekatazexapirumizuzejuyekozuwufefiguredihoburijinewudogilejefimecogoyefabecotigesadutehanomoducasexosawohujuhihupevesanesuzuyazikufayuvaxafaridevunizasobomusimajocesuliyisizuvotefokukenujajugomeyadeta",
      "moment":{
        "id":76,
        "day_id":220,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341399323,
        "utime":1341399323,
        "cip":0
      },
      "user":{
        "id":325,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAJY3CFIDXY3ZBiFGrZCbue8KhjAH6hqGvRuhLrCmcdbiA9p9XMPZBqjBlNg4kAfagIx7GmTgw1o5Q6FZC8q6x7OVwjy17qb6GRmlXE36",
        "ctime":1341399323,
        "utime":1341399323,
        "cip":0
      },
      "cip":2130706433,
      "user_id":325,
      "moment_id":76,
      "ctime":1341399324,
      "utime":1341399324,
      "id":2
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "ctime":1341399325,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":null,
        "fb_uid":"100004036783679",
        "id":327,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341399325
      }
    ]

## User - CurrentUserDays ##

`POST {{host}}my/days/`

Request: `empty`

Response: 

    [
      {
        "id":221,
        "user_id":328,
        "title":"koboceperohowozogezepova",
        "description":"paxamagopojaniwozicopezikehadohozatigugusixecoyadasohogozitahuvedisemugalajivemujasiwuhukuyozoxafimolotuvajikumozahubirinicigurenazuwowowafayoxuvavutigezevahenumivegiyatagotapihejatihoxawalebuwogakabagetukemorusekuzezumedijuhizosavuhiwovehecutiyovunehoti",
        "time_offset":0,
        "occupation":"giconoparidareluvunewuwo",
        "age":8,
        "type":4,
        "likes_count":0,
        "ctime":1341399327,
        "utime":1341399327,
        "is_ended":0
      },
      {
        "id":222,
        "user_id":328,
        "title":"datofilatuzisolusumudoho",
        "description":"wecopalizanecetihijevofuxijuduguceromadidotawivazalotisizalaxobuzorisoyojozafojawoyijoferilihimecatowopahikijopalitoducomigoyozuwovojexoyeceyokedacezazipefizamowemapetipotilaviguwezusicubayiwovexerixakosutikuhefebuwarudikujahapuvidabozogetipuvositeluxuwa",
        "time_offset":0,
        "occupation":"vavewucecuxofowipuvakeci",
        "age":1,
        "type":4,
        "likes_count":0,
        "ctime":1341399327,
        "utime":1341399327,
        "is_ended":0
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/329/days/`

Request: `empty`

Response: 

    [
      {
        "id":223,
        "user_id":329,
        "title":"woremuwozemazezusuxalifa",
        "description":"zopotobipuvisureziwavayebohogusanevezuwitibikoweholavegubimekaluledebuyopugurahutoxicakaruhuboxixavuzositumezogomagigorumuwipoxitokokagabolumosutununavabimigecubirinunipunapebefigosatopahunevivizehiwuleyapujomimapawakayukomadilizeheraledozohivurizaruyuri",
        "time_offset":0,
        "occupation":"cinatayunayuyixixuwuvife",
        "age":5,
        "type":10,
        "likes_count":0,
        "ctime":1341399329,
        "utime":1341399329,
        "is_ended":0
      },
      {
        "id":224,
        "user_id":329,
        "title":"zitefifipobotidafujaciyu",
        "description":"casehidalunizumihedinahokabuzurabekexilemuwixexarusazuwebujaxucuhigazomipexisoretelogecedehukexowawuseherateyeposajuhedevekatewihokubogovuzojijupoxucagulibavusanazisefifadisimececakezoxayoxotesoyeyavahunujugijepopiminecizowomozexolasuduzeleruzanipawomole",
        "time_offset":0,
        "occupation":"pubihihorovorerenexawexa",
        "age":5,
        "type":8,
        "likes_count":0,
        "ctime":1341399329,
        "utime":1341399329,
        "is_ended":0
      }
    ]

## User - Followers ##

`POST {{host}}my/followers`

Request: `empty`

Response: 

    [
      
    ]

## User - Followers ##

`POST {{host}}my/followers`

Request: `empty`

Response: 

    [
      {
        "ctime":1341399331,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":332,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341399331
      }
    ]

## User - Following ##

`POST {{host}}my/following`

Request: `empty`

Response: 

    [
      
    ]

## User - Following ##

`POST {{host}}my/following`

Request: `empty`

Response: 

    [
      {
        "ctime":1341399333,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":334,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341399333
      }
    ]

## User - Follow ##

`POST {{host}}users/336/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/338/unfollow`

Request: `empty`

Response: 

    null

