# API #
 Version: 19.07.12 15:27:49

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#9227b7d646d05f929bf01e89de0141fb'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#9e59ff5a39376390cb691df3c733dffc'>Update</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#0f48aa58b40009e1d77d09f0c6418169'>Item</a>
1. <a href='#1769e68c5a9d0fa59c499233dc33a0cc'>Item_Many</a>
1. <a href='#4b294ea621ec8fd1569ed4b0d895ae27'>CommentCreate</a>
1. <a href='#dd5111529e2c289bd373aa6d8c51a5a6'>Update</a>
1. <a href='#f61c2876030b13dd7f599ded2d03bbc3'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#8ad564d81f93dc4592dd9747ddda98f0'>AddToFavourites</a>
1. <a href='#ac9c105bc0929139a37ac0d634725ce5'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#093cece53721d5c2719d5cceaf73a42f'>Update</a>
1. <a href='#dd260226c14dea1f06133cdb250ce307'>Delete</a>
1. <a href='#955ef89215098e4b8ba8b686d3f225f5'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#News'>News</a> ###
1. <a href='#3292f47a05d97e9f9f13470ea62f442c'>GetNewNews</a>
1. <a href='#ac58b5d4856554754127b2e90d5832a3'>GetArchiveNews</a>
1. <a href='#a82a80c9be8111df7bc209e3e3470f58'>FirstGetNews</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#bec2c9e54df778017ef46d923343806a'>UserByIdDays</a>
1. <a href='#9bde9641241c14c85b592784fb08a940'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#095533d47f2e91e73e4abd92dc591302'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#aef6e0d28ad74910e0bbde2e665d0e21'>FollowingByUserId</a>
1. <a href='#878bc2797a2b88d85cd27a164c2c89ea'>Follow</a>
1. <a href='#5f20fbc33efe69b31f06b5c4a36b6948'>Unfollow</a>


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
      "fb_access_token":"AAAFnVo0zuqkBABr12CUn6WR1HNBMPrbfAPAH9PemNPZAR9jEli7QSJJKZCPfhG9HEbHCrwWU3Y2FWAcrmgZAuWyBshAh3YCgGWbqmlZBwOSbqZB2YoqYG"
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
      "sessid":"is7qhl16ngvf0qf9alevjbrmv2",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342700859,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":10907,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342700859
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="9227b7d646d05f929bf01e89de0141fb"></a>


