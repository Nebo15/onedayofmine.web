# API examples #

 Version: 12.07.12 18:56:26

## Auth - IsLoggedIn ##



`POST auth/is_logged_in`

### Request: ###

`empty`

### Response: ###

    false

## Auth - Login ##

This method is pretty much simple, it gets user credentials, auth user and returns session id in respond.

`POST auth/login/`

### Request: ###

    {
      "fb_access_token":"AAAFnVo0zuqkBAOB4MiPlx1ZAUaWyDjOLMxZBfExQJhKz7ZASmsCeYyhdmt17Q3fJW8rYlgj2mQ4YMeyZB3uRhNyZAOievk8uIxpCb6YCD9mUOnAT0PKWb"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>fb_access_token</td><td>String[118]</td><td>Y</td><td>Facebook access token <a href="http://developers.facebook.com/">FB Dev</a></td></tr></table>

### Response: ###

    {
      "sessid":"he36em8n7t00ihst1ur9558d53",
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
        "ctime":1342108576,
        "utime":1342108576,
        "id":467
      }
    }

Response params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th>Description</th></tr>

<tr><td>String[32]</td><td>sessid</td><td>PHP user session id.</td></tr></table>

## Complaints - Create ##



`POST /complaints/250/create`

### Request: ###

    {
      "text":"ditudo"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>text</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "day_id":null,
      "text":"ditudo",
      "ctime":1342108578,
      "id":6
    }

## CurrentDay - Start ##



`POST current_day/start`

