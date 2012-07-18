# API #
 Version: 18.07.12 08:19:06

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#97756b44f14c7a1e05bd24e120ea8df5'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#9e59ff5a39376390cb691df3c733dffc'>Update</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#520e3a140c541d45c96955bb93af1440'>Item</a>
1. <a href='#5da2554206d28b091960422d62cba10d'>Item_Many</a>
1. <a href='#95527290700b9c3cd1191fa35545d4d7'>CommentCreate</a>
1. <a href='#cac6525b8b3f33a9db2e04e87b6c8214'>Update</a>
1. <a href='#c6f069e235cfa5c6cc04cfc8e79c261e'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#aaf39bc48ee2983fb28b060e01c0ef3c'>AddToFavourites</a>
1. <a href='#310d9b5a227890022bf0caf7b87b7c96'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#a2d375c3cd70186692578858ec03b58b'>Update</a>
1. <a href='#ae3d9fed9f711104e376cd59e1231d4d'>Delete</a>
1. <a href='#832cfbeb23f09537c1ef40db8156b344'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#d33c5a717b0a407aace57e9d1d9eb08d'>UserByIdDays</a>
1. <a href='#ddc0a37b9bc86b721e0bc5da1f3f9196'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#ce97407b264db7102e3605df36863b84'>FollowersByUserId</a>
1. <a href='#ce97407b264db7102e3605df36863b84'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#1c06e74da7a256524f124f48fe4d40f5'>FollowingByUserId</a>
1. <a href='#1c06e74da7a256524f124f48fe4d40f5'>FollowingByUserId</a>
1. <a href='#023125f413386e65c21ba5775224f256'>Follow</a>
1. <a href='#5dc1bd8077b697fab90d54be533d2d1d'>Unfollow</a>


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
      "fb_access_token":"AAAFnVo0zuqkBAOB4MiPlx1ZAUaWyDjOLMxZBfExQJhKz7ZASmsCeYyhdmt17Q3fJW8rYlgj2mQ4YMeyZB3uRhNyZAOievk8uIxpCb6YCD9mUOnAT0PKWb"
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
<tr><td>User</td><td>user</td><td>Authorized user information</td></tr>

