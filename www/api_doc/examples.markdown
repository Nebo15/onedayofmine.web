# API #
 Version: 13.07.12 17:20:51

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#7fc0a3237138a67c4ac35f6ea4750afe'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#14ee01adf4a995f1d0e95a8dc27adc04'>Item</a>
1. <a href='#350d1da00b1d461831e7bc54c3a86607'>Item_Many</a>
1. <a href='#fb55be9374256d09009839648e092bd1'>CommentCreate</a>
1. <a href='#1b341b284e056b0236d84276688e9c93'>Update</a>
1. <a href='#c4f1e935c624929c3ec83a66b2efae92'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#0c9f7a697ea5574b8ddba47cfdc85a2a'>AddToFavourites</a>
1. <a href='#071ba2e6025e5018e19fd98ceeab7e62'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#def51bf28d1e17a449abb4bb036b8ce0'>Update</a>
1. <a href='#1c481db6858c3124a56c650089802f43'>Delete</a>
1. <a href='#bff697f8b314b722f27315a243ea3144'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#fae6e857ebe974a82cb4f18d04ee13a1'>UserByIdDays</a>
1. <a href='#dd740394f79621d96dbf4ffc90033fbe'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#0fdb065ba6d36503d13254c360d12a9b'>FollowersByUserId</a>
1. <a href='#0fdb065ba6d36503d13254c360d12a9b'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#5552e2044616e15ea1096817dce3ddb1'>FollowingByUserId</a>
1. <a href='#5552e2044616e15ea1096817dce3ddb1'>FollowingByUserId</a>
1. <a href='#733eca35173eecd3ea78ba47a5610aba'>Follow</a>
1. <a href='#938c1e16b644651bd7fbc21eabf201d3'>Unfollow</a>


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
###### Params: ######
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
      "sessid":"gg2uv5vkh5us7jssfsokel05h0",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342189242,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":12358,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342189242
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="7fc0a3237138a67c4ac35f6ea4750afe"></a>


`POST /complaints/1444/create`

##### Request: #####
###### Params: ######
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
      "text":"nezihu"
    }



##### Response: #####
###### Params: ######
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
      "text":"nezihu",
      "ctime":1342189245,
      "id":151
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### CurrentDay ###
<a name='CurrentDay'></a>
#### Start ####
<a name="aef4d0c381bfa1dccfdd2216f8f188ef"></a>


`POST current_day/start`

##### Request: #####
###### Params: ######
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
      "title":"muwuxenagicukadozecinabi",
      "description":"jesomuruvuwovulixilozosipemerowuyipekagafayuyekuxupulekapujamadepotuwudabazukevefedorirajujocidoduruxozuvuyaholicicocoyesedotekufavawoyoruvunekivijufefumepapuzobotumolamabaliraxubadexipitaloxilohuhoboxavelimejijitecesolanepuxuxamuzexorefapipuzedaruwayeji",
      "timezone":0,
      "occupation":"vacagoxumumetiyerineloyu",
      "age":4,
      "type":"holiday",
      "likes_count":null,
      "ctime":null,
      "utime":null,
      "is_ended":null
    }



##### Response: #####
###### Params: ######
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
      "id":1445,
      "user_id":12366,
      "title":"muwuxenagicukadozecinabi",
      "description":"jesomuruvuwovulixilozosipemerowuyipekagafayuyekuxupulekapujamadepotuwudabazukevefedorirajujocidoduruxozuvuyaholicicocoyesedotekufavawoyoruvunekivijufefumepapuzobotumolamabaliraxubadexipitaloxilohuhoboxavelimejijitecesolanepuxuxamuzexorefapipuzedaruwayeji",
      "timezone":"0",
      "occupation":"vacagoxumumetiyerineloyu",
      "age":"4",
      "type":"holiday",
      "likes_count":null,
      "ctime":1342189245,
      "utime":1342189245,
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
      "id":1446,
      "user_id":12367,
      "title":"sovuheludutezehomezagoco",
      "description":"femafididubidonoluxexavoruzisuhugozehayecuxatizagunazexihucusevufohiwavufoducabeziluxepadocobusepuridijecifapelivunocawevuzuvoberovodacapejamosepeyojoxasuxinuvapixosuxegajoyayihufiraseyivimipaditomozowekojehofifonudiluyuliyibohihefapiwuvanupotapuputixabu",
      "timezone":0,
      "occupation":"pokamuxawuficepasobekana",
      "age":5,
      "type":"working",
      "likes_count":0,
      "ctime":1342189245,
      "utime":1342189245,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateMoment ####
