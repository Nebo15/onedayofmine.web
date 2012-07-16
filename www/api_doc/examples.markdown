# API #
 Version: 16.07.12 14:55:35

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#90b4e053cf08dbb7c2eb52472446ad01'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#3db210be4872b5f9fd9fde6114644ce7'>Item</a>
1. <a href='#828e259865d16607a1248f084ef2496b'>Item_Many</a>
1. <a href='#5d22b95049e6f08ff35316e3be1635bc'>CommentCreate</a>
1. <a href='#1b341b284e056b0236d84276688e9c93'>Update</a>
1. <a href='#6468f75b9509b74edd4766498739cea9'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#41fc24316f0e70d9c3065ec0743c173d'>AddToFavourites</a>
1. <a href='#fd65f4c42bf093988b2fe53bf032548a'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#fda9d57deb2a38d95c7981389cac9d54'>Update</a>
1. <a href='#ebe5b612e6ffc21f95de357125e68647'>Delete</a>
1. <a href='#14508aa45409b72e4887a63c3ba9dc03'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#37fc8a0c21385d8f13d34b38fb79326c'>UserByIdDays</a>
1. <a href='#dc71c96cfbd1fe44d4fcf9002e840bb9'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#1cd8f9991d386a12c9bb13a77fc581d8'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#94066fc0e307e8f7edccd3bfb0f21f7f'>FollowingByUserId</a>
1. <a href='#60ba23f6509df226195c5a1ed2b6b562'>Follow</a>
1. <a href='#6323886db6e6f46eb2b1ba56d60e2e04'>Unfollow</a>


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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>boolean</td><td>-</td><td>TRUE user is logged id, else - FALSE</td></tr>

</table>
###### Example response: ######
    false


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Login ####
<a name="bbc87c2030342e7f8609accf937e12ee"></a>
User authorization.

`POST auth/login/`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string[118]</td><td>fb_access_token</td><td>1</td><td>Facebook access token</td></tr>