### Request: ###

    {
      "id":null,
      "user_id":null,
      "title":"kefovejavakexojazonekoje",
      "description":"gibetizazoyoweyekitarebibunoyizabanomixifofuzakesamehivejezewuluzupiliyogaragupubagenarujidanibimibubunebaledufazelikakorixabutinolisuvodayedakamoruxapimisikicudilomamijiwimapuzevugejowagaleciwikeruxuholoxutufisixudobexisubilivahobikijelaconobitadonugaye",
      "timezone":0,
      "occupation":"cokeregogakutofosivegoco",
      "age":6,
      "type":"day-off",
      "likes_count":null,
      "ctime":null,
      "utime":null,
      "is_ended":null
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>id</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>user_id</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>title</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>description</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>timezone</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>occupation</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>age</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>type</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>likes_count</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>ctime</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>utime</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>is_ended</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "id":251,
      "user_id":475,
      "title":"kefovejavakexojazonekoje",
      "description":"gibetizazoyoweyekitarebibunoyizabanomixifofuzakesamehivejezewuluzupiliyogaragupubagenarujidanibimibubunebaledufazelikakorixabutinolisuvodayedakamoruxapimisikicudilomamijiwimapuzevugejowagaleciwikeruxuholoxutufisixudobexisubilivahobikijelaconobitadonugaye",
      "timezone":"0",
      "occupation":"cokeregogakutofosivegoco",
      "age":"6",
      "type":"day-off",
      "likes_count":null,
      "ctime":1342108579,
      "utime":1342108579,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##



`POST current_day`

### Request: ###

`empty`

### Response: ###

    {
      "id":252,
      "user_id":476,
      "title":"kubugoyewaromunahazevefa",
      "description":"tevevudozujujiyenitubefozazixizoyoyosajoyonegirozetasusoyocohalavewiladexoradewapiceloyeludociwuxojexirodevemijadejidexiguhenadivitoyekapahatoduzilatetuhugocefuxunuguxuzaxovapomuyegofirihovipokamoyelumerejebufubipeyerexetibanitiwakelupofipepovawojizewosu",
      "timezone":0,
      "occupation":"nowopawayofedehehepipoko",
      "age":4,
      "type":"",
      "likes_count":0,
      "ctime":1342108579,
      "utime":1342108579,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##



`POST current_day/moment_create`

### Request: ###

    {
      "description":"cedelizurucametesuvafisifituraxokaconatabuhifuxuxobacosecidomamuciripevofafezagusezoxoyucaticakasutekixinayicakokemebihamurifusuzefexaxiduyazezesiroxuvexeyajoyebarudijejelepeseweyofodacadetasofesewuna",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>description</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>image_name</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>image_content</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "id":93,
      "day_id":254,
      "description":"cedelizurucametesuvafisifituraxokaconatabuhifuxuxobacosecidomamuciripevofafezagusezoxoyucaticakasutekixinayicakokemebihamurifusuzefexaxiduyazezesiroxuvexeyajoyebarudijejelepeseweyofodacadetasofesewuna",
      "img_url":"\/media\/478\/day\/254\/1f08e5406f57fe65c9c09ee897d2aeb7ad67a873.png",
      "likes_count":null,
      "ctime":1342108579
    }

## CurrentDay - Finish ##



`POST current_day/finish`

### Request: ###

`empty`

### Response: ###

`empty`

## Day - Item ##



`POST days/256/item`

### Request: ###

`empty`

### Response: ###

    {
      "id":256,
      "user_id":480,
      "title":"pidinojakelodenutesugoze",
      "description":"johikajakayemudakeneniyeguficemecoyiwenehimohowoyezixuwawanukahiwayolixoyekazewupulitenihaloboduxaneneyiveronitahanukamocuhapezimisuxoloyalinapogatofegedikoyedevujolohewoxewicapusocubeleyesatixadewisodizubaboyokuregavalifayafajanasororotoholoracuduzigasa",
      "timezone":0,
      "occupation":"neyalilaligenemanojukuzu",
      "age":8,
      "type":"",
      "likes_count":0,
      "ctime":1342108579,
      "utime":1342108579,
      "is_ended":0,
      "moments":[
        {
          "id":94,
          "day_id":256,
          "description":"description cevabosasetuzexikabisawonolodigesalosavekihetavahoruyiricahemimapuxebopefutuyizahodecosawukenumatehozufasubokavoruwotiwinaxa",
          "img_url":"",
          "likes_count":0,
          "ctime":1342108579
        },
        {
          "id":95,
          "day_id":256,
          "description":"description hoyixelalofibidimenifawarewuwujasepipusavulohikoxuhacadomumewokibuboyoronamurupivuruyomisutivazubuluraradazoyijokunesateziwo",
          "img_url":"",
          "likes_count":0,
          "ctime":1342108579
        }
      ]
    }

## Day - Item_Many ##



`POST days/257;258;312/item`

### Request: ###

`empty`

### Response: ###

    {
      "257":{
        "id":257,
        "user_id":482,
        "title":"jazofubotomategapodunomo",
        "description":"pedutezacovinabodasubavaduluciwowumihisegiwonunobapafecejihezabobihezusakiyukinepalolicoyefulasisuvoxixeyodefosotamaniyiwakehatuzisuyicuhedixodoxovedowuwagagudalobehagijezedawutikujewalajociwifuxiyazelumibenoxurafikinogicacewutozobesiyotimikavinadaverulo",
        "timezone":0,
        "occupation":"vapumepamafonavejupefoci",
        "age":4,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342108580,
        "utime":1342108580,
        "is_ended":0,
        "moments":[
          {
            "id":96,
            "day_id":257,
            "description":"description huvupaciwocejelixopesirisovufupivelemixefusihazavikicuboposoregirovadomerawugubukikilefafuvuduhoraxoteceluhoveravupakofirujo",
            "img_url":"",
            "likes_count":0,
            "ctime":1342108580
          }
        ]
      },
      "258":{
        "id":258,
        "user_id":483,
        "title":"kuticapedibanucuyuhokefe",
        "description":"godekacahohegalevepadetinagivukupijusicubegelonazagakuruyuhovotegagulevisatasehojivolipehucanukowireyitimisatuwamisuzehecehofokafahamusumecajufumuticusakuvipanoguxowirexoleribalonitasadirosaluzepoweboziyobutiteyilonicahohorezabulanemizimoyayupemazigejiyu",
        "timezone":0,
        "occupation":"kunarirunuciyegafurahura",
        "age":2,
        "type":"working",
        "likes_count":0,
        "ctime":1342108580,
        "utime":1342108580,
        "is_ended":0,
        "moments":[
          {
            "id":97,
            "day_id":258,
            "description":"description gujibepupuwuvibibajadugupimuyomanosizekideputonosuxusasenafivorekexepeyoliradawozorowezelawetinawemiridayofayawutirisiyatoji",
            "img_url":"",
            "likes_count":0,
            "ctime":1342108580
          }
        ]
      },
      "312":null
    }

## Day - CommentCreate ##



`POST days/260/comment_create`

### Request: ###

    {
      "text":"fajidevevarajekogegayuvewasinejohohebasucewipecomewegitasinaruyumajiguhehatujurocidezuhojuwuroxayapadulizageyucajejedoyilojamefekonipuyicawububederezirejulufofikoburunodesahomebapusejufovekuyosuteyeyarifugogevugicilekarofinumecimulapoyohacabenaxukedazepi"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>text</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "text":"fajidevevarajekogegayuvewasinejohohebasucewipecomewegitasinaruyumajiguhehatujurocidezuhojuwuroxayapadulizageyucajejedoyilojamefekonipuyicawububederezirejulufofikoburunodesahomebapusejufovekuyosuteyeyarifugogevugicilekarofinumecimulapoyohacabenaxukedazepi",
      "day":{
        "id":260,
        "user_id":487,
        "title":"yuxudibebaxaxesitesusupu",
        "occupation":"yuziveyudopiluwejegugixa",
        "age":3,
        "type":"day-off",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342108580,
        "utime":1342108580,
        "cip":0
      },
      "user":{
        "id":487,
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
        "ctime":1342108580,
        "utime":1342108580,
        "cip":0
      },
      "cip":2130706433,
      "user_id":487,
      "day_id":260,
      "ctime":1342108580,
      "utime":1342108580,
      "id":13
    }

## Day - Update ##



`POST days/42/update`

### Request: ###

    {
      "tags":[
        "tag1",
        "tag2"
      ],
      "top_moment_id":111
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>tags</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>top_moment_id</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

`empty`

## Day - DeleteDay ##



`POST days/261/delete`

### Request: ###

`empty`

### Response: ###

`empty`

## Day - GetFavouriteDays ##



`POST days/favourites`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":262,
        "user_id":490,
        "title":"sumepotujigugetokogetike",
        "description":"xuhamavuyavixuhahimubatagihefikanoguvuyofofanifozoratebuxehayocijelajewibanimokijumajizexehoyegesokabenagarotufazocegamahoxacamovuwucexekibamadixasagadixatudavubosayikebekipiyitinutomosapojesezeluyugufomodeguzovokehakuwogicaxicujevixejariwigihovirakiyiya",
        "timezone":0,
        "occupation":"jufaloratifipupudezenodu",
        "age":1,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342108580,
        "utime":1342108580,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##



`POST /days/263/favourite`

### Request: ###

`empty`

### Response: ###

`empty`

## Day - RemoveFromFavourites ##



`POST /days/264/unfavourite`

### Request: ###

`empty`

### Response: ###

`empty`

## Day - GetFollowingUsersDays ##



`POST days/following_users/`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":265,
        "user_id":497,
        "title":"govujadipibogeketuperolu",
        "description":"hufupucalabolepakubexukexumacojenijakehunenuracacakubojurocomecuxecevebesigesekolorimuhatewatufihewarujemiraxuwetitelujakajabisetikelosuhezajulahahofowivaruredewitefidivarayafegixedoxuwitiwuvojixiyazodowasugulajiwemotacicudijayebuzapofevifenivesebelaxixa",
        "timezone":0,
        "occupation":"cahuyexupejozemevadutuja",
        "age":4,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342108581,
        "utime":1342108581,
        "is_ended":0
      },
      {
        "id":266,
        "user_id":497,
        "title":"negotosesapofagesevuduze",
        "description":"civaxonerukuzicunotaxafaxidapizobotumejagodegafoxuwobuxupaxamuwisikavohakehopikihadefadobayiyozihetacudikecuwikarikonininicifabikopivoyaducukizazeviwecevawudulirazevumuwivebogudamujijarabozijineyefifabugavizumixuzaxohulelowuzogagefejihaxezesufozahebopiki",
        "timezone":0,
        "occupation":"nicahimezasidumetodufeyi",
        "age":2,
        "type":"working",
        "likes_count":0,
        "ctime":1342108581,
        "utime":1342108581,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##



`POST days/following_users/`

### Request: ###

    {
      "from":265
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>from</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    [
      {
        "id":266,
        "user_id":497,
        "title":"negotosesapofagesevuduze",
        "description":"civaxonerukuzicunotaxafaxidapizobotumejagodegafoxuwobuxupaxamuwisikavohakehopikihadefadobayiyozihetacudikecuwikarikonininicifabikopivoyaducukizazeviwecevawudulirazevumuwivebogudamujijarabozijineyefifabugavizumixuzaxohulelowuzogagefejihaxezesufozahebopiki",
        "timezone":0,
        "occupation":"nicahimezasidumetodufeyi",
        "age":2,
        "type":"working",
        "likes_count":0,
        "ctime":1342108581,
        "utime":1342108581,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##



`POST days/following_users/`

### Request: ###

    {
      "from":265,
      "to":266
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>from</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>to</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

`empty`

## Day - GetNewDays ##



`POST days/new/`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":268,
        "user_id":499,
        "title":"piranuwayurubemufadizawu",
        "description":"purofowayawavamaxoyibuxarejukuyuwitugidatugiborulilineratucawuzonorohoyuralowanerutahehujecahawuviradibotilinuwayihezigewelakeyarigodenusukexekuvocodeburicusadepeconomenumecuguleriponacidopedapevawekefutesucagosojazitafekekunacemisohixukubisokuxelimoxuye",
        "timezone":0,
        "occupation":"gifomarotitivakivaviwisi",
        "age":2,
        "type":"working",
        "likes_count":0,
        "ctime":1342108581,
        "utime":1342108581,
        "is_ended":0
      },
      {
        "id":269,
        "user_id":498,
        "title":"rofalelusisehalawelojodo",
        "description":"huducamaceviminuhuwuvurivawatidumexikesivicebofenuheyutobitodusicidizozogazeranafomasatoviluhametowolulowixirerofawuhinazuyedirucinihudakunakavigojifunawiluyavumelohiwonesumilocoferolifukayabilifobujijumulunirovelericasufokifihenowuresadapoxeyeniwipipogu",
        "timezone":0,
        "occupation":"xaburujigohuyojotojoketu",
        "age":4,
        "type":"trip",
        "likes_count":0,
        "ctime":1342108581,
        "utime":1342108581,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##



`POST days/new/`

### Request: ###

    {
      "from":268
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>from</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    [
      {
        "id":269,
        "user_id":498,
        "title":"rofalelusisehalawelojodo",
        "description":"huducamaceviminuhuwuvurivawatidumexikesivicebofenuheyutobitodusicidizozogazeranafomasatoviluhametowolulowixirerofawuhinazuyedirucinihudakunakavigojifunawiluyavumelohiwonesumilocoferolifukayabilifobujijumulunirovelericasufokifihenowuresadapoxeyeniwipipogu",
        "timezone":0,
        "occupation":"xaburujigohuyojotojoketu",
        "age":4,
        "type":"trip",
        "likes_count":0,
        "ctime":1342108581,
        "utime":1342108581,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##



`POST days/new/`

### Request: ###

    {
      "from":268,
      "to":269
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>from</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>to</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

`empty`

## Day - CurrentUserDays ##



`POST days/my`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":271,
        "user_id":500,
        "title":"lezamoputejabehotuyunayu",
        "description":"dibumarisonahafufuxuxepodufivivucowiyibidipipokoteporajodijubaxaxorodokefusotanihabuheriyujubebuxotahahibugozofewedaronisumocirufezikexifadawekonivagesugapesahumegumahofivuvasesiluvawagejupitawuyecezesogizutokapahefivilecakudegepemebosuresupedurekitovuya",
        "timezone":0,
        "occupation":"jobugigupoluhoyawuvobale",
        "age":8,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342108582,
        "utime":1342108582,
        "is_ended":0
      },
      {
        "id":272,
        "user_id":500,
        "title":"posobejoputujovuwojotenu",
        "description":"padodufaxoluwutolexakawixemicejojimijoregafaxuxedomitezinidosijawomakakogisalikihucudaponojecohukocoxilabafisizulaxidigofiyedafiyejutoyoxafiralafepevobujufifezareyecucuyelikupifayuzuxeyatakofabakayibutikajusifilapelijapoxotuwabopapenukuyajarogabosevedozu",
        "timezone":0,
        "occupation":"yivunokemijayenilepuzula",
        "age":8,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342108582,
        "utime":1342108582,
        "is_ended":0
      }
    ]

## Moments - Update ##



`POST moments/102/update`

### Request: ###

    {
      "description":"razadeluyetoledacetisocahonidajogevenahimugufezetorejomokafigihiwavehawobapekilahanowugabisezurobifemuzibitidanegababegasugowulujidunajirazogifinamilopapuvesagavewelaxafuwejuwufelizutiwiyisaninevumobomucoxurafaraberuwikisuyefofojejocepugezehineyafosifela"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>description</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "id":102,
      "day_id":277,
      "description":"razadeluyetoledacetisocahonidajogevenahimugufezetorejomokafigihiwavehawobapekilahanowugabisezurobifemuzibitidanegababegasugowulujidunajirazogifinamilopapuvesagavewelaxafuwejuwufelizutiwiyisaninevumobomucoxurafaraberuwikisuyefofojejocepugezehineyafosifela",
      "img_url":"",
      "likes_count":0,
      "ctime":1342108583
    }

## Moments - Delete ##



`POST moments/103/delete`

### Request: ###

`empty`

### Response: ###

`empty`

## Moments - Comment ##



`POST moments/104/comment`

### Request: ###

    {
      "text":"lemuyizoxuyojihediyuwikusocakalukusemozenubumebiyumomupapoguwowarinafimojimowikonulasagetigifatupeyotilayuxolelucuboyezoteduhutudorucayuzosebakazevuromezogemudopolowerodefakigeyagiwoyojacudemozujohupigopohuzexevoyomexiduvisomunoyadawowapojizaduvofoferuwe"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>text</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "text":"lemuyizoxuyojihediyuwikusocakalukusemozenubumebiyumomupapoguwowarinafimojimowikonulasagetigifatupeyotilayuxolelucuboyezoteduhutudorucayuzosebakazevuromezogemudopolowerodefakigeyagiwoyojacudemozujohupigopohuzexevoyomexiduvisomunoyadawowapojizaduvofoferuwe",
      "moment":{
        "id":104,
        "day_id":279,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342108583,
        "utime":1342108583,
        "cip":0
      },
      "user":{
        "id":513,
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
        "ctime":1342108583,
        "utime":1342108583,
        "cip":0
      },
      "cip":2130706433,
      "user_id":513,
      "moment_id":104,
      "ctime":1342108583,
      "utime":1342108583,
      "id":35
    }

## My - Profile ##



`POST /my/profile`

### Request: ###

`empty`

### Response: ###

    {
      "id":514,
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
      "ctime":1342108583,
      "utime":1342108583
    }

## My - UpdateProfile ##



`POST /my/profile`

### Request: ###

    {
      "first_name":"duyurujomihatarufabiyeju",
      "last_name":"yalulohecerulujifoyevuna",
      "occupation":"kikohavocehefeteyayorofe",
      "location":"manarukatoyamocobafijuda",
      "birthday":"1984-00-25"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>first_name</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>last_name</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>occupation</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>location</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>birthday</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "id":515,
      "user_settings_id":0,
      "first_name":"duyurujomihatarufabiyeju",
      "last_name":"yalulohecerulujifoyevuna",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"manarukatoyamocobafijuda",
      "occupation":"kikohavocehefeteyayorofe",
      "birthday":"1984-00-25",
      "sex":"male",
      "ctime":1342108583,
      "utime":1342108583,
      "uip":2130706433
    }

## My - UpdateProfile_Partial ##



`POST /my/profile`

### Request: ###

    {
      "first_name":"lanowixanirozamurofivewo",
      "birthday":"1953-01-02"
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>first_name</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>birthday</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "id":516,
      "user_settings_id":0,
      "first_name":"lanowixanirozamurofivewo",
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
      "birthday":"1953-01-02",
      "sex":"male",
      "ctime":1342108583,
      "utime":1342108584,
      "uip":2130706433
    }

## My - Settings ##



`POST /my/settings/`

### Request: ###

`empty`

### Response: ###

    {
      "id":11,
      "notifications_new_days":1,
      "notifications_new_comments":0,
      "notifications_related_activity":1,
      "notifications_shooting_photos":0,
      "photos_save_original":1,
      "photos_save_filtered":0
    }

## My - UpdateSettings ##



`POST /my/settings/`

### Request: ###

    {
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1
    }

Request params: 

<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>

<tr><td>notifications_new_days</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>notifications_new_comments</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>notifications_related_activity</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>notifications_shooting_photos</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>photos_save_original</td><td>String</td><td>Y</td><td>Describe me!</td></tr><tr><td>photos_save_filtered</td><td>String</td><td>Y</td><td>Describe me!</td></tr></table>

### Response: ###

    {
      "id":12,
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1,
      "uip":2130706433
    }

## Social - FacebookFiends ##



`POST social/facebook_friends`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":520,
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
        "ctime":1342108584,
        "utime":1342108584,
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



`POST users/521/days/`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":280,
        "user_id":521,
        "title":"xorafonijofazutihowamapo",
        "description":"palicacezivadetifobevokucepuxesimayiguyenojozabasalisuhofusafemomefojayuvemohiyupelefobepokobukigifisakijuhojapunadotacewicuhikibibosifuhirorenagoxuwuholenovufulenasocufopoxazavudowehetuyitajakugapezobinusibikacanekefewulabobewipujokunakinotixeyenapezumu",
        "timezone":0,
        "occupation":"dudavomupipitacevehanabo",
        "age":1,
        "type":"",
        "likes_count":0,
        "ctime":1342108584,
        "utime":1342108584,
        "is_ended":0
      },
      {
        "id":281,
        "user_id":521,
        "title":"fifafovosecemidajolitaji",
        "description":"susesubeyanegivavinuxokoxidufejucucozadugohigarumayevebowanakuxiwufucetezusabefilaxeluwezegegawabayajokeramojofotazayukugohitanodixicevoheloxilorivigamivoxiwihuwakukarokaheroxedowevevizococetunawufininuwanolojezamosilohidulocenevawexolihucicatiwebefevega",
        "timezone":0,
        "occupation":"bowusujopufabijokusomofo",
        "age":3,
        "type":"trip",
        "likes_count":0,
        "ctime":1342108584,
        "utime":1342108584,
        "is_ended":0
      }
    ]

## User - Followers ##



`POST users/followers`

### Request: ###

`empty`

### Response: ###

`empty`

## User - Followers ##



`POST users/followers`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":524,
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
        "ctime":1342108584,
        "utime":1342108584
      }
    ]

## User - Following ##



`POST users/following`

### Request: ###

`empty`

### Response: ###

`empty`

## User - Following ##



`POST users/following`

### Request: ###

`empty`

### Response: ###

    [
      {
        "id":526,
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
        "ctime":1342108585,
        "utime":1342108585
      }
    ]

## User - Follow ##



`POST users/528/follow`

### Request: ###

`empty`

### Response: ###

`empty`

## User - Unfollow ##



`POST users/530/unfollow`

### Request: ###

`empty`

### Response: ###

`empty`

