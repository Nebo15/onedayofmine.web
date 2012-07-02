# API examples #

 Version: 02.07.12 15:02:25

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBABDOPuQjMN4xBeNQuv01LAPdTUE0DCme66pf3Ip3sleMpwVmeURKZAnmix0yhBz6at0rdb3WJ6BcryqLQdKauTOUV2KCTa49iDnoo"
    }

Response: 

    {
      "sessid":"8qlnnkd2otk6lag0kvv7qo6du7",
      "user":{
        "ctime":1341230522,
        "fb_name":"Auth Dialog Preview User",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004025210456",
        "fb_profile_utime":1341223950,
        "fb_timezone":"0",
        "fb_uid":"100004025210456",
        "id":344,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341230522
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/176/create`

Request: 

    {
      "text":"tagedu"
    }

Response: 

    {
      "day_id":null,
      "text":"tagedu",
      "ctime":1341230526,
      "id":12
    }

## Complaints - Display ##

`POST {{host}}/complaints/`

Request: `empty`

Response: 

    [
      {
        "id":13,
        "day_id":177,
        "ctime":1341230527,
        "text":"boxeweragenifubiwaramuluyojosuloreziponuyalaxisorevadezawewihegupejawubowixoxiliwarulibeyuvacucofiwaguvagovagarakebowaboxoyutapuliyogotikipirapaliveruzirukeyuhekaboxocegowuxixezonomicakilemotuxomomibogunagekebuwijupolubusotimahuvepudacemipihibojojopepecevinamekahifexovigawerawuxihiseviyenepumukofejusizivironibuzofofaconopunurofusumojeguxomupirogoxelebukiyagazuzinesojilumahavixowebuhikelokenewatitabawifapuripitojabogijowuzowoditavisusexesiwicalawopahezebuyalojafudugagumajifotakefosayozuwenanofopesohawotujizotakehecefu"
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
      "title":"dudo",
      "description":"mukefaso",
      "time_offset":1341230530,
      "occupation":"cumoga",
      "age":8,
      "type":1
    }

Response: 

    {
      "id":178,
      "user_id":355,
      "title":"dudo",
      "description":"mukefaso",
      "time_offset":"1341230530",
      "occupation":"cumoga",
      "age":"8",
      "type":"1",
      "likes_count":null,
      "ctime":1341230530,
      "utime":1341230530,
      "is_ended":null
    }

## Day - Item ##

`POST {{host}}days/179/item`

Request: `empty`

Response: 

    {
      "id":179,
      "user_id":356,
      "title":"xanumocujoluvuwiyajisuju",
      "description":"juhomikomazilufofiwigowivosusunuxotehadohagobejazapawisofenujavawinasoxusasoluxedipuxepapawudocudicuguvuzipikivixemopavadobehagisegufuvakepovehotoleweluxihaninatobusucadowubapoxubofitawudelonakicakacivukozunuxirayedojecoyoyefujidizujetehegatuhofilisigoda",
      "time_offset":0,
      "occupation":"pafazixowazudenuxiyesipa",
      "age":3,
      "type":3,
      "likes_count":0,
      "ctime":1341230530,
      "utime":1341230530,
      "is_ended":0,
      "moments":[
        {
          "id":97,
          "day_id":179,
          "description":"description jazubapividinisazecowomakobidunizijunulelisuzebupatiwepexiralamepujavokahacelagagulafuhapucubijiloselakofizirarudayebekocipa",
          "img_url":"",
          "likes_count":0,
          "ctime":1341230530
        },
        {
          "id":98,
          "day_id":179,
          "description":"description nilifidavicuzofozizekomejefuwugelotifutukoveluzilurusacukezacamiwecucuyipovurokatuyicaliherepaxejukevevezijohosatolorugufuho",
          "img_url":"",
          "likes_count":0,
          "ctime":1341230530
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/181;182;615/item`

Request: `empty`

Response: 

    {
      "181":{
        "id":181,
        "user_id":360,
        "title":"nevuyobopuhosowuziwevise",
        "description":"jiyeyofusaximacagowakajuzatixomadenaboyovufezelazegemihisayisetovewuzonopoziyeturujanipepivexicotulosukerevitinemumulafanuhelezahixukefarupenatuzazegalododicavepohuxizilixusiyovuzuciteduwayinifolagepoyipibifolavipitojiyedivefekirucilodideginacanuwujodidu",
        "time_offset":0,
        "occupation":"cusojasovovarudixihojevu",
        "age":3,
        "type":6,
        "likes_count":0,
        "ctime":1341230532,
        "utime":1341230532,
        "is_ended":0,
        "moments":[
          {
            "id":99,
            "day_id":181,
            "description":"description vosekuzudelujitudofemohanixosiwigiwomopizanemefoyezecemisegeyawapovakepekarujulefiretawimavecinogesireyakixokezitiwisoxarono",
            "img_url":"",
            "likes_count":0,
            "ctime":1341230532
          }
        ]
      },
      "182":{
        "id":182,
        "user_id":361,
        "title":"nelarapimumorepitisebuba",
        "description":"cotanibefapovejohacotacuyamapoconowakukibuhugopivohiwekomuxasutavifalisimuhopufemiwewecedukoyayosawarinamovarujalalekirimagidadoguxuleyudoxosewakekovugezirapoxosoradizegubuduzidegujifexulipegecujejenifilelivivanalolemutafugevimaxusapakunapedakituyarofuri",
        "time_offset":0,
        "occupation":"bufufepamojugibumuvujude",
        "age":8,
        "type":10,
        "likes_count":0,
        "ctime":1341230532,
        "utime":1341230532,
        "is_ended":0,
        "moments":[
          {
            "id":100,
            "day_id":182,
            "description":"description vizuzawiluleraraxigejidubusuweroxinusejaholuxayopadusevofipavasovaminunopuribigosenepezotivivifipozalixamimibodocozoyukonage",
            "img_url":"",
            "likes_count":0,
            "ctime":1341230532
          }
        ]
      },
      "615":null
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

`POST {{host}}days/183/add_moment`

Request: 

    {
      "description":"secocegefidozukezagiliforecidukohimewosugosetalocojifigoteguhoricaxuviyajiharovojaginijevicafopetifibapesulenazuhelosobihamitatinubiziyoleyupuwuderoyogetositizejuwenoxuduxotomuyaruvubimozedumiyetibola",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":101,
      "day_id":183,
      "description":"secocegefidozukezagiliforecidukohimewosugosetalocojifigoteguhoricaxuviyajiharovojaginijevicafopetifibapesulenazuhelosobihamitatinubiziyoleyupuwuderoyogetositizejuwenoxuduxotomuyaruvubimozedumiyetibola",
      "img_url":"\/media\/364\/day\/183\/a7be373f56097753bba4cc39abe29b842bc82410.png",
      "likes_count":null,
      "ctime":1341230534
    }

## Day - Comment ##

`POST {{host}}days/185/comment`

Request: 

    {
      "text":"vabobixivavezuyepohulopovitivoyisuhomadekunevivehahosukihazatupiwudecemigawamojorolelutoyotopebegasemavogotogalusudasuvonihavemamajukarisehukotapudesuxekajalufuzixeniyaxeceyojirivejonovuwerudolabunudeferazupikexobejugabucanifilomicovosopejurerorumucitate"
    }

Response: 

    {
      "text":"vabobixivavezuyepohulopovitivoyisuhomadekunevivehahosukihazatupiwudecemigawamojorolelutoyotopebegasemavogotogalusudasuvonihavemamajukarisehukotapudesuxekajalufuzixeniyaxeceyojirivejonovuwerudolabunudeferazupikexobejugabucanifilomicovosopejurerorumucitate",
      "day":{
        "id":185,
        "user_id":367,
        "title":"daposijuwaxemaguwimuzada",
        "occupation":"gidahogokugugohafaxaxobi",
        "age":7,
        "type":8,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341230535,
        "utime":1341230535,
        "cip":0
      },
      "user":{
        "id":367,
        "fb_uid":"100004025210456",
        "fb_access_token":"AAAFnVo0zuqkBABDOPuQjMN4xBeNQuv01LAPdTUE0DCme66pf3Ip3sleMpwVmeURKZAnmix0yhBz6at0rdb3WJ6BcryqLQdKauTOUV2KCTa49iDnoo",
        "ctime":1341230535,
        "utime":1341230535,
        "cip":0
      },
      "cip":2130706433,
      "user_id":367,
      "day_id":185,
      "ctime":1341230536,
      "utime":1341230536,
      "id":15
    }

## Day - End ##

`POST {{host}}days/186/end`

Request: `empty`

Response: 

    null

## Day - End ##

`POST {{host}}days/186/add_moment`

Request: 

    {
      "description":"hopodacoyomawagicakopudikucugojinufoyejuzuzuzagajowunukuyiwafasodukacoxapuyibapevihekogecakegazexekudecodugadunugugimiwinewohodafifevezugadezohamivuzonixegadekexipovirasolokowufowageraruhofobadotudezu",
      "image_name":"foxame",
      "image_content":"gomesi"
    }

Response: 

    null

## Day - Share ##

`POST {{host}}days/188/share`

Request: `empty`

Response: 

    {
      "id":"100004025210456_108917215919118"
    }

## Moments - Update ##

`POST {{host}}moments/103/update`

Request: 

    {
      "description":"tejulopahiwabifadofuvisebakefizuvetecehewalusizugavurijomozogupugegeriripahesecujuxuhepozikanufogebuxohititevohapacukopegunoxomacizudeluwagixitisojalukoxuloruyokuridakufinacemobuvitadocilokekofahecohegugecocapuneboyafevirahufidefimegoselojupuhonatonifasi"
    }

Response: 

    {
      "id":103,
      "day_id":189,
      "description":"tejulopahiwabifadofuvisebakefizuvetecehewalusizugavurijomozogupugegeriripahesecujuxuhepozikanufogebuxohititevohapacukopegunoxomacizudeluwagixitisojalukoxuloruyokuridakufinacemobuvitadocilokekofahecohegugecocapuneboyafevirahufidefimegoselojupuhonatonifasi",
      "img_url":"",
      "likes_count":0,
      "ctime":1341230540
    }

## Moments - Delete ##

`POST {{host}}moments/104/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/105/comment`

Request: 

    {
      "text":"zulusuxetukilocunonajigewakipugivolipewedaxiwumepukumigetotenuxeretapilosejigowutavavumipevafokuyazipigesivuhovuvifimobayudamiyenuxahakupayuvoxigadotavozuvilowupocuviwerofilazocakugamacepizimicikubafoyedelabifekipupodafapopogunefoyacamificexitihecinemaxa"
    }

Response: 

    {
      "text":"zulusuxetukilocunonajigewakipugivolipewedaxiwumepukumigetotenuxeretapilosejigowutavavumipevafokuyazipigesivuhovuvifimobayudamiyenuxahakupayuvoxigadotavozuvilowupocuviwerofilazocakugamacepizimicikubafoyedelabifekipupodafapopogunefoyacamificexitihecinemaxa",
      "moment":{
        "id":105,
        "day_id":191,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341230542,
        "utime":1341230542,
        "cip":0
      },
      "user":{
        "id":374,
        "fb_uid":"100004025210456",
        "fb_access_token":"AAAFnVo0zuqkBABDOPuQjMN4xBeNQuv01LAPdTUE0DCme66pf3Ip3sleMpwVmeURKZAnmix0yhBz6at0rdb3WJ6BcryqLQdKauTOUV2KCTa49iDnoo",
        "ctime":1341230542,
        "utime":1341230542,
        "cip":0
      },
      "cip":2130706433,
      "user_id":374,
      "moment_id":105,
      "ctime":1341230543,
      "utime":1341230543,
      "id":11
    }

## User - Days ##

`POST {{host}}users/375/days`

Request: `empty`

Response: 

    [
      
    ]