`POST /complaints/805/create`

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
      "text":"javihi"
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
      "text":"javihi",
      "ctime":1342700861,
      "id":129
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
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "id":null,
      "user_id":null,
      "title":"finuyacedijemoseseticiva",
      "description":"heluxolovadusiziyizadiwonekoguticajuvopivomifizaxugamavukarozecanibefivuhemitinokoruwivepiwiwurekopigenisayimicugoracihoxagocuzinizozigonadusawuwizuxerokulitiwebuzajetukuwaboyucuvuditihaxurogonasulesogiwefoceruhohagiganuwomeyafenudoluyotuyewadaferimagexo",
      "timezone":0,
      "location":"zogoviyayogowunewutemifi",
      "type":"special_event",
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
      "id":806,
      "user_id":10915,
      "title":"finuyacedijemoseseticiva",
      "description":"heluxolovadusiziyizadiwonekoguticajuvopivomifizaxugamavukarozecanibefivuhemitinokoruwivepiwiwurekopigenisayimicugoracihoxagocuzinizozigonadusawuwizuxerokulitiwebuzajetukuwaboyucuvuditihaxurogonasulesogiwefoceruhohagiganuwomeyafenudoluyotuyewadaferimagexo",
      "timezone":"0",
      "location":"zogoviyayogowunewutemifi",
      "type":"special_event",
      "likes_count":null,
      "ctime":1342700862,
      "utime":1342700862,
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
      "id":807,
      "user_id":10916,
      "title":"keluwaguluxetibumizeliru",
      "description":"dejihesanabuyomonejizisidifupazolefosuxazubunipaxumukahisijesezapaveyokurexayigokopovugijituwobevuponurajihezibeficulekoxasotocinogapufukifeyatatobadexumisegotokuwuwuxalanefekucibavudelunonemufexuhofotozuzewavugivexefeyorerosivufurusowozotonukegemipidawo",
      "timezone":0,
      "location":"xaheyetehunesicukeyozaga",
      "type":"working",
      "likes_count":0,
      "ctime":1342700862,
      "utime":1342700862,
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
      "description":"gemapanuvuzadoselafiluzekasapoyobiwonemekimidasihubotubadodomalimecurihubomayatezoyosuvusumazurifoluhowemelelapiwicimujavojotufurituhidoxiderosihozorexecadocesoxipazoyufaduwohapevamopiwojubarulabewuga",
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
      "id":279,
      "day_id":809,
      "description":"gemapanuvuzadoselafiluzekasapoyobiwonemekimidasihubotubadodomalimecurihubomayatezoyosuvusumazurifoluhowemelelapiwicimujavojotufurituhidoxiderosihozorexecadocesoxipazoyufaduwohapevamopiwojubarulabewuga",
      "img_url":"\/media\/10918\/day\/809\/6ef09c5f04399f4f0a2a24362ec79a1c8c1c0352.png",
      "likes_count":null,
      "ctime":1342700862
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
      "title":"yimane",
      "description":"cobito",
      "timezone":9,
      "location":"xorelu",
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
<tr><td>result</td><td><s>int</s></td><td>id Day ID</td></tr>
<tr><td>result</td><td><s>int</s></td><td>user_id</td></tr>
<tr><td>result</td><td><s>string</s></td><td>title</td></tr>
<tr><td>result</td><td><s>string</s></td><td>description</td></tr>
<tr><td>result</td><td><s>int</s></td><td>timezone UTC time zone offset</td></tr>
<tr><td>result</td><td><s>string</s></td><td>occupation</td></tr>
<tr><td>result</td><td><s>string</s></td><td>type One of pre-defined types: {working, day-off, holiday, trip, special_event}</td></tr>
<tr><td>result</td><td><s>int|null</s></td><td>likes_count</td></tr>
<tr><td>result</td><td><s>int</s></td><td>ctime Creation time, unix timestamp</td></tr>
<tr><td>result</td><td><s>int</s></td><td>utime Last update time, unix timestamp</td></tr>
<tr><td>result</td><td><s>boolean</s></td><td>is_ended TRUE if day is ended, else - FALSE</td></tr>
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
      "id":810,
      "user_id":10919,
      "title":"yimane",
      "description":"cobito",
      "timezone":"9",
      "location":"xorelu",
      "type":"working",
      "likes_count":0,
      "ctime":1342700862,
      "utime":1342700862,
      "is_ended":0
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
<a name="0f48aa58b40009e1d77d09f0c6418169"></a>
Returns basic Day entity by given Day ID.

