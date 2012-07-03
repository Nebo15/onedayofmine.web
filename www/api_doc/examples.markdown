# API examples #

 Version: 03.07.12 22:45:33

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAH7K3Dsry3NZBRbgbrigXoFcZAVxd3IcQaagvR67C1ZCwkeKDfMkxC3wLDY9lsICAlvnNdiqpPoV6liELU6l4yZCBZB7WnDTkwRoALTfn"
    }

Response: 

    {
      "sessid":"pur2s9nopjojib2jnjgig30443",
      "user":{
        "ctime":1341344675,
        "fb_name":"foo",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_timezone":"3",
        "fb_uid":"100004010804750",
        "id":1273,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341344675
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/101/create`

Request: 

    {
      "text":"toyobe"
    }

Response: 

    {
      "day_id":null,
      "text":"toyobe",
      "ctime":1341344686,
      "id":26
    }

## Complaints - Display ##

`POST {{host}}/complaints/`

Request: `empty`

Response: 

    [
      {
        "id":27,
        "day_id":102,
        "ctime":1341344688,
        "text":"negiserulovadoveruluhuponevexiwetaxehihodawevimelufosolefemarelejetovajucadutifalexafekenukacumidebugeteludalehusazulefudicekiritokuyageyenesufeyafemehoyewexiwocapaholafumutodowebesezosuzihofezokenolotumirociyavolohanesubufapihakovarenexisutilagohoyupuwozijenoyetineviwigiyotakayezihugegilofebuxifobafepayeheharerucucejiciwamosokoriyasumudocoboranolufilapuvemayatuhesohunepicasoxanarucavulebekogoculetutenulelekukuxifojoyezebazacemokebucifivimanerozujujefemaminuhugevewuwomevapitilakokicusikanobobubuvulecehorafacividuhoko"
      }
    ]

## Day - Begin ##

`POST {{host}}days/begin`

Request: 

    {
      "title":"tuwi",
      "description":"wobuyupo",
      "time_offset":1341344691,
      "occupation":"rijiso",
      "age":5,
      "type":1
    }

Response: 

    {
      "id":103,
      "user_id":1283,
      "title":"tuwi",
      "description":"wobuyupo",
      "time_offset":"1341344691",
      "occupation":"rijiso",
      "age":"5",
      "type":"1",
      "likes_count":null,
      "ctime":1341344692,
      "utime":1341344692,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/104/item`

Request: `empty`

Response: 

    {
      "id":104,
      "user_id":1284,
      "title":"muregewimiviweyisigefepo",
      "description":"livuforopasulidolezenuhoyevevokedafewobiyokedidixaweyacukuganikosizijayeteruwomovecokamoboyiheguwemagikuvuxotejiridupotijodiyenonaxometehowuyalipinagetiyuduforotimavelawecolihucodebuwusuvurepexamogutadowihanexosunivemicayolusumuvezubumeyatotereximezilugu",
      "time_offset":0,
      "occupation":"ferakijofucojafuzihaguda",
      "age":4,
      "type":9,
      "likes_count":0,
      "ctime":1341344692,
      "utime":1341344692,
      "is_ended":0,
      "moments":[
        {
          "id":52,
          "day_id":104,
          "description":"description gutawirewocaraguzixuzuluciyicesefemuwajovevekajelagedojadeperenusuwicadumuguxihetitufabejinuwavibizatayezacusegewufubahevoho",
          "img_url":"",
          "likes_count":0,
          "ctime":1341344692
        },
        {
          "id":53,
          "day_id":104,
          "description":"description jatowufezutidununodojimogavubatehicalelecazaficohemotukubavakilobivitevokoyihagigodusixototafavaripevedadasecuyesagepacetulu",
          "img_url":"",
          "likes_count":0,
          "ctime":1341344692
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/106;107;303/item`

Request: `empty`

Response: 

    {
      "106":{
        "id":106,
        "user_id":1288,
        "title":"wavikifininedawohosoweza",
        "description":"gayenuroxikozoyosewiwobowihuriputicemoxegecaxaxijocamawesafesocigasoxibavahodafiyepejesumugapepomemevimipofoyedupohuduxovaveledurohicozomajinihafibemuxezorebojokidijadohiguxizabajixavuwihufinifobitahupiwiyonuvumobepususukekiwizinenatenofaruwarujatuzivera",
        "time_offset":0,
        "occupation":"cadenuhepoxepadoyakipesa",
        "age":7,
        "type":5,
        "likes_count":0,
        "ctime":1341344695,
        "utime":1341344695,
        "is_ended":0,
        "moments":[
          {
            "id":54,
            "day_id":106,
            "description":"description lexoduyicuvurarivayetifarohepocuduvevosupisemevelosahuhumidajacidutunevawiketapaxehabizidarijoxinojazafupidesolixosuholevawa",
            "img_url":"",
            "likes_count":0,
            "ctime":1341344695
          }
        ]
      },
      "107":{
        "id":107,
        "user_id":1289,
        "title":"jelibiwuyasipelejezusemo",
        "description":"fimizizukifocoveharuhusayilivohudonagibocekazanegafibusujakatocukozidugegikatukudikakacodiwucutipoboreyuwebihemeyuneyocacuyawopejocuxavojuhogobasimifiselikeguripomitegadisehomugunemaruvafazupipacekekivavavebagilovaribuparapagomoyucoyuvocosejazadosalefalo",
        "time_offset":0,
        "occupation":"jobiruhuvisuriyonenanifa",
        "age":6,
        "type":11,
        "likes_count":0,
        "ctime":1341344695,
        "utime":1341344695,
        "is_ended":0,
        "moments":[
          {
            "id":55,
            "day_id":107,
            "description":"description comehodovewuvepikusiribaxotunukipuyuparehigatoravepivonolepucunovimematonuwetilituxiridarozosijiyuwixifimasamasecitozuvopoje",
            "img_url":"",
            "likes_count":0,
            "ctime":1341344695
          }
        ]
      },
      "303":null
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

`POST {{host}}days/108/add_moment`

Request: 

    {
      "description":"cozexunixamogisirinevidexuzedogameleduxudevexixibixowacoyadawehenorosiruwifoxafumatecobuwacomexubisozenotomovopetepubiwutumafefexuyudirufanuwafijokejagabogecimugewexihapoyiwazaxepanogimivixenasemivone",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":56,
      "day_id":108,
      "description":"cozexunixamogisirinevidexuzedogameleduxudevexixibixowacoyadawehenorosiruwifoxafumatecobuwacomexubisozenotomovopetepubiwutumafefexuyudirufanuwafijokejagabogecimugewexihapoyiwazaxepanogimivixenasemivone",
      "img_url":"\/media\/1292\/day\/108\/813d08b3bfbfcc4b85c7281669b785339330518e.png",
      "likes_count":null,
      "ctime":1341344701
    }

## Day - Comment ##

`POST {{host}}days/110/comment`

Request: 

    {
      "text":"padimusinuyokudimiluhoxitenikadujelugalocenifobocisediyutikasicusiwuperopacovalupagoraperumelihababijoguvesilalafotuwefigovofatafovijakajasodawevidoxedayusabihadasibapecefalamepowiyumuyayupedogofevosucubixisidiwaneyinujaciwefapuwewudukujalipenarinahuheha"
    }

Response: 

    {
      "text":"padimusinuyokudimiluhoxitenikadujelugalocenifobocisediyutikasicusiwuperopacovalupagoraperumelihababijoguvesilalafotuwefigovofatafovijakajasodawevidoxedayusabihadasibapecefalamepowiyumuyayupedogofevosucubixisidiwaneyinujaciwefapuwewudukujalipenarinahuheha",
      "day":{
        "id":110,
        "user_id":1295,
        "title":"tidoruvihuvuyurufajuhisi",
        "occupation":"xivamapahamezetaxewocipu",
        "age":2,
        "type":8,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341344703,
        "utime":1341344703,
        "cip":0
      },
      "user":{
        "id":1295,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAH7K3Dsry3NZBRbgbrigXoFcZAVxd3IcQaagvR67C1ZCwkeKDfMkxC3wLDY9lsICAlvnNdiqpPoV6liELU6l4yZCBZB7WnDTkwRoALTfn",
        "ctime":1341344703,
        "utime":1341344703,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1295,
      "day_id":110,
      "ctime":1341344705,
      "utime":1341344705,
      "id":8
    }

## Day - End ##

`POST {{host}}days/111/end`

Request: `empty`

Response: 

    null

## Day - End ##

`POST {{host}}days/111/add_moment`

Request: 

    {
      "description":"jekatipaguxazajokezagecafagiheminurejejidetakaxokuvigupizuyebewigiwiraboloyovonaretufejadekarevurikevicafuyuticewuhufodewinitehexosocovesofigewadabetapisazikeweziwagojukikiwaruhofuvoniwiyewolohexixale",
      "image_name":"lihayo",
      "image_content":"wusoca"
    }

Response: 

    null

## Day - Delete ##

`POST {{host}}days/112/delete`

Request: `empty`

Response: 

    null

## Day - Share ##

`POST {{host}}days/113/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_110335575776802"
    }

## Moments - Update ##

`POST {{host}}moments/58/update`

Request: 

    {
      "description":"jeyotaticapijihucenihuhobosisizavuribebapopucuwagerifuhenuremogenuvihorulesidisewevafagobuximavazipekebomohifuxafocesebofufocusapehumetubameyehabemosikulimipapaludufuwexemoroyocejoxopejawugecoganeceruratevoyuzerubagehahilefopobobonoteziwukufusafupiyuyefa"
    }

Response: 

    {
      "id":58,
      "day_id":114,
      "description":"jeyotaticapijihucenihuhobosisizavuribebapopucuwagerifuhenuremogenuvihorulesidisewevafagobuximavazipekebomohifuxafocesebofufocusapehumetubameyehabemosikulimipapaludufuwexemoroyocejoxopejawugecoganeceruratevoyuzerubagehahilefopobobonoteziwukufusafupiyuyefa",
      "img_url":"",
      "likes_count":0,
      "ctime":1341344711
    }

## Moments - Delete ##

`POST {{host}}moments/59/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/60/comment`

Request: 

    {
      "text":"dumaxudisosimefocovufetohafipavobewudukotajeliyihokiyacafesojilesefogipurufakanowucozaxaliyoyecirekuwuvivumacawuyurucicizagukenunuwevovipevohinemadirebogenomaruyijobahojahoruwazuridofexozevikobokavosasusewikolakisizijuyanevibarovewijivabayigebuxamezihita"
    }

Response: 

    {
      "text":"dumaxudisosimefocovufetohafipavobewudukotajeliyihokiyacafesojilesefogipurufakanowucozaxaliyoyecirekuwuvivumacawuyurucicizagukenunuwevovipevohinemadirebogenomaruyijobahojahoruwazuridofexozevikobokavosasusewikolakisizijuyanevibarovewijivabayigebuxamezihita",
      "moment":{
        "id":60,
        "day_id":116,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341344715,
        "utime":1341344715,
        "cip":0
      },
      "user":{
        "id":1302,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBAH7K3Dsry3NZBRbgbrigXoFcZAVxd3IcQaagvR67C1ZCwkeKDfMkxC3wLDY9lsICAlvnNdiqpPoV6liELU6l4yZCBZB7WnDTkwRoALTfn",
        "ctime":1341344715,
        "utime":1341344715,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1302,
      "moment_id":60,
      "ctime":1341344717,
      "utime":1341344717,
      "id":4
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "ctime":1341344717,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":null,
        "fb_uid":"100004036783679",
        "id":1304,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341344717
      }
    ]

## User - CurrentUserDays ##

`POST {{host}}my/days/`

Request: `empty`

Response: 

    [
      {
        "id":117,
        "user_id":1305,
        "title":"resabexinobikinebojusafe",
        "description":"guyigazowafabewevocamarunulurotusolutirinoticixujuzobirimakavazisijiwuyetoyugusivokofuhobovutogigiwamolamebofohujosisufosunevowujozolizuvurusuwapinenoyatipifelibihiwejigumuwexiwirefinuzajamosifuyafepegahakamapanoraroduviticukayihixiparujafufosutelujalari",
        "time_offset":0,
        "occupation":"cicoyusanirupiwudohezoki",
        "age":2,
        "type":7,
        "likes_count":0,
        "ctime":1341344719,
        "utime":1341344719,
        "is_ended":0
      },
      {
        "id":118,
        "user_id":1305,
        "title":"dotajiyamohoduwejobilayi",
        "description":"dogelivoxilakapidisemohacoricabaxenereyitenakanipetayugatuluyizusifewawilerulajajacebehocopadixobacudukigukodotivotocapasafusapodonepuvuxamuyelozamafagufisumemiyawixijovotobakajuciyekasaxaketekivedabuxopuxuyewutohavufodibuwikositololanebipumepolesobofaru",
        "time_offset":0,
        "occupation":"numabemecebizekuxulijiti",
        "age":1,
        "type":7,
        "likes_count":0,
        "ctime":1341344719,
        "utime":1341344719,
        "is_ended":0
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/1306/days/`

Request: `empty`

Response: 

    [
      {
        "id":119,
        "user_id":1306,
        "title":"basuroluwoyeginaxesogoba",
        "description":"kuwudediyunapuvipisujusosuvopuvuvivuxumotuxezowifiniledadusoxirocirujasacijahapisazajafizufujopefajihanerukubujocevikuxevagawomayunewapiyujuyosuzileketajuhatofopoxetiwokarewehovodayujewimijogujahanatuhefasixidaraxujonogulitonawadiyeyalopecojotepaxaxayeno",
        "time_offset":0,
        "occupation":"gahuzitiwirohipurafazumu",
        "age":5,
        "type":8,
        "likes_count":0,
        "ctime":1341344721,
        "utime":1341344721,
        "is_ended":0
      },
      {
        "id":120,
        "user_id":1306,
        "title":"navosesizivutolikamatomu",
        "description":"cevomabalitehuvuyafumugukelugoceyubezapenepofetanuzutaxalecoyabubahubukicukekajubexonoxudusaboxasaboyihakohovorozinihelejalevelilifewiledozujotedeverevujahamonudojudogemafovucuduhocatehamotatutaxuvafehebahaziyefajuliyukoyapocipumococavegotazufewixomemija",
        "time_offset":0,
        "occupation":"deputawabonoduyotupuzizi",
        "age":3,
        "type":10,
        "likes_count":0,
        "ctime":1341344721,
        "utime":1341344721,
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
        "ctime":1341344723,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":1309,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341344723
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
        "ctime":1341344725,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":1311,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341344725
      }
    ]

## User - Follow ##

`POST {{host}}users/1313/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/1315/unfollow`

Request: `empty`

Response: 

    null

