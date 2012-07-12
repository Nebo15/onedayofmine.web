# API examples #

 Version: 12.07.12 16:22:57

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAOB4MiPlx1ZAUaWyDjOLMxZBfExQJhKz7ZASmsCeYyhdmt17Q3fJW8rYlgj2mQ4YMeyZB3uRhNyZAOievk8uIxpCb6YCD9mUOnAT0PKWb"
    }

Response: 

    {
      "sessid":"f8msc63fpeq136htdis1247104",
      "user":{
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "last_name":"foo",
        "sex":"male",
        "timezone":"3",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "occupation":"",
        "current_location":"",
        "birthday":"1992-08-08",
        "ctime":1342099368,
        "utime":1342099368,
        "id":209
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/41/create`

Request: 

    {
      "text":"tayeji"
    }

Response: 

    {
      "day_id":null,
      "text":"tayeji",
      "ctime":1342099370,
      "id":16
    }

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"nofo",
      "description":"fijuketi",
      "time_offset":1342099370,
      "occupation":"goceme",
      "age":3,
      "type":7
    }

Response: 

    {
      "id":42,
      "user_id":217,
      "title":"nofo",
      "description":"fijuketi",
      "time_offset":"1342099370",
      "occupation":"goceme",
      "age":"3",
      "type":"7",
      "likes_count":null,
      "ctime":1342099370,
      "utime":1342099370,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":43,
      "user_id":218,
      "title":"vewowipiwasubaterakonowo",
      "description":"namoxafokomepadejafoxolenefesilanuyeyabevisesoraxotolabumehasojapenikiwacinojawayiyeruhagiguhibuwikedaketubazugujaguficecegexefovixutefidamazobewehutekusidivehixamiloziwirudoduxizivelixiboxegolojujekavuyupaximubeditabosubusipuhuhobapuyazurirosodevadicajo",
      "time_offset":0,
      "occupation":"wefitinesikamuyezadivovo",
      "age":7,
      "type":3,
      "likes_count":0,
      "ctime":1342099370,
      "utime":1342099370,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"vukojexevixuyurijebemototuwenuyevezarulejejefutihovominakemufeguradebisevunuzemebezitiravabumezakakepatecejamugibazorixisukacehilowutikovovenuvifojujahubodazepebekoyomolezuhoninuhubivafufahopedubasiva",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":18,
      "day_id":45,
      "description":"vukojexevixuyurijebemototuwenuyevezarulejejefutihovominakemufeguradebisevunuzemebezitiravabumezakakepatecejamugibazorixisukacehilowutikovovenuvifojujahubodazepebekoyomolezuhoninuhubivafufahopedubasiva",
      "img_url":"\/media\/220\/day\/45\/951b9cbff71a363d7337b93a7df80af836d20964.png",
      "likes_count":null,
      "ctime":1342099371
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

## Day - Item ##

`POST {{host}}days/47/item`

Request: `empty`

Response: 

    {
      "id":47,
      "user_id":222,
      "title":"pukowerutasediseyawuxebo",
      "description":"mubanojeserilejadetijilirehiloputizefepusekapojoyagerosewutetediwatamexanegayitupucapoketarikoyexogeyamikomegefofeyobedomogunacivetoleduxodawexanuvifuhosimaripiwedenecixenonitagipilubakihubukufidotacilojubazepisumocugevefacerazekazosesojoyuhoxojunigevelu",
      "time_offset":0,
      "occupation":"najigehalubiwicenejubole",
      "age":2,
      "type":8,
      "likes_count":0,
      "ctime":1342099371,
      "utime":1342099371,
      "is_ended":0,
      "moments":[
        {
          "id":19,
          "day_id":47,
          "description":"description medebayurezigucubaridugiluyofucohecejahuhelicimanapoyugevadufapikovosaruhalenumayavuyahoferepewuxosisemukujuvuzoyoputunugaho",
          "img_url":"",
          "likes_count":0,
          "ctime":1342099371
        },
        {
          "id":20,
          "day_id":47,
          "description":"description wocamawofomigehutuhupomakiriyujoriwapoyomigovipikumunucumokepodadujoremarovihexoferohorokadusedugipusazevosacisezezezoberahe",
          "img_url":"",
          "likes_count":0,
          "ctime":1342099371
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/48;49;970/item`

Request: `empty`

Response: 

    {
      "48":{
        "id":48,
        "user_id":224,
        "title":"waxucibaxesibutusawiyuro",
        "description":"nexuxidahocunizakuvepamavaruguyojurajogomemuwibelonawufibukevebadohikibuvivozuxipelikozemeresokuhohocenuwenudegovodajanomabawezazevapezepifoxikocivenefalafenajilapukikubipuzunalelunozuvagejiwositazazarixomisusaxetufizivebozobotuwozigucojoruwigijebewunumi",
        "time_offset":0,
        "occupation":"gukemefofubunayinazuyade",
        "age":6,
        "type":8,
        "likes_count":0,
        "ctime":1342099371,
        "utime":1342099371,
        "is_ended":0,
        "moments":[
          {
            "id":21,
            "day_id":48,
            "description":"description dibotusuwejocawivemagefojijixohufetufiwuwatugijuwufafevivacoxepasexuvovixilacocupeyopohexeyositexofokugemojilelarevadanalita",
            "img_url":"",
            "likes_count":0,
            "ctime":1342099371
          }
        ]
      },
      "49":{
        "id":49,
        "user_id":225,
        "title":"fifumevalagacumawonazeka",
        "description":"xofavajexaducuganimudaforihosijifiputujizikalodufixetabereyewexawizijecetikacibedunuzidiyaxokotagotizoxohevewuputatosuhizajeyanavetobikexarobarojemagoraxunubazohomehuracewamiwowevazegujotevocakilolavihonocenureyosamuxahoxeteyawefoxigegetofebazogisarutiji",
        "time_offset":0,
        "occupation":"fifatujurorujozejuxixiru",
        "age":6,
        "type":1,
        "likes_count":0,
        "ctime":1342099371,
        "utime":1342099371,
        "is_ended":0,
        "moments":[
          {
            "id":22,
            "day_id":49,
            "description":"description dagovewopelecupugiwiyirulomefuseyubofumodudesodufukamuyureduhudevaxubesahujuniyoletuhovubutevunicinavegabibicugifukinakidaxu",
            "img_url":"",
            "likes_count":0,
            "ctime":1342099371
          }
        ]
      },
      "970":null
    }

## Day - CommentCreate ##

`POST {{host}}days/51/comment_create`

Request: 

    {
      "text":"gisalayerifuvejuzuzojaregizamiwobiyiruvejufahibemaxofifezapipegoxadizuvewukakejulesisuzoyidiyedomejidatuzabenehupumetiyozafukesunuhocupacomozonisawemocivejanayabatafedeyixujemukekubijosoxasuhobavajulemefusovayayupetexolilogituraxajekifafudadacohoyakesobu"
    }

Response: 

    {
      "text":"gisalayerifuvejuzuzojaregizamiwobiyiruvejufahibemaxofifezapipegoxadizuvewukakejulesisuzoyidiyedomejidatuzabenehupumetiyozafukesunuhocupacomozonisawemocivejanayabatafedeyixujemukekubijosoxasuhobavajulemefusovayayupetexolilogituraxajekifafudadacohoyakesobu",
      "day":{
        "id":51,
        "user_id":229,
        "title":"gebicoyefexatetuwetavaci",
        "occupation":"niribugiwoyenirekaresunu",
        "age":2,
        "type":3,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342099372,
        "utime":1342099372,
        "cip":0
      },
      "user":{
        "id":229,
        "user_settings_id":0,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBAOB4MiPlx1ZAUaWyDjOLMxZBfExQJhKz7ZASmsCeYyhdmt17Q3fJW8rYlgj2mQ4YMeyZB3uRhNyZAOievk8uIxpCb6YCD9mUOnAT0PKWb",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":1341686153,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "location":"",
        "occupation":"",
        "birthday":"1992-08-08",
        "sex":"male",
        "ctime":1342099372,
        "utime":1342099372,
        "cip":0
      },
      "cip":2130706433,
      "user_id":229,
      "day_id":51,
      "ctime":1342099372,
      "utime":1342099372,
      "id":3
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

`POST {{host}}days/52/delete`

Request: `empty`

Response: 

    null

## Day - GetFavouriteDays ##

`POST {{host}}days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":53,
        "user_id":232,
        "title":"dunopamuvoyepilaxenaroko",
        "description":"cejejifekazatobojujicafidukicapakulokocorayerucuximunonorufoyoveseyaxaviboyosurilanutaneyobumudacafucumasetekeyomisananixihelimimomirupejerosimazajikuyemepusakaturewaranewevekomohupecamoyategifuvubedirutehafoviresolakegasipuhewetuwezitesubijoxujedopewewi",
        "time_offset":0,
        "occupation":"fabokesinekowutohuminaja",
        "age":3,
        "type":5,
        "likes_count":0,
        "ctime":1342099372,
        "utime":1342099372,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/54/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/55/unfavourite`

Request: `empty`

Response: 

    null

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":56,
        "user_id":239,
        "title":"rakemowejijawatoxoririba",
        "description":"behacotuvuravudobemivoducofehenerojomanezajocikavuninomomoyobicofeholuyizefatidilobujipugipeyowabawiyoxubayoragasezuvivubefuzacadumasezokukaxibiwanipeposorovorurazeluyuwewoxugoxogicudopokeluhacejigejanatezucutekudinoguboxetupamojovuyigumewerabosilulireve",
        "time_offset":0,
        "occupation":"ranovaduwijoravahabikime",
        "age":5,
        "type":11,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      },
      {
        "id":57,
        "user_id":239,
        "title":"benagekajijadijehesexalu",
        "description":"cafepoxiyeyuzelumiworagomevazolazihigabalucegijobalohogozavuwacovekupidukajisojowojaliwipikevifiwinizokewoyikedezihebavotazirabitixofebuzumegipacupabesonogaxerowijuvezojidibotapefirujanijevubimepesibazapuwecepezebeliwozitufejomajibepogiyevinovibaduyaloco",
        "time_offset":0,
        "occupation":"yekeduzimicewepawayikeba",
        "age":3,
        "type":7,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":56
    }

Response: 

    [
      {
        "id":57,
        "user_id":239,
        "title":"benagekajijadijehesexalu",
        "description":"cafepoxiyeyuzelumiworagomevazolazihigabalucegijobalohogozavuwacovekupidukajisojowojaliwipikevifiwinizokewoyikedezihebavotazirabitixofebuzumegipacupabesonogaxerowijuvezojidibotapefirujanijevubimepesibazapuwecepezebeliwozitufejomajibepogiyevinovibaduyaloco",
        "time_offset":0,
        "occupation":"yekeduzimicewepawayikeba",
        "age":3,
        "type":7,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":56,
      "to":57
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
        "id":59,
        "user_id":241,
        "title":"keripawecasezufanekoxisa",
        "description":"zaxizaxewaworasizuxoraletemikaledevakokatexejixelocaxilisucabilaxafexikiveyaxumepikizobosatosawijutapavelonemupanunitifetucebuyeyoniwewezenijapubajoridekevidotakenapelisubaboxasevetusadimedehinoradasuzoxuhobuyojosutolebimebacodatobomutorotinafabuzifuboga",
        "time_offset":0,
        "occupation":"zugibapayoyeholakezewece",
        "age":6,
        "type":7,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      },
      {
        "id":60,
        "user_id":240,
        "title":"fecoyogijukiyehejuluteku",
        "description":"ligoculilolivaxerodudorexupinigufitekasuyajohezubawawilojufupiwowizetobotekapeyolotegazicalopekiwesibogocovozohimutocohawowizaxunikihojehazevesegezebenuzejunevavapawujazejopubujufegogebifivurifenucucafewojuroxuzanekividinoboyitalodidukiwucovaxehexavapevo",
        "time_offset":0,
        "occupation":"dedibixedunutecekacelogu",
        "age":3,
        "type":8,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":59
    }

Response: 

    [
      {
        "id":60,
        "user_id":240,
        "title":"fecoyogijukiyehejuluteku",
        "description":"ligoculilolivaxerodudorexupinigufitekasuyajohezubawawilojufupiwowizetobotekapeyolotegazicalopekiwesibogocovozohimutocohawowizaxunikihojehazevesegezebenuzejunevavapawujazejopubujufegogebifivurifenucucafewojuroxuzanekividinoboyitalodidukiwucovaxehexavapevo",
        "time_offset":0,
        "occupation":"dedibixedunutecekacelogu",
        "age":3,
        "type":8,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":59,
      "to":60
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
        "id":62,
        "user_id":242,
        "title":"yejirihuvuwafuguwikuboke",
        "description":"mejelorapiwolijureliyubohopanemarokakugupapunuzahesagozimisayaciyirelugaxubitupajegizacitonoyifubudisemigizulizoxajukijafutaluxivaxilezowurepibivehatiguluzuxuhoyacemazecipofibuyecoxepehidamewenutazojahurilokeyibuvidadeforazaxofulixojidofifayayotatuhumuyi",
        "time_offset":0,
        "occupation":"xuyirakicavogocigegofogi",
        "age":1,
        "type":3,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      },
      {
        "id":63,
        "user_id":242,
        "title":"vavilaluyefukiwozayomoco",
        "description":"norabozipadowibudosunevopobedaroxesuxolivicibakavacejuzunufodohubuxurejexezumebelapoyisinucosesojipuwujoheposibasoxifibolajamatunevegacilohagefuzanapiwusacafobododexaxewakamizirirebigoreyucupatonixexonevaxomigatenubaguzewimifadalatujizahisinivajogitaxite",
        "time_offset":0,
        "occupation":"wuwekefofizeyivurokicaku",
        "age":1,
        "type":8,
        "likes_count":0,
        "ctime":1342099373,
        "utime":1342099373,
        "is_ended":0
      }
    ]

## Moments - Update ##

`POST {{host}}moments/27/update`

Request: 

    {
      "description":"lehikapuguboyivufaruyaxonabitatamarucasedobafuyeyigutapejitavidemocizoxamudovabopemekaroresewurepowilopuponevizevisanewasinihatuvikagucosodifavupidavufiloxovinidutexudimeyojorufoyusajawavivefufugatepapixufiwehoguxicotuhidikejijayuhikamireyubawuturituyuke"
    }

Response: 

    {
      "id":27,
      "day_id":68,
      "description":"lehikapuguboyivufaruyaxonabitatamarucasedobafuyeyigutapejitavidemocizoxamudovabopemekaroresewurepowilopuponevizevisanewasinihatuvikagucosodifavupidavufiloxovinidutexudimeyojorufoyusajawavivefufugatepapixufiwehoguxicotuhidikejijayuhikamireyubawuturituyuke",
      "img_url":"",
      "likes_count":0,
      "ctime":1342099374
    }

## Moments - Delete ##

`POST {{host}}moments/28/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/29/comment`

Request: 

    {
      "text":"meniwoxurutoyonicurejaxarunexucecovugoxuripijabecosevilenuviwutulivofopugakiheyebovofedofudatuxakoxikikopofudagatuyufareyokorewazopefuyotarugubuwuxabikugorubiwufijelecakoconapecikayobanobicupehurofoxikufubogagofakahuweludufixodamuruyotupubopaxujawamecohe"
    }

Response: 

    {
      "text":"meniwoxurutoyonicurejaxarunexucecovugoxuripijabecosevilenuviwutulivofopugakiheyebovofedofudatuxakoxikikopofudagatuyufareyokorewazopefuyotarugubuwuxabikugorubiwufijelecakoconapecikayobanobicupehurofoxikufubogagofakahuweludufixodamuruyotupubopaxujawamecohe",
      "moment":{
        "id":29,
        "day_id":70,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342099375,
        "utime":1342099375,
        "cip":0
      },
      "user":{
        "id":255,
        "user_settings_id":0,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBAOB4MiPlx1ZAUaWyDjOLMxZBfExQJhKz7ZASmsCeYyhdmt17Q3fJW8rYlgj2mQ4YMeyZB3uRhNyZAOievk8uIxpCb6YCD9mUOnAT0PKWb",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":1341686153,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "location":"",
        "occupation":"",
        "birthday":"1992-08-08",
        "sex":"male",
        "ctime":1342099375,
        "utime":1342099375,
        "cip":0
      },
      "cip":2130706433,
      "user_id":255,
      "moment_id":29,
      "ctime":1342099375,
      "utime":1342099375,
      "id":11
    }

## My - Profile ##

`POST {{host}}/my/profile`

Request: `empty`

Response: 

    {
      "id":256,
      "user_settings_id":0,
      "first_name":"foo",
      "last_name":"foo",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"",
      "occupation":"",
      "birthday":"1992-08-08",
      "sex":"male",
      "ctime":1342099375,
      "utime":1342099375
    }

## My - UpdateProfile ##

`POST {{host}}/my/profile`

Request: 

    {
      "first_name":"larawokeropibajikegegabo",
      "last_name":"lafajunajopowekunomecohu",
      "occupation":"dazicivitaxamodisocenasu",
      "location":"lazixofohufifuwasiyekoja",
      "birthday":"1911-00-06"
    }

Response: 

    {
      "id":257,
      "user_settings_id":0,
      "first_name":"larawokeropibajikegegabo",
      "last_name":"lafajunajopowekunomecohu",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"lazixofohufifuwasiyekoja",
      "occupation":"dazicivitaxamodisocenasu",
      "birthday":"1911-00-06",
      "sex":"male",
      "ctime":1342099375,
      "utime":1342099375,
      "uip":2130706433
    }

## My - UpdateProfile_Partial ##

`POST {{host}}/my/profile`

Request: 

    {
      "first_name":"rukaboralafokimakimipive",
      "birthday":"1907-00-02"
    }

Response: 

    {
      "id":258,
      "user_settings_id":0,
      "first_name":"rukaboralafokimakimipive",
      "last_name":"foo",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"",
      "occupation":"",
      "birthday":"1907-00-02",
      "sex":"male",
      "ctime":1342099375,
      "utime":1342099375,
      "uip":2130706433
    }

## My - Settings ##

`POST {{host}}/my/settings/`

Request: `empty`

Response: 

    {
      "id":27,
      "notifications_new_days":1,
      "notifications_new_comments":0,
      "notifications_related_activity":1,
      "notifications_shooting_photos":0,
      "photos_save_original":1,
      "photos_save_filtered":0
    }

## My - UpdateSettings ##

`POST {{host}}/my/settings/`

Request: 

    {
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1
    }

Response: 

    {
      "id":28,
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1,
      "uip":2130706433
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "id":262,
        "user_settings_id":0,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004087981387",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "location":"",
        "occupation":"",
        "birthday":"1980-08-08",
        "sex":"male",
        "ctime":1342099376,
        "utime":1342099376,
        "user_info":{
          "fb_uid":"100004087981387",
          "first_name":"bar",
          "last_name":"bar",
          "sex":"male",
          "timezone":null,
          "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
          "fb_profile_utime":"1341683761",
          "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
          "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
          "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
          "occupation":"",
          "current_location":"",
          "birthday":"1980-08-08"
        }
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/263/days/`

Request: `empty`

Response: 

    [
      {
        "id":71,
        "user_id":263,
        "title":"yakegiyifocatekuzetaginu",
        "description":"femolimepodivalerisogonamizufajepoduhihugekakojukurotatavocuxehidelizohebogikilonakefaluvixoxacanilifosehurolamubugezofofakagicozigafujivudezofamihicidenihozemuwocupelekinefokofocedemotolocurupowacemiwavavasuvoduyinojukewagetanojugazadoforunowikedohicame",
        "time_offset":0,
        "occupation":"nosihegusizaxigudakohofe",
        "age":1,
        "type":2,
        "likes_count":0,
        "ctime":1342099376,
        "utime":1342099376,
        "is_ended":0
      },
      {
        "id":72,
        "user_id":263,
        "title":"huzanozoyosabuhidadamuke",
        "description":"lorabexoxiduwiziyibinugifohecupivemupemixolobeguyelicocekepijayajixuvelozujafiyaverucociboxevolafecusipojusilosebecazamuvejidosebogogujisucarojocesanabenewocizahetibacocawoyajupabafakokakisenupelijijesacojepukozirejamomacudohigicizotakaluyopukefogokoxitu",
        "time_offset":0,
        "occupation":"cadiweyahinewagadimesipa",
        "age":4,
        "type":8,
        "likes_count":0,
        "ctime":1342099376,
        "utime":1342099376,
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
        "id":266,
        "user_settings_id":0,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004087981387",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "location":"",
        "occupation":"",
        "birthday":"1980-08-08",
        "sex":"male",
        "ctime":1342099376,
        "utime":1342099376
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
        "id":268,
        "user_settings_id":0,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004087981387",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "location":"",
        "occupation":"",
        "birthday":"1980-08-08",
        "sex":"male",
        "ctime":1342099376,
        "utime":1342099376
      }
    ]

## User - Follow ##

`POST {{host}}users/270/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/272/unfollow`

Request: `empty`

Response: 

    null