`POST days/812/item`

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
<tr><td><a href='#Entity:Moment'>Moment[]</a></td><td>moments</td><td>Array of day moments</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":812,
      "user_id":10921,
      "title":"pecuxocavezohaboyafamupu",
      "description":"hepejubizotihakagejemizoperoxuladumiyizuhojitoruyuhinebapotinarodacanayovejibuluyojizemibezikifirenajizatepohasasapokafejayotafejonofivuwesajehajutoyucecuyocafiwodaguzagodizepegezafakecebakapeyohanefoxehutucufadediravojawukopoxaxawokanabobasapurazewenofu",
      "timezone":0,
      "location":"xasisaloyowoxiyevevoxuno",
      "type":"trip",
      "likes_count":0,
      "ctime":1342700862,
      "utime":1342700862,
      "is_ended":0,
      "moments":[
        {
          "id":280,
          "day_id":812,
          "description":"description fikewawukiruzohayacofatuxekajunikuxadozidijajohetezulotezakezuwexonukimicurilusagocohoyeyepuhihadodihobelovunicocaleyerusetu",
          "img_url":"",
          "likes_count":0,
          "ctime":1342700862
        },
        {
          "id":281,
          "day_id":812,
          "description":"description vilodijikadamayokikulupucixuwoxidehevoxavufedaxipekufuyelucenuxogayatofivetumikawobatugavelegezilumasosizijibonumiwamajekopi",
          "img_url":"",
          "likes_count":0,
          "ctime":1342700862
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="1769e68c5a9d0fa59c499233dc33a0cc"></a>
Get few days in one request.

`POST days/813;814;471/item`

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
<tr><td>[type]</td><td><s>813</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>814</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>471</s></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "813":{
        "id":813,
        "user_id":10923,
        "title":"rejanesosuyabejepiyotazi",
        "description":"coputuhipameyuximilekacowipelenizakocofowoxomogukohotemiwaxegetemayitafivahexifefizuwilomeworiyaruseyuxoyazosazupusekabujunukidahokereyikujabexohiboranuwazenaguyibiwudexihuvanasivepejijeruluseloxesamimonexajipaxakaponanucahiyatifafoyoxotehejamokakuguweca",
        "timezone":0,
        "location":"webaxijokizisobewiboyosu",
        "type":"trip",
        "likes_count":0,
        "ctime":1342700862,
        "utime":1342700862,
        "is_ended":0,
        "moments":[
          {
            "id":282,
            "day_id":813,
            "description":"description revojunegelenujabiweganawajehusudisilavomeyabedaxukaducucefehugikuxucomixepuroyisenugovezusexusetibugikaxuzisuzegididuwayiko",
            "img_url":"",
            "likes_count":0,
            "ctime":1342700862
          }
        ]
      },
      "814":{
        "id":814,
        "user_id":10924,
        "title":"bejuzetivibibajovagiwuzo",
        "description":"jekidosamupevowujuyunotedaruvozazesabehifuxumovoporajelinakevelosaxolagobapivejeculehuwuyedopimeseyanatigecarekojocisukidihocoyobuxibidexajipogumemagusekucisahoyahusegipibagebonivokidolehagivaracemexaxugadetovilaziyivenutedekasunixemalojahasogohacakizaxa",
        "timezone":0,
        "location":"rawuhotehapenimagunapexi",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342700862,
        "utime":1342700862,
        "is_ended":0,
        "moments":[
          {
            "id":283,
            "day_id":814,
            "description":"description tazinemurujujixamiyivireguyazumocihiwolinolukexuwuhiguyixupuvamunolemuvurawulovenaxozugusorixagewovenihatacawuleyedudetodegu",
            "img_url":"",
            "likes_count":0,
            "ctime":1342700862
          }
        ]
      },
      "471":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="4b294ea621ec8fd1569ed4b0d895ae27"></a>
Create moment in specified day

`POST days/816/comment_create`

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
      "text":"cahavelamevahebozafomesejihehihepinexulehalimigimefuruhukigodibobicumigosojadisixumitomahotefocejaduserebupametecaxoyexacipekomowipizaxacifisuyoconufefeyomelubenititimubokonekicupehomenunuxifeduxunetibafilidimovomezufiyabalabebisocoxegexevebicivamunezimi"
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
      "text":"cahavelamevahebozafomesejihehihepinexulehalimigimefuruhukigodibobicumigosojadisixumitomahotefocejaduserebupametecaxoyexacipekomowipizaxacifisuyoconufefeyomelubenititimubokonekicupehomenunuxifeduxunetibafilidimovomezufiyabalabebisocoxegexevebicivamunezimi",
      "day":{
        "id":816,
        "user_id":10928,
        "title":"seruyokedidonuxepufipida",
        "location":"zubifarezujuzolalacomati",
        "type":"day-off",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342700863,
        "utime":1342700863,
        "cip":0
      },
      "user":{
        "id":10928,
        "user_settings_id":0,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBABr12CUn6WR1HNBMPrbfAPAH9PemNPZAR9jEli7QSJJKZCPfhG9HEbHCrwWU3Y2FWAcrmgZAuWyBshAh3YCgGWbqmlZBwOSbqZB2YoqYG",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":1341686153,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "location":"",
        "occupation":"",
        "birthday":"1992-08-08",
        "sex":"male",
        "ctime":1342700863,
        "utime":1342700863,
        "cip":0
      },
      "cip":2130706433,
      "user_id":10928,
      "day_id":816,
      "ctime":1342700863,
      "utime":1342700863,
      "id":30
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="dd5111529e2c289bd373aa6d8c51a5a6"></a>
Updates a day

`POST days/817/update`

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
      "title":"tivuda",
      "description":"sigoyu",
      "timezone":3,
      "location":"muwira",
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
      "id":817,
      "user_id":10929,
      "title":"tivuda",
      "description":"sigoyu",
      "timezone":"3",
      "location":"muwira",
      "type":"working",
      "likes_count":0,
      "ctime":1342700863,
      "utime":1342700863,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="f61c2876030b13dd7f599ded2d03bbc3"></a>
Deletes a day

`POST days/818/delete`

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
        "id":819,
        "user_id":10931,
        "title":"hoziruxofofinezenirogulo",
        "description":"kodubisunejurulahafavafexorepipudoxaficotipekulobisutucipowadecedulelizayipenuyinikelivuficezapacukimetexesegiyofezivonukogevuluvokedarulekoxelapisefehiwiyojemafujezuhehocaxigixuwacasupinuyazaxekujohigetawupoxewulixabiyumucehigibifewukoxukojasorivobopiso",
        "timezone":0,
        "location":"lerowanawikajimocetafoha",
        "type":"trip",
        "likes_count":0,
        "ctime":1342700863,
        "utime":1342700863,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="8ad564d81f93dc4592dd9747ddda98f0"></a>


`POST /days/820/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="ac9c105bc0929139a37ac0d634725ce5"></a>


`POST /days/821/unfavourite`

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
      "from":822,
      "to":823
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
      "from":825,
      "to":826
    }



##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetInterestingDays ####
<a name="58c74019b980810ae9e042bb65573a7a"></a>


`POST days/interesting/`

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
      "from":828,
      "to":830
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
        "id":829,
        "user_id":10941,
        "title":"bowipebiyenageyiwibokece",
        "description":"waxotamasanazelojesinujelosemoveyoxovetimeminudufukovoyajopokecebuyohogoyohirehogonujifocolicitamoxohanevoredufenojudineguremekuberejanayamacokijolifusexeresahoguzicirurazovehacorerepipexegazibubalobavavikasivesipeyamuloyefujazowaxibodituxiciyotuwasexira",
        "timezone":0,
        "location":"yarejuxaganadonuxiziruro",
        "type":"working",
        "likes_count":2,
        "ctime":1342614464,
        "utime":1342700864,
        "is_ended":0
      }
    ]


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
        "id":832,
        "user_id":10943,
        "title":"zanejinojagilaramodeloga",
        "description":"sakiveyixekecapebuyuletovanuliyareniriziwewunehigemomakehugonavanenatisiwimexoxayevinasodulocevoneveviwozezubuzufokoyamazusaditotixizofuzavuboyaneyikemehaminecetuvoruricipafihowadenirutahejenahetufemewahunisesupelacahekorusufevevepigupokecacohiwerasateye",
        "timezone":0,
        "location":"kopifalikiyeyesadijuvore",
        "type":"trip",
        "likes_count":0,
        "ctime":1342700864,
        "utime":1342700864,
        "is_ended":0
      },
      {
        "id":833,
        "user_id":10943,
        "title":"xitesusamivenimafozuyata",
        "description":"riduracapolugiyefuhalatazamenutaluzayaciwimabikekolutazofiyomowuloyexuxolesivatasazehubilufupuvuvojosejapurebenomidolafucevojiragutugabobodabovicugibikavavatiguluxozukapiciducevetovayihosuduyiwudutixebuxawujihakagepizemafiragoxuhogesalibocexijavupofaxemi",
        "timezone":0,
        "location":"zududegoluzimimekawafoji",
        "type":"working",
        "likes_count":0,
        "ctime":1342700864,
        "utime":1342700864,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="093cece53721d5c2719d5cceaf73a42f"></a>


`POST moments/288/update`

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
      "description":"ceyofusolubamizatarodexotilizokazewagixojuvomoyewizuyurohagesijoxavarotupisahojafecafovitatipabidunomesavecabefesekuyahofucozagayoxebiluzixuxafihilatowususozuvurogogomadefamepoyuxosopepezidolololojuwijamolamecebocicowaguwosejaxozodevibasinoxinuforusuyimi"
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
      "id":288,
      "day_id":838,
      "description":"ceyofusolubamizatarodexotilizokazewagixojuvomoyewizuyurohagesijoxavarotupisahojafecafovitatipabidunomesavecabefesekuyahofucozagayoxebiluzixuxafihilatowususozuvurogogomadefamepoyuxosopepezidolololojuwijamolamecebocicowaguwosejaxozodevibasinoxinuforusuyimi",
      "img_url":"",
      "likes_count":0,
      "ctime":1342700865
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="dd260226c14dea1f06133cdb250ce307"></a>


`POST moments/289/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="955ef89215098e4b8ba8b686d3f225f5"></a>


`POST moments/290/comment`

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
      "text":"cemomatiraresukemorivecoxisozasakasugejunufazikihazalavepibipopuxewarazadajasonuvibapolagisogevamogavagujizujizazuhivotufevirimafofuxiwazufehaledowukixixozigipefojafagabimenunopepuwinodigebotenahohiwexepifadolotedezewaruyebiledovuzohidirefayujafejuluwehu"
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
      "text":"cemomatiraresukemorivecoxisozasakasugejunufazikihazalavepibipopuxewarazadajasonuvibapolagisogevamogavagujizujizazuhivotufevirimafofuxiwazufehaledowukixixozigipefojafagabimenunopepuwinodigebotenahohiwexepifadolotedezewaruyebiledovuzohidirefayujafejuluwehu",
      "moment":{
        "id":290,
        "day_id":840,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342700865,
        "utime":1342700865,
        "cip":0
      },
      "user":{
        "id":10956,
        "user_settings_id":0,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBABr12CUn6WR1HNBMPrbfAPAH9PemNPZAR9jEli7QSJJKZCPfhG9HEbHCrwWU3Y2FWAcrmgZAuWyBshAh3YCgGWbqmlZBwOSbqZB2YoqYG",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":1341686153,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "location":"",
        "occupation":"",
        "birthday":"1992-08-08",
        "sex":"male",
        "ctime":1342700865,
        "utime":1342700865,
        "cip":0
      },
      "cip":2130706433,
      "user_id":10956,
      "moment_id":290,
      "ctime":1342700865,
      "utime":1342700865,
      "id":110
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
<tr><td>[type]</td><td>twitter_access_token</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_access_token_secret</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342700865,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":10957,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "utime":1342700865
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
      "first_name":"fufozasixufunisiwoyigiwe",
      "last_name":"degojasuzilepuzikuhipaxi",
      "occupation":"segozejocusuwevemesaricu",
      "location":"foyonukewiwayadenuxeceka",
      "birthday":"1980-01-20"
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
<tr><td>[type]</td><td>twitter_access_token</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_access_token_secret</td><td>[description]</td></tr>
<tr><td>[type]</td><td>uip</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1980-01-20",
      "ctime":1342700865,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"fufozasixufunisiwoyigiwe",
      "id":10958,
      "last_name":"degojasuzilepuzikuhipaxi",
      "location":"foyonukewiwayadenuxeceka",
      "occupation":"segozejocusuwevemesaricu",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "uip":2130706433,
      "utime":1342700865
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
      "first_name":"jukeruzabajotepogisagixo",
      "birthday":"1955-01-04"
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
<tr><td>[type]</td><td>twitter_access_token</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_access_token_secret</td><td>[description]</td></tr>
<tr><td>[type]</td><td>uip</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1955-01-04",
      "ctime":1342700865,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"jukeruzabajotepogisagixo",
      "id":10959,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "uip":2130706433,
      "utime":1342700865
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
      "id":39,
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
      "id":40,
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

### News ###
<a name='News'></a>
#### GetNewNews ####
<a name="3292f47a05d97e9f9f13470ea62f442c"></a>
Get list of news that was created after specified news.

`POST social/news`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>last</td><td>1</td><td>ID of latest present in application news</td></tr>

</table>
###### Example request: ######
    {
      "last":840
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:News'>News[]</a></td><td><s>-</s></td><td>List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":841,
        "recipient_id":10962,
        "user_id":10964,
        "text":"bar loves foo",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetArchiveNews ####
<a name="ac58b5d4856554754127b2e90d5832a3"></a>
Get specified range of news, logic: $first < NEWS < $last

`POST social/news`

##### Request: #####
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>first</td><td>1</td><td>Lowest limit of range</td></tr>
<tr><td>int</td><td>last</td><td>1</td><td>Highest limit of range</td></tr>

</table>
###### Example request: ######
    {
      "first":843,
      "last":846
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:News'>News[]</a></td><td><s>-</s></td><td>List of news in specified range</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":844,
        "recipient_id":10965,
        "user_id":10968,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":845,
        "recipient_id":10965,
        "user_id":10969,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FirstGetNews ####
<a name="a82a80c9be8111df7bc209e3e3470f58"></a>
Get list of latest news (size is defined by application, by default is 50).

`POST social/news`

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
<tr><td><a href='#Entity:News'>News[]</a></td><td><s>List</s></td><td>of news</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>
<tr><td>[type]</td><td>2</td><td>[description]</td></tr>
<tr><td>[type]</td><td>3</td><td>[description]</td></tr>
<tr><td>[type]</td><td>4</td><td>[description]</td></tr>
<tr><td>[type]</td><td>5</td><td>[description]</td></tr>
<tr><td>[type]</td><td>6</td><td>[description]</td></tr>
<tr><td>[type]</td><td>7</td><td>[description]</td></tr>
<tr><td>[type]</td><td>8</td><td>[description]</td></tr>
<tr><td>[type]</td><td>9</td><td>[description]</td></tr>
<tr><td>[type]</td><td>10</td><td>[description]</td></tr>
<tr><td>[type]</td><td>11</td><td>[description]</td></tr>
<tr><td>[type]</td><td>12</td><td>[description]</td></tr>
<tr><td>[type]</td><td>13</td><td>[description]</td></tr>
<tr><td>[type]</td><td>14</td><td>[description]</td></tr>
<tr><td>[type]</td><td>15</td><td>[description]</td></tr>
<tr><td>[type]</td><td>16</td><td>[description]</td></tr>
<tr><td>[type]</td><td>17</td><td>[description]</td></tr>
<tr><td>[type]</td><td>18</td><td>[description]</td></tr>
<tr><td>[type]</td><td>19</td><td>[description]</td></tr>
<tr><td>[type]</td><td>20</td><td>[description]</td></tr>
<tr><td>[type]</td><td>21</td><td>[description]</td></tr>
<tr><td>[type]</td><td>22</td><td>[description]</td></tr>
<tr><td>[type]</td><td>23</td><td>[description]</td></tr>
<tr><td>[type]</td><td>24</td><td>[description]</td></tr>
<tr><td>[type]</td><td>25</td><td>[description]</td></tr>
<tr><td>[type]</td><td>26</td><td>[description]</td></tr>
<tr><td>[type]</td><td>27</td><td>[description]</td></tr>
<tr><td>[type]</td><td>28</td><td>[description]</td></tr>
<tr><td>[type]</td><td>29</td><td>[description]</td></tr>
<tr><td>[type]</td><td>30</td><td>[description]</td></tr>
<tr><td>[type]</td><td>31</td><td>[description]</td></tr>
<tr><td>[type]</td><td>32</td><td>[description]</td></tr>
<tr><td>[type]</td><td>33</td><td>[description]</td></tr>
<tr><td>[type]</td><td>34</td><td>[description]</td></tr>
<tr><td>[type]</td><td>35</td><td>[description]</td></tr>
<tr><td>[type]</td><td>36</td><td>[description]</td></tr>
<tr><td>[type]</td><td>37</td><td>[description]</td></tr>
<tr><td>[type]</td><td>38</td><td>[description]</td></tr>
<tr><td>[type]</td><td>39</td><td>[description]</td></tr>
<tr><td>[type]</td><td>40</td><td>[description]</td></tr>
<tr><td>[type]</td><td>41</td><td>[description]</td></tr>
<tr><td>[type]</td><td>42</td><td>[description]</td></tr>
<tr><td>[type]</td><td>43</td><td>[description]</td></tr>
<tr><td>[type]</td><td>44</td><td>[description]</td></tr>
<tr><td>[type]</td><td>45</td><td>[description]</td></tr>
<tr><td>[type]</td><td>46</td><td>[description]</td></tr>
<tr><td>[type]</td><td>47</td><td>[description]</td></tr>
<tr><td>[type]</td><td>48</td><td>[description]</td></tr>
<tr><td>[type]</td><td>49</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":848,
        "recipient_id":10972,
        "user_id":10973,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":849,
        "recipient_id":10972,
        "user_id":10974,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":850,
        "recipient_id":10972,
        "user_id":10975,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":851,
        "recipient_id":10972,
        "user_id":10976,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":852,
        "recipient_id":10972,
        "user_id":10977,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":853,
        "recipient_id":10972,
        "user_id":10978,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":854,
        "recipient_id":10972,
        "user_id":10979,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":855,
        "recipient_id":10972,
        "user_id":10980,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":856,
        "recipient_id":10972,
        "user_id":10981,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":857,
        "recipient_id":10972,
        "user_id":10982,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":858,
        "recipient_id":10972,
        "user_id":10983,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":859,
        "recipient_id":10972,
        "user_id":10984,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":860,
        "recipient_id":10972,
        "user_id":10985,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":861,
        "recipient_id":10972,
        "user_id":10986,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":862,
        "recipient_id":10972,
        "user_id":10987,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":863,
        "recipient_id":10972,
        "user_id":10988,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":864,
        "recipient_id":10972,
        "user_id":10989,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":865,
        "recipient_id":10972,
        "user_id":10990,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":866,
        "recipient_id":10972,
        "user_id":10991,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":867,
        "recipient_id":10972,
        "user_id":10992,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":868,
        "recipient_id":10972,
        "user_id":10993,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":869,
        "recipient_id":10972,
        "user_id":10994,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":870,
        "recipient_id":10972,
        "user_id":10995,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":871,
        "recipient_id":10972,
        "user_id":10996,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":872,
        "recipient_id":10972,
        "user_id":10997,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":873,
        "recipient_id":10972,
        "user_id":10998,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":874,
        "recipient_id":10972,
        "user_id":10999,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":875,
        "recipient_id":10972,
        "user_id":11000,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":876,
        "recipient_id":10972,
        "user_id":11001,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":877,
        "recipient_id":10972,
        "user_id":11002,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":878,
        "recipient_id":10972,
        "user_id":11003,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":879,
        "recipient_id":10972,
        "user_id":11004,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":880,
        "recipient_id":10972,
        "user_id":11005,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":881,
        "recipient_id":10972,
        "user_id":11006,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":882,
        "recipient_id":10972,
        "user_id":11007,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":883,
        "recipient_id":10972,
        "user_id":11008,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":884,
        "recipient_id":10972,
        "user_id":11009,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":885,
        "recipient_id":10972,
        "user_id":11010,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":886,
        "recipient_id":10972,
        "user_id":11011,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":887,
        "recipient_id":10972,
        "user_id":11012,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":888,
        "recipient_id":10972,
        "user_id":11013,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":889,
        "recipient_id":10972,
        "user_id":11014,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":890,
        "recipient_id":10972,
        "user_id":11015,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":891,
        "recipient_id":10972,
        "user_id":11016,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":892,
        "recipient_id":10972,
        "user_id":11017,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":893,
        "recipient_id":10972,
        "user_id":11018,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":894,
        "recipient_id":10972,
        "user_id":11019,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":895,
        "recipient_id":10972,
        "user_id":11020,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":896,
        "recipient_id":10972,
        "user_id":11021,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      },
      {
        "id":897,
        "recipient_id":10972,
        "user_id":11022,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342700866
      }
    ]


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
        "ctime":1342700867,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11024,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "user_info":{
          "fb_uid":"100004087981387",
          "first_name":"bar",
          "last_name":"bar",
          "sex":"male",
          "timezone":null,
          "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
          "fb_profile_utime":"1342526485",
          "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
          "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
          "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
          "occupation":"",
          "current_location":"San Antonio, Texas",
          "birthday":"1980-08-08"
        },
        "utime":1342700867
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="bec2c9e54df778017ef46d923343806a"></a>


`POST users/11025/days/`

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
        "id":841,
        "user_id":11025,
        "title":"xonicozixayunutemifedilo",
        "description":"vajeseralisoyanixininicetasovulidovodeyixofusokihubumacahoxatepucesetivogumusumuviverukupeyenifowuxilogoropenahepamexudidavonuhevayawaxixitenusabajubijanawacakuhebanumejevufiyepecititepihorolubizijixosolucecoraherupenuwanecitacanuseradolekalolapahaxajije",
        "timezone":0,
        "location":"zonubocayotaharezakikize",
        "type":"trip",
        "likes_count":0,
        "ctime":1342700867,
        "utime":1342700867,
        "is_ended":0
      },
      {
        "id":842,
        "user_id":11025,
        "title":"jupobipiveduvijawajoholu",
        "description":"xotucegodufijojetiliredomohejiyadocexexufapivutijayupapawulahejizisuviwusilijayojunuyayozexesatopenezehovobawutawebojumehepunerasamonogekelagajakexogebisomexajijufunifusicutibatuvugomuludedixihahumitacocofawuzoxeledukedivuyabexisisokonixenuzicewagamesejo",
        "timezone":0,
        "location":"dafatahukofipayarebodato",
        "type":"holiday",
        "likes_count":0,
        "ctime":1342700867,
        "utime":1342700867,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="9bde9641241c14c85b592784fb08a940"></a>


`POST users/11027/item/`

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
<tr><td>[type]</td><td>twitter_access_token</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_access_token_secret</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "birthday":"1992-08-08",
      "ctime":1342700867,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":11027,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "utime":1342700867
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
        "ctime":1342700867,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11032,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342700867
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="095533d47f2e91e73e4abd92dc591302"></a>


`POST users/11033/followers`

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
        "ctime":1342700867,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11034,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342700867
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
        "ctime":1342700868,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11036,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342700868
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="aef6e0d28ad74910e0bbde2e665d0e21"></a>


`POST users/11037/following`

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
        "ctime":1342700868,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":11038,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342700868
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="878bc2797a2b88d85cd27a164c2c89ea"></a>


`POST users/11040/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="5f20fbc33efe69b31f06b5c4a36b6948"></a>


`POST users/11042/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
