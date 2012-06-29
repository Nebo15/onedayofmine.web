# API examples #

 Version: 29.06.12 21:33:51

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBALFnZBlG6sLlLKfvCa9ad7HiWTiAvUA0xgHmifvRLv02LikO1qayhx3pmRJGvYfAp8G9SzLtSw67iEZCxdbijZCAzAp2Akf9uNnqRDl"
    }

Response: 

    {
      "sessid":"bp9sk4ec20k59cg5sss3bce316",
      "user":{
        "ctime":1340994806,
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
        "utime":1340994806
      }
    }

## Complaint - Create ##

`POST {{host}}/complaint/create`

Request: 

    {
      "day_id":1,
      "text":"juweyu"
    }

Response: 

    {
      "day_id":"1",
      "text":"juweyu",
      "ctime":1340994810,
      "id":1
    }

## Complaint - Get ##

`POST {{host}}/complaint/get`

Request: `empty`

Response: 

    [
      {
        "id":1,
        "day_id":1,
        "ctime":1340994811,
        "text":"hufanizocopegunokawizewogijatosulucugateserugamigedenuyokevaxicegahifuvujitipecopezaduwidirubohexisaniyuxokixigisenudejeyugutifobusijikegosagumudusejanebogogikehawosawuyizalibilowovebudepesurubiporipiyitezoxemofedacemorapecosojebuxulohikawuyudafahowutifuculefihakosodaxuyoyavagasabimagicoyedejiyafadabavudibesoloduxelubefanirinupowisonogidugipelitukogixocigohohajututukuxolizuzoteluyeruturasudawuxiwelowugosamenuhiduluvaxixamoxegonomemofawonenovosenigiyalewesabevirefokalukurarejavinotucihorezewirujuzoxetimevumikahazerece"
      }
    ]

## Day - Begin ##

`POST {{host}}day/begin`

Request: 

    {
      "title":"vele",
      "description":"kefixewi",
      "time_offset":1340994812,
      "occupation":"kecoxe",
      "age":8,
      "type":1
    }

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"vele",
      "description":"kefixewi",
      "time_offset":"1340994812",
      "occupation":"kecoxe",
      "age":"8",
      "type":"1",
      "likes_count":null,
      "ctime":1340994813,
      "utime":1340994813,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}day/item`

Request: 

    {
      "id":1
    }

Response: 

    {
      "id":1,
      "user_id":1,
      "title":"numayidoretayesocovahuso",
      "description":"notodafunamopuwacelofedepohitixedobetefejoyunoyozehatiledovudodejanakohojanuyimuwobigixedofejemolurorumucuwameyeduwelorijuvocehigujuwowutoyabumaxelezaxexozuyemadobunuwenomisusigaxefonalizetimufivokobukilamapogiyegikozezovipuzeteyogegokowukalekowojodenuva",
      "time_offset":0,
      "occupation":"pimojinivurufujelevekuhi",
      "age":5,
      "type":1,
      "likes_count":0,
      "ctime":1340994813,
      "utime":1340994813,
      "is_ended":null,
      "moments":[
        {
          "id":1,
          "day_id":1,
          "description":"description dehefasuzinucezivimegibiwanenepopuyozisucaxamupejaripoyetivevexefodajodizapixasafetozofoduyugogipepudojatunicevenibidafecade",
          "img_url":"",
          "likes_count":0,
          "ctime":1340994813
        },
        {
          "id":2,
          "day_id":1,
          "description":"description hiwewimukazicupabokimozuciyamicodubuliwomojivuturagaxezuvudemebofapinekafopuretelulegihujigorelojukukowimilavakadomefojidiho",
          "img_url":"",
          "likes_count":0,
          "ctime":1340994813
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}day/item`

Request: 

    {
      "id":[
        1,
        2
      ]
    }

