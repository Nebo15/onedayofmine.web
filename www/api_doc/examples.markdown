# API examples #

 Version: 05.07.12 21:53:31

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAGeLtWWi2hBhh6NIVFrkmZAdZB379ANA1CRzmm9BkBPs5qsuyX8hoR8pmIQuHsmS6rIstYJSI595PJcuXZBlXtz3YdoX0DFBvuG3qxU"
    }

Response: 

    {
      "sessid":"qcubbt5pr8h082ushnlf4at3g0",
      "user":{
        "name":"foo",
        "sex":"female",
        "timezone":"3",
        "fb_uid":"100004010804750",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "ctime":1341514353,
        "utime":1341514353,
        "id":535
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/281/create`

Request: 

    {
      "text":"vayoza"
    }

Response: 

    {
      "day_id":null,
      "text":"vayoza",
      "ctime":1341514363,
      "id":8
    }

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"pero",
      "description":"fovasuwe",
      "time_offset":1341514367,
      "occupation":"mupovo",
      "age":6,
      "type":9
    }

Response: 

    {
      "id":282,
      "user_id":543,
      "title":"pero",
      "description":"fovasuwe",
      "time_offset":"1341514367",
      "occupation":"mupovo",
      "age":"6",
      "type":"9",
      "likes_count":null,
      "ctime":1341514367,
      "utime":1341514367,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":283,
      "user_id":544,
      "title":"zituronurububofeketohomi",
      "description":"cutugurufonubopuravipepozilegofepuduvowumeticekolahunuvigavixuwiwuhisanakesipafagizohohizazubohusilepupugemokowidokenoxitujopipecusoyesanayuwomunukamepecuzomiyinigiwurecifujoyumeyunidikagusakasisimewixamaribasubekavohunududumujudapufadomayacujidafidokeri",
      "time_offset":0,
      "occupation":"gajadazotobejunegigicipo",
      "age":2,
      "type":7,
      "likes_count":0,
      "ctime":1341514367,
      "utime":1341514367,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"vaginaxerocazufufoyumucexihudijunihatametinolosomipunohefigezidicipupagepobamorujaxuwagasihozefawoyewaseyolimakufesakubakevesumitexiniyihexojenimepudoziyowosedesaxenosudipitazehicefawavotiyuvixovimigi",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":92,
      "day_id":285,
      "description":"vaginaxerocazufufoyumucexihudijunihatametinolosomipunohefigezidicipupagepobamorujaxuwagasihozefawoyewaseyolimakufesakubakevesumitexiniyihexojenimepudoziyowosedesaxenosudipitazehicefawavotiyuvixovimigi",
      "img_url":"\/media\/546\/day\/285\/1ee65fa930a3dd5bf747feab9878effac4e52535.png",
      "likes_count":null,
      "ctime":1341514370
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

## Day - Item ##

`POST {{host}}days/287/item`

Request: `empty`

Response: 

    {
      "id":287,
      "user_id":548,
      "title":"zemejarupebagudutowizowi",
      "description":"gasiwivivagepavofugasimabesifufezuyujokavokeracobexosetorejuhigejacoviticayojumehecutosefugilitopokehayehuzowizawaciwoxusalanawazelejenogigazedohahayadihisosixotexasesuxuyudasigunadotefifuyanojesutewojonivaxadifeburejocewoxazidoyukesutibimabojapuhutedizu",
      "time_offset":0,
      "occupation":"kigenusatoheregiwutilura",
      "age":4,
      "type":4,
      "likes_count":0,
      "ctime":1341514372,
      "utime":1341514372,
      "is_ended":0,
      "moments":[
        {
          "id":93,
          "day_id":287,
          "description":"description xojixusebutarafujubepikemuvixuyorejifuxayigirekujifuzihimabexudigizelupeloyafebisakotocasanicobecasixevecokezitorajetinenayi",
          "img_url":"",
          "likes_count":0,
          "ctime":1341514372
        },
        {
          "id":94,
          "day_id":287,
          "description":"description xayitinasaheyecemuhibatusuyiribivuyilipalunegisolugicujovegiwexiducigotonezovoleposorakigowawosunonolelumerebamosahefovihoma",
          "img_url":"",
          "likes_count":0,
          "ctime":1341514372
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/288;289;728/item`

Request: `empty`

Response: 

    {
      "288":{
        "id":288,
        "user_id":550,
        "title":"xizejanuwiyixexopakusega",
        "description":"xadimohexesaziluwibuxifiwojuleyejaxuwacokotehahasezixabovererinupetenocunohuyixixudozakomazanibayominijakixedoxurasifajocevowotonedavidaculatefejuyizefapusetedepejetinoluzahanibicutebefosubodobiboxipemimosujolisasomukatiyubujatepenawuvizafinuranabugojare",
        "time_offset":0,
        "occupation":"dujuyogilicepolezaxajabe",
        "age":2,
        "type":6,
        "likes_count":0,
        "ctime":1341514374,
        "utime":1341514374,
        "is_ended":0,
        "moments":[
          {
            "id":95,
            "day_id":288,
            "description":"description holodowusoguwinupabayatumitacavesayuyosolunehafugazafozojovevisivojokuhowocawezakugiraguyajopufepibumevedumubibijebuleyegebu",
            "img_url":"",
            "likes_count":0,
            "ctime":1341514374
          }
        ]
      },
      "289":{
        "id":289,
        "user_id":551,
        "title":"xizesovupisuvolanefagiba",
        "description":"gemehoyakizigulolamomifajobepajunogokayoruguvonatazemakuxicinegafiwipojaribefipupidasixiyuyikanirecacejoyedayobihapusilolecunijayijavovozuwurulubuwomejuritabajulobehuyetoferigopakajoyufodasifacakezepocobohejujoxolurimovafuhecopayatuwosabuzesuzasisajijijo",
        "time_offset":0,
        "occupation":"semamifixatazusaheziyumo",
        "age":1,
        "type":10,
        "likes_count":0,
        "ctime":1341514374,
        "utime":1341514374,
        "is_ended":0,
        "moments":[
          {
            "id":96,
            "day_id":289,
            "description":"description hasupuhagofuwafeyarayabicavejunowapicurenudexepojawejutexipajavajeregesobucudosiwivakimebaleganipaxukipekohihuzamohugocewipa",
            "img_url":"",
            "likes_count":0,
            "ctime":1341514374
          }
        ]
      },
      "728":null
    }

## Day - CommentCreate ##

`POST {{host}}days/291/comment_create`

Request: 

    {
      "text":"tijagatowuziwelijateyelameyutojigopiwegohedanipusecositavozijeyibizuwalalifucovodukokayawuragirebocuviyabadaxuyawevelokepujunucipalerepomowesokicasixaticahibefomibayovekotakamihaxagiperuxofajoretiziyedojituxabodekopapitomalakaresisofahuxayuyadevojedacici"
    }

Response: 

    {
      "text":"tijagatowuziwelijateyelameyutojigopiwegohedanipusecositavozijeyibizuwalalifucovodukokayawuragirebocuviyabadaxuyawevelokepujunucipalerepomowesokicasixaticahibefomibayovekotakamihaxagiperuxofajoretiziyedojituxabodekopapitomalakaresisofahuxayuyadevojedacici",
      "day":{
        "id":291,
        "user_id":555,
        "title":"bicuxojayazalotufabogapo",
        "occupation":"jefitagaxabimelasufoloyi",
        "age":2,
        "type":4,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341514377,
        "utime":1341514377,
        "cip":0
      },
      "user":{
        "id":555,
        "name":"foo",
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAGeLtWWi2hBhh6NIVFrkmZAdZB379ANA1CRzmm9BkBPs5qsuyX8hoR8pmIQuHsmS6rIstYJSI595PJcuXZBlXtz3YdoX0DFBvuG3qxU",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "sex":"female",
        "ctime":1341514377,
        "utime":1341514377,
        "cip":0
      },
      "cip":2130706433,
      "user_id":555,
      "day_id":291,
      "ctime":1341514378,
      "utime":1341514378,
      "id":14
    }

## Day - ShareDay ##

`POST {{host}}days/292/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_112001892276837"
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

## Day - DeleteDay ##

`POST {{host}}days/293/delete`

Request: `empty`

Response: 

    null

## Day - GetFavouriteDays ##

`POST {{host}}days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":294,
        "user_id":560,
        "title":"fokafipepupehotuvopozoyi",
        "description":"cinorixasayujiyabiwowerisojacerawayiponeyiceyujupatilewazacanofewavexeruwocotirepesusicorasawunozecurosilodagolodavorulezaluzumugiwuhigohewidehekabuxiguposipanoteruwusagireturazocudesoyehimohecufutucukojarufipelonalilozuledifelufixigasucumodukozocelahuhi",
        "time_offset":0,
        "occupation":"rowezazaxojetonowomogeje",
        "age":8,
        "type":8,
        "likes_count":0,
        "ctime":1341514384,
        "utime":1341514384,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/295/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/296/unfavourite`

Request: `empty`

Response: 

    null

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":297,
        "user_id":567,
        "title":"muguveruyenepuyukatoxabo",
        "description":"fifogifujirohesehuyepakicevivenuwopadoxigidiwotavojevoxucokuxuvoretocifedewucizuhegazazatexohojuzarasokocasavobazedukazamuvomaridemuzupabefuyexumaxuduzisohavupudavaweduperimimunevofofulibekifirupihohuzukilulufaneyogegepixocisoyujavedavibamekapeturucenuzo",
        "time_offset":0,
        "occupation":"jisotodovojiniyesuyapido",
        "age":5,
        "type":1,
        "likes_count":0,
        "ctime":1341514388,
        "utime":1341514388,
        "is_ended":0
      },
      {
        "id":298,
        "user_id":567,
        "title":"xazokijuwecelidikavobuli",
        "description":"hilowajeyulidetopefifutadimudupikacecipakupikefunelojawipehogudixavupezukiloyotizadehutujuniwodowusijokogomakepekorotemakuneroyinowuhanizusegetizegotosatejewetexigatosovecupopidogunubedenurekivirijefasecebowakacuzadakocuwimozadelelapijocavifukaxigecehuso",
        "time_offset":0,
        "occupation":"fudojizadaxitiyajigiluku",
        "age":1,
        "type":3,
        "likes_count":0,
        "ctime":1341514388,
        "utime":1341514388,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":297
    }

Response: 

    [
      {
        "id":298,
        "user_id":567,
        "title":"xazokijuwecelidikavobuli",
        "description":"hilowajeyulidetopefifutadimudupikacecipakupikefunelojawipehogudixavupezukiloyotizadehutujuniwodowusijokogomakepekorotemakuneroyinowuhanizusegetizegotosatejewetexigatosovecupopidogunubedenurekivirijefasecebowakacuzadakocuwimozadelelapijocavifukaxigecehuso",
        "time_offset":0,
        "occupation":"fudojizadaxitiyajigiluku",
        "age":1,
        "type":3,
        "likes_count":0,
        "ctime":1341514388,
        "utime":1341514388,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":297,
      "to":298
    }

Response: 

    [
      
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: `empty`

Response: 

    [
      {
        "id":300,
        "user_id":569,
        "title":"wiralizapifewobizevegoxe",
        "description":"womozowiwugiguhenocugijemuvujukasuwonocepewugadowapasukaxadadihojakutifevucudatukebagefamegivikaroyegarucozayodebajemihuwipicurosicuroxoluxepariduvolaperawocilobisogijolezugonepezuligatatumariseduwipesifufohobetiwumizekikuzahazapijecifegizesosirabokicoka",
        "time_offset":0,
        "occupation":"sucuwimukemehebejayiyibe",
        "age":8,
        "type":2,
        "likes_count":0,
        "ctime":1341514389,
        "utime":1341514389,
        "is_ended":0
      },
      {
        "id":301,
        "user_id":568,
        "title":"rirugozepotovuyowemireyi",
        "description":"wazahehipobafapusemuduwekeheforutifuximidirepajekodisuwahalitalipokicuyakinusugapepegijinozetirebavaxojegufurizetinuzuminisewepujebebelefogubabotitokefurudidokibesatajuvisutopihefonemadorejuvekikapozehodakonobogizotakelojazorevadonikomokukirozojovobakeke",
        "time_offset":0,
        "occupation":"yekasesunicakisobugebivi",
        "age":3,
        "type":6,
        "likes_count":0,
        "ctime":1341514389,
        "utime":1341514389,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":300
    }

Response: 

    [
      {
        "id":301,
        "user_id":568,
        "title":"rirugozepotovuyowemireyi",
        "description":"wazahehipobafapusemuduwekeheforutifuximidirepajekodisuwahalitalipokicuyakinusugapepegijinozetirebavaxojegufurizetinuzuminisewepujebebelefogubabotitokefurudidokibesatajuvisutopihefonemadorejuvekikapozehodakonobogizotakelojazorevadonikomokukirozojovobakeke",
        "time_offset":0,
        "occupation":"yekasesunicakisobugebivi",
        "age":3,
        "type":6,
        "likes_count":0,
        "ctime":1341514389,
        "utime":1341514389,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":300,
      "to":301
    }

Response: 

    [
      
    ]

## Day - CurrentUserDays ##

`POST {{host}}days/my`

Request: `empty`

Response: 

    [
      {
        "id":303,
        "user_id":570,
        "title":"yuvadenuyixojosohifagocu",
        "description":"hadesivawimutofumofafivataminurobofojutanabewafeyemavehihoyuvirohomosevekomezonuzuzofegicahururusanejepocayasixokujidicasebehoguvojabuvazocoduhiwodufacunadoteticapazefucenagutaluzizalifijuwaludubajezemipoketocokavopuhuwazecagafihayosimavewuyazozipemiliri",
        "time_offset":0,
        "occupation":"durigaduponezecuduhodapi",
        "age":6,
        "type":9,
        "likes_count":0,
        "ctime":1341514391,
        "utime":1341514391,
        "is_ended":0
      },
      {
        "id":304,
        "user_id":570,
        "title":"fipefekugejodafaxatekiju",
        "description":"xeriheyohegaloxihepacedewuzoxuxogifixadaledudagelulifitumovepocudejujicowepuhuhorofuhuwopicagazelehovenoranuyupinokusenevoluwijetizizidipomimacawiwisevibelurocejaxepuyasesamofefuwukohexogilexojocuvubikonulofosalaromilozuyurepodetavayezezazodivodegixeluca",
        "time_offset":0,
        "occupation":"dicojesezawuxetoxagepibi",
        "age":1,
        "type":6,
        "likes_count":0,
        "ctime":1341514391,
        "utime":1341514391,
        "is_ended":0
      }
    ]

## Moments - Update ##

`POST {{host}}moments/102/update`

Request: 

    {
      "description":"gicitonegujegujasajohizotatamiwobufosozupefohivusatunotetijabawacawovuredodihukucayowoxidesakiginafexorupokutowoxolokehimurumuhuyihoguvosareyifudinixoyetifalifeyifajuxucikayiwadenufijubidibewutucayucumibebukahudijikeziwuvoyirurizonidivakahocediwivuzowogo"
    }

Response: 

    {
      "id":102,
      "day_id":309,
      "description":"gicitonegujegujasajohizotatamiwobufosozupefohivusatunotetijabawacawovuredodihukucayowoxidesakiginafexorupokutowoxolokehimurumuhuyihoguvosareyifudinixoyetifalifeyifajuxucikayiwadenufijubidibewutucayucumibebukahudijikeziwuvoyirurizonidivakahocediwivuzowogo",
      "img_url":"",
      "likes_count":0,
      "ctime":1341514398
    }

## Moments - Delete ##

`POST {{host}}moments/103/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/104/comment`

Request: 

    {
      "text":"hayukoxihovagesitifimulohawomusoxopehisigiriwexixabezicenuzavovoheyividubolubelujihexepehilagasinibefahaxobuzivexasokedowisatemezinarojimekixavofimitifidupuhabepikahosodagudusemawatatuyesakolugudinohowirumehumadeducafofilomolofulirexefenihunegohesibuzimi"
    }

Response: 

    {
      "text":"hayukoxihovagesitifimulohawomusoxopehisigiriwexixabezicenuzavovoheyividubolubelujihexepehilagasinibefahaxobuzivexasokedowisatemezinarojimekixavofimitifidupuhabepikahosodagudusemawatatuyesakolugudinohowirumehumadeducafofilomolofulirexefenihunegohesibuzimi",
      "moment":{
        "id":104,
        "day_id":311,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341514400,
        "utime":1341514400,
        "cip":0
      },
      "user":{
        "id":583,
        "name":"foo",
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAGeLtWWi2hBhh6NIVFrkmZAdZB379ANA1CRzmm9BkBPs5qsuyX8hoR8pmIQuHsmS6rIstYJSI595PJcuXZBlXtz3YdoX0DFBvuG3qxU",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "sex":"female",
        "ctime":1341514400,
        "utime":1341514400,
        "cip":0
      },
      "cip":2130706433,
      "user_id":583,
      "moment_id":104,
      "ctime":1341514401,
      "utime":1341514401,
      "id":22
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "id":585,
        "name":"bar",
        "fb_uid":"100004036783679",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "sex":"male",
        "ctime":1341514402,
        "utime":1341514402,
        "user_info":{
          "name":"bar",
          "sex":"male",
          "timezone":null,
          "fb_uid":"100004036783679",
          "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
          "fb_profile_utime":1340810728,
          "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
          "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
          "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg"
        }
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/586/days/`

Request: `empty`

Response: 

    [
      {
        "id":312,
        "user_id":586,
        "title":"punapoviwodecadaremadijo",
        "description":"hizonujitugevixubofajufixehegekitegehisukuhalabiyepedowadahejowacajepakuzodevawokezifuneyupenihiloyareziyazojokofegeforapehasirafiduxalogemifugegisedemonotejehizijunorocagebipexerupasaxijawosoburisegolibiyirowevekinexulolamibazolenusigoculufajiruwiregaho",
        "time_offset":0,
        "occupation":"cenogixoporuvayumuvamewa",
        "age":7,
        "type":3,
        "likes_count":0,
        "ctime":1341514403,
        "utime":1341514403,
        "is_ended":0
      },
      {
        "id":313,
        "user_id":586,
        "title":"hiyoyowoxehugutojowadesi",
        "description":"vapegatulewubinadixaxiwojevirujeyuvazibiwuguhobihulalexorodepirikesewovonanuvihaloguzapivovedewitiwififoponegolomonivabivuxufokufamevocekitokajuwuhozedoduresagugofukejowalagobapesirohovuciyehabidisifinisojovuzimogokasimovovogufujeluzapevegovokalocafituji",
        "time_offset":0,
        "occupation":"gejamizufatexadinucivezi",
        "age":6,
        "type":2,
        "likes_count":0,
        "ctime":1341514403,
        "utime":1341514403,
        "is_ended":0
      }
    ]

## User - Followers ##

`POST {{host}}users/followers`

Request: `empty`

Response: 

    [
      
    ]

## User - Followers ##

`POST {{host}}users/followers`

Request: `empty`

Response: 

    [
      {
        "id":589,
        "name":"bar",
        "fb_uid":"100004036783679",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "sex":"male",
        "ctime":1341514405,
        "utime":1341514405
      }
    ]

## User - Following ##

`POST {{host}}users/following`

Request: `empty`

Response: 

    [
      
    ]

## User - Following ##

`POST {{host}}users/following`

Request: `empty`

Response: 

    [
      {
        "id":591,
        "name":"bar",
        "fb_uid":"100004036783679",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "sex":"male",
        "ctime":1341514406,
        "utime":1341514406
      }
    ]

## User - Follow ##

`POST {{host}}users/593/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/595/unfollow`

Request: `empty`

Response: 

    null