</table>
###### Example request: ######
    {
      "fb_access_token":"AAAFnVo0zuqkBAH1r4AtZCI0hZCDzHAHZBW4bZC4CHY7mocGeFp9iwA762AWwhBkUTqBhm1kDXj2l05JJac5bMeeHMVEzlFZBG3fJwTtCDZB3dJW1XIxuXq"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>string[32]</td><td>sessid</td><td>Session ID for future requests</td></tr>
<tr><td><a href='#Entity:User'>User</a></td><td>user</td><td>Authorized user information</td></tr>

</table>
###### Example response: ######
    {
      "sessid":"bio8ejr5197ju2cu96bacit5r3",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342439728,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":20270,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342439728
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="90b4e053cf08dbb7c2eb52472446ad01"></a>


`POST /complaints/4994/create`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td><s>id</s></td><td>1</td><td>ID of abused comment</td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Abuse description message</td></tr>

</table>
###### Example request: ######
    {
      "text":"cayape"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id</td><td></td></tr>
<tr><td>string</td><td>text</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time, unix timestamp</td></tr>
<tr><td>int</td><td>id</td><td>Complaint ID</td></tr>

</table>
###### Example response: ######
    {
      "day_id":null,
      "text":"cayape",
      "ctime":1342439730,
      "id":242
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### CurrentDay ###
<a name='CurrentDay'></a>
#### Start ####
<a name="aef4d0c381bfa1dccfdd2216f8f188ef"></a>
Starts a day

`POST current_day/start`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>title</td><td>1</td><td>Title name for this day</td></tr>
<tr><td>string</td><td>description</td><td>1</td><td>Description for this day</td></tr>
<tr><td>int</td><td>timezone</td><td>1</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td>1</td><td>Thing that user are planning to do during current day</td></tr>
<tr><td>string</td><td>type</td><td>1</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>[type]</td><td>age</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "id":null,
      "user_id":null,
      "title":"bomegaharetagexeyakeyogo",
      "description":"wekozuvuvazulifihiradugayupimazeneyikomaticawetawedugezajisusodabatetanipopixenotosucocifogulecijowayemizayulipadecaxapayoyeduvitomozufucawipiroroyixipuhifimuxereyojapegexuvinifizayiyebaribivoxohavupagiwaxemavifoyayudinacexuzadozotadiguxococejajeziwiruvi",
      "timezone":0,
      "occupation":"bipoxevohazuhivoxanilara",
      "age":7,
      "type":"holiday",
      "likes_count":null,
      "ctime":null,
      "utime":null,
      "is_ended":null
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>Day ID</td></tr>
<tr><td>int</td><td>user_id</td><td></td></tr>
<tr><td>string</td><td>title</td><td></td></tr>
<tr><td>string</td><td>description</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>UTC time zone</td></tr>
<tr><td>string</td><td>occupation</td><td></td></tr>
<tr><td>string</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int|null</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time, unix timestamp</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time, unix timestamp</td></tr>
<tr><td>boolean</td><td>is_ended</td><td>Always FALSE for new days</td></tr>
<tr><td>[type]</td><td>age</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":4995,
      "user_id":20278,
      "title":"bomegaharetagexeyakeyogo",
      "description":"wekozuvuvazulifihiradugayupimazeneyikomaticawetawedugezajisusodabatetanipopixenotosucocifogulecijowayemizayulipadecaxapayoyeduvitomozufucawipiroroyixipuhifimuxereyojapegexuvinifizayiyebaribivoxohavupagiwaxemavifoyayudinacexuzadozotadiguxococejajeziwiruvi",
      "timezone":"0",
      "occupation":"bipoxevohazuhivoxanilara",
      "age":"7",
      "type":"holiday",
      "likes_count":null,
      "ctime":1342439730,
      "utime":1342439730,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetCurrentDay ####
<a name="cbad16697e3ffed4670242666474b25b"></a>
Returns current day

`POST current_day`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>Day ID</td></tr>
<tr><td>int</td><td>user_id</td><td></td></tr>
<tr><td>string</td><td>title</td><td></td></tr>
<tr><td>string</td><td>description</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td></td></tr>
<tr><td>string</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int|null</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time, unix timestamp</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time, unix timestamp</td></tr>
<tr><td>boolean</td><td>is_ended</td><td>TRUE if day is ended, else - FALSE</td></tr>
<tr><td>[type]</td><td>age</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":4996,
      "user_id":20279,
      "title":"rifacadecuhirifuhucinuba",
      "description":"sipofixasimawenugekikinayicilowajewixopihapalabonifuxozogagoxasalisegevijeronolaciyuhutizufuzuzekosoxicewozekilibelegaweducawamesawipuwiruwugelenupobebakahadoluxelideyoboteyanicagamehujibigigarorowinugedamorivureducikaxomatatexiximatohahutawehugekoleguku",
      "timezone":0,
      "occupation":"tusubatucicuxepohawevoco",
      "age":1,
      "type":"trip",
      "likes_count":0,
      "ctime":1342439730,
      "utime":1342439730,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateMoment ####
<a name="69e8f640ca26b9cc716ecf64942b8619"></a>
Creates moment

`POST current_day/moment_create`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>description</td><td>1</td><td></td></tr>
<tr><td>string</td><td>image_name</td><td>1</td><td></td></tr>
<tr><td>string</td><td>image_content</td><td>1</td><td>File contents, that was previously encoded by base64</td></tr>

</table>
###### Example request: ######
    {
      "description":"mucetugilijohekipidekehepesebufitewifaxipehunokadikitovexirujokabanagevoraravuhunokeganarabuyiburiduyupizesoguropayugizupawilulajixelivirifulupaxiwazuyiwocepihubafipuxelacuyoxodoxanurepopafucaberigivo",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>Moment ID</td></tr>
<tr><td>int</td><td>day_id</td><td>ID day that moment belongs to</td></tr>
<tr><td>string</td><td>description</td><td>Moment description</td></tr>
<tr><td>string</td><td>img_url</td><td>URL to file image</td></tr>
<tr><td>int|null</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Moment creation time, unix timestamp</td></tr>

</table>
###### Example response: ######
    {
      "id":2050,
      "day_id":4998,
      "description":"mucetugilijohekipidekehepesebufitewifaxipehunokadikitovexirujokabanagevoraravuhunokeganarabuyiburiduyupizesoguropayugizupawilulajixelivirifulupaxiwazuyiwocepihubafipuxelacuyoxodoxanurepopafucaberigivo",
      "img_url":"\/media\/20281\/day\/4998\/39943038d0f15c4856975530d3a2d76c04333277.png",
      "likes_count":null,
      "ctime":1342439731
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="edffd7a5f673999b16ade68463815ffe"></a>
Finish current day.

`POST current_day/finish`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="3db210be4872b5f9fd9fde6114644ce7"></a>
Returns basic Day entity by given Day ID.

`POST days/5000/item`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td><s>id</s></td><td>1</td><td>Day ID</td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>user_id</td><td></td></tr>
<tr><td>string</td><td>title</td><td></td></tr>
<tr><td>string</td><td>description</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td></td></tr>
<tr><td>int</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time</td></tr>
<tr><td>bool</td><td>is_ended</td><td>TRUE if day is ended, else - FALSE</td></tr>
<tr><td><a href='#Entity:Moment'>Moment[]</a></td><td>moments</td><td>Array of day moments</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>age</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":5000,
      "user_id":20283,
      "title":"hepikimecilihejosukekaso",
      "description":"vuyuwufisuwesicikesocokewudakepacicuhelucekosijatuvorafizepepanoronuxuyufevutayibogowifuvofeyozikimemegosaneciwadawumuvetuposifacohicigomodigusezihimasezexovasutululonukonipeyitebeholeyeyokonapuyaniyucinosigesepuxaguhamotuveyojicekatuwekavahezajezojihala",
      "timezone":0,
      "occupation":"fowecoyiyeyudicedehabepo",
      "age":2,
      "type":"special_event",
      "likes_count":0,
      "ctime":1342439731,
      "utime":1342439731,
      "is_ended":0,
      "moments":[
        {
          "id":2051,
          "day_id":5000,
          "description":"description hizaxahomesatuninulinipunovorigucabugeposexecexojecuwoselicabezamubohikuwejupenunitegitoxutudobisahuroyixejimukakakonahiyuja",
          "img_url":"",
          "likes_count":0,
          "ctime":1342439731
        },
        {
          "id":2052,
          "day_id":5000,
          "description":"description fudukipudiwenecarunadixibehohoyipagunuyolozudazozixazonuzuvemoravuzesuyarubozumumebicimajehuyuwovuzitumexicumituxomuhubofela",
          "img_url":"",
          "likes_count":0,
          "ctime":1342439731
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="828e259865d16607a1248f084ef2496b"></a>
Get few days in one request.

`POST days/5001;5002;308/item`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td><s>ids</s></td><td>1</td><td>List of ID's, that was separated by ";".</td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td><s>days</s></td><td>Associative array of (day_id => Day)</td></tr>
<tr><td>[type]</td><td><s>5001</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>5002</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>308</s></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "5001":{
        "id":5001,
        "user_id":20285,
        "title":"rexijucusoguwoyimukicafi",
        "description":"bujivurijewajolicasuzobanikevegohihakumogexicecajobekajupogebidebejegocicubagagiwewejaduxefuvefosifuhekegemilozezumeboduzevosunelogozibazirifosamalitikoyalicuxitafotexosicudozoxecoyihurokotegilicaruwemudosagimedevigefocuyehetelejerudoloxojezitoxudapeyine",
        "timezone":0,
        "occupation":"dudixanixevamobedemecawi",
        "age":6,
        "type":"trip",
        "likes_count":0,
        "ctime":1342439731,
        "utime":1342439731,
        "is_ended":0,
        "moments":[
          {
            "id":2053,
            "day_id":5001,
            "description":"description kemifabeduceruzikolabifovahejixoweganegobebojugototogumucojijedanefanititogavisicigehohelovowuyegalonajeyigobufajelocobihoha",
            "img_url":"",
            "likes_count":0,
            "ctime":1342439731
          }
        ]
      },
      "5002":{
        "id":5002,
        "user_id":20286,
        "title":"mucekuwowulifilafojataze",
        "description":"cesigubaconayeliruzevehelobemoxibibejamitupohuguwefopiyahuhopagorexujejajuvoyapogolugewigagugilutevarafubupuyataxazalupoyomaguzugobuxevufexalohetekacuwategugeyizugugavejomogobuzefajudajebinuziyejaganituhuseyosatucuzeduyoyuducibeniwemafakawafizejupizicuja",
        "timezone":0,
        "occupation":"hijirobipecavebovixoretu",
        "age":3,
        "type":"working",
        "likes_count":0,
        "ctime":1342439731,
        "utime":1342439731,
        "is_ended":0,
        "moments":[
          {
            "id":2054,
            "day_id":5002,
            "description":"description zogavejigenigilunajunifijecehuvelalagoridaxetejelohucinevopalejukoconocoxuyihexoxarunajevukejocomajuwipokihovakohupufuduwifa",
            "img_url":"",
            "likes_count":0,
            "ctime":1342439731
          }
        ]
      },
      "308":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="5d22b95049e6f08ff35316e3be1635bc"></a>
Create moment in specified day

`POST days/5004/comment_create`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td><s>day_id</s></td><td>1</td><td></td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Comment contents</td></tr>

</table>
###### Example request: ######
    {
      "text":"gaguxucojapedubehacuhojawonamoyozarufonitawuyugazefeyiloguvotojoyunasarifijajihewipozulazewozakufucubohadijidovucesajafejazefehejefebinaburaleditonaxokesepuvufafekawujutucajasayadoxizixilokosizavuzasoboyeyikuvipobifudonigabahobexozuluhemofefoxajacisiyuvu"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>text</td><td>Same text as inputed to verifi successfull delivery</td></tr>
<tr><td><a href='#Entity:Day'>Day</a></td><td>day</td><td></td></tr>
<tr><td><a href='#Entity:User'>User</a></td><td>user</td><td></td></tr>
<tr><td>int</td><td>user_id</td><td>Same as user.id</td></tr>
<tr><td>int</td><td>day_id</td><td>Same as day.id</td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time</td></tr>
<tr><td>int</td><td>utime</td><td>Update time</td></tr>
<tr><td>int</td><td>id</td><td>Comment ID</td></tr>
<tr><td>[type]</td><td>cip</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "text":"gaguxucojapedubehacuhojawonamoyozarufonitawuyugazefeyiloguvotojoyunasarifijajihewipozulazewozakufucubohadijidovucesajafejazefehejefebinaburaleditonaxokesepuvufafekawujutucajasayadoxizixilokosizavuzasoboyeyikuvipobifudonigabahobexozuluhemofefoxajacisiyuvu",
      "day":{
        "id":5004,
        "user_id":20290,
        "title":"kitexakakunoliyolezihahi",
        "occupation":"zomovelaretocazayonibomo",
        "age":4,
        "type":"trip",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342439731,
        "utime":1342439731,
        "cip":0
      },
      "user":{
        "id":20290,
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
        "ctime":1342439731,
        "utime":1342439731,
        "cip":0
      },
      "cip":2130706433,
      "user_id":20290,
      "day_id":5004,
      "ctime":1342439731,
      "utime":1342439731,
      "id":257
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="1b341b284e056b0236d84276688e9c93"></a>
Updates a day

`POST days/42/update`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td><s>day_id</s></td><td>1</td><td></td></tr>
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

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="6468f75b9509b74edd4766498739cea9"></a>
Deletes a day

`POST days/5005/delete`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td><s>day_id</s></td><td>1</td><td></td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFavouriteDays ####
<a name="9a54a19098a30dcbd74124cbddb1ab6c"></a>


`POST days/favourites`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":5006,
        "user_id":20293,
        "title":"pebepuwujiyorusopinopuci",
        "description":"bonulazoniroripezegegizutugadaharudayawinigayumufofefahucizanejabifumalamofemojokiziselotexerakopiraracatemayovehoxuzesosizetezezokisiretanoxezacucadovuhofadajavosifevuleresilolivihilikipitupiseyunovubegozolifazivebazoropagelacuwuyuhanewusadomubibafotowu",
        "timezone":0,
        "occupation":"tetahimobiromafupereboka",
        "age":1,
        "type":"working",
        "likes_count":0,
        "ctime":1342439731,
        "utime":1342439731,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="41fc24316f0e70d9c3065ec0743c173d"></a>


`POST /days/5007/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="fd65f4c42bf093988b2fe53bf032548a"></a>


`POST /days/5008/unfavourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>


`POST days/following_users/`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":5009,
      "to":5010
    }



##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>


`POST days/new/`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":5012,
      "to":5013
    }



##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### CurrentUserDays ####
<a name="f2c5afe4a024dc21f1c43ff206afb8f1"></a>


`POST days/my`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":5015,
        "user_id":20303,
        "title":"cefifukivazenidaxuhevomu",
        "description":"jetesewenisabemifizavuyejijazifesusecisiberavasusodimarunuzilavazikayarulecejofukelukarubokivanopuwiyinesipujozodimimakivoziyihijabeniracefebacanirasupivizobefejaputebumegijepuwayifiyuburadujibujofenopocubowuxojagebedogemivinafomohamebicujupozuxubarehawa",
        "timezone":0,
        "occupation":"yawinetolevecebihoxifaye",
        "age":8,
        "type":"trip",
        "likes_count":0,
        "ctime":1342439732,
        "utime":1342439732,
        "is_ended":0
      },
      {
        "id":5016,
        "user_id":20303,
        "title":"gedaxesironihepojogaxiso",
        "description":"lulewinecuparucopagoxutohupedumivuzijivikemajirurunitegugofevozinudulujujuwokinajamajobimeyexuviwuhewodaluvulewokexobuhidatacilulofejekogapomemusenohofezulaluzunaduliposakanuzegiyihaxebehicekokimuzanoguwotobuhulibetapapogujikolexubavuxisunuwumugeyugimiko",
        "timezone":0,
        "occupation":"lozejejimucofufejigeboga",
        "age":1,
        "type":"special_event",
        "likes_count":0,
        "ctime":1342439732,
        "utime":1342439732,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="fda9d57deb2a38d95c7981389cac9d54"></a>


`POST moments/2059/update`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>description</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "description":"piyixigeyehivahigopajugusololusakomedonayonovogamoduserezabiyolejupirapiyajowitejudugohewerocabezoxotifomikebarezojemomeyazafakasetisucalilinawivavetemojisinapajepagofococisudizusocaleraxafihitununopijofamemifagehorutibuyelofurotahawicetivuraduroweguhafo"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>day_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>description</td><td>[description]</td></tr>
<tr><td>[type]</td><td>img_url</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":2059,
      "day_id":5021,
      "description":"piyixigeyehivahigopajugusololusakomedonayonovogamoduserezabiyolejupirapiyajowitejudugohewerocabezoxotifomikebarezojemomeyazafakasetisucalilinawivavetemojisinapajepagofococisudizusocaleraxafihitununopijofamemifagehorutibuyelofurotahawicetivuraduroweguhafo",
      "img_url":"",
      "likes_count":0,
      "ctime":1342439733
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="ebe5b612e6ffc21f95de357125e68647"></a>


`POST moments/2060/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="14508aa45409b72e4887a63c3ba9dc03"></a>


`POST moments/2061/comment`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>text</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "text":"jexelorugipesinoleluvubuderolobozubetohucugogonodupuviwuyipefifanamewofuresudanedagusawimezozatijetazubiholiwutubuxozohidecakupocevagurimazebojaratoyacagadozohacacexowevosomuwafitapoduyeluzoyatajisayiyiginapopevacuyadeyabudoxijirebiwezehicuwuzutuyujuzesa"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moment</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moment_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "text":"jexelorugipesinoleluvubuderolobozubetohucugogonodupuviwuyipefifanamewofuresudanedagusawimezozatijetazubiholiwutubuxozohidecakupocevagurimazebojaratoyacagadozohacacexowevosomuwafitapoduyeluzoyatajisayiyiginapopevacuyadeyabudoxijirebiwezehicuwuzutuyujuzesa",
      "moment":{
        "id":2061,
        "day_id":5023,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342439733,
        "utime":1342439733,
        "cip":0
      },
      "user":{
        "id":20316,
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
        "ctime":1342439733,
        "utime":1342439733,
        "cip":0
      },
      "cip":2130706433,
      "user_id":20316,
      "moment_id":2061,
      "ctime":1342439733,
      "utime":1342439733,
      "id":773
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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_square</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_url</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>first_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>last_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342439733,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":20317,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342439733
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateProfile ####
<a name="469f2a8ab70c10e7b8a6c9890ba465ef"></a>


`POST /my/profile`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
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
      "first_name":"gisuyacizicujexufimadogu",
      "last_name":"suviharedawukofegivamoha",
      "occupation":"pahohunefeluyepemifunejo",
      "location":"cebokucimacabayamexebasu",
      "birthday":"1961-00-28"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_square</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_url</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>first_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>last_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td>[description]</td></tr>
<tr><td>[type]</td><td>uip</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1961-00-28",
      "ctime":1342439733,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"gisuyacizicujexufimadogu",
      "id":20318,
      "last_name":"suviharedawukofegivamoha",
      "location":"cebokucimacabayamexebasu",
      "occupation":"pahohunefeluyepemifunejo",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342439734
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateProfile_Partial ####
<a name="3d82563d7faa5e246fb6a69128b0cce4"></a>


`POST /my/profile`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>first_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "first_name":"cononabejizizubopajixopo",
      "birthday":"1977-01-16"
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_square</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_url</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>first_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>last_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td>[description]</td></tr>
<tr><td>[type]</td><td>uip</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1977-01-16",
      "ctime":1342439734,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"cononabejizizubopajixopo",
      "id":20319,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342439734
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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_new_days</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_new_comments</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_related_activity</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_shooting_photos</td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_original</td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_filtered</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":257,
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
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_new_days</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_new_comments</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_related_activity</td><td>[description]</td></tr>
<tr><td>[type]</td><td>notifications_shooting_photos</td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_original</td><td>[description]</td></tr>
<tr><td>[type]</td><td>photos_save_filtered</td><td>[description]</td></tr>
<tr><td>[type]</td><td>uip</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":258,
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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342439734,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":20323,
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
        "utime":1342439734
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="37fc8a0c21385d8f13d34b38fb79326c"></a>


`POST users/20324/days/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":5024,
        "user_id":20324,
        "title":"sifivonucovosufelubenesi",
        "description":"tipakugasumoxopexewekufumobicedowozarejefozanijeyarezoginebolalewelipowopuvakamegaraxurebozitetivabeyudirupuzahadukusujopegetuxiduxasupexahugibelejakowuzahobafabafobobuyevaxunegukimenijofeyemulosilokebapuyafayitewexabamukuyorofajimesahocivabikutezohivoko",
        "timezone":0,
        "occupation":"hapafacezamedurufoxuhivu",
        "age":1,
        "type":"special_event",
        "likes_count":0,
        "ctime":1342439734,
        "utime":1342439734,
        "is_ended":0
      },
      {
        "id":5025,
        "user_id":20324,
        "title":"tejiwapupametiwaxoyumumu",
        "description":"wexasiwujipinojajucobiheholufojaxefivanamasaxadayevuvafavozugezanarefamohasafujabacugewuxuyafugocubebixesilujozeyadajudewajuzisalogigavupetuzoguvebakajagofagufonidomuradezacabupazugedizeraduwohuloxawumodizaligemisiyoxixakotosalihenobohawopacanorilibepize",
        "timezone":0,
        "occupation":"hizosidogupeneyepicotovi",
        "age":6,
        "type":"special_event",
        "likes_count":0,
        "ctime":1342439734,
        "utime":1342439734,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="dc71c96cfbd1fe44d4fcf9002e840bb9"></a>


`POST users/20326/item/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_pic_square</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_url</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_profile_utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>first_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>last_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342439734,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":20326,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342439734
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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342439734,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":20331,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342439734
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="1cd8f9991d386a12c9bb13a77fc581d8"></a>


`POST users/20332/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342439734,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":20333,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342439734
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
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342439735,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":20335,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342439735
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="94066fc0e307e8f7edccd3bfb0f21f7f"></a>


`POST users/20336/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342439735,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":20337,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342439735
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="60ba23f6509df226195c5a1ed2b6b562"></a>


`POST users/20339/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="6323886db6e6f46eb2b1ba56d60e2e04"></a>


`POST users/20341/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