Response: 

    {
      "1":{
        "id":1,
        "user_id":1,
        "title":"belelelasukalobikuvuwaju",
        "description":"tagihapuzuwuvezukebejupenenoluxazapedagadabugutigowisevatexafohawujuzicapazocokekawapigewamuwodoniribopivikufodizurimuxezejobimixabuvomidulepiyilidulugejifezoxutuvinedobizobufimeluhogigixebocotujeciyazutavumefudipebovuzusapeyurukicekujavulutileyibohamuca",
        "time_offset":0,
        "occupation":"gasatifagecohehumobarino",
        "age":2,
        "type":8,
        "likes_count":0,
        "ctime":1340994814,
        "utime":1340994814,
        "is_ended":null,
        "moments":[
          {
            "id":1,
            "day_id":1,
            "description":"description munebapatojisudifihakorufanabacicovarefecivomujomitufeselapigobegokudihacayizegiwuhahukocuferapuyutanuhobafalemehojisogosece",
            "img_url":"",
            "likes_count":0,
            "ctime":1340994814
          }
        ]
      },
      "2":{
        "id":2,
        "user_id":2,
        "title":"yehisalotaliyofefufopife",
        "description":"lehoyubixaxofitofumiyazahemojiyowamobijupasosilulujebemepubukuradayanecakowafexifeyemenajixolixipusabogimanojigirasanedutupanisagefecetilegorihenujafiyulicuyozacalanatukuvakahubizabucikakexemunudacubiwumewodujabecavihavamecudebadaruxafowepamimitezukocuza",
        "time_offset":0,
        "occupation":"tomiwajovebohejujagijobe",
        "age":5,
        "type":8,
        "likes_count":0,
        "ctime":1340994814,
        "utime":1340994814,
        "is_ended":null,
        "moments":[
          {
            "id":2,
            "day_id":2,
            "description":"description gipokidurehanivacirolotukukitokujutoluracufimuvinegubuveyavoxapadexidisakuvuvikeyihumahefabahifixabunofunutelareruhayimaridu",
            "img_url":"",
            "likes_count":0,
            "ctime":1340994814
          }
        ]
      }
    }

## Day - Update ##

`POST {{host}}day/update`

Request: 

    {
      "day_id":42,
      "tags":[
        "tag1",
        "tag2"
      ],
      "top_moment_id":111
    }

Response: 

    null

## Day - AddMoment ##

`POST {{host}}day/add_moment`

Request: 

    {
      "day_id":1,
      "description":"panotiyebidoyigolavetuheyazozaxifehuwaduverovumaxenicowaxovuyokabozuxatokekagujacusasifihukeroholenekeyoreyudezedokofijinosaluwugedoralekefiravowanatumemaludeveruzebenitoyewobowirikawuhewenitanokicuyo",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"panotiyebidoyigolavetuheyazozaxifehuwaduverovumaxenicowaxovuyokabozuxatokekagujacusasifihukeroholenekeyoreyudezedokofijinosaluwugedoralekefiravowanatumemaludeveruzebenitoyewobowirikawuhewenitanokicuyo",
      "img_url":"\/media\/1\/day\/1\/3be2bf26d78895e6327c58ab29561c9217e3caa0.png",
      "likes_count":null,
      "ctime":1340994817
    }

## Day - Comment ##

`POST {{host}}day/comment`

Request: 

    {
      "day_id":1,
      "text":"bonebukazexegobesigibeyehakudanasamoxutucifefaruvuludefemigorovevebobomajomixakozuladinodogonacegazexikadusubapawaduporolumuxigasajirosoretokerejofulususavisapeguxurireyexesimujoyonipateseketigolufadakakanubupuranagepupugemizuhayehelojunewahiforezajiciyi"
    }

