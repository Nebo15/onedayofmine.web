# API examples #

 Version: 04.07.12 18:07:16

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAGUHuJ9ifrZBL0YJNMm3JtS1Xuml2zC90rBh0cvGhNb21LWAqLO8w8zbpgN6X4QQo8U8ZACa07FmIb793nRBZBnHoWnDZAWBZBEvLrtzd"
    }

Response: 

    {
      "sessid":"lso2ss0dqrooggbjl8ucn6hok4",
      "user":{
        "ctime":1341414368,
        "fb_name":"foo",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_timezone":"3",
        "fb_uid":"100004010804750",
        "id":651,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341414368
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/418/create`

Request: 

    {
      "text":"niyofi"
    }

Response: 

    {
      "day_id":null,
      "text":"niyofi",
      "ctime":1341414379,
      "id":36
    }

## Complaints - Display ##

`POST {{host}}/complaints/`

Request: `empty`

Response: 

    [
      {
        "id":37,
        "day_id":419,
        "ctime":1341414381,
        "text":"vupalareredolelatediruduzocudipuhabogobuyapepapegoturutimuloganififedegalomuvahavuxewizekixolidiyezamefuboxusawicowugofogagomegiremaloziguguzakatazuzaraguwofadohoxogudisekomotayofuxodaruxozuperiyuhajulorumecibejucibojumexamilejolorukevupugodinaziwelepejawomaluvavajibukeniwaroricavokatavahecahuholenonahecucokatavafihusifosirucafiworazozakefalugimipacozogireroximipifimixosesuyakijigedixosipibabimeduvusijejemosududehucunopirodawecihobicevibikajimomirafapovoyozafetevunikibovehezovovuwetocogariherafapitijizitujipalemazite"
      }
    ]

## Day - Begin ##

`POST {{host}}days/begin`

Request: 

    {
      "title":"gede",
      "description":"niyurumu",
      "time_offset":1341414385,
      "occupation":"lezave",
      "age":4,
      "type":8
    }

Response: 

    {
      "id":420,
      "user_id":661,
      "title":"gede",
      "description":"niyurumu",
      "time_offset":"1341414385",
      "occupation":"lezave",
      "age":"4",
      "type":"8",
      "likes_count":null,
      "ctime":1341414385,
      "utime":1341414385,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/421/item`

Request: `empty`

Response: 

    {
      "id":421,
      "user_id":662,
      "title":"higehuxuvigiditayibudexa",
      "description":"jaxupotixovamopegenukizexogipedumuxavorojerubabelicocabuwelirijanecewoxacizatahapeyoluregasupaxagukasegowawifasomolupafodupoxiwalafamewenowotinecudobekaguxaloguyeyevosekibayikanisiwatabodijeheteriyewetulokutuhilamafivezasejimuyigotunaruzewetelekitaxogizi",
      "time_offset":0,
      "occupation":"sofanejizecejudelukotogo",
      "age":7,
      "type":9,
      "likes_count":0,
      "ctime":1341414385,
      "utime":1341414385,
      "is_ended":0,
      "moments":[
        {
          "id":51,
          "day_id":421,
          "description":"description zikigizuwizusolazutacerisategifeyivayobojaratadocuxadipurecuvedovuvorumuwazifagezajapuyegacugasacitohasagoreturozuwiwotavuba",
          "img_url":"",
          "likes_count":0,
          "ctime":1341414385
        },
        {
          "id":52,
          "day_id":421,
          "description":"description hovekidatohedocehotabanisitemecoyubelalayonajojikasifexuwogewebofacofivafefiyicepotoborugudadaxeguxilopizoduhaguzupurawuzuza",
          "img_url":"",
          "likes_count":0,
          "ctime":1341414385
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/423;424;975/item`

Request: `empty`

Response: 

    {
      "423":{
        "id":423,
        "user_id":666,
        "title":"vadokucepogiveyopukusici",
        "description":"becidegozalabepahemacalacabujohezeyatavojawenekotuvozeyajuwosabonuteciyisovadazubosuzozepuzeyuxiyosadolukazijuketajorezecumayemuzaxawexamusuwaficigoteyufexatezopuvedononemehoyecacukusikirayitilixififorocugahefedijucokotehiwozogaciwobureyuragoripofujugola",
        "time_offset":0,
        "occupation":"lagasoxucuzewezujixezazu",
        "age":4,
        "type":8,
        "likes_count":0,
        "ctime":1341414388,
        "utime":1341414388,
        "is_ended":0,
        "moments":[
          {
            "id":53,
            "day_id":423,
            "description":"description gujipulofegukicazunadojinudesuzuwehegobezegevenofayetewecupoxiroxucaranokozabiyemunedemajaxerizilarafasixotudodopowobewejopu",
            "img_url":"",
            "likes_count":0,
            "ctime":1341414388
          }
        ]
      },
      "424":{
        "id":424,
        "user_id":667,
        "title":"woposusamoyixuhopocaxowi",
        "description":"bapixedevuzeraxobalehexehirosazodidayejogedujusedarimivoyimomijibipututufuxiwixurikacaxuneruwunulaxabideluvemofadiharafanodetohavahutecajukulizicevoluxutukiropituhigepifulimefiruhaxazicebozidomifotohusomadosopuvibobacaxaravaluvarabevilufarobefadafefahoba",
        "time_offset":0,
        "occupation":"tohacipumamagebafeyakeba",
        "age":7,
        "type":1,
        "likes_count":0,
        "ctime":1341414388,
        "utime":1341414388,
        "is_ended":0,
        "moments":[
          {
            "id":54,
            "day_id":424,
            "description":"description vuniyeforuvapudofiyefewajicuhefadopacoxopotanuwokobidurihojizirafafeyabirosapiwuhumitaxavaposaxukafebawoyivibolemusazifovopi",
            "img_url":"",
            "likes_count":0,
            "ctime":1341414388
          }
        ]
      },
      "975":null
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

`POST {{host}}days/425/add_moment`

Request: 

    {
      "description":"romejuzasomokuxazebovonomozanoxalelojixuferigirewoyohigofeyoyuxefecitulujamipavivocadewenozipuvofufuvowasesemitecojabamixizijofipeleyemopaxanokikovixezosugusemesurodahogawovajaxanojinalozadikujamicofe",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":55,
      "day_id":425,
      "description":"romejuzasomokuxazebovonomozanoxalelojixuferigirewoyohigofeyoyuxefecitulujamipavivocadewenozipuvofufuvowasesemitecojabamixizijofipeleyemopaxanokikovixezosugusemesurodahogawovajaxanojinalozadikujamicofe",
      "img_url":"\/media\/670\/day\/425\/e29d1772d6ee5223b62a168d5241e0e7de37f1e2.png",
      "likes_count":null,
      "ctime":1341414394
    }

## Day - Comment ##

`POST {{host}}days/427/comment`

Request: 

    {
      "text":"rarijorehowomatubaducayecudugidusolumahovanefedalebiluvixulakizahebolenelanihovoyudetuwivesawofabaximesulamowekobidokukahahatiforadaluzuzinusurokonotuxubacorelehijokenetagiyufepobesuhocekopuxukapomadefesafujopebeheyepebacuzicigireworixujapunidoxacikapizi"
    }

Response: 

    {
      "text":"rarijorehowomatubaducayecudugidusolumahovanefedalebiluvixulakizahebolenelanihovoyudetuwivesawofabaximesulamowekobidokukahahatiforadaluzuzinusurokonotuxubacorelehijokenetagiyufepobesuhocekopuxukapomadefesafujopebeheyepebacuzicigireworixujapunidoxacikapizi",
      "day":{
        "id":427,
        "user_id":673,
        "title":"jinopasosivubexoroxoyubo",
        "occupation":"saliminaxubogowuwuxuwoya",
        "age":2,
        "type":10,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341414396,
        "utime":1341414396,
        "cip":0
      },
      "user":{
        "id":673,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAGUHuJ9ifrZBL0YJNMm3JtS1Xuml2zC90rBh0cvGhNb21LWAqLO8w8zbpgN6X4QQo8U8ZACa07FmIb793nRBZBnHoWnDZAWBZBEvLrtzd",
        "ctime":1341414396,
        "utime":1341414396,
        "cip":0
      },
      "cip":2130706433,
      "user_id":673,
      "day_id":427,
      "ctime":1341414397,
      "utime":1341414397,
      "id":9
    }

## Day - End ##

`POST {{host}}days/428/end`

Request: `empty`

Response: 

    null

## Day - End ##

`POST {{host}}days/428/add_moment`

Request: 

    {
      "description":"robiwagapuvohicocehopupikivadaxozugoyixikohofekesoxemivubizatuyovamonefuzipavukiresasizozuxowokixuhidijawufowiciwopidigamawexayozafapifikecayasoweguvidenupicidasedevesarojixugogitayuhivuwukuxahujagafu",
      "image_name":"tilane",
      "image_content":"rijafo"
    }

Response: 

    null

## Day - DeleteDay ##

`POST {{host}}days/429/delete`

Request: `empty`

Response: 

    null

## Day - ShareDay ##

`POST {{host}}days/430/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_111062722370754"
    }

## Day - GetFollowingUsers ##

`POST {{host}}/my/days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":431,
        "user_id":679,
        "title":"pisosimakopegacurucivevi",
        "description":"jihivohisunihadimajewomorocekahomifegisuhelihidosizicidodacigefoxeyawibawisabuwohufehecilaxonahelanevikocasaxiwajupihozovujeyotewepowugubuzulocovojahetafakasamihadabezahuyotalisomubabegejumolowixuyuxavuxiweyibimariguyitekadesaciwuvovocizadumibadexawokati",
        "time_offset":0,
        "occupation":"mumazegixebuketedehalare",
        "age":6,
        "type":10,
        "likes_count":0,
        "ctime":1341414404,
        "utime":1341414404,
        "is_ended":0
      },
      {
        "id":432,
        "user_id":679,
        "title":"kocuyihiwoxurisuwexuwiha",
        "description":"dotivodadedolijelapopehugitivuxumilefijeyiyeyeselebunewovigilalusufukifexarujeforatamiwefavidamozorecusuxewerazegokojayigobexidudogepugifatocobelezopugopeditehubicikecijokemeruvirenudacepumusikocobajeyotecehuyudivepumatuzeledicarimiceyapazidayukivuriwixe",
        "time_offset":0,
        "occupation":"zofigojetemifigehosiriwo",
        "age":1,
        "type":6,
        "likes_count":0,
        "ctime":1341414404,
        "utime":1341414404,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsers ##

`POST {{host}}/my/days/following_users/`

Request: 

    {
      "from":431
    }

Response: 

    [
      {
        "id":432,
        "user_id":679,
        "title":"kocuyihiwoxurisuwexuwiha",
        "description":"dotivodadedolijelapopehugitivuxumilefijeyiyeyeselebunewovigilalusufukifexarujeforatamiwefavidamozorecusuxewerazegokojayigobexidudogepugifatocobelezopugopeditehubicikecijokemeruvirenudacepumusikocobajeyotecehuyudivepumatuzeledicarimiceyapazidayukivuriwixe",
        "time_offset":0,
        "occupation":"zofigojetemifigehosiriwo",
        "age":1,
        "type":6,
        "likes_count":0,
        "ctime":1341414404,
        "utime":1341414404,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsers ##

`POST {{host}}/my/days/following_users/`

Request: 

    {
      "from":431,
      "to":432
    }

Response: 

    [
      
    ]

## Day - GetNewDays ##

`POST {{host}}/days/new/`

Request: `empty`

Response: 

    [
      {
        "id":434,
        "user_id":681,
        "title":"cuhilidozuwowawoyidaluli",
        "description":"dujawerapazekigehijoneyuparejajibonuyaxihusohuwinafapazaholovocoliretivujirikidureyalujopokenidubohofatinecuvewenoputuseraramocilegokuduhexalomunayeyinirataxupefuyivamajedocotirowigefumuyetisujolasufaheveyixidofebegihawariyudebohewinowidocekereruxuyoyigu",
        "time_offset":0,
        "occupation":"gaxuyesawewaxewavozivaco",
        "age":2,
        "type":4,
        "likes_count":0,
        "ctime":1341414406,
        "utime":1341414406,
        "is_ended":0
      },
      {
        "id":435,
        "user_id":680,
        "title":"zoniguhuyirakovuhatejipa",
        "description":"pesibohabozozazocomijaguxotixiviwizudezayuyucusanarufusapipiyeyovurucocapuxoxiwesiguhuzujijexebocopagoforalirexesafucavisasijodijopijojuxolibevomupicezomogujegocugipikijuyedozoridoyalitogabitagumumuhosecoxalirifisozigamepajudusisukefidanipacosokofowoxiwa",
        "time_offset":0,
        "occupation":"suhemejoxibabuwepumokeze",
        "age":2,
        "type":5,
        "likes_count":0,
        "ctime":1341414406,
        "utime":1341414406,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}/days/new/`

Request: 

    {
      "from":434
    }

Response: 

    [
      {
        "id":435,
        "user_id":680,
        "title":"zoniguhuyirakovuhatejipa",
        "description":"pesibohabozozazocomijaguxotixiviwizudezayuyucusanarufusapipiyeyovurucocapuxoxiwesiguhuzujijexebocopagoforalirexesafucavisasijodijopijojuxolibevomupicezomogujegocugipikijuyedozoridoyalitogabitagumumuhosecoxalirifisozigamepajudusisukefidanipacosokofowoxiwa",
        "time_offset":0,
        "occupation":"suhemejoxibabuwepumokeze",
        "age":2,
        "type":5,
        "likes_count":0,
        "ctime":1341414406,
        "utime":1341414406,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":434,
      "to":435
    }

Response: 

    [
      
    ]

## Day - GetFavouriteDays ##

`POST {{host}}my/days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":437,
        "user_id":682,
        "title":"rovamofiwabayamuvevodezo",
        "description":"jazomihanugogupisusuwudawazaxohewebewemefocimozarodiserimirejupagimaxukapinafigufegusujalumoxayarefihirubayarazonepacuhixohovaxinayopirisivetocezolapopimuhezasifohofukumacayakuvuzepixakajehuxiragocopivotowaroyozifuniyuzewusicuganotemizenixiguzesizokuwawi",
        "time_offset":0,
        "occupation":"zajicujekerayosulevexusa",
        "age":6,
        "type":11,
        "likes_count":0,
        "ctime":1341414408,
        "utime":1341414408,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/438/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/439/unfavourite`

Request: `empty`

Response: 

    null

## Moments - Update ##

`POST {{host}}moments/57/update`

Request: 

    {
      "description":"wawuxololecimemeruceliwazebaxegokapewubejatujebubafisapohisayuxeyipokibosopuzozutalidubeponirewivejazeyodiracicutigumehaborofifuwiduyalapadosemetogebijahusikukalizepikamivatenibotagadiyuxesematileyolihepunamivarufolanelepujelopematohevokejakudisiseyamibo"
    }

Response: 

    {
      "id":57,
      "day_id":440,
      "description":"wawuxololecimemeruceliwazebaxegokapewubejatujebubafisapohisayuxeyipokibosopuzozutalidubeponirewivejazeyodiracicutigumehaborofifuwiduyalapadosemetogebijahusikukalizepikamivatenibotagadiyuxesematileyolihepunamivarufolanelepujelopematohevokejakudisiseyamibo",
      "img_url":"",
      "likes_count":0,
      "ctime":1341414414
    }

## Moments - Delete ##

`POST {{host}}moments/58/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/59/comment`

Request: 

    {
      "text":"gizazihinusowubakisikoyedikeyufalafenivaliwehujogugovayusejiciviruxajogodazixecajetamocayevaxinimerucupexiroxowecikigitawidobodiboharujikuhesamosujuhabanaviwuzusezecewihasufavubavedomozefufasulodibuyebohevacuduferoxixakagaxovuduzacasegilehidivocohusoyuvo"
    }

Response: 

    {
      "text":"gizazihinusowubakisikoyedikeyufalafenivaliwehujogugovayusejiciviruxajogodazixecajetamocayevaxinimerucupexiroxowecikigitawidobodiboharujikuhesamosujuhabanaviwuzusezecewihasufavubavedomozefufasulodibuyebohevacuduferoxixakagaxovuduzacasegilehidivocohusoyuvo",
      "moment":{
        "id":59,
        "day_id":442,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341414418,
        "utime":1341414418,
        "cip":0
      },
      "user":{
        "id":690,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAGUHuJ9ifrZBL0YJNMm3JtS1Xuml2zC90rBh0cvGhNb21LWAqLO8w8zbpgN6X4QQo8U8ZACa07FmIb793nRBZBnHoWnDZAWBZBEvLrtzd",
        "ctime":1341414418,
        "utime":1341414418,
        "cip":0
      },
      "cip":2130706433,
      "user_id":690,
      "moment_id":59,
      "ctime":1341414419,
      "utime":1341414419,
      "id":5
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "ctime":1341414420,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":null,
        "fb_uid":"100004036783679",
        "id":692,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341414420
      }
    ]

## User - CurrentUserDays ##

`POST {{host}}my/days/`

Request: `empty`

Response: 

    [
      {
        "id":443,
        "user_id":693,
        "title":"bununisisukasilazomaxiwe",
        "description":"xapumujerilofivoludemopedezadecupoyapehevozugototuxamimivituwoxilumucofulavoyijojaxorejivajiwazezigagixopojidofivafikiwapasihosefujejabuveluzojoriduzudicuzemoromucocasulavetadepejigicegaroselafizepoduvukiziwivacapajugupugucelarusozireyoxofoxerilujoxupayo",
        "time_offset":0,
        "occupation":"zomuvupoxagukiwozajumigu",
        "age":5,
        "type":9,
        "likes_count":0,
        "ctime":1341414422,
        "utime":1341414422,
        "is_ended":0
      },
      {
        "id":444,
        "user_id":693,
        "title":"tiruvodajimoyuxikanuzetu",
        "description":"bucafihoduyesovunijucopobijodilajijibiganakawacerekodumajowijepotufomixupedejetupatobewebotexeyigahonasakunobetojikesasowizotuhucipitetadewamiwubafokukegeyuhewewiyitosuwibecucabevecapemigotabimucepocegaseyokubajagukololasisalokumikonaziwekulozorekazofohu",
        "time_offset":0,
        "occupation":"polujabiyayucisokenalaya",
        "age":5,
        "type":11,
        "likes_count":0,
        "ctime":1341414422,
        "utime":1341414422,
        "is_ended":0
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/694/days/`

Request: `empty`

Response: 

    [
      {
        "id":445,
        "user_id":694,
        "title":"lufujopimeviwewemawubuwa",
        "description":"huwemuhepecikuculerufumikumojesidiyikawukuloxirexedacomiludofujehexokororamipawijuninuxuxarawujafewiyihimocaxumevurezigupuxiwenamenevuyepahixototezoxanicixuseyatipihisunuketabiludefovedofubazopigubuviyayofuboyazaxolalowitogejigeluxecoyetuxofuwarebawumiso",
        "time_offset":0,
        "occupation":"mobalucifucomacipuvunija",
        "age":1,
        "type":1,
        "likes_count":0,
        "ctime":1341414424,
        "utime":1341414424,
        "is_ended":0
      },
      {
        "id":446,
        "user_id":694,
        "title":"royepuyuvegudefufebiyefe",
        "description":"mafugedamupimuxaxitipuhexumezisirukudibojoculubekowurahizoxujilumuvijofolenugidogupucukarebuwiwehixikahokorihofitokuroxebudukufonagudisigecibebobipogiyejacobejijilibazekavehudehobidusibofabipecawadojiwaxayalasisulehidimayanacecaditunobirireyederewowexohi",
        "time_offset":0,
        "occupation":"kekibibuyabewuxonefofuwa",
        "age":2,
        "type":9,
        "likes_count":0,
        "ctime":1341414424,
        "utime":1341414424,
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
        "ctime":1341414426,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":697,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341414426
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
        "ctime":1341414428,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":699,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341414428
      }
    ]

## User - Follow ##

`POST {{host}}users/701/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/703/unfollow`

Request: `empty`

Response: 

    null

