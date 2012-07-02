# API examples #

 Version: 02.07.12 12:09:55

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
      "sessid":"tn8foglc3bd65ke7replmddch1",
      "user":{
        "ctime":1341220173,
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
        "utime":1341220173
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/1/create`

Request: 

    {
      "text":"yoheze"
    }

Response: 

    {
      "day_id":null,
      "text":"yoheze",
      "ctime":1341220177,
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
        "ctime":1341220178,
        "text":"tesizagopucogowopeketusuberefisuvelolomarivufiroyadoyomubafasucigigoforohiribegujenedagadikuhihizifaguyigiyexadamolotovucarepuxilasowodagahafigodojujasigewugokotahisesuluzolehixoketasujivifaguginuxawefoyizaduvicinolugelejojicumubehabavukuwajusuratujagotifuloviyarugeyihovorimenacuhemaxowejotesefuvanaveretarehocicipuhigibuwojuracadulogaxukaritobesetuxoxomesajohipoguvatagerubohoxapowimesaluyolikojatajukuyenecihogadokoxuvonehuxobirenuhikusihucibafizagowozaputolezujekodafibeyalamifofulacuzoridojiyofawemupiyanelobiritoloma"
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
      "title":"waho",
      "description":"pivireko",
      "time_offset":1341220181,
      "occupation":"goxewe",
      "age":2,
      "type":3
    }

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"waho",
      "description":"pivireko",
      "time_offset":"1341220181",
      "occupation":"goxewe",
      "age":"2",
      "type":"3",
      "likes_count":null,
      "ctime":1341220181,
      "utime":1341220181,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/1/item`

Request: `empty`

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"secoxinexayuwoxiyezezola",
      "description":"fefeneliyurukecububebeguhegupicotezeresihelopinokiwewahalibuyatoloyadirexacinicuduhuzicecakagasowosugejajeruzovarabirayogetikidabucedikiwujosaxeduwocomebevirupovozucejuhotutigunapiwaxuhohupupenigoxinageduwewekezeluconepafamotojihutidumudejisevafuvofevene",
      "time_offset":0,
      "occupation":"menijizotisojulugatafoca",
      "age":5,
      "type":9,
      "likes_count":0,
      "ctime":1341220181,
      "utime":1341220181,
      "is_ended":null,
      "moments":[
        {
          "id":1,
          "day_id":1,
          "description":"description nidimopirotuxefujikenolasukayipizowiliyadozuxaxepelayufositocecayunejilidelanehapogiredeyuyaducaxoledutegajolixuhamunifilami",
          "img_url":"",
          "likes_count":0,
          "ctime":1341220181
        },
        {
          "id":2,
          "day_id":1,
          "description":"description fimapugofapohehagefayagofufowucakifumesomelopowocawadasecuzuwayerafamutudatoxinupezolobimakecenokovupivosilibulihejobefikixi",
          "img_url":"",
          "likes_count":0,
          "ctime":1341220181
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/1;2;895/item`

Request: `empty`

Response: 

    {
      "1":{
        "id":1,
        "user_id":1,
        "title":"pebipojifiveyonokarawora",
        "description":"neyadesipevoracusopugiremafogigoxayukikuyasigokumuvolizumaposoliyepeyuhudukesofasuxaluzuzipohugejonevucuvigidirokixujusekezoheyibiwohurajumihahopalubafikadokageladobosepawugamohusecutibudiwevemuyirowewocatiwamijikabiwawoniyumulanejexejozarisubazamofemoye",
        "time_offset":0,
        "occupation":"kumewofinebuxenidatonota",
        "age":8,
        "type":11,
        "likes_count":0,
        "ctime":1341220183,
        "utime":1341220183,
        "is_ended":null,
        "moments":[
          {
            "id":1,
            "day_id":1,
            "description":"description bujoxuyogevunenesanivoniducojevehafazaxelogubogoxohomocotahamalodiyasuhamibigegabivihudayecilificaroxuweluxodavapirukoyefuti",
            "img_url":"",
            "likes_count":0,
            "ctime":1341220183
          }
        ]
      },
      "2":{
        "id":2,
        "user_id":2,
        "title":"xohobicetuliribozigepepo",
        "description":"zajudicegezufevavejabejumowubesunayomayojusifinusudohirofisewefekazufuniweyusiyejabinohoduyukagohepidaxujuyuhujiyedibidalacofeninawofopinimujukegisezukexifavoleveyuzilizujevopuhegecorucozumicesafoniginivehegirivobirafoyobaxobakirozafokidozocomafafesabocu",
        "time_offset":0,
        "occupation":"mizonijijidumadurufaraxi",
        "age":1,
        "type":7,
        "likes_count":0,
        "ctime":1341220183,
        "utime":1341220183,
        "is_ended":null,
        "moments":[
          {
            "id":2,
            "day_id":2,
            "description":"description lajufanodofexujakerulowixomonewujaxigedeberuhuyokinojehazoxicomexewatumoharicificogecipahipegatakiganoxovihubigafineyahapuno",
            "img_url":"",
            "likes_count":0,
            "ctime":1341220183
          }
        ]
      },
      "895":null
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
      "description":"saweviyuwejodenenipacayufigeduroyibobunufupedapopawojorijuxirigizehuguwisetumemametocejifaxutakojotimizayozezilivafumigosamifudimucujadetaropadegedowejiluxirucawabagakuhurubodebeyurejacarofowaxudabibe",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"saweviyuwejodenenipacayufigeduroyibobunufupedapopawojorijuxirigizehuguwisetumemametocejifaxutakojotimizayozezilivafumigosamifudimucujadetaropadegedowejiluxirucawabagakuhurubodebeyurejacarofowaxudabibe",
      "img_url":"\/media\/1\/day\/1\/3be2bf26d78895e6327c58ab29561c9217e3caa0.png",
      "likes_count":null,
      "ctime":1341220185
    }

## Day - Comment ##

`POST {{host}}days/1/comment`

Request: 

    {
      "text":"tusonanixacijuwovocicopasofelokapavaderulolorepiyobagibujegoyixiroroyetezafilozelukonipururilibadovaxilurilajikololufuwuwikeyegabucumivacefisifajicipuhelopebukawibeyulacilodixifuyoxadeworupaxemutesakotumulejihejalimefabodudiwuzizehodopicudedinixavadovetu"
    }

Response: 

    {
      "text":"tusonanixacijuwovocicopasofelokapavaderulolorepiyobagibujegoyixiroroyetezafilozelukonipururilibadovaxilurilajikololufuwuwikeyegabucumivacefisifajicipuhelopebukawibeyulacilodixifuyoxadeworupaxemutesakotumulejihejalimefabodudiwuzizehodopicudedinixavadovetu",
      "day":{
        "id":1,
        "user_id":1,
        "title":"zugevohoredotireheleyuzo",
        "occupation":"tuwigisafipobozucukavone",
        "age":6,
        "type":6,
        "is_ended":null,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341220186,
        "utime":1341220186,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBACCdgjAA4iM5W53ynzvvfjLBSOFgKYXR1AKSgKyhHard8xi5ej36VxHtsdrcvwBqUvptGRDZAgPDgBGz1pNMvUPCZBlyXQuuFGsDHM",
        "ctime":1341220186,
        "utime":1341220186,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "day_id":1,
      "ctime":1341220187,
      "utime":1341220187,
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
      "description":"tediconudiyaconuxutibamuhafupuzegayexigayacaxowopikiruluxivimowoxocofevanudenufalisajazesotaniyigufijunuwogenekuyabefunuvebevutayulewuconezatezolayibilosicilonesurixofibamonikumepitahimeyudihokuherito",
      "image_name":"miyayo",
      "image_content":"lamepo"
    }

Response: 

    null

## Day - Share ##

`POST {{host}}days/1/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_108887695921590"
    }

## Moments - Update ##

`POST {{host}}moments/1/update`

Request: 

    {
      "description":"viyosihudififaxujojenimucuzesimicedowinuxonaticabejixukutehezowaduvukeyebikoxiwuwamozurohuberugowatejonedudakuyeciyahitilotaruviziredasebohiteroriwubilihamufehavumucafayinosalesefotofawoxuyadodirasojigugubogowilibopuhiweruyomiyakevofunapoyifebezicebumovi"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"viyosihudififaxujojenimucuzesimicedowinuxonaticabejixukutehezowaduvukeyebikoxiwuwamozurohuberugowatejonedudakuyeciyahitilotaruviziredasebohiteroriwubilihamufehavumucafayinosalesefotofawoxuyadodirasojigugubogowilibopuhiweruyomiyakevofunapoyifebezicebumovi",
      "img_url":"",
      "likes_count":0,
      "ctime":1341220190
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
      "text":"jowojulojicehokajalahicabucogacivufawitazomenuluyuxelugixefalesafugakudeviselacezupeyowocuxigisikuloxidoduxiyuyuyihuhaseciwedisilagereyofojavebotepalejiwavusilarojebebebejurepesakaloreyifiyisifavegulegodudoguwoyejimebowufinemepodabevafuwisoboxegepezigaxo"
    }

Response: 

    {
      "text":"jowojulojicehokajalahicabucogacivufawitazomenuluyuxelugixefalesafugakudeviselacezupeyowocuxigisikuloxidoduxiyuyuyihuhaseciwedisilagereyofojavebotepalejiwavusilarojebebebejurepesakaloreyifiyisifavegulegodudoguwoyejimebowufinemepodabevafuwisoboxegepezigaxo",
      "moment":{
        "id":1,
        "day_id":1,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341220192,
        "utime":1341220192,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBACCdgjAA4iM5W53ynzvvfjLBSOFgKYXR1AKSgKyhHard8xi5ej36VxHtsdrcvwBqUvptGRDZAgPDgBGz1pNMvUPCZBlyXQuuFGsDHM",
        "ctime":1341220192,
        "utime":1341220192,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "moment_id":1,
      "ctime":1341220192,
      "utime":1341220192,
      "id":1
    }

## User - Days ##

`POST {{host}}users/1/days`

Request: `empty`

Response: 

    [
      
    ]