<a name="69e8f640ca26b9cc716ecf64942b8619"></a>


`POST current_day/moment_create`

##### Request: #####
###### Params: ######
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
      "description":"funapucowexifikosujedewutazofomepunayoxoxofahisunahoganufivedevogevayoyukaxosipenuxozetaxipuverasifobalefebuwocemudijusakedarodefeyeleroromihiwomuguvubadahoyicavujajuvupemuvepefodusaduhipaxohorovuniya",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }



##### Response: #####
###### Params: ######
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
      "id":593,
      "day_id":1448,
      "description":"funapucowexifikosujedewutazofomepunayoxoxofahisunahoganufivedevogevayoyukaxosipenuxozetaxipuverasifobalefebuwocemudijusakedarodefeyeleroromihiwomuguvubadahoyicavujajuvupemuvepefodusaduhipaxohorovuniya",
      "img_url":"\/media\/12369\/day\/1448\/9ac79caa61bad16a6eee9a224e267bd806f829e2.png",
      "likes_count":null,
      "ctime":1342189246
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
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="14ee01adf4a995f1d0e95a8dc27adc04"></a>
Returns basic Day entity by given Day ID.

`POST days/1450/item`

##### Request: #####
###### Params: ######
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
###### Params: ######
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
      "id":1450,
      "user_id":12371,
      "title":"kuzusogogufepifenuxoveka",
      "description":"jopinikopalukubofilulasikufaxakatupejuzubevekudikilopakuzifuribemoropisozibehayoremelufijehuxejeyudinudihawihogucofineyutavomazibayiyazahuvipunosofababohukoxefumalegipigecuhimuhofevacazivuwuwederesaxumutonevoxucodasapibelusibexomopusevaniyimacidosogodono",
      "timezone":0,
      "occupation":"wakerugagocubebezedepaba",
      "age":8,
      "type":"holiday",
      "likes_count":0,
      "ctime":1342189246,
      "utime":1342189246,
      "is_ended":0,
      "moments":[
        {
          "id":594,
          "day_id":1450,
          "description":"description gapanuxajokireyiwugumepizonilumodavozoxemevapomepojadurapanudareceyacokibapowaziwelufacofiverenovivufajehuwazunodutebocakula",
          "img_url":"",
          "likes_count":0,
          "ctime":1342189246
        },
        {
          "id":595,
          "day_id":1450,
          "description":"description karefuzuwenurezipezeyemumopiwuzadilemehetofebawiluwecehiyudovayusehatimijowevoxemopizucusarihiluxocogibifuxumofumonirijevuva",
          "img_url":"",
          "likes_count":0,
          "ctime":1342189246
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="350d1da00b1d461831e7bc54c3a86607"></a>


`POST days/1451;1452;485/item`

##### Request: #####
###### Params: ######
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
###### Params: ######
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
      "1451":{
        "id":1451,
        "user_id":12373,
        "title":"moredemamuwopamiwewelazu",
        "description":"vuyuxezozibumexalevudarataveticikukegecaxafejanohesijeralejavitalaloliwenusubaremevurexavehirutacatirivanibiroxayoxizorobujowatugikuzabinabatugomagiyugusipirelutotoyodiwaribugibizuhexuvimituhitudotedilocipeyotunudeyuwijikocaretemuxupukahevufeyesugihidofa",
        "timezone":0,
        "occupation":"vezoxotiwibonebusetijura",
        "age":1,
        "type":"day-off",
        "likes_count":0,
        "ctime":1342189246,
        "utime":1342189246,
        "is_ended":0,
        "moments":[
          {
            "id":596,
            "day_id":1451,
            "description":"description kihefidebekalikuxugawopabacarihazigadelarohagoxamadewomuwizicemavogucocoketizositotimekevetupexeyagatetariticebodojozoxocoro",
            "img_url":"",
            "likes_count":0,
            "ctime":1342189246
          }
        ]
      },
      "1452":{
        "id":1452,
        "user_id":12374,
        "title":"zezanecimademolahibohora",
        "description":"domoseyuravamoxugihinozamahekazivijitekekaluvesawulerilarojawenotucicixipehepuleyutiharuwuxohegagenevivesatezaruzelemacecuyejakimuxejopaseholupiharococasunaduriwiwafegusinakanodalexikimupivafosuwujaranaduhopevupomufuwomoxogirakucazifamitawibedijelabuvupu",
        "timezone":0,
        "occupation":"momodupiyojatalelovehudu",
        "age":6,
        "type":"",
        "likes_count":0,
        "ctime":1342189246,
        "utime":1342189246,
        "is_ended":0,
        "moments":[
          {
            "id":597,
            "day_id":1452,
            "description":"description butadekopapecexawikaconuvororozomosiyajifuxefolujofenogelucanasusenikubiwuwureyubakivoxemuhayuzohifolefedafohategaxasogatifo",
            "img_url":"",
            "likes_count":0,
            "ctime":1342189246
          }
        ]
      },
      "485":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="fb55be9374256d09009839648e092bd1"></a>


`POST days/1454/comment_create`

##### Request: #####
###### Params: ######
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
      "text":"movivulumolinexokidugunicugicuxirocimihugoloyemexigaponotogotahetevaxadatixoxeyoyawixefodilunofecukuyibobuhugasajisexuwuhewuyubayizuyamuyoxayikebaluyexanozisamolimenuhisariruwobenupidadapudalinuyawamijaducuragazoraxogipenayayucobigerekojatigojuxepasalafe"
    }



##### Response: #####
###### Params: ######
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
      "text":"movivulumolinexokidugunicugicuxirocimihugoloyemexigaponotogotahetevaxadatixoxeyoyawixefodilunofecukuyibobuhugasajisexuwuhewuyubayizuyamuyoxayikebaluyexanozisamolimenuhisariruwobenupidadapudalinuyawamijaducuragazoraxogipenayayucobigerekojatigojuxepasalafe",
      "day":{
        "id":1454,
        "user_id":12378,
        "title":"gigohedorizewewojizekaxa",
        "occupation":"vacesasonusuhevebewipozu",
        "age":2,
        "type":"trip",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342189246,
        "utime":1342189246,
        "cip":0
      },
      "user":{
        "id":12378,
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
        "ctime":1342189246,
        "utime":1342189246,
        "cip":0
      },
      "cip":2130706433,
      "user_id":12378,
      "day_id":1454,
      "ctime":1342189246,
      "utime":1342189246,
      "id":75
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="1b341b284e056b0236d84276688e9c93"></a>


`POST days/42/update`

##### Request: #####
###### Params: ######
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
###### Params: ######
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
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="c4f1e935c624929c3ec83a66b2efae92"></a>


`POST days/1455/delete`

##### Request: #####
###### Params: ######
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
###### Params: ######
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

###### Example response: ######
    [
      {
        "id":1456,
        "user_id":12381,
        "title":"lazivitubuferikolaniguca",
        "description":"viduduvilebeludiwemayolayiwageruwowusojaxelejivavegoyowugozibimuhevuyadonidubuyodanaweyabunalaxohosevozehadezadahodazafuyobetubarogimetojudeyelewihurivifuxuvuxeravajixokayegenayuxihocinujewasihipiyigemaronaviyozajaruzucudohefuzajalukanufekayehelucewaguyi",
        "timezone":0,
        "occupation":"pejimenunayuciyijetebape",
        "age":8,
        "type":"",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="0c9f7a697ea5574b8ddba47cfdc85a2a"></a>


`POST /days/1457/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="071ba2e6025e5018e19fd98ceeab7e62"></a>


`POST /days/1458/unfavourite`

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

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":1459,
        "user_id":12388,
        "title":"zekefajijarawofatanumupo",
        "description":"pulifofepezewulegepababirojodihomofomeyarujivowuyifulalawovujarovulefejugohukazemahuhozamocowopinawojamivopawimesohumecuzatuwelejeboligegokajulapozayazufotuzajeleyuwadazifejijuhezajudirumobuyidukubibazejevogayegefevugemecetehagepehimowehahahimixehapojoda",
        "timezone":0,
        "occupation":"foducupafesafokipoxazuma",
        "age":8,
        "type":"working",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      },
      {
        "id":1460,
        "user_id":12388,
        "title":"robozahanukirejipuvupato",
        "description":"berinawevomilogelelemenuvavusubogodotuzipizagajonozaciyuroweruzumapezitizopexuwisulohepubigohamohazepoxilitekitakawomipiwodaziwerunanisuxigebujecacipobemamitetedemosaripuvovabugakotefenorezenaravefivohikarexulesarukamakilupayehavaxasederufagugurozasepaha",
        "timezone":0,
        "occupation":"teyeliwalipapevowefijuxo",
        "age":6,
        "type":"holiday",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>


`POST days/following_users/`

##### Request: #####
###### Params: ######
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
      "from":1459
    }



##### Response: #####
###### Params: ######
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
        "id":1460,
        "user_id":12388,
        "title":"robozahanukirejipuvupato",
        "description":"berinawevomilogelelemenuvavusubogodotuzipizagajonozaciyuroweruzumapezitizopexuwisulohepubigohamohazepoxilitekitakawomipiwodaziwerunanisuxigebujecacipobemamitetedemosaripuvovabugakotefenorezenaravefivohikarexulesarukamakilupayehavaxasederufagugurozasepaha",
        "timezone":0,
        "occupation":"teyeliwalipapevowefijuxo",
        "age":6,
        "type":"holiday",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>


`POST days/following_users/`

##### Request: #####
###### Params: ######
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
      "from":1459,
      "to":1460
    }



##### Response: #####
###### Params: ######
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
    empty
<a href="#toc">^ back to Table of conetens</a>

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
        "id":1462,
        "user_id":12390,
        "title":"veyokicucohojigomalusobe",
        "description":"cujasadogebabacijitolecixowililikopavosazocuvalapawaluperesayapeyakowatovovizesikipolacanodixotuxanodemubemanapusasahogonegecufuzorazazakiburivetilagowozadayebubozuvubamacarukejukimejiginatibofavubodiwapicuwivezeletosevivofuwuyutajiguzewosizowizibovocipe",
        "timezone":0,
        "occupation":"magimujayorazorocewaxehu",
        "age":2,
        "type":"holiday",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      },
      {
        "id":1463,
        "user_id":12389,
        "title":"powiweyagunabutosekocaxo",
        "description":"wetohawihegasidusatunakomulalibexoxawonazojofipumesajatucayitusisisigepezuxajibovovawixusujetazipoxuxibukubolanavehiwamizoxowudemagemeguferihavalaregatawiyokabucegimilosagufuyiziwepikidecikalikozudinolososogofaxopegopehumojujetisefayuvonuhobamolojazoyihe",
        "timezone":0,
        "occupation":"fegotezarivazefeyavewoni",
        "age":2,
        "type":"trip",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>


`POST days/new/`

##### Request: #####
###### Params: ######
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
      "from":1462
    }



##### Response: #####
###### Params: ######
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
        "id":1463,
        "user_id":12389,
        "title":"powiweyagunabutosekocaxo",
        "description":"wetohawihegasidusatunakomulalibexoxawonazojofipumesajatucayitusisisigepezuxajibovovawixusujetazipoxuxibukubolanavehiwamizoxowudemagemeguferihavalaregatawiyokabucegimilosagufuyiziwepikidecikalikozudinolososogofaxopegopehumojujetisefayuvonuhobamolojazoyihe",
        "timezone":0,
        "occupation":"fegotezarivazefeyavewoni",
        "age":2,
        "type":"trip",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>


`POST days/new/`

##### Request: #####
###### Params: ######
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
      "from":1462,
      "to":1463
    }



##### Response: #####
###### Params: ######
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

###### Example response: ######
    [
      {
        "id":1465,
        "user_id":12391,
        "title":"jecomefawobakasohocaveca",
        "description":"capuzicubahuxabacagevunebugezehalubekakehohasejonidenopinowibaniziweratuwadijifubefizodinuzicizacukobarudohifijawitogugowehuteyocenakaxixayarehivugawivosanejifitomaweponiwawaricurujepumakonigegokacuwonowetiyuhiviyepelufumehocowarovahimabiweyoyuyigekejuvi",
        "timezone":0,
        "occupation":"bazuhuwuvokekapijokehaha",
        "age":8,
        "type":"trip",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      },
      {
        "id":1466,
        "user_id":12391,
        "title":"viwuzosayujihixovovulevo",
        "description":"fejumafacaxetokuxopukurubudecujefofotesunifeficajoxorinoloziresuzumohamotobugayiwugikocolahakuxewezamixefucicazuxajezibemelugedarafarahobegalazekepetitawazalafafefumipiwupezipexatotivirosawucagewosifigowejirepexevoxekilekigivagimizofuyihivuxodohuboniwuza",
        "timezone":0,
        "occupation":"rinonazupozapuyexoyonepe",
        "age":4,
        "type":"working",
        "likes_count":0,
        "ctime":1342189247,
        "utime":1342189247,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="def51bf28d1e17a449abb4bb036b8ce0"></a>


`POST moments/602/update`

##### Request: #####
###### Params: ######
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
      "description":"wuwucujizukexibivuroxetagubepohepafozifumigedeyufisawedahakuwofeveboxesewusudiwedikuwizapeyizawomunecesudeveyinabuzukuzuhukebabibiwavizuwocokovenohuteyufehameriwiriyolokimofedobisosituxuzehoxacisadatisegunepivehiwuhozebexujukazidoyuyasinebenesejubefanaxu"
    }



##### Response: #####
###### Params: ######
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
      "id":602,
      "day_id":1471,
      "description":"wuwucujizukexibivuroxetagubepohepafozifumigedeyufisawedahakuwofeveboxesewusudiwedikuwizapeyizawomunecesudeveyinabuzukuzuhukebabibiwavizuwocokovenohuteyufehameriwiriyolokimofedobisosituxuzehoxacisadatisegunepivehiwuhozebexujukazidoyuyasinebenesejubefanaxu",
      "img_url":"",
      "likes_count":0,
      "ctime":1342189248
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="1c481db6858c3124a56c650089802f43"></a>


`POST moments/603/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="bff697f8b314b722f27315a243ea3144"></a>


`POST moments/604/comment`

##### Request: #####
###### Params: ######
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
      "text":"yuxociwapikojubebeyizuyixiwuxuyuwoluhecuwimalimixizukulemefegafaxizawabonivubejusewagehomiconeviwopovihecagahibuxuzacewituhedatutenixuvuxudanadebanakesagukeyagokoderugiwesenotixerepejogocavevacukotofibuyipocixosibafesejipapozujorihojafuwekozacubefonifapo"
    }



##### Response: #####
###### Params: ######
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
      "text":"yuxociwapikojubebeyizuyixiwuxuyuwoluhecuwimalimixizukulemefegafaxizawabonivubejusewagehomiconeviwopovihecagahibuxuzacewituhedatutenixuvuxudanadebanakesagukeyagokoderugiwesenotixerepejogocavevacukotofibuyipocixosibafesejipapozujorihojafuwekozacubefonifapo",
      "moment":{
        "id":604,
        "day_id":1473,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342189248,
        "utime":1342189248,
        "cip":0
      },
      "user":{
        "id":12404,
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
        "ctime":1342189248,
        "utime":1342189248,
        "cip":0
      },
      "cip":2130706433,
      "user_id":12404,
      "moment_id":604,
      "ctime":1342189248,
      "utime":1342189248,
      "id":227
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
      "ctime":1342189248,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":12405,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342189248
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
      "first_name":"cuxacuwevehanopawomuhafo",
      "last_name":"belalewoyezapawaxohucogu",
      "occupation":"yimulovimaripetipefedovi",
      "location":"hazelisapehuracuhocotuwo",
      "birthday":"1975-01-16"
    }



##### Response: #####
###### Params: ######
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
      "birthday":"1975-01-16",
      "ctime":1342189249,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"cuxacuwevehanopawomuhafo",
      "id":12406,
      "last_name":"belalewoyezapawaxohucogu",
      "location":"hazelisapehuracuhocotuwo",
      "occupation":"yimulovimaripetipefedovi",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342189249
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
      "first_name":"cikesowibedikitanohacoxa",
      "birthday":"1983-01-19"
    }



