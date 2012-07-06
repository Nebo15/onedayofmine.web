# API examples #

 Version: 06.07.12 17:43:11

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBABV2DiIDQpTsA81Idw4ALzYV8EHw6yDIPbeWOagdFMMyVHWA2QMqlYiRmuD8DFuEaIMzmeD1draaurosSokZBqKwwfm6k4oigAd15"
    }

Response: 

    {
      "sessid":"sdnr4pvqs7k89nrjhlg7e92qi7",
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
        "ctime":1341585776,
        "utime":1341585776,
        "id":1256
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/363/create`

Request: 

    {
      "text":"solege"
    }

Response: 

    {
      "day_id":null,
      "text":"solege",
      "ctime":1341585779,
      "id":15
    }

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"guhu",
      "description":"yohanexe",
      "time_offset":1341585779,
      "occupation":"fuceda",
      "age":2,
      "type":10
    }

Response: 

    {
      "id":364,
      "user_id":1264,
      "title":"guhu",
      "description":"yohanexe",
      "time_offset":"1341585779",
      "occupation":"fuceda",
      "age":"2",
      "type":"10",
      "likes_count":null,
      "ctime":1341585779,
      "utime":1341585779,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":365,
      "user_id":1265,
      "title":"sevudagafafanusihixokibi",
      "description":"pefojepadositupodozobasofanovoweyacelolikadacovamozivodusosihiwamumunuluzizagogonegexegizubekuluvuvewagotawuyasihutafutawokasucituvibujofasagepigeseginafuguvejifacecezenokozuhahupikanicomudokewimuvifecicanegojuhoyojupowonazepihexisubozidejibifukiyuhoruzo",
      "time_offset":0,
      "occupation":"wuvotebupubanufebabuyifi",
      "age":8,
      "type":11,
      "likes_count":0,
      "ctime":1341585780,
      "utime":1341585780,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"foxejigunorotiwokecuzatuvahanesozicezegizufomumuhivesidirimavaxotubohegefezojimoyexovadilipevizikafohexitucajisewixorubapihezeweguzikuzasafapuhelazadadopiciruyuxuketejikilujojowewujurukomupixijesarama",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":145,
      "day_id":367,
      "description":"foxejigunorotiwokecuzatuvahanesozicezegizufomumuhivesidirimavaxotubohegefezojimoyexovadilipevizikafohexitucajisewixorubapihezeweguzikuzasafapuhelazadadopiciruyuxuketejikilujojowewujurukomupixijesarama",
      "img_url":"\/media\/1267\/day\/367\/1872e570fd847669259eaea6efdda3ace2ca56a3.png",
      "likes_count":null,
      "ctime":1341585780
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

## Day - Item ##

`POST {{host}}days/369/item`

Request: `empty`

Response: 

    {
      "id":369,
      "user_id":1269,
      "title":"ziyovimidowuwupeyuhicutu",
      "description":"zokubayopagavanojuwesuhayumizewubayagutozuzoyipemenajufevowozotaxocamoxitugojoyufizihatawiwugiwagufosadewebadubekawofitadiwedomenobasapiposopobuturukexiwowujejuzeconodahovunoverecusumisemaruxidufopevucirijivuvuyixebitipejiyijadukutilebovutitobicadopoduda",
      "time_offset":0,
      "occupation":"manayisefewarikorofavawi",
      "age":5,
      "type":4,
      "likes_count":0,
      "ctime":1341585781,
      "utime":1341585781,
      "is_ended":0,
      "moments":[
        {
          "id":146,
          "day_id":369,
          "description":"description dixegeleyorahikoligasoduvagumifiwayakekeculenuzuhecubavogasoluheyakepoposazaxudafacajuyixohemipevuseseyejunaxohavegafatawake",
          "img_url":"",
          "likes_count":0,
          "ctime":1341585781
        },
        {
          "id":147,
          "day_id":369,
          "description":"description zigifarugoloyonotawaxasiyukozozucanejafixogugolutecokodesiyodurecamijozaheziyimosijahijuyepafahejorolowowugogolugozifekapufo",
          "img_url":"",
          "likes_count":0,
          "ctime":1341585781
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/370;371;698/item`

Request: `empty`

Response: 

    {
      "370":{
        "id":370,
        "user_id":1271,
        "title":"vurifibidelupasuxayagiro",
        "description":"melutopihotazufumazidezafefocosizamotaguvucovetejosiyopaxoxukinerucebejuhipasejazalutabotupamamacikayoyedihuvowosesegozuridapidofitagohedifufurugegizemovisefobejokikoyifalecagekiveseyiwovulohonohujalihuxeyatepirevitifinihujomituvajabemukagusugikuzilidoji",
        "time_offset":0,
        "occupation":"vovoxanozubasuvoroguhiru",
        "age":8,
        "type":3,
        "likes_count":0,
        "ctime":1341585781,
        "utime":1341585781,
        "is_ended":0,
        "moments":[
          {
            "id":148,
            "day_id":370,
            "description":"description kigiteripuburuhanasicubezuhomicuzehorugevecedenomegidevacawimuligogunicetasunenulonizesakirukakovilebiroseranafuxonubexitiha",
            "img_url":"",
            "likes_count":0,
            "ctime":1341585781
          }
        ]
      },
      "371":{
        "id":371,
        "user_id":1272,
        "title":"luzayapojufucifoyifocaka",
        "description":"nivededecujotiwijinipimucenoxarivevuruhoxokodefiroxadederozixixoyominohikobixeziyuragohulejevexoyegifixiducudalazacawebepenericiwezutunutiwurexojuvahuluguhukekepefefofuhutugininetudatedufihituxufareyuhowigecoropoyedahepixekofivoxosakisowokinuhigemitabije",
        "time_offset":0,
        "occupation":"lobanifegafideyonuxolohi",
        "age":1,
        "type":3,
        "likes_count":0,
        "ctime":1341585781,
        "utime":1341585781,
        "is_ended":0,
        "moments":[
          {
            "id":149,
            "day_id":371,
            "description":"description ziboyukubutixazipupodoyehelabapapovilakicazucumovahutagamofivomekewumajihemehubabeyomavuwulivuyagobozegerorusoyoxunebejuhola",
            "img_url":"",
            "likes_count":0,
            "ctime":1341585781
          }
        ]
      },
      "698":null
    }

## Day - CommentCreate ##

`POST {{host}}days/373/comment_create`

Request: 

    {
      "text":"lavizufulakacofavonigobusacubijisayobanidumanoheloxokurayobugekunenilaziyisicutitodanofimelopuradarigibazopateniyopilozuzeriferemewowuwurixetivocefidamamarokezumunetecewusikihiwibunibaposuxowemeratonisadarenivikezejibanutehatukirubedalonugemirizubazixoya"
    }

Response: 

    {
      "text":"lavizufulakacofavonigobusacubijisayobanidumanoheloxokurayobugekunenilaziyisicutitodanofimelopuradarigibazopateniyopilozuzeriferemewowuwurixetivocefidamamarokezumunetecewusikihiwibunibaposuxowemeratonisadarenivikezejibanutehatukirubedalonugemirizubazixoya",
      "day":{
        "id":373,
        "user_id":1276,
        "title":"kigatidomezimajozivegere",
        "occupation":"potebilukirugomamumibudi",
        "age":5,
        "type":4,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341585782,
        "utime":1341585782,
        "cip":0
      },
      "user":{
        "id":1276,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBABV2DiIDQpTsA81Idw4ALzYV8EHw6yDIPbeWOagdFMMyVHWA2QMqlYiRmuD8DFuEaIMzmeD1draaurosSokZBqKwwfm6k4oigAd15",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "sex":"female",
        "ctime":1341585782,
        "utime":1341585782,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1276,
      "day_id":373,
      "ctime":1341585782,
      "utime":1341585782,
      "id":17
    }

## Day - ShareDay ##

`POST {{host}}days/374/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_112561525554207"
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

`POST {{host}}days/375/delete`

Request: `empty`

Response: 

    null

## Day - GetFavouriteDays ##

`POST {{host}}days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":376,
        "user_id":1281,
        "title":"rujuhoravowayemilujewuwu",
        "description":"zazovowoxokivatedawilezewowidemalixadoxulemakanihecopacivuzufizoxuvanozuyiderovucupoxocopanomikekakuwewovubisuhosukinifamoxuhehomonebebokafaxitijadupezacuzedezoyiyuxutebugukumodonoyitukojizeduvaxobixamazucinacaxapizuhemepodesazoputayoyafigenahasecupidafe",
        "time_offset":0,
        "occupation":"vimeyawutivivavecozarapu",
        "age":7,
        "type":7,
        "likes_count":0,
        "ctime":1341585784,
        "utime":1341585784,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/377/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/378/unfavourite`

Request: `empty`

Response: 

    null

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":379,
        "user_id":1288,
        "title":"lunikarigusawosoronozoco",
        "description":"ceyutifurusabuhizubobupagupedakemefaxedigunesuvotujovuwuvihupodaxegotegudoguranewucitunikululizeyaconepocomovacoxagocodipilafijapisatetubenuhilatotulujamobodetovewirijovumalufapuzuvezecaxakiyazorohuhavodesekefegutafofazirusipegugiyagahuhodibekonimopiheju",
        "time_offset":0,
        "occupation":"vuxerojuhenutujemegemaji",
        "age":5,
        "type":11,
        "likes_count":0,
        "ctime":1341585785,
        "utime":1341585785,
        "is_ended":0
      },
      {
        "id":380,
        "user_id":1288,
        "title":"hefomivofasucemafiragoja",
        "description":"wucubotabobehusugasamuverixafexagubesohojexigikipamabejoverumizomuyatavamorofadodiwaxatokepuxinenimerehaxuwazuwanogevuzajizedipozaxihasadigalagusihikerowozudiparisureboxexejaganinuvasivonugabupotecozubugeyilizujocuhuruvuyorimesicomalomefuvawawucavoyimuka",
        "time_offset":0,
        "occupation":"puvifilemoxukevebudosuva",
        "age":1,
        "type":8,
        "likes_count":0,
        "ctime":1341585785,
        "utime":1341585785,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":379
    }

Response: 

    [
      {
        "id":380,
        "user_id":1288,
        "title":"hefomivofasucemafiragoja",
        "description":"wucubotabobehusugasamuverixafexagubesohojexigikipamabejoverumizomuyatavamorofadodiwaxatokepuxinenimerehaxuwazuwanogevuzajizedipozaxihasadigalagusihikerowozudiparisureboxexejaganinuvasivonugabupotecozubugeyilizujocuhuruvuyorimesicomalomefuvawawucavoyimuka",
        "time_offset":0,
        "occupation":"puvifilemoxukevebudosuva",
        "age":1,
        "type":8,
        "likes_count":0,
        "ctime":1341585785,
        "utime":1341585785,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":379,
      "to":380
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
        "id":382,
        "user_id":1290,
        "title":"pisonotorefohiradecakedo",
        "description":"tanolitakitafamaguzucabuniyesininadumuzujozisirujiwevugehasupalagicolanosigexugamanexopayedilirodohisohehisakujuzucusobixadetoxulalazomefakicolapixeduwacuhusasakafevopuvunusuxemomoterugurudeyilawetefijokategabovobepejedipaxafogucilifolubobaluwigisiroyawu",
        "time_offset":0,
        "occupation":"guwafolicuropulehaturuja",
        "age":3,
        "type":3,
        "likes_count":0,
        "ctime":1341585786,
        "utime":1341585786,
        "is_ended":0
      },
      {
        "id":383,
        "user_id":1289,
        "title":"rarowisehozelidubakimeza",
        "description":"xixabuvuyanaceyufiwajanuyuzajotafifamufiyomayezawojawubovazarogogizokadexijuzezobexuduruyizigakirefunehixihuxerumitilemeyiyarererugadipacuxuciwizidiyovubocozoyonaworesogirebiwuzukupavixuhunamajesuteruxegutaxozerilidehedupowuyiwoxipovoriwifowujeginixojiha",
        "time_offset":0,
        "occupation":"komocuzolaluxulemijidana",
        "age":7,
        "type":4,
        "likes_count":0,
        "ctime":1341585786,
        "utime":1341585786,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":382
    }

Response: 

    [
      {
        "id":383,
        "user_id":1289,
        "title":"rarowisehozelidubakimeza",
        "description":"xixabuvuyanaceyufiwajanuyuzajotafifamufiyomayezawojawubovazarogogizokadexijuzezobexuduruyizigakirefunehixihuxerumitilemeyiyarererugadipacuxuciwizidiyovubocozoyonaworesogirebiwuzukupavixuhunamajesuteruxegutaxozerilidehedupowuyiwoxipovoriwifowujeginixojiha",
        "time_offset":0,
        "occupation":"komocuzolaluxulemijidana",
        "age":7,
        "type":4,
        "likes_count":0,
        "ctime":1341585786,
        "utime":1341585786,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":382,
      "to":383
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
        "id":385,
        "user_id":1291,
        "title":"befatedasokiwuhifiwusino",
        "description":"bobohayimoyetonusurigimevocibuwanutozohijesazabobofedoruhomepejafaxatarajecemabivavuwewacelorotuwizitonaxolevixirolibepaputavizibucopoxigewutonejuwegelokazarusoyolijezipopemasucifewocevajiyacuvijawesecesikekiwitodoxuvejogiruyucogodezuxedewuvirujiwasawupi",
        "time_offset":0,
        "occupation":"vatufaxubexujabowanasake",
        "age":1,
        "type":11,
        "likes_count":0,
        "ctime":1341585786,
        "utime":1341585786,
        "is_ended":0
      },
      {
        "id":386,
        "user_id":1291,
        "title":"hejebinalojujirodalimayo",
        "description":"fixeyihuyeforikapavejitiperupalosebotelosilebojiwayarosazezimijasetitacetirohujadehoyuyuhumojoxufilutigizugexikuvotopopunapuwivubewosagozizuyewozikiduloyuloletimidasewovomodekawosurapicahihaxopaxekowamevoratixekilubibezejubuxucerukagatujihaworesovozobepa",
        "time_offset":0,
        "occupation":"hejonazagilacepoyuwiyofu",
        "age":3,
        "type":1,
        "likes_count":0,
        "ctime":1341585786,
        "utime":1341585786,
        "is_ended":0
      }
    ]

## Moments - Update ##

`POST {{host}}moments/155/update`

Request: 

    {
      "description":"gizudunozisewixowokowusomurugezivuhuyopufegavasoxagoxumewafalamebofupowoyavodijamivemetehujozuyapazawoxovomuduzikozuyodepizigupobiyuhopalabixudesabovaxepuxotipoyinegahofefagegukenalemufevuverowayahatilumogorizatenejonaremebelukocadibigehuwezipitugecupidi"
    }

Response: 

    {
      "id":155,
      "day_id":391,
      "description":"gizudunozisewixowokowusomurugezivuhuyopufegavasoxagoxumewafalamebofupowoyavodijamivemetehujozuyapazawoxovomuduzikozuyodepizigupobiyuhopalabixudesabovaxepuxotipoyinegahofefagegukenalemufevuverowayahatilumogorizatenejonaremebelukocadibigehuwezipitugecupidi",
      "img_url":"",
      "likes_count":0,
      "ctime":1341585788
    }

## Moments - Delete ##

`POST {{host}}moments/156/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/157/comment`

Request: 

    {
      "text":"raboxitolinijacukagiyevivelumenajisebiyiyizepabucelapenenufufocihosefotacohotesopavahenuhowikuyoroyohowekabamoxavogazoyelosorilegecizuwebulineneyolumeducutolazomadiyuvuvelemuritajekidigufozahifexajobaxikemavacalimizokalegovicomejilabuniwesujakurepamukosa"
    }

Response: 

    {
      "text":"raboxitolinijacukagiyevivelumenajisebiyiyizepabucelapenenufufocihosefotacohotesopavahenuhowikuyoroyohowekabamoxavogazoyelosorilegecizuwebulineneyolumeducutolazomadiyuvuvelemuritajekidigufozahifexajobaxikemavacalimizokalegovicomejilabuniwesujakurepamukosa",
      "moment":{
        "id":157,
        "day_id":393,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341585788,
        "utime":1341585788,
        "cip":0
      },
      "user":{
        "id":1304,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBABV2DiIDQpTsA81Idw4ALzYV8EHw6yDIPbeWOagdFMMyVHWA2QMqlYiRmuD8DFuEaIMzmeD1draaurosSokZBqKwwfm6k4oigAd15",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "sex":"female",
        "ctime":1341585788,
        "utime":1341585788,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1304,
      "moment_id":157,
      "ctime":1341585788,
      "utime":1341585788,
      "id":41
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "id":1306,
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
        "ctime":1341585788,
        "utime":1341585788,
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

`POST {{host}}users/1307/days/`

Request: `empty`

Response: 

    [
      {
        "id":394,
        "user_id":1307,
        "title":"nududirujewacogecusakaco",
        "description":"popaxadowutuboseyahelarunepakobulicerayibojalakedosiwelepunuviyadalofefazigenotohifatimepugenanodukejinecosilegowewizevihaxofikekorohazezoyebacunukifabifufehirohejimeyiyuwuyuwitayujuhiwiwazivevawelosepijijazajuzowedotuvomizesunapalasosaxodanawejubayutiko",
        "time_offset":0,
        "occupation":"yunisegigajuhomozaveroxa",
        "age":3,
        "type":7,
        "likes_count":0,
        "ctime":1341585789,
        "utime":1341585789,
        "is_ended":0
      },
      {
        "id":395,
        "user_id":1307,
        "title":"latufosekohijolufefesiwu",
        "description":"yoxazaciziwufetezigoxoyijupecahavafofekatacunogijigegavicevakafafeyeremelifujilowoxavoruzebelemopezarinayobecixucozulitezotizebipavelejezepawizufutipizigozeyawibitixavuleyevuduxunijiziguvazisafemaleyupucetahibobejuxiyotuhezitinaricehanajorepoturolihamimi",
        "time_offset":0,
        "occupation":"wovomofatigiwigoluxovodi",
        "age":8,
        "type":9,
        "likes_count":0,
        "ctime":1341585789,
        "utime":1341585789,
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
        "id":1310,
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
        "ctime":1341585789,
        "utime":1341585789
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
        "id":1312,
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
        "ctime":1341585789,
        "utime":1341585789
      }
    ]

## User - Follow ##

`POST {{host}}users/1314/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/1316/unfollow`

Request: `empty`

Response: 

    null

