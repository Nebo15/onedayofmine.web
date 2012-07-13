# API #
 Version: 13.07.12 16:58:05

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#2342b7225879db7d9bfb1dba2bece55b'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#7b64ea4d159841f27d8415439f6c61db'>Item</a>
1. <a href='#35fa4231302c216a0325a5ed936767c3'>Item_Many</a>
1. <a href='#4c060da638b622d103ae13449afae956'>CommentCreate</a>
1. <a href='#1b341b284e056b0236d84276688e9c93'>Update</a>
1. <a href='#e3fac7b2cf293cc4467c3c3b107efdf3'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#d38fd222f68a8fe36f971a1bd476160a'>AddToFavourites</a>
1. <a href='#e749533d2045ac700d76175edee97a99'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#1e47b692f770b4d3aee4755bc2d57a7b'>Update</a>
1. <a href='#e8f740f4fa009bd51b6228c0c04cd181'>Delete</a>
1. <a href='#16a1a810120bb29602693e28faa41a4c'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#015d676007b8300fc8195ec323d4f236'>UserByIdDays</a>
1. <a href='#aae6ef7923e4a0f85bc43133015c22d2'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#1ec70cb6de1690d8410be4050b1e3232'>FollowersByUserId</a>
1. <a href='#1ec70cb6de1690d8410be4050b1e3232'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#f0eebb10b5a0330374d32c9a860de9e0'>FollowingByUserId</a>
1. <a href='#f0eebb10b5a0330374d32c9a860de9e0'>FollowingByUserId</a>
1. <a href='#a8635325457ca1b94c8d7d82404a25b9'>Follow</a>
1. <a href='#2e9b7d1210a77f21f3903a5666d72823'>Unfollow</a>


## API methods ##

### Auth ###
<a name='Auth'></a>
#### IsLoggedIn ####
<a name="f3fe153a8e0372904ddc25f133cecd23"></a>
Returns user authentication status.

`POST auth/is_logged_in`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      false
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Login ####
<a name="bbc87c2030342e7f8609accf937e12ee"></a>
User authorization.

`POST auth/login/`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>String[118]</td><td>fb_access_token</td><td>1</td><td><a href="https://developers.facebook.com/docs/authentication/server-side/">Facebook access token</a>, we preffer <a href="https://developers.facebook.com/roadmap/offline-access-removal/">Long-Time Access Token</a></td></tr>

</table>
###### Example request: ######
    {
      "fb_access_token":"AAAFnVo0zuqkBAH1r4AtZCI0hZCDzHAHZBW4bZC4CHY7mocGeFp9iwA762AWwhBkUTqBhm1kDXj2l05JJac5bMeeHMVEzlFZBG3fJwTtCDZB3dJW1XIxuXq"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>String[118]</td><td>fb_access_token</td><td>1</td><td><a href="https://developers.facebook.com/docs/authentication/server-side/">Facebook access token</a>, we preffer <a href="https://developers.facebook.com/roadmap/offline-access-removal/">Long-Time Access Token</a></td></tr>

</table>
###### Example response: ######
    {
      "sessid":"0eu474j6ao3jtubd1e8dtrtgj4",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342187877,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":11240,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342187877
      }
    }

<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="2342b7225879db7d9bfb1dba2bece55b"></a>


`POST /complaints/937/create`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>1</td><td>ID of abused comment</td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Abuse description message</td></tr>

