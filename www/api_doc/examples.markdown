# API examples #

 Version: 06.07.12 16:02:46

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAFqG9oc0b0o1OSDcfZBUZCgmdZCwhabB6eJUVxwLzuqxm1utenTXK8BstqvGRXRZAcMnI7Uut3gTGOiCh1uexHEbSKybjAVRv9c0ZBiyR"
    }

Response: 

    {
      "sessid":"q0pjc24svvgvebsnvosp2kh7j4",
      "user":{
        "first_name":"foo",
        "last_name":"foo",
        "sex":"female",
        "timezone":"3",
        "fb_uid":"100004010804750",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "ctime":1341579681,
        "utime":1341579681,
        "id":707
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/43/create`

Request: 

    {
      "text":"cekuto"
    }

Response: 

    {
      "day_id":null,
      "text":"cekuto",
      "ctime":1341579700,
      "id":10
    }

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"defi",
      "description":"lalayaya",
      "time_offset":1341579705,
      "occupation":"cobuco",
      "age":7,
      "type":6
    }

Response: 

    {
      "id":44,
      "user_id":715,
      "title":"defi",
      "description":"lalayaya",
      "time_offset":"1341579705",
      "occupation":"cobuco",
      "age":"7",
      "type":"6",
      "likes_count":null,
      "ctime":1341579705,
      "utime":1341579705,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":45,
      "user_id":716,
      "title":"fubuwoxobehuvoxokawidoyo",
      "description":"roxexifihojisuralirorajolomaculopecivebazepohatosejekoduliyimegapenepimixagafuxujagowenexitevulehutumelegonirejupitiwerosecijivolilutuhunokafofofufadotofogihudonirelufusifufepehokenafoxehakexuzicekekavixuyijafopovolocovicojafelirupikilexomalavatevuyihugi",
      "time_offset":0,
      "occupation":"xicavudixugoharupabopate",
      "age":7,
      "type":1,
      "likes_count":0,
      "ctime":1341579705,
      "utime":1341579705,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"dugadawezovemulosaxexehoyuwoyehakigipawivovereyegunabuwusorobusikuyuyomokezumuhotuwososehezefotinoniladohavobamoyemoyazelunopefaxometocuvutozanulunecipiladukecezinofosunetipelugukemuwucuyifusanewoxisi",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":18,
      "day_id":47,
      "description":"dugadawezovemulosaxexehoyuwoyehakigipawivovereyegunabuwusorobusikuyuyomokezumuhotuwososehezefotinoniladohavobamoyemoyazelunopefaxometocuvutozanulunecipiladukecezinofosunetipelugukemuwucuyifusanewoxisi",
      "img_url":"\/media\/718\/day\/47\/576ce8a78bf30495cbea74280c2a44e8b0cd8af5.png",
      "likes_count":null,
      "ctime":1341579710
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

## Day - Item ##

`POST {{host}}days/49/item`

Request: `empty`

Response: 

    {
      "id":49,
      "user_id":720,
      "title":"vevecefajijacozepegazenu",
      "description":"kaluvuseyaziyutitosalafevovocuvibehofucacatuximidavihuwativopihotikunicimopegayegozironekefuwipizumilicujogitayuvulisuwahubakopepaxapuxupalefehuholusebugazorizerugevadefisezukerofebagegewuwubiresijuvikixekepabohayijavaziyubigobinocuguhogurenujilopavivono",
      "time_offset":0,
      "occupation":"kegofuzifedacamijexepufo",
      "age":1,
      "type":5,
      "likes_count":0,
      "ctime":1341579711,
      "utime":1341579711,
      "is_ended":0,
      "moments":[
        {
          "id":19,
          "day_id":49,
          "description":"description fehopaxodoxiwezikotixegozohocuvefaxofolelewenovunikivogojililesohikijovociyokonuhujanivubehimucomigohunepizufiwikalusevomafu",
          "img_url":"",
          "likes_count":0,
          "ctime":1341579711
        },
        {
          "id":20,
          "day_id":49,
          "description":"description zocajipilolifemuziweyiyijetivefobexesizafepepafirazipududujufisevipicipeyapifocovajexihajoyiditufekexulodahevecijizexegaxasu",
          "img_url":"",
          "likes_count":0,
          "ctime":1341579711
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/50;51;581/item`

Request: `empty`

Response: 

    {
      "50":{
        "id":50,
        "user_id":722,
        "title":"natovapikunocipitisodaka",
        "description":"futufezusipuvebetohowinisogosejugawikuhaguyucugupireyawoyajijomisezadefedajabibobozuwupoxujanutedojeyipapugomegiyelobamuyubirotolabenilamosuxuludunaxabuxajiwaheberiwapesegifokemukeyegoliheniniwacogozuzamawuketotofumomoxajepapovokoseyaloyodonukovujepahupu",
        "time_offset":0,
        "occupation":"dalinebajanakadabimivixu",
        "age":7,
        "type":7,
        "likes_count":0,
        "ctime":1341579714,
        "utime":1341579714,
        "is_ended":0,
        "moments":[
          {
            "id":21,
            "day_id":50,
            "description":"description coworidolifenawocokinidotukiyupapewavuzanaladevewaterubevevohetuticilasufazehonazemicixuxonabebotahadudebapeyalujulilegeboma",
            "img_url":"",
            "likes_count":0,
            "ctime":1341579714
          }
        ]
      },
      "51":{
        "id":51,
        "user_id":723,
        "title":"cilakenuzegetajuwivopeba",
        "description":"boyejuhawacigivobenucetelasebofahakobotutukuhapekacikuwoxicufezilecizuhosoruvegakepodenuyixaxunefotaluwapibesemapatolesexilokubirosatifezeromasadisiseyiyehejexucizocabakosuvewuvinixizuwedapucopakogisodelutewivexowumodovopuhazovebiwaxebimucehuzawitucipolu",
        "time_offset":0,
        "occupation":"mufapolulumuwuwohamaferu",
        "age":6,
        "type":11,
        "likes_count":0,
        "ctime":1341579714,
        "utime":1341579714,
        "is_ended":0,
        "moments":[
          {
            "id":22,
            "day_id":51,
            "description":"description jiyacedatamesihesujinixonebomamotiyurazefituxugixidicugifegokomadeyoludojumawovohudewexuparuxacumavuxunatakivagazekosevelige",
            "img_url":"",
            "likes_count":0,
            "ctime":1341579714
          }
        ]
      },
      "581":null
    }

## Day - CommentCreate ##

`POST {{host}}days/53/comment_create`

Request: 

    {
      "text":"marobasegadalahupaveyeladecezomivacododevekekodutuhogoweyusurakigigefeturaduvexigafixuvoyitipazunefopupezofobagegesakixeyixirujacivojexedabadekesalapekiwezicenatexatokuvizutegemomaxumocidatojizapoyunolipaxunemujewucuhabaxenumapebacipopinawucajuzivepohico"
    }

Response: 

    {
      "text":"marobasegadalahupaveyeladecezomivacododevekekodutuhogoweyusurakigigefeturaduvexigafixuvoyitipazunefopupezofobagegesakixeyixirujacivojexedabadekesalapekiwezicenatexatokuvizutegemomaxumocidatojizapoyunolipaxunemujewucuhabaxenumapebacipopinawucajuzivepohico",
      "day":{
        "id":53,
        "user_id":727,
        "title":"fewavepelegaworejiginixe",
        "occupation":"govutavetovenejozamadije",
        "age":6,
        "type":5,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341579720,
        "utime":1341579720,
        "cip":0
      },
      "user":{
        "id":727,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAFqG9oc0b0o1OSDcfZBUZCgmdZCwhabB6eJUVxwLzuqxm1utenTXK8BstqvGRXRZAcMnI7Uut3gTGOiCh1uexHEbSKybjAVRv9c0ZBiyR",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "sex":"female",
        "ctime":1341579720,
        "utime":1341579720,
        "cip":0
      },
      "cip":2130706433,
      "user_id":727,
      "day_id":53,
      "ctime":1341579721,
      "utime":1341579721,
      "id":3
    }

## Day - ShareDay ##

`POST {{host}}days/54/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_112496638894029"
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

`POST {{host}}days/55/delete`

Request: `empty`

Response: 

    null

## Day - GetFavouriteDays ##

`POST {{host}}days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":56,
        "user_id":732,
        "title":"jaxuhupurenuluxadoferuce",
        "description":"hutiweloyurijufafabusunilexesasuzilusupisecubebahacuyimexerimemivujitubecajajehomepezasukelusujivoxipuwozavepaxalilimahulotaranetixejoyexonivenawurebufirupebaponibufudasonibaruyefufelojuzedicobanedohogogevudodesesacucajesexomeyozakeyomonoloyayogarecunohe",
        "time_offset":0,
        "occupation":"bocivakarorehiradahosowa",
        "age":7,
        "type":11,
        "likes_count":0,
        "ctime":1341579731,
        "utime":1341579731,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/57/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/58/unfavourite`

Request: `empty`

Response: 

    null

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":59,
        "user_id":739,
        "title":"xemifixukagezayalejopulu",
        "description":"fugofirirekarerelesasomihodexamazotagetuvabemorubecozihegimamufisuruhesanolujaxejucemepovawezatoyenevahexohetaracokicujuyadudupafahugigagikuruzosejogoratocunoyosesutucukixalutadaxesinigihoganukewaducijunoveyujugujokikokiwumecekafisikajalecocesicazitezigi",
        "time_offset":0,
        "occupation":"piperejazetohuvevihakine",
        "age":8,
        "type":1,
        "likes_count":0,
        "ctime":1341579736,
        "utime":1341579736,
        "is_ended":0
      },
      {
        "id":60,
        "user_id":739,
        "title":"tutolojenabuwiyusunenavu",
        "description":"gitanaseyefecosamagicorogasurunumexugihaviludaxigadexozayoyirilaseduwidixilarerulofemajeweyiseperogidebuxibivojajilusofizazomizahaninilebixobayesefecexanutumocoxifedivazoxawukidiweyohipularividuxemokihemadurelimedowovetiviyulodumikowuxutifayomalevapipezi",
        "time_offset":0,
        "occupation":"jevikedibidowotolobiyezo",
        "age":4,
        "type":4,
        "likes_count":0,
        "ctime":1341579736,
        "utime":1341579736,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":59
    }

Response: 

    [
      {
        "id":60,
        "user_id":739,
        "title":"tutolojenabuwiyusunenavu",
        "description":"gitanaseyefecosamagicorogasurunumexugihaviludaxigadexozayoyirilaseduwidixilarerulofemajeweyiseperogidebuxibivojajilusofizazomizahaninilebixobayesefecexanutumocoxifedivazoxawukidiweyohipularividuxemokihemadurelimedowovetiviyulodumikowuxutifayomalevapipezi",
        "time_offset":0,
        "occupation":"jevikedibidowotolobiyezo",
        "age":4,
        "type":4,
        "likes_count":0,
        "ctime":1341579736,
        "utime":1341579736,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":59,
      "to":60
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
        "id":62,
        "user_id":741,
        "title":"pezupolekekodovuleyokuka",
        "description":"cawurevefezunacozageyewerorokoritilewapuniwapuvibuxugofukupomegasoniwameselefavafocekegocunibotokefekopayujafagewetanuzividohumodoxihipalugiciyutoberawenufowoluhemisatazusaloyajukuzejifigadozixizinosisepabigelohexiwacacesarinifajunugacepepuxukomawigutuye",
        "time_offset":0,
        "occupation":"wehoduvobezugiyifawexopu",
        "age":2,
        "type":3,
        "likes_count":0,
        "ctime":1341579737,
        "utime":1341579737,
        "is_ended":0
      },
      {
        "id":63,
        "user_id":740,
        "title":"dadejijedarekucicoxadoke",
        "description":"tipoyihiyurarelorurupasugulifadusoriguzawigiyogipulazabebivesufepoxusubilezexayicepalogicatoyudisuhexexenusibixayidecewakiyelavabalukefucujalefesesoriyazujexamufuvidumewujebinovamesekogobavibukuniwuvovaxupiperatelayovuvinonuralizecojurukagafujobehogajowu",
        "time_offset":0,
        "occupation":"xomanehiloyinewedujuzuwa",
        "age":6,
        "type":1,
        "likes_count":0,
        "ctime":1341579737,
        "utime":1341579737,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":62
    }

Response: 

    [
      {
        "id":63,
        "user_id":740,
        "title":"dadejijedarekucicoxadoke",
        "description":"tipoyihiyurarelorurupasugulifadusoriguzawigiyogipulazabebivesufepoxusubilezexayicepalogicatoyudisuhexexenusibixayidecewakiyelavabalukefucujalefesesoriyazujexamufuvidumewujebinovamesekogobavibukuniwuvovaxupiperatelayovuvinonuralizecojurukagafujobehogajowu",
        "time_offset":0,
        "occupation":"xomanehiloyinewedujuzuwa",
        "age":6,
        "type":1,
        "likes_count":0,
        "ctime":1341579737,
        "utime":1341579737,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":62,
      "to":63
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
        "id":65,
        "user_id":742,
        "title":"zimejohihufezivelisonala",
        "description":"getazayoyotadopereriyezajabevulugaceguzatofukoduconudizinusexahagejijerazuwepujoturujijupucicenesuwufizahupuvumitalarowetusuhaducuyekumotamiyucobirofiyulitoturuvidaliwaperihodefobegugomujevubimavutibeyovakuniriwumanubuduvakejafatajowawebetoxineragoyemopu",
        "time_offset":0,
        "occupation":"litejoyalezakivixupifuwu",
        "age":2,
        "type":7,
        "likes_count":0,
        "ctime":1341579739,
        "utime":1341579739,
        "is_ended":0
      },
      {
        "id":66,
        "user_id":742,
        "title":"guvalubavuxaxirupuvutaca",
        "description":"pawapeyozasexoheticosutadutupusazigitafokucerenezocolovisimejakesovivudaxekipuwinufusunelarofuburohevinorucewuvewujixuxewibamaxawamirufeyemofecufimagejawecekujadutovuzofilesikuyuxadaguneguhicekodataxupehewocoluxidanokopojobolawajobuzefoyenegeyemibufonihi",
        "time_offset":0,
        "occupation":"julepimerigosayuyusazozu",
        "age":8,
        "type":1,
        "likes_count":0,
        "ctime":1341579739,
        "utime":1341579739,
        "is_ended":0
      }
    ]

## Moments - Update ##

`POST {{host}}moments/28/update`

Request: 

    {
      "description":"rizujirugebejihadogopacarixivomidilibahehepovutupupadogodagutokufohawilavutiximilapituhuyivoganeyopohuxazosucahigubusewowihatomopamubeyuziwatanuzixowohohitajatufavamofigumucaxapotiluconotuyivapijaginimaliberibebijafuwuvohixucayesivalatimecitazadayubovego"
    }

Response: 

    {
      "id":28,
      "day_id":71,
      "description":"rizujirugebejihadogopacarixivomidilibahehepovutupupadogodagutokufohawilavutiximilapituhuyivoganeyopohuxazosucahigubusewowihatomopamubeyuziwatanuzixowohohitajatufavamofigumucaxapotiluconotuyivapijaginimaliberibebijafuwuvohixucayesivalatimecitazadayubovego",
      "img_url":"",
      "likes_count":0,
      "ctime":1341579749
    }

## Moments - Delete ##

`POST {{host}}moments/29/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/30/comment`

Request: 

    {
      "text":"fobozenobamoyerutofayajapugegepiyifuwonuvunokasatugobitonubogofagecaciwupepumebedexawowepucomezorasorirexedemapoliwecopomoluzepikejawugofeconojudafetowelederozabebuhemiridafibenenezemerotejojebederotefukeheturecipiyefonikuwefururebugefivujedezoyuzanipuje"
    }

Response: 

    {
      "text":"fobozenobamoyerutofayajapugegepiyifuwonuvunokasatugobitonubogofagecaciwupepumebedexawowepucomezorasorirexedemapoliwecopomoluzepikejawugofeconojudafetowelederozabebuhemiridafibenenezemerotejojebederotefukeheturecipiyefonikuwefururebugefivujedezoyuzanipuje",
      "moment":{
        "id":30,
        "day_id":73,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341579752,
        "utime":1341579752,
        "cip":0
      },
      "user":{
        "id":755,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAFqG9oc0b0o1OSDcfZBUZCgmdZCwhabB6eJUVxwLzuqxm1utenTXK8BstqvGRXRZAcMnI7Uut3gTGOiCh1uexHEbSKybjAVRv9c0ZBiyR",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "sex":"female",
        "ctime":1341579752,
        "utime":1341579752,
        "cip":0
      },
      "cip":2130706433,
      "user_id":755,
      "moment_id":30,
      "ctime":1341579754,
      "utime":1341579754,
      "id":11
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "id":757,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004036783679",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "sex":"male",
        "ctime":1341579754,
        "utime":1341579754,
        "user_info":{
          "first_name":"bar",
          "last_name":"bar",
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

`POST {{host}}users/758/days/`

Request: `empty`

Response: 

    [
      {
        "id":74,
        "user_id":758,
        "title":"rudugukuzikezozagelirehu",
        "description":"ridozazedivafonegetebibojikubamolijepetotixufejivavomunujuvezebeveveridebujakopasezafiziloxeyuvohicucehagihoguvugobiguyotucovukaliyisepuvumutexuzukexeyofuhuxozeduwocisuhaxuloyisesirifopisidotepibozonewigefasumelayowiciyafokogekacukukifivuleduhamanipisoda",
        "time_offset":0,
        "occupation":"wakafusodakicemoyudoluce",
        "age":6,
        "type":9,
        "likes_count":0,
        "ctime":1341579756,
        "utime":1341579756,
        "is_ended":0
      },
      {
        "id":75,
        "user_id":758,
        "title":"cixihunagotahinarazafozo",
        "description":"jurimoruxivulewuviyinuzasenogifimobupovidihiwanipibamagagovijubutatesivubakufulokiwulazowocatazifotufisanazobiliwegejeyazahofedeyufajuhuzepusukigovixotutanuhoganehuhitevegihoyigocaloyawicadehosinucegunihucejeyilegenawicuxerixanulowufavehapamunojatasodido",
        "time_offset":0,
        "occupation":"xozaceyerovuwaturedaxowi",
        "age":7,
        "type":3,
        "likes_count":0,
        "ctime":1341579756,
        "utime":1341579756,
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
        "id":761,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004036783679",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "sex":"male",
        "ctime":1341579759,
        "utime":1341579759
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
        "id":763,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004036783679",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "sex":"male",
        "ctime":1341579761,
        "utime":1341579761
      }
    ]

## User - Follow ##

`POST {{host}}users/765/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/767/unfollow`

Request: `empty`

Response: 

    null