Response: 

    {
      "text":"bonebukazexegobesigibeyehakudanasamoxutucifefaruvuludefemigorovevebobomajomixakozuladinodogonacegazexikadusubapawaduporolumuxigasajirosoretokerejofulususavisapeguxurireyexesimujoyonipateseketigolufadakakanubupuranagepupugemizuhayehelojunewahiforezajiciyi",
      "day":{
        "id":1,
        "user_id":1,
        "title":"caguhefewifurivibavoyaco",
        "occupation":"viviwalalopekiriresigigi",
        "age":1,
        "type":11,
        "is_ended":null,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1340994817,
        "utime":1340994817,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBALFnZBlG6sLlLKfvCa9ad7HiWTiAvUA0xgHmifvRLv02LikO1qayhx3pmRJGvYfAp8G9SzLtSw67iEZCxdbijZCAzAp2Akf9uNnqRDl",
        "ctime":1340994817,
        "utime":1340994817,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "day_id":1,
      "ctime":1340994818,
      "utime":1340994818,
      "id":1
    }

## Day - End ##

`POST {{host}}day/end`

Request: 

    {
      "day_id":1
    }

Response: 

    null

## Day - End ##

`POST {{host}}day/add_moment`

Request: 

    {
      "day_id":1,
      "description":"wakukopoduravizatotonefizadimecejigodulerajirenecebimabifaxojuyolajibowowacimoviwodezavahoworohayorukipapopahepadomawehayatiwuropesuredezohebukanuhecikarapicefoluradojakijilopupugojosutekumimulabivera",
      "image_name":"bixeyu",
      "image_content":"ceziri"
    }

Response: 

    null

## Day - Share ##

`POST {{host}}day/share`

Request: 

    {
      "day_id":1
    }

Response: 

    {
      "id":"100004010804750_106700676140292"
    }

## Moment - Update ##

`POST {{host}}moment/update`

Request: 

    {
      "moment_id":1,
      "description":"cavogoyofudeharasacamutinebewezulopomihokibomowawujevaxejupagibojikocolicididusuwagodayicirebozegedebivaburawedokehimayitixofucegesevihujuzagavimacugununesogodiboroguriwisasipamodororazeyecasawexagipadebutozahayusidoxayubicuxuxamicisakiterakiyacavucoxahu"
    }

Response: 

    {
      "id":1,
      "day_id":1,
      "description":"cavogoyofudeharasacamutinebewezulopomihokibomowawujevaxejupagibojikocolicididusuwagodayicirebozegedebivaburawedokehimayitixofucegesevihujuzagavimacugununesogodiboroguriwisasipamodororazeyecasawexagipadebutozahayusidoxayubicuxuxamicisakiterakiyacavucoxahu",
      "img_url":"",
      "likes_count":0,
      "ctime":1340994822
    }

## Moment - Delete ##

`POST {{host}}moment/delete`

Request: `empty`

Response: 

    null

## Moment - Comment ##

`POST {{host}}moment/comment`

Request: 

    {
      "moment_id":1,
      "text":"wuxagaxekuhakitamezapigawufilirehikipexufazirorazidiberufujihuwikaculuyicudorowohudejodiricukumocisimicimehayavebunesowecufiwofufukoligusicopuwiteyezosatunimokopojahiyubapixefisazoxotimeduyisihuminimimadelexakuvenixasubomodosojabotiwuwedokipavarodepayava"
    }

Response: 

    {
      "text":"wuxagaxekuhakitamezapigawufilirehikipexufazirorazidiberufujihuwikaculuyicudorowohudejodiricukumocisimicimehayavebunesowecufiwofufukoligusicopuwiteyezosatunimokopojahiyubapixefisazoxotimeduyisihuminimimadelexakuvenixasubomodosojabotiwuwedokipavarodepayava",
      "moment":{
        "id":1,
        "day_id":1,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1340994824,
        "utime":1340994824,
        "cip":0
      },
      "user":{
        "id":1,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBALFnZBlG6sLlLKfvCa9ad7HiWTiAvUA0xgHmifvRLv02LikO1qayhx3pmRJGvYfAp8G9SzLtSw67iEZCxdbijZCAzAp2Akf9uNnqRDl",
        "ctime":1340994824,
        "utime":1340994824,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1,
      "moment_id":1,
      "ctime":1340994824,
      "utime":1340994824,
      "id":1
    }

## Moment - Share ##

`POST {{host}}moment/share`

Request: 

    {
      "moment_id":1
    }

Response: 

    {
      "id":"100004010804750_106700779473615"
    }

## Search - Suggest ##

`POST {{host}}search/suggest`

Request: `empty`

Response: 

    [
      "foo1",
      "foo2"
    ]

## Search - Search ##

`POST {{host}}search/text`

Request: `empty`

Response: 

    {
      "users":[
        {
          "cip":2130706433,
          "ctime":1339621518,
          "fb_name":"Foo",
          "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100003921268738",
          "fb_profile_utime":"1339136917",
          "fb_uid":"100003921268738",
          "id":1,
          "pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/369578_100003921268738_1696883803_n.jpg",
          "pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/369578_100003921268738_1696883803_t.jpg",
          "pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/369578_100003921268738_1696883803_q.jpg",
          "sex":"male",
          "timezone":"3",
          "utime":1339621518,
          "is_fake":true
        }
      ],
      "days":[
        {
          "id":42,
          "title":"My loooooooooooooong day",
          "img_url":"http:\/\/upload.wikimedia.org\/wikipedia\/commons\/8\/84\/Example.svg",
          "description":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nQuisque volutpat egestas elit, id ornare risus cursus non.\nInteger consequat dignissim nisi, non tincidunt metus interdum non.\nPhasellus purus sem, convallis vitae rutrum nec, vulputate in ante.\nVestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.\nDuis congue dolor et dolor lacinia scelerisque. Suspendisse potenti.\nMauris non ultricies mi. Aliquam erat volutpat. Pellentesque non justo\nfacilisis tellus semper venenatis scelerisque ultricies justo.\nNullam ultricies mattis placerat. Maecenas metus est, convallis\nadipiscing mollis eget, porttitor nec sem. Nulla elementum pretium\nturpis, id fermentum magna mollis a. Donec sit amet eleifend arcu.'",
          "ctime":1330000000,
          "is_fake":true
        }
      ],
      "day_comments":[
        {
          "id":422,
          "user_id":1,
          "day_id":42,
          "text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nQuisque volutpat egestas elit, id ornare risus cursus non.\nInteger consequat dignissim nisi, non tincidunt metus interdum non.\nPhasellus purus sem, convallis vitae rutrum nec, vulputate in ante.\nVestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.",
          "likes_count":123,
          "ctime":1331000000,
          "is_fake":true
        }
      ],
      "moments":[
        {
          "id":11,
          "day_id":42,
          "description":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nQuisque volutpat egestas elit, id ornare risus cursus non.\nInteger consequat dignissim nisi, non tincidunt metus interdum non.\nPhasellus purus sem, convallis vitae rutrum nec, vulputate in ante.\nVestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.",
          "img_url":"http:\/\/upload.wikimedia.org\/wikipedia\/commons\/8\/84\/Example.svg",
          "type":"photo",
          "likes_count":43,
          "ctime":1330500000,
          "is_fake":true
        }
      ],
      "moment_comments":[
        {
          "id":111,
          "user_id":1,
          "moment_id":11,
          "text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nQuisque volutpat egestas elit, id ornare risus cursus non.\nInteger consequat dignissim nisi, non tincidunt metus interdum non.\nPhasellus purus sem, convallis vitae rutrum nec, vulputate in ante.\nVestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.",
          "likes_count":123,
          "ctime":1331000000
        }
      ]
    }

## User - Days_CurrentUser ##

`POST {{host}}user/days/`

Request: `empty`

Response: 

    [
      {
        "id":1,
        "user_id":1,
        "title":"zuxalacepifoyusogiyohahu",
        "description":"huzetihefamizawetiyisocidedafokiresexutadanajekavenibizayahatonebasudeyeniluvoyicizabugubibofibatocucucilimehevewomutowofumejinagixepuxumegotuditiligefibovedelewerehikowonipocegitituxomodixiyoxidazizudikodizeyovopokahiracixucufamaxipegoseboyohilonofaweto",
        "time_offset":0,
        "occupation":"zunipijofatugimuziwimoxe",
        "age":4,
        "type":4,
        "likes_count":0,
        "ctime":1340994824,
        "utime":1340994824,
        "is_ended":null
      }
    ]

## User - Days_AnotherUser ##

`POST {{host}}user/days/1`

Request: `empty`

Response: 

    [
      {
        "id":1,
        "user_id":1,
        "title":"zuxalacepifoyusogiyohahu",
        "description":"huzetihefamizawetiyisocidedafokiresexutadanajekavenibizayahatonebasudeyeniluvoyicizabugubibofibatocucucilimehevewomutowofumejinagixepuxumegotuditiligefibovedelewerehikowonipocegitituxomodixiyoxidazizudikodizeyovopokahiracixucufamaxipegoseboyohilonofaweto",
        "time_offset":0,
        "occupation":"zunipijofatugimuziwimoxe",
        "age":4,
        "type":4,
        "likes_count":0,
        "ctime":1340994824,
        "utime":1340994824,
        "is_ended":null
      }
    ]

## User - FiendsWithApp ##

`POST {{host}}user/friends_in_app`

Request: `empty`

Response: 

    [
      {
        "ctime":1340994828,
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
        "utime":1340994828
      }
    ]