</table>
###### Example request: ######
    {
      "text":"vewiri"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>1</td><td>ID of abused comment</td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Abuse description message</td></tr>

</table>
###### Example response: ######
    {
      "day_id":null,
      "text":"vewiri",
      "ctime":1342187879,
      "id":138
    }

<a href="#toc">^ back to Table of conetens</a>

* * *

### CurrentDay ###
<a name='CurrentDay'></a>
#### Start ####
<a name="aef4d0c381bfa1dccfdd2216f8f188ef"></a>


`POST current_day/start`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>String</td><td>title</td><td>1</td><td>Title name for this day</td></tr>
<tr><td>String</td><td>description</td><td>1</td><td>Description for this day</td></tr>
<tr><td>int</td><td>time_offset</td><td>1</td><td>UTC time zone offset</td></tr>
<tr><td>String</td><td>occupation</td><td>1</td><td>Thing that user are planning to do during current day</td></tr>
<tr><td>int</td><td>type</td><td>1</td><td>[0:working, 1:day-off, 2:holiday, 3:trip, 4:special event]</td></tr>
<tr><td>[type]</td><td>id</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>age</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "id":null,
      "user_id":null,
      "title":"guditijugirivukoxuhiwuwe",
      "description":"sukodebufayokesewefumecosokazudowihuwewalosoyecosepanoyakekefizuzexopovulivexudidosokiwoxecatabojulupexutojinidofojijahekehakevofesomivagavopuloroguxigewikevazukovufiberoderiyehagasiliyutozotejigibexozaxinuxozayonefigugepupulolizedujupuwirumimazomapokaru",
      "timezone":0,
      "occupation":"pehaxotilanowegipewozujo",
      "age":1,
      "type":"holiday",
      "likes_count":null,
      "ctime":null,
      "utime":null,
      "is_ended":null
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>String</td><td>title</td><td>1</td><td>Title name for this day</td></tr>
<tr><td>String</td><td>description</td><td>1</td><td>Description for this day</td></tr>
<tr><td>int</td><td>time_offset</td><td>1</td><td>UTC time zone offset</td></tr>
<tr><td>String</td><td>occupation</td><td>1</td><td>Thing that user are planning to do during current day</td></tr>
<tr><td>int</td><td>type</td><td>1</td><td>[0:working, 1:day-off, 2:holiday, 3:trip, 4:special event]</td></tr>
<tr><td>[type]</td><td>id</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>age</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":938,
      "user_id":11248,
      "title":"guditijugirivukoxuhiwuwe",
      "description":"sukodebufayokesewefumecosokazudowihuwewalosoyecosepanoyakekefizuzexopovulivexudidosokiwoxecatabojulupexutojinidofojijahekehakevofesomivagavopuloroguxigewikevazukovufiberoderiyehagasiliyutozotejigibexozaxinuxozayonefigugepupulolizedujupuwirumimazomapokaru",
      "timezone":"0",
      "occupation":"pehaxotilanowegipewozujo",
      "age":"1",
      "type":"holiday",
      "likes_count":null,
      "ctime":1342187880,
      "utime":1342187880,
      "is_ended":0
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetCurrentDay ####
<a name="cbad16697e3ffed4670242666474b25b"></a>


`POST current_day`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    {
      "id":939,
      "user_id":11249,
      "title":"businoxoyiyaxucujozixeco",
      "description":"tunizuhizipecizekujekupikiniwifijodetivoweyuxudetinahanopahemizufadunupegihakejawugayowiwaxenudozenidawepaluloberekizecuhucuwemolagidayodesidowozejulivokunacuzibacaguxejixihogexifezuzewipumilitisunihucajewipodozatumimamupumelagurivorabiridojaxacerilamazu",
      "timezone":0,
      "occupation":"jinivadovodujacusoluvagu",
      "age":4,
      "type":"trip",
      "likes_count":0,
      "ctime":1342187880,
      "utime":1342187880,
      "is_ended":0
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateMoment ####
<a name="69e8f640ca26b9cc716ecf64942b8619"></a>


`POST current_day/moment_create`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>description</td><td>1</td><td></td></tr>
<tr><td>string</td><td>image_name</td><td>1</td><td></td></tr>
<tr><td>string</td><td>image_content</td><td>1</td><td>File contents, that was previously encoded by base64</td></tr>

</table>
###### Example request: ######
    {
      "description":"tejumatodolexinuvacedohajazageburewalixihevayezohaciselakiditanenemuyemasejinejulegasodadesulagunowicesonukajoxobawovuvufiwiramatesurepajugopakigajadayepoxevekisajekumowokewozaxebukuhutadimibapemuhuta",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>description</td><td>1</td><td></td></tr>
<tr><td>string</td><td>image_name</td><td>1</td><td></td></tr>
<tr><td>string</td><td>image_content</td><td>1</td><td>File contents, that was previously encoded by base64</td></tr>

</table>
###### Example response: ######
    {
      "id":385,
      "day_id":941,
      "description":"tejumatodolexinuvacedohajazageburewalixihevayezohaciselakiditanenemuyemasejinejulegasodadesulagunowicesonukajoxobawovuvufiwiramatesurepajugopakigajadayepoxevekisajekumowokewozaxebukuhutadimibapemuhuta",
      "img_url":"\/media\/11251\/day\/941\/e3159059620506821a4be95f1760e4f0fcfacfca.png",
      "likes_count":null,
      "ctime":1342187880
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="edffd7a5f673999b16ade68463815ffe"></a>


`POST current_day/finish`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="7b64ea4d159841f27d8415439f6c61db"></a>
Returns basic Day entity by given Day ID.

`POST days/943/item`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>1</td><td>Day ID</td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>1</td><td>Day ID</td></tr>

</table>
###### Example response: ######
    {
      "id":943,
      "user_id":11253,
      "title":"yotecegefiyijoyudotiwabe",
      "description":"ziyezonupipeyowajotolugudafeyahuvafozosidexabodemucutetukudediguripicedenajitixagubuhowosuyukasupepopoxasarepipumiwokojarexalibuwiregimusajepudalutopaxajogohetavenawuzicevodusivijemanuyopazejopuwewoxubonaneserasageyazijuvotenitehogehomuzafofuteconafubupo",
      "timezone":0,
      "occupation":"gadujabupapehuyoyeretoru",
      "age":8,
      "type":"trip",
      "likes_count":0,
      "ctime":1342187880,
      "utime":1342187880,
      "is_ended":0,
      "moments":[
        {
          "id":386,
          "day_id":943,
          "description":"description kuraxuwowikahovivecucemuvemetupaxafofulamucomufefefepogexosisetimujoworerozaraholibudejuyapihefodikuhaguvezekedutavukaxefiyi",
          "img_url":"",
          "likes_count":0,
          "ctime":1342187880
        },
        {
          "id":387,
          "day_id":943,
          "description":"description bazozukedekafemazadacipopidukamihibehenivupugabedahapuvahuzobicewapamanebafedamejolupadudanamilesamadakadiletunasubedacegiko",
          "img_url":"",
          "likes_count":0,
          "ctime":1342187880
        }
      ]
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="35fa4231302c216a0325a5ed936767c3"></a>


`POST days/944;945;284/item`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>ids</td><td>1</td><td>List of ID's, that was separated by ";".</td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>ids</td><td>1</td><td>List of ID's, that was separated by ";".</td></tr>

</table>
###### Example response: ######
    {
      "944":{
        "id":944,
        "user_id":11255,
        "title":"jisokuyazevehojebidiyanu",
        "description":"mibizutibejuzewihanutamuyubucozigacawosuzatuhimisunebuguweyuzumayikoharebegeyowiseyojasajobeninibugeyupufohamasaliwosixafukolufivetogesidunicatitihecaledoyirazimodobudawosuweliyoyayegadapohifoheledilufawunenizimuvoyuxisacuxedesexagagabohifebofulatereloge",
        "timezone":0,
        "occupation":"raborosikezatijaxibojedi",
        "age":7,
        "type":"holiday",
        "likes_count":0,
        "ctime":1342187880,
        "utime":1342187880,
        "is_ended":0,
        "moments":[
          {
            "id":388,
            "day_id":944,
            "description":"description lirisawoledovulogarehimunutijadomogawazelayezebelolodunovefajexucabufafodawalujulopisagikirovinupiwopukocavizakixubicebisodi",
            "img_url":"",
            "likes_count":0,
            "ctime":1342187880
          }
        ]
      },
      "945":{
        "id":945,
        "user_id":11256,
        "title":"wufibofulomabezamiranexi",
        "description":"kiriwoxububozanuduyopehezivelakusajirelofijarubotukehorederinajabotoxajanogamexagemixatumenujufenubezelizosixisawapogesorarubujiteyotegobuguluyebiyevoxiwikujokadetuturoxupetipobizudugukivojavinijemuyeviribagasexocatisigasulemolusehixuyubazokuniyezovarida",
        "timezone":0,
        "occupation":"biloyuvupuborodatatofocu",
        "age":5,
        "type":"trip",
        "likes_count":0,
        "ctime":1342187880,
        "utime":1342187880,
        "is_ended":0,
        "moments":[
          {
            "id":389,
            "day_id":945,
            "description":"description benoweluxofelorifosopevulifutuwofeluruximavutijucarokisoxuritijutoxerowavobibelakavominehaxapeyebusopivefowedejijahopocuzuyi",
            "img_url":"",
            "likes_count":0,
            "ctime":1342187880
          }
        ]
      },
      "284":null
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="4c060da638b622d103ae13449afae956"></a>


`POST days/947/comment_create`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td>1</td><td></td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Comment contents</td></tr>

</table>
###### Example request: ######
    {
      "text":"volagevirosubelopibesadubatumomekulifacuwotuzalivixipuhocarisavabasakobalobeyiyoyodividulokawafujubonaxuvukojekedituyusenalegigileguhaxazevepamosanibeyiheyiyabekehokatelisusarejayekuxofufayenemozuzogigulubagegatozojalijesusarocokebifilenorovekoyoyedetude"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td>1</td><td></td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Comment contents</td></tr>

</table>
###### Example response: ######
    {
      "text":"volagevirosubelopibesadubatumomekulifacuwotuzalivixipuhocarisavabasakobalobeyiyoyodividulokawafujubonaxuvukojekedituyusenalegigileguhaxazevepamosanibeyiheyiyabekehokatelisusarejayekuxofufayenemozuzogigulubagegatozojalijesusarocokebifilenorovekoyoyedetude",
      "day":{
        "id":947,
        "user_id":11260,
        "title":"seconocesalayocumayovaxa",
        "occupation":"jomuhugarugukozacavuvuno",
        "age":4,
        "type":"holiday",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342187881,
        "utime":1342187881,
        "cip":0
      },
      "user":{
        "id":11260,
        "user_settings_id":0,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBAH1r4AtZCI0hZCDzHAHZBW4bZC4CHY7mocGeFp9iwA762AWwhBkUTqBhm1kDXj2l05JJac5bMeeHMVEzlFZBG3fJwTtCDZB3dJW1XIxuXq",
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
        "ctime":1342187881,
        "utime":1342187881,
        "cip":0
      },
      "cip":2130706433,
      "user_id":11260,
      "day_id":947,
      "ctime":1342187881,
      "utime":1342187881,
      "id":49
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="1b341b284e056b0236d84276688e9c93"></a>


`POST days/42/update`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td>1</td><td></td></tr>
<tr><td>[type]</td><td>tags</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>top_moment_id</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "tags":[
        "tag1",
        "tag2"
      ],
      "top_moment_id":111
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td>1</td><td></td></tr>
<tr><td>[type]</td><td>tags</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>top_moment_id</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="e3fac7b2cf293cc4467c3c3b107efdf3"></a>


`POST days/948/delete`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td>1</td><td></td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td>1</td><td></td></tr>

</table>
###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFavouriteDays ####
<a name="9a54a19098a30dcbd74124cbddb1ab6c"></a>


`POST days/favourites`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":949,
        "user_id":11263,
        "title":"zoripexijavejesutaviwebe",
        "description":"novumosogamoyecamiwelihowahehesuzirihefijocebakitavavayogaxipijibubegevixuwuzejolaxafovizoyigecefapejezadocabixinoronidicazegarefavimosonotifizojolubijapemukafigubotojemaworukulovijapukatodujexebocexikogunixukolosaracewagamamitiwocajefuwaweseyehilewenaju",
        "timezone":0,
        "occupation":"micitakojubupasayocaxaci",
        "age":1,
        "type":"holiday",
        "likes_count":0,
        "ctime":1342187881,
        "utime":1342187881,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="d38fd222f68a8fe36f971a1bd476160a"></a>


`POST /days/950/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="e749533d2045ac700d76175edee97a99"></a>


`POST /days/951/unfavourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>


`POST days/following_users/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":952,
        "user_id":11270,
        "title":"ticurituxuhaducipumahuko",
        "description":"tukokijohusahexupujoharonejohivapasurupuwecanubaxewamiyutetuwizirokesufifepofovazihibalolavesoselapazopazavawihudihatoxaxolikawudeyadigasuginijociwojoyaketolipiyisabudoxegexicudutiporuzesixezuvoxonumejotegudesuwemidivuxocununepajakovaxayuliwewesuvitofono",
        "timezone":0,
        "occupation":"movulawopenizixolefasiyu",
        "age":8,
        "type":"trip",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      },
      {
        "id":953,
        "user_id":11270,
        "title":"zesexecufimayacuberacepe",
        "description":"rowanapisifabonelonatorajefeyugirapafatutuyonidudocujobozayucalohuxidogunarapobolapowikovesunanobifacibiporamoyutisicajukusubesasugohehuzubinujeluvibajecahahufuvisasuyoxudiyiseliwinaxifasibukogawubopusojiduyilobuyupabepacuwebogajuzanerohigojesefelamagiba",
        "timezone":0,
        "occupation":"tolitojikajavorujomabovo",
        "age":8,
        "type":"trip",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>


`POST days/following_users/`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":952
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":953,
        "user_id":11270,
        "title":"zesexecufimayacuberacepe",
        "description":"rowanapisifabonelonatorajefeyugirapafatutuyonidudocujobozayucalohuxidogunarapobolapowikovesunanobifacibiporamoyutisicajukusubesasugohehuzubinujeluvibajecahahufuvisasuyoxudiyiseliwinaxifasibukogawubopusojiduyilobuyupabepacuwebogajuzanerohigojesefelamagiba",
        "timezone":0,
        "occupation":"tolitojikajavorujomabovo",
        "age":8,
        "type":"trip",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>


`POST days/following_users/`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":952,
      "to":953
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>


`POST days/new/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":955,
        "user_id":11272,
        "title":"sawalidocodefexepekudoru",
        "description":"hoxolamikenofidarumogerojitabaletezamisuvamuvobimicoxojefakadomuciziyoloxusomobugasawujuzodamozicudasitilifufexijinamudiperaxorupozegovoduneditiyerifoyoziwudivofoyilociroxoboguyukanewivohudaretitagutulorihularohabaruvutuyegoxuwavizegosilarawuguzutovisovu",
        "timezone":0,
        "occupation":"dakaleraticayusujizomitu",
        "age":5,
        "type":"trip",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      },
      {
        "id":956,
        "user_id":11271,
        "title":"fojexuyipukahatoxonaboku",
        "description":"latobogopiwagonagugisipuyefotuxayoyukatusizufiziheyutiwoxulowetoxotewifibakeresurixecozusepirehizuvomuhicotobepoyiyaduzohijuwimupepafuneneyipifiyapabiwecagutotexejafuhodagorehimupijevinujeranikunituguzipowufesovacilomowawerafatuzuwulepehopulezixedefunuha",
        "timezone":0,
        "occupation":"loyasinocecijucozexiyaba",
        "age":2,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>


`POST days/new/`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":955
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":956,
        "user_id":11271,
        "title":"fojexuyipukahatoxonaboku",
        "description":"latobogopiwagonagugisipuyefotuxayoyukatusizufiziheyutiwoxulowetoxotewifibakeresurixecozusepirehizuvomuhicotobepoyiyaduzohijuwimupepafuneneyipifiyapabiwecagutotexejafuhodagorehimupijevinujeranikunituguzipowufesovacilomowawerafatuzuwulepehopulezixedefunuha",
        "timezone":0,
        "occupation":"loyasinocecijucozexiyaba",
        "age":2,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>


`POST days/new/`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":955,
      "to":956
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### CurrentUserDays ####
<a name="f2c5afe4a024dc21f1c43ff206afb8f1"></a>


`POST days/my`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":958,
        "user_id":11273,
        "title":"yeducubifahonihomecudimi",
        "description":"renibilevulifufebixupizoveroxifiwocuhidalimonozidunokikawavorugirehuvizeziwiducesibacefuluraxumidolufidaxusuvohijenisojarudiwibukixixasobetocahehovulabacapuviwacosuvetosipomudorutabocayoyohovenihevucilogunesahefedejayevaciniboxovuheridayojafimevokocaxate",
        "timezone":0,
        "occupation":"gebuwavucaziyohihelozapa",
        "age":7,
        "type":"working",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      },
      {
        "id":959,
        "user_id":11273,
        "title":"pupojoladokufobevorusuve",
        "description":"pagijepeyulohunefigopozoyecuyuyidazinisikadobobegexobuludiwalopixizifoyivafotazulutitajurayayinucigefavugutudoxipizetedenakinugoliwirinunetoyofifavumuhayolinobudumomunugeraxusazibijemexusipojopulavubahofamuhihezonixilixugasuzaxoduvenupatumaciroyicebujeda",
        "timezone":0,
        "occupation":"yudohiterumuturarelihesu",
        "age":8,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342187882,
        "utime":1342187882,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="1e47b692f770b4d3aee4755bc2d57a7b"></a>


`POST moments/394/update`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>description</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "description":"gasibesifoseyefixusajofepunadugecuvaginefaramupetekayilimupowuzusozufijesunavanikunemuvuyepofisujowifayucicunijumufuvuyojimicaleweyujuxegugonirakozatuxakerimawehojonabodemovarayijolatonefulujotokewezusiniparisudacuyigapodukunobedugulogaxumivitulolotujuxo"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>description</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":394,
      "day_id":964,
      "description":"gasibesifoseyefixusajofepunadugecuvaginefaramupetekayilimupowuzusozufijesunavanikunemuvuyepofisujowifayucicunijumufuvuyojimicaleweyujuxegugonirakozatuxakerimawehojonabodemovarayijolatonefulujotokewezusiniparisudacuyigapodukunobedugulogaxumivitulolotujuxo",
      "img_url":"",
      "likes_count":0,
      "ctime":1342187883
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="e8f740f4fa009bd51b6228c0c04cd181"></a>


`POST moments/395/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="16a1a810120bb29602693e28faa41a4c"></a>


`POST moments/396/comment`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>text</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "text":"biyisosegiluzubexihayecanarayozudumosadurisokoxedajanidapobikumiyuhiciloyahevapukuyujayuwukayusuvukukonexurobepefihipekedonarexefegicoxunipitazurekamoninasahiniwobuluxulinapicetilafuvobiwebevucuvitomacajomiyexelajaverosozinahenayugabitizotuzayejoruhereva"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>text</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "text":"biyisosegiluzubexihayecanarayozudumosadurisokoxedajanidapobikumiyuhiciloyahevapukuyujayuwukayusuvukukonexurobepefihipekedonarexefegicoxunipitazurekamoninasahiniwobuluxulinapicetilafuvobiwebevucuvitomacajomiyexelajaverosozinahenayugabitizotuzayejoruhereva",
      "moment":{
        "id":396,
        "day_id":966,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342187883,
        "utime":1342187883,
        "cip":0
      },
      "user":{
        "id":11286,
        "user_settings_id":0,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBAH1r4AtZCI0hZCDzHAHZBW4bZC4CHY7mocGeFp9iwA762AWwhBkUTqBhm1kDXj2l05JJac5bMeeHMVEzlFZBG3fJwTtCDZB3dJW1XIxuXq",
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
        "ctime":1342187883,
        "utime":1342187883,
        "cip":0
      },
      "cip":2130706433,
      "user_id":11286,
      "moment_id":396,
      "ctime":1342187883,
      "utime":1342187883,
      "id":149
    }

<a href="#toc">^ back to Table of conetens</a>

* * *

### My ###
<a name='My'></a>
#### Profile ####
<a name="7c42c715a02e964a2889306b19fe292c"></a>


`POST /my/profile`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342187883,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":11287,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342187883
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateProfile ####
<a name="469f2a8ab70c10e7b8a6c9890ba465ef"></a>


`POST /my/profile`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>first_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>last_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "first_name":"tanikolerinisahuxihazusi",
      "last_name":"bilofavicohocibupowekuma",
      "occupation":"kayifetufiloreyejogumuzo",
      "location":"vumusoregecodahebedonine",
      "birthday":"1917-01-07"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>first_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>last_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1917-01-07",
      "ctime":1342187883,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"tanikolerinisahuxihazusi",
      "id":11288,
      "last_name":"bilofavicohocibupowekuma",
      "location":"vumusoregecodahebedonine",
      "occupation":"kayifetufiloreyejogumuzo",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342187884
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateProfile_Partial ####
<a name="3d82563d7faa5e246fb6a69128b0cce4"></a>


`POST /my/profile`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>first_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "first_name":"xakeforakepecazilewikaro",
      "birthday":"1986-01-02"
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>first_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1986-01-02",
      "ctime":1342187884,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"xakeforakepecazilewikaro",
      "id":11289,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342187884
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Settings ####
<a name="85578e28a8c20f5cd81c7ca1e4de3b08"></a>


`POST /my/settings/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    {
      "id":49,
      "notifications_new_days":1,
      "notifications_new_comments":0,
      "notifications_related_activity":1,
      "notifications_shooting_photos":0,
      "photos_save_original":1,
      "photos_save_filtered":0
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateSettings ####
<a name="93fdb34170033523c95e7443bb659e3d"></a>


`POST /my/settings/`

##### Request: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>notifications_new_days</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_new_comments</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_related_activity</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_shooting_photos</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_original</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_filtered</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1
    }



##### Response: #####
<table width="100%" border="1">
<tr>
  <th width="150">Name</th>
  <th width="40">Type</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>notifications_new_days</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_new_comments</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_related_activity</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_shooting_photos</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_original</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_filtered</td><td></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":50,
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1,
      "uip":2130706433
    }

<a href="#toc">^ back to Table of conetens</a>

* * *

### Social ###
<a name='Social'></a>
#### FacebookFiends ####
<a name="71917347c17968e3b4669c7949094d34"></a>


`POST social/facebook_friends`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342187884,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11293,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
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
        },
        "utime":1342187884
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="015d676007b8300fc8195ec323d4f236"></a>


`POST users/11294/days/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":967,
        "user_id":11294,
        "title":"pexowibakinacotutisicuja",
        "description":"tecebelowevifubavosukepulepuxalimixitehinadozayoxirewecepocivibebuvofajocimapewiyisosozekarapolinejohomeculojedesobenapucedoxigivifagolepuzucafoxedigokezizubehoviwacejocepaloyezatewapopiritujikanikudiforomixirosisegetuwivazajipokofikofujahusulefosunilese",
        "timezone":0,
        "occupation":"wefikujitixegupixepaharu",
        "age":5,
        "type":"trip",
        "likes_count":0,
        "ctime":1342187884,
        "utime":1342187884,
        "is_ended":0
      },
      {
        "id":968,
        "user_id":11294,
        "title":"lewivanitewiciteculojeze",
        "description":"rofisuluvomotafadativezebasesidejewadexuyenokotivixiwuxuxidideyipolozeruranawemotegigalasitovofejobeyogivopibagomijopowehizafaliviwocajuwuluzopidudoruxunubociguyapucuwuvetoyegagetujiwumunihokavufuwuvihikawigayuyenocunimujuzavayidofefipadobatujesigebobena",
        "timezone":0,
        "occupation":"mufusucadubazuguwehubico",
        "age":2,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342187884,
        "utime":1342187884,
        "is_ended":0
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="aae6ef7923e4a0f85bc43133015c22d2"></a>


`POST users/11296/item/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342187884,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":11296,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342187884
    }

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Followers ####
<a name="0907aac9dba2a8f9700b9333f7e36795"></a>


`POST users/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### Followers ####
<a name="0907aac9dba2a8f9700b9333f7e36795"></a>


`POST users/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342187884,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11299,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342187884
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="1ec70cb6de1690d8410be4050b1e3232"></a>


`POST users/11300/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="1ec70cb6de1690d8410be4050b1e3232"></a>


`POST users/11300/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342187884,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11301,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342187884
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Following ####
<a name="774c23c770724885bdc9325b3159b700"></a>


`POST users/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### Following ####
<a name="774c23c770724885bdc9325b3159b700"></a>


`POST users/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342187885,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11303,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342187885
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="f0eebb10b5a0330374d32c9a860de9e0"></a>


`POST users/11304/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="f0eebb10b5a0330374d32c9a860de9e0"></a>


`POST users/11304/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342187885,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11305,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342187885
      }
    ]

<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="a8635325457ca1b94c8d7d82404a25b9"></a>


`POST users/11307/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="2e9b7d1210a77f21f3903a5666d72823"></a>


`POST users/11309/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty<a href="#toc">^ back to Table of conetens</a>

* * *