##### Response: #####
###### Params: ######
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
      "birthday":"1983-01-19",
      "ctime":1342189249,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"cikesowibedikitanohacoxa",
      "id":12407,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342189249
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
      "id":75,
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
###### Params: ######
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
      "id":76,
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
        "ctime":1342189249,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":12411,
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
        "utime":1342189249
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="fae6e857ebe974a82cb4f18d04ee13a1"></a>


`POST users/12412/days/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "id":1474,
        "user_id":12412,
        "title":"tofizenojafedejetazusiye",
        "description":"fifojusanokedugirifewokigavetayuranubeciyiwajamumojekoxoxowitomewagugelavefahocojibodujanareyarodurefanujocokakorilojovuyidunopopecohitojugozokocokemahipigafuvobuneleyocakavosumahugikuyoyaloximevusopoxuwosinapodohiredijifeboromemabebuzohixuhurinevovafuka",
        "timezone":0,
        "occupation":"kajesesibexoyijatucediha",
        "age":5,
        "type":"trip",
        "likes_count":0,
        "ctime":1342189249,
        "utime":1342189249,
        "is_ended":0
      },
      {
        "id":1475,
        "user_id":12412,
        "title":"rurihezupecojogagikohuke",
        "description":"yesuyiyavecipagohupimaduzekuxuwofitacoduzekikigomoguyevuratibihacajasibosegazitigukajacujolejonisupehibuzezutokuroduxaxezenezatoxecayabukaxasebezagujacekorerezisarodoniseperiritulayijedupojiharuronaganonajatazacusifukopojututetenumasufaducacazopanuyasezi",
        "timezone":0,
        "occupation":"lagiligefedodowinucesudo",
        "age":3,
        "type":"working",
        "likes_count":0,
        "ctime":1342189249,
        "utime":1342189249,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="dd740394f79621d96dbf4ffc90033fbe"></a>


`POST users/12414/item/`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342189249,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":12414,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342189249
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
    empty
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
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342189249,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":12417,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342189249
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="0fdb065ba6d36503d13254c360d12a9b"></a>


`POST users/12418/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="0fdb065ba6d36503d13254c360d12a9b"></a>


`POST users/12418/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342189249,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":12419,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342189249
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
    empty
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
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342189250,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":12421,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342189250
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="5552e2044616e15ea1096817dce3ddb1"></a>


`POST users/12422/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="5552e2044616e15ea1096817dce3ddb1"></a>


`POST users/12422/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    [
      {
        "birthday":"1980-08-08",
        "ctime":1342189250,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":12423,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342189250
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="733eca35173eecd3ea78ba47a5610aba"></a>


`POST users/12425/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="938c1e16b644651bd7fbc21eabf201d3"></a>


`POST users/12427/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