</table>
###### Example response: ######
    {
      "sessid":"6vtrqda16a0m46qqat5n63j6s1",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342588736,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":1,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342588736
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="97756b44f14c7a1e05bd24e120ea8df5"></a>


`POST /complaints/1/create`

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
      "text":"jubotu"
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
      "text":"jubotu",
      "ctime":1342588738,
      "id":1
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
<tr><td>string</td><td><s>occupation</s></td><td>1</td><td>Thing that user are planning to do during current day</td></tr>
<tr><td>string</td><td>type</td><td>1</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>[type]</td><td>id</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "id":null,
      "user_id":null,
      "title":"sunabekufunihuhunikotoxu",
      "description":"zeregezocupuwixesuwehuxixamacuhacugefebecofufahuyacecutuzezabecacekepipobopawuboyazucoxayucubacamilaxutuvecicajugezebujuseyopawamecegugacepamufofazezedotajecajikixogarememudorevonoyokosoyovejasewujigusotokecaziyugepuyisovuyifojifijuharomoxigojicukakatabo",
      "timezone":0,
      "location":"kupokagozulijusomujopago",
      "type":"day-off",
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
<tr><td>string</td><td><s>occupation</s></td><td></td></tr>
<tr><td>string</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int|null</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time, unix timestamp</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time, unix timestamp</td></tr>
<tr><td>boolean</td><td>is_ended</td><td>Always FALSE for new days</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":2,
      "user_id":9,
      "title":"sunabekufunihuhunikotoxu",
      "description":"zeregezocupuwixesuwehuxixamacuhacugefebecofufahuyacecutuzezabecacekepipobopawuboyazucoxayucubacamilaxutuvecicajugezebujuseyopawamecegugacepamufofazezedotajecajikixogarememudorevonoyokosoyovejasewujigusotokecaziyugepuyisovuyifojifijuharomoxigojicukakatabo",
      "timezone":"0",
      "location":"kupokagozulijusomujopago",
      "type":"day-off",
      "likes_count":null,
      "ctime":1342588738,
      "utime":1342588738,
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
<tr><td>string</td><td><s>occupation</s></td><td></td></tr>
<tr><td>string</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int|null</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time, unix timestamp</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time, unix timestamp</td></tr>
<tr><td>boolean</td><td>is_ended</td><td>TRUE if day is ended, else - FALSE</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":3,
      "user_id":10,
      "title":"lehihanefivocesoheduzudu",
      "description":"dizarunafojoyetekumuwenipifaracomawayegazixuxogepocezoyibarodomotevorawipolijorukohekayehicegibuwuriwizidewibihegititozufakepijiguwakomifexevaratepizilaropafuriximegutegoravebipozifetofezefivabehefuripelemiyacupejebipaxopowiyawacinosucaludixovabusowilige",
      "timezone":0,
      "location":"wejulupizuducicehubilelu",
      "type":"day-off",
      "likes_count":0,
      "ctime":1342588738,
      "utime":1342588738,
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
      "description":"kayufecagabilemuzozujazanibonehukexinunodihiyolulewopuwajuvudavigoborinocuhupoxacovonotumisomidocamosakowotijolehebuworefeyovakufumuyuponefuxigavezoyoyazuvoxanabawuyisisujilivewowoloxenocivoluretisibe",
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
      "id":1,
      "day_id":5,
      "description":"kayufecagabilemuzozujazanibonehukexinunodihiyolulewopuwajuvudavigoborinocuhupoxacovonotumisomidocamosakowotijolehebuworefeyovakufumuyuponefuxigavezoyoyazuvoxanabawuyisisujilivewowoloxenocivoluretisibe",
      "img_url":"\/media\/12\/day\/5\/7906fcdb86b5453036533e413343f1d5ebf5e004.png",
      "likes_count":null,
      "ctime":1342588739
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="9e59ff5a39376390cb691df3c733dffc"></a>


`POST current_day/update`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>title</td><td>1</td><td></td></tr>
<tr><td>string</td><td>description</td><td>1</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>1</td><td></td></tr>
<tr><td>string</td><td>location</td><td>1</td><td></td></tr>
<tr><td>string</td><td>type</td><td>1</td><td></td></tr>

</table>
###### Example request: ######
    {
      "title":"coligu",
      "description":"veramu",
      "timezone":11,
      "location":"vikani",
      "type":"working"
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
<tr><td>int</td><td>timezone</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td><s>occupation</s></td><td></td></tr>
<tr><td>string</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int|null</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time, unix timestamp</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time, unix timestamp</td></tr>
<tr><td>boolean</td><td>is_ended</td><td>TRUE if day is ended, else - FALSE</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":6,
      "user_id":13,
      "title":"coligu",
      "description":"veramu",
      "timezone":"11",
      "location":"vikani",
      "type":"working",
      "likes_count":0,
      "ctime":1342588739,
      "utime":1342588739,
      "is_ended":0
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
<a name="520e3a140c541d45c96955bb93af1440"></a>
Returns basic Day entity by given Day ID.

`POST days/8/item`

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
<tr><td>string</td><td><s>occupation</s></td><td></td></tr>
<tr><td>int</td><td>type</td><td>One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>int</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time</td></tr>
<tr><td>bool</td><td>is_ended</td><td>TRUE if day is ended, else - FALSE</td></tr>
<tr><td>Moment[]</td><td>moments</td><td>Array of day moments</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":8,
      "user_id":15,
      "title":"bafubadaxapadowowewujabe",
      "description":"danujozenecepumokepitahogerifugezohemenalogunorubakoholizayaxaluzodixomehojokusedacitizopuxicegazemubugepidunojowiciyahiyaxulabinijikixuduyovejotedolidenakufelowohejafidaculenavovacupizupajuxatakahiletihaxogolawizicukodoruwecekewutijarevuxexosudoviludaxu",
      "timezone":0,
      "location":"tadijileniliwehenekurizo",
      "type":"holiday",
      "likes_count":0,
      "ctime":1342588739,
      "utime":1342588739,
      "is_ended":0,
      "moments":[
        {
          "id":2,
          "day_id":8,
          "description":"description hufonirokecuromohupadulazokoxaxabaximifuxesiyafecojepohimogetamofejoxinotagokexidesozuginiwepecosiliyuhodijixezumotinuyaloja",
          "img_url":"",
          "likes_count":0,
          "ctime":1342588739
        },
        {
          "id":3,
          "day_id":8,
          "description":"description foyoticeganamagogomitujamutitesuzinofozesipanoyolegajiholukagacarixogufujobunurujudokekukozovaverofunetucotiremugopibukerebi",
          "img_url":"",
          "likes_count":0,
          "ctime":1342588739
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="5da2554206d28b091960422d62cba10d"></a>


`POST days/9;10;439/item`

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
<tr><td>Day[]</td><td><s>days</s></td><td>Associative array of (day_id => Day)</td></tr>
<tr><td>[type]</td><td><s>9</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>10</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>439</s></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "9":{
        "id":9,
        "user_id":17,
        "title":"wisuyopaxezazapumagoweru",
        "description":"yodexakenitetuxigeyukurafizuwazovadogiyoyobosubuguvoweruzoyuvupizofefabawatiyokatavinimibijojujeripusiyisozikevamirayanunuvuvagirogekataworacehiyupubawiyimosofelenupewezipawurovaruhilebuzopazaniwavolofaxaxivosenuwufuwapihimocexubesajifabuxojerajubazipeda",
        "timezone":0,
        "location":"xakihafifapacoguvurokure",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342588739,
        "utime":1342588739,
        "is_ended":0,
        "moments":[
          {
            "id":4,
            "day_id":9,
            "description":"description jesobedoduyotaxihanefonayujokojobujajitijocavuradahexumowolapoxovetasinucobupoxowabozimuhuzusumicanopasosomekebanawipejugesu",
            "img_url":"",
            "likes_count":0,
            "ctime":1342588739
          }
        ]
      },
      "10":{
        "id":10,
        "user_id":18,
        "title":"cimavebareracecekosabuja",
        "description":"rizalehaxolecaxicawaxiveweyosowebulibomuludizazacufuhugahatuvijokohilojusijomesidupixopayedoxineforinulekoxucimelasewelonimebupavevefamizelaxugexurodamoruboyovowiyutinovutowuzoxolusurewoxohokageduvoriregijefawofinuvemocohiyiwalisadeletopuzinayazokijigoza",
        "timezone":0,
        "location":"fasorusolotifegusupucexi",
        "type":"trip",
        "likes_count":0,
        "ctime":1342588739,
        "utime":1342588739,
        "is_ended":0,
        "moments":[
          {
            "id":5,
            "day_id":10,
            "description":"description peligokurajihabuzukemawufekazodicizegefukijosemofuboyurafucatasutofuyevexazimifohakabuhazejonuperofibuxuculijohiwovupacikehu",
            "img_url":"",
            "likes_count":0,
            "ctime":1342588739
          }
        ]
      },
      "439":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="95527290700b9c3cd1191fa35545d4d7"></a>


`POST days/12/comment_create`

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
      "text":"memocedadodijeracuvidimonamineyupirowosumulogawebitaceyijicurawaliwegifojonitevoyiyasupahoxusocafujikidofofuzusuloyamidofurusozupehuxerabuyavozaguholelojanatiwewahomusivopihitilugukonosatinitesazazosohehivubeyedexobirobaholuvecobomezoxosuzofayasureromuku"
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
<tr><td>Day</td><td>day</td><td></td></tr>
<tr><td>User</td><td>user</td><td></td></tr>
<tr><td>int</td><td>user_id</td><td>Same as user.id</td></tr>
<tr><td>int</td><td>day_id</td><td>Same as day.id</td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time</td></tr>
<tr><td>int</td><td>utime</td><td>Update time</td></tr>
<tr><td>int</td><td>id</td><td>Comment ID</td></tr>
<tr><td>[type]</td><td>cip</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "text":"memocedadodijeracuvidimonamineyupirowosumulogawebitaceyijicurawaliwegifojonitevoyiyasupahoxusocafujikidofofuzusuloyamidofurusozupehuxerabuyavozaguholelojanatiwewahomusivopihitilugukonosatinitesazazosohehivubeyedexobirobaholuvecobomezoxosuzofayasureromuku",
      "day":{
        "id":12,
        "user_id":22,
        "title":"rigurunebajuxodubedabupo",
        "location":"wenineyudoxobuxabigexate",
        "type":"special_event",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342588740,
        "utime":1342588740,
        "cip":0
      },
      "user":{
        "id":22,
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
        "ctime":1342588740,
        "utime":1342588740,
        "cip":0
      },
      "cip":2130706433,
      "user_id":22,
      "day_id":12,
      "ctime":1342588740,
      "utime":1342588740,
      "id":1
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="cac6525b8b3f33a9db2e04e87b6c8214"></a>


`POST days/13/update`

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
<tr><td>[type]</td><td>title</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>description</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "title":"jayoda",
      "description":"sehile",
      "timezone":7,
      "location":"fabibu",
      "type":"working"
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
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>description</td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":13,
      "user_id":23,
      "title":"jayoda",
      "description":"sehile",
      "timezone":"7",
      "location":"fabibu",
      "type":"working",
      "likes_count":0,
      "ctime":1342588740,
      "utime":1342588740,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="c6f069e235cfa5c6cc04cfc8e79c261e"></a>


`POST days/14/delete`

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
        "id":15,
        "user_id":25,
        "title":"wedevalalobakefumodovawe",
        "description":"zobaxoxarapojagujuhoxanubexusapovosoliwasisunuwutarohalemehaluvemixuboxodisomimerawuhedopixagogodapawiwubirizatogimiwogebalevozuvibiyupujalehayitizibayahehabeyotukowuradamegixuwumubexetajokenahuvawegumojoferacaxamokaxoyebijejajanicujisiremojetocazuwufuki",
        "timezone":0,
        "location":"koninodabolawucadugosuxa",
        "type":"working",
        "likes_count":0,
        "ctime":1342588740,
        "utime":1342588740,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="aaf39bc48ee2983fb28b060e01c0ef3c"></a>


`POST /days/16/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="310d9b5a227890022bf0caf7b87b7c96"></a>


`POST /days/17/unfavourite`

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
        "id":18,
        "user_id":32,
        "title":"polejihurizinipuhihumugu",
        "description":"bedafifokagekonisowevibogenivibuvazutatafujinubenulekidiwofidakukewanidomigajegudogifecuzenalubohuwokumumoxozasavurugoyayijekefofulizuliregokutavecucafamikuwimanupiwuzihecoduvufuxexahepofifolorugizayeluxiwolunegikivudukerobevesomozurukimuladomifenefuroso",
        "timezone":0,
        "location":"vidivirepodacukasejawumu",
        "type":"working",
        "likes_count":0,
        "ctime":1342588741,
        "utime":1342588741,
        "is_ended":0
      },
      {
        "id":19,
        "user_id":32,
        "title":"fejisepikuzalimalugirapi",
        "description":"fosuvibogarowinowafadefawusenicogopufoperabiridipemopoxemivuzusapedoxodixazisazelizudujikanezenimohejewemotaxolefegegixotizorigadilixerebemudufehiribifoyalirosodafujojefugeteravepuvopoyugiruhozivehapizotofetusevibedujemugovegimisayoxojacabojodedejipolopa",
        "timezone":0,
        "location":"yidekuzolobipekejedifora",
        "type":"working",
        "likes_count":0,
        "ctime":1342588741,
        "utime":1342588741,
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
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":18
    }



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
        "id":19,
        "user_id":32,
        "title":"fejisepikuzalimalugirapi",
        "description":"fosuvibogarowinowafadefawusenicogopufoperabiridipemopoxemivuzusapedoxodixazisazelizudujikanezenimohejewemotaxolefegegixotizorigadilixerebemudufehiribifoyalirosodafujojefugeteravepuvopoyugiruhozivehapizotofetusevibedujemugovegimisayoxojacabojodedejipolopa",
        "timezone":0,
        "location":"yidekuzolobipekejedifora",
        "type":"working",
        "likes_count":0,
        "ctime":1342588741,
        "utime":1342588741,
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
      "from":18,
      "to":19
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
        "id":21,
        "user_id":34,
        "title":"zalabororocobazaniwefava",
        "description":"zukerurecuvutumoficusuhixuziforarakexaruwexigekixigilizejutireselamecahulamonucijezowubazorifewikexijajohulosifuwatodovanisotihatamaguwirejevihosuhutayemizacegukoxopodabimuyolotolitetayokuzowejoyumacimijihobamimevekoyotukifogapofofogidiganorayegedacuzija",
        "timezone":0,
        "location":"fizoyoyaxosevuxidemomucu",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342588741,
        "utime":1342588741,
        "is_ended":0
      },
      {
        "id":22,
        "user_id":33,
        "title":"duninicohifuhiyadidamiro",
        "description":"pomulopavonugohapekowejanakotapexadetokikukorosayaxokaxujepajakafinufukivodikopewibesududoziweruwaxabenuyogemorehonunoxojudagodaxucugisahumosacuvowehozipatuvuxoxunanegodonoxotogiyihubuzososilimurufuvereciyodakaroyonulesavasecehefanukihekemolaketuhafuhucu",
        "timezone":0,
        "location":"yomixucibabizicoxihopehe",
        "type":"working",
        "likes_count":0,
        "ctime":1342588741,
        "utime":1342588741,
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
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":21
    }



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
        "id":22,
        "user_id":33,
        "title":"duninicohifuhiyadidamiro",
        "description":"pomulopavonugohapekowejanakotapexadetokikukorosayaxokaxujepajakafinufukivodikopewibesududoziweruwaxabenuyogemorehonunoxojudagodaxucugisahumosacuvowehozipatuvuxoxunanegodonoxotogiyihubuzososilimurufuvereciyodakaroyonulesavasecehefanukihekemolaketuhafuhucu",
        "timezone":0,
        "location":"yomixucibabizicoxihopehe",
        "type":"working",
        "likes_count":0,
        "ctime":1342588741,
        "utime":1342588741,
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
      "from":21,
      "to":22
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
        "id":28,
        "user_id":37,
        "title":"dagatomarujuzitinowajobe",
        "description":"xujaxebibewinohifahawupitusoyisumaxehuvehotolahobisumelebayusovaronunefozupeyubuloxuyefukayatogejohucisakeledihidalalocusayitatayayalibuwiduyimapudunewegoruyebukuxonurelohedokosisatikuhuyajucowumeyatevasuvapiperevuhazegedezuhijenanebeguhuhucufuwixusadoka",
        "timezone":0,
        "location":"vijubajuxufizodemagaroko",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342588742,
        "utime":1342588742,
        "is_ended":0
      },
      {
        "id":29,
        "user_id":37,
        "title":"nahuzahomilegonuyahiyixe",
        "description":"lunotumacomaxediyobokusajehedebijihamofinotezuxunuruwezarelorijubobikecuxuhusavabebusazehecuweyubukedigajixasofozenohiyixamolepijuvimamonewebayagisizocuripazaledavogelorezogusijezeyafiropixaxagosixafijafizubefaracoronehegalivaxofadifebacamecajaxuxegaviha",
        "timezone":0,
        "location":"zegulikofewiyayenivapehi",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342588742,
        "utime":1342588742,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="a2d375c3cd70186692578858ec03b58b"></a>


`POST moments/10/update`

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
      "description":"gunaxidevugehanokinimupivoyiwowasediwevoguxifegiyocerowekozanofefevapironihoxigogefuzuhetemebomazegivujejocadezeragodizusifodoxaxaroyubepalokedanerowipibogajaheguxaxulizugegekosumipabovevakajiyevudahabilevociviyeruzegomiwufobupadufajimajipadimomicogigaki"
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
      "id":10,
      "day_id":34,
      "description":"gunaxidevugehanokinimupivoyiwowasediwevoguxifegiyocerowekozanofefevapironihoxigogefuzuhetemebomazegivujejocadezeragodizusifodoxaxaroyubepalokedanerowipibogajaheguxaxulizugegekosumipabovevakajiyevudahabilevociviyeruzegomiwufobupadufajimajipadimomicogigaki",
      "img_url":"",
      "likes_count":0,
      "ctime":1342588743
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="ae3d9fed9f711104e376cd59e1231d4d"></a>


`POST moments/11/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="832cfbeb23f09537c1ef40db8156b344"></a>


`POST moments/12/comment`

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
      "text":"wakikupeyahedicasixerovevitofilumolurudidewewumilewacijufarenahuwovitubuhudatopazefayixarilapocemuxavubatadivopobovuhocufibohadobayoxuwicuburirojiroconehibitajofenaderehocugopidegeyonejivasawuhexisirudoxeliyisawixewewojisajumelataduvagemawajoteyimodohuyo"
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
      "text":"wakikupeyahedicasixerovevitofilumolurudidewewumilewacijufarenahuwovitubuhudatopazefayixarilapocemuxavubatadivopobovuhocufibohadobayoxuwicuburirojiroconehibitajofenaderehocugopidegeyonejivasawuhexisirudoxeliyisawixewewojisajumelataduvagemawajoteyimodohuyo",
      "moment":{
        "id":12,
        "day_id":36,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342588743,
        "utime":1342588743,
        "cip":0
      },
      "user":{
        "id":50,
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
        "ctime":1342588743,
        "utime":1342588743,
        "cip":0
      },
      "cip":2130706433,
      "user_id":50,
      "moment_id":12,
      "ctime":1342588743,
      "utime":1342588743,
      "id":5
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
      "ctime":1342588743,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":51,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342588743
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
      "first_name":"witutajimaguhutofanesugu",
      "last_name":"fagunugocibobomefelopula",
      "occupation":"disokutipigatawayalixuce",
      "location":"govogixavukicifibiseciza",
      "birthday":"1974-00-17"
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
      "birthday":"1974-00-17",
      "ctime":1342588744,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"witutajimaguhutofanesugu",
      "id":52,
      "last_name":"fagunugocibobomefelopula",
      "location":"govogixavukicifibiseciza",
      "occupation":"disokutipigatawayalixuce",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342588744
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
      "first_name":"labinarixesoyehokewexemu",
      "birthday":"1980-01-08"
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
      "birthday":"1980-01-08",
      "ctime":1342588744,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"labinarixesoyehokewexemu",
      "id":53,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342588744
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
      "id":1,
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
      "id":2,
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
        "ctime":1342588744,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":57,
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
        "utime":1342588744
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="d33c5a717b0a407aace57e9d1d9eb08d"></a>


`POST users/58/days/`

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
        "id":37,
        "user_id":58,
        "title":"rosojozitajitegiyupuhaye",
        "description":"dotizukusirinocavemumupijefepiwocigalibacotikotadedibodeyepiteguzixecunanesuzecapetozuzuciluyosudihalohuzuyujacugoneridobinugavetanawudovatabobepinadoyafibiruvexemofolusacoyazititudoyecuvoviboxijadocuxamuhikuzawatolotamitifobitahozaxizazefulubavixirebexe",
        "timezone":0,
        "location":"sobugahoxibilijosicisudi",
        "type":"holiday",
        "likes_count":0,
        "ctime":1342588744,
        "utime":1342588744,
        "is_ended":0
      },
      {
        "id":38,
        "user_id":58,
        "title":"buboyajerebareduvohivoro",
        "description":"dedutatacadisorewefofisedidazujadiyusoxosafevupifokegareponirusokiragitunujetuyuseguhuhuruletabarocuduvotazizuhodipikuhutogitemexigujaradomamovigebogepuyujocubujezojotigapoyehasevunewifadezagemazuvohuxusufuzufotobifetemomobuwavotapoxelafexecocafekupuramo",
        "timezone":0,
        "location":"gawavigasucuvaxagokeruhu",
        "type":"holiday",
        "likes_count":0,
        "ctime":1342588744,
        "utime":1342588744,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="ddc0a37b9bc86b721e0bc5da1f3f9196"></a>


`POST users/60/item/`

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
      "ctime":1342588744,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":60,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342588744
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
        "ctime":1342588745,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":63,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588745
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="ce97407b264db7102e3605df36863b84"></a>


`POST users/64/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="ce97407b264db7102e3605df36863b84"></a>


`POST users/64/followers`

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
        "ctime":1342588745,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":65,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588745
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
        "ctime":1342588745,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":67,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588745
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="1c06e74da7a256524f124f48fe4d40f5"></a>


`POST users/68/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="1c06e74da7a256524f124f48fe4d40f5"></a>


`POST users/68/following`

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
        "ctime":1342588745,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":69,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588745
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="023125f413386e65c21ba5775224f256"></a>


`POST users/71/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="5dc1bd8077b697fab90d54be533d2d1d"></a>


`POST users/73/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
