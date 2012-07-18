# API #
 Version: 18.07.12 08:09:53

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#c9a25f00c129391276900a4d5ff2de4b'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#9e59ff5a39376390cb691df3c733dffc'>Update</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#9147cceff690c49d2c8d87e2bddd97e2'>Item</a>
1. <a href='#42b8f91f7c96bc33ff471457378eea1a'>Item_Many</a>
1. <a href='#c9736cbdc905c6e7e86baf7c5f31a39a'>CommentCreate</a>
1. <a href='#2738aa555933bc72d9742614d99a2fb9'>Update</a>
1. <a href='#9b5671ea8511caa9698645a8c8101929'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#df4531de7b8d0c78a064ac42646b685b'>AddToFavourites</a>
1. <a href='#c8ac75d814b24f9357a04df3c1440f87'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#753fee95a5b3bdea84b7e19c72ffe391'>Update</a>
1. <a href='#b12993d80e5d069f13794c5c3f583cec'>Delete</a>
1. <a href='#cf7ac7e1148a299458f0040f9a8690c6'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#27bcab1430556914451ef01fa22c1c19'>UserByIdDays</a>
1. <a href='#638f1e3f646091a3a594238c1fabcb57'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#b3e121e063ddf4cde91eb71d0ed787d3'>FollowersByUserId</a>
1. <a href='#b3e121e063ddf4cde91eb71d0ed787d3'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#7435c2c465ffe6ea5ebbefa0c2a7de75'>FollowingByUserId</a>
1. <a href='#7435c2c465ffe6ea5ebbefa0c2a7de75'>FollowingByUserId</a>
1. <a href='#46f7806e7d980a097202878146dca1e8'>Follow</a>
1. <a href='#ce0896c063569972cb157c084d4b35a1'>Unfollow</a>


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
      "sessid":"u0bdqqg2mmhjeak4j2qh5m3qq4",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342588183,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":1872,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342588183
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="c9a25f00c129391276900a4d5ff2de4b"></a>


`POST /complaints/896/create`

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
      "text":"vowadi"
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
      "text":"vowadi",
      "ctime":1342588185,
      "id":10
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
      "title":"wexahiyexejusosedidojuji",
      "description":"joluvusahawigevokipumawepivayereyafoxutabiteviwaxibenutajihevulobolumacisotihirazonimerotubixifuciwituzisoyuhicefivowilikiceyeduwumiwibifulimitocihuyomefinavocipifibayecesiwifuxivofecetiligicubegalahimubekaferucofadusiluzisuvucacesijoxoxazibahefeduyivuci",
      "timezone":0,
      "location":"wirazuroxosujidinexotiza",
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
      "id":897,
      "user_id":1880,
      "title":"wexahiyexejusosedidojuji",
      "description":"joluvusahawigevokipumawepivayereyafoxutabiteviwaxibenutajihevulobolumacisotihirazonimerotubixifuciwituzisoyuhicefivowilikiceyeduwumiwibifulimitocihuyomefinavocipifibayecesiwifuxivofecetiligicubegalahimubekaferucofadusiluzisuvucacesijoxoxazibahefeduyivuci",
      "timezone":"0",
      "location":"wirazuroxosujidinexotiza",
      "type":"day-off",
      "likes_count":null,
      "ctime":1342588185,
      "utime":1342588185,
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
      "id":898,
      "user_id":1881,
      "title":"yofatetejupuzowuragumiwi",
      "description":"hupesaxunurolelapeleticepanatukuyujizamifagojoruyaforebehikumozitezonidopejuzuvuburofoyifelobicotakenizaxebugovetizucuhedoxaduwubecitasijolimewesocorezocuxawobuyalofagiwobexunirohezebadugusewolehikibafanaxariruviforetuhefazijedovaxuhebalosapirogedufeheme",
      "timezone":0,
      "location":"fonovudexiloxatojuxenoki",
      "type":"working",
      "likes_count":0,
      "ctime":1342588185,
      "utime":1342588185,
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
      "description":"cafifovubatinimigugozetopebixebumelozepuhelowugavisosemerivixomezubudoyiyegohivayiviwewiwozokicekajisezorakusabipofecawuropagolitodibacohipupinakomitekecukerowemuvibudehogujoyolidatimomucapulaxepuboge",
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
      "id":66,
      "day_id":900,
      "description":"cafifovubatinimigugozetopebixebumelozepuhelowugavisosemerivixomezubudoyiyegohivayiviwewiwozokicekajisezorakusabipofecawuropagolitodibacohipupinakomitekecukerowemuvibudehogujoyolidatimomucapulaxepuboge",
      "img_url":"\/media\/1883\/day\/900\/131bb00c9d74a6a02f3b908e81f0f9fe465eb953.png",
      "likes_count":null,
      "ctime":1342588186
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
<tr><td>int</td><td><s>day_id</s></td><td>1</td><td></td></tr>
<tr><td>[type]</td><td>title</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>description</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "title":"lureju",
      "description":"tanida",
      "timezone":9,
      "location":"reburi",
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
      "id":901,
      "user_id":1884,
      "title":"lureju",
      "description":"tanida",
      "timezone":"9",
      "location":"reburi",
      "type":"working",
      "likes_count":0,
      "ctime":1342588186,
      "utime":1342588186,
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
<a name="9147cceff690c49d2c8d87e2bddd97e2"></a>
Returns basic Day entity by given Day ID.

`POST days/903/item`

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
      "id":903,
      "user_id":1886,
      "title":"gomozexarukeyojubicexaja",
      "description":"yalazubapabodokuwoyabiwakoxomufixorupozawaxuwewozowafocihujowifodonolixenogebabavucunamucupujopipagasajexipupoyemuhadowaricugoluvowitarisemewirelujitatepoholopehisupepemapemerufumucegobilidasimelarujaculidamezufafetaxaragelosuvexalubumayuluyiyazohuwuwahe",
      "timezone":0,
      "location":"dotezolirihanirobejilinu",
      "type":"working",
      "likes_count":0,
      "ctime":1342588186,
      "utime":1342588186,
      "is_ended":0,
      "moments":[
        {
          "id":67,
          "day_id":903,
          "description":"description wafabibawewizefehewiyiwavetebehulizibapuhikevisayiluzezorococeliwixulisowazosorifalajexudupajasalibubopuwimigabediniwekujufo",
          "img_url":"",
          "likes_count":0,
          "ctime":1342588186
        },
        {
          "id":68,
          "day_id":903,
          "description":"description yuripedewakimacizoxegikihokehuhexuviguvabanidozagulikuyoneyuhebadusetilopugopawozegecabomulodiyejirazawibahigajejipevobenizo",
          "img_url":"",
          "likes_count":0,
          "ctime":1342588186
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="42b8f91f7c96bc33ff471457378eea1a"></a>


`POST days/904;905;493/item`

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
<tr><td>[type]</td><td><s>904</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>905</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>493</s></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "904":{
        "id":904,
        "user_id":1888,
        "title":"konohevijataviwaxebamuku",
        "description":"jayitudedupimidotocabajehehayevenoverunotajeribeganecupefukagakowazicifuribezasadekecupewukadovuxokugivucufaxugabogapokevolulavexahatazowawoyatutubetesidajihaxahahadevukosesehejesasenomujoyexejagikamorabenetupexevicegiyaruluzokesucezarilekavejisetuvodemi",
        "timezone":0,
        "location":"wijulajeguzolanixedekowi",
        "type":"day-off",
        "likes_count":0,
        "ctime":1342588186,
        "utime":1342588186,
        "is_ended":0,
        "moments":[
          {
            "id":69,
            "day_id":904,
            "description":"description camofudewuxazunalalohigubuzakepihagicesujibekimurunuhoxerumacamedovecicibatisahebogenasayafagokekaniroxovocivetufufozuwuzaya",
            "img_url":"",
            "likes_count":0,
            "ctime":1342588186
          }
        ]
      },
      "905":{
        "id":905,
        "user_id":1889,
        "title":"vegumawibativogicilumuji",
        "description":"godekosewecameboyemezogecowewinabolihasalofuzapulafesisoficayidufikipapuvoxoxiremotageyixulonitobafodopumisexetecinewitolamusetojujisulakanejeresasisigapodeyuzeveviharogayilizavoricunonoximutefitisedunamupidedovapewazopinesowegitelekuhukejidasoliwegiwovi",
        "timezone":0,
        "location":"losegamereminekujoxohapa",
        "type":"working",
        "likes_count":0,
        "ctime":1342588186,
        "utime":1342588186,
        "is_ended":0,
        "moments":[
          {
            "id":70,
            "day_id":905,
            "description":"description yaficalawilehacagakawogaleverunicodavihiyoyavahufobahebomubatitohuyajeseyomorosukowozujiteniyefecahihutenaxayizeguzaseretawo",
            "img_url":"",
            "likes_count":0,
            "ctime":1342588186
          }
        ]
      },
      "493":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="c9736cbdc905c6e7e86baf7c5f31a39a"></a>


`POST days/907/comment_create`

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
      "text":"duvulodejucirorodafatemidabicikelacuxebacarowejukicaxisuronofuzozaluhiberobixekexijobutorekudelaluzohacusajilovedabacovozamapugutesagoyuwemezenakigihadegikomivavifagazajijevukakoposoyuhetowiyozasefohicivulabuvinijikisajipefijutimazirolaxixobicewiyinecane"
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
      "text":"duvulodejucirorodafatemidabicikelacuxebacarowejukicaxisuronofuzozaluhiberobixekexijobutorekudelaluzohacusajilovedabacovozamapugutesagoyuwemezenakigihadegikomivavifagazajijevukakoposoyuhetowiyozasefohicivulabuvinijikisajipefijutimazirolaxixobicewiyinecane",
      "day":{
        "id":907,
        "user_id":1893,
        "title":"baborayobisavojukeziwoza",
        "location":"zubopicogepenegomobabalu",
        "type":"working",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342588187,
        "utime":1342588187,
        "cip":0
      },
      "user":{
        "id":1893,
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
        "ctime":1342588187,
        "utime":1342588187,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1893,
      "day_id":907,
      "ctime":1342588187,
      "utime":1342588187,
      "id":11
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="2738aa555933bc72d9742614d99a2fb9"></a>


`POST days/908/update`

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
      "title":"voremi",
      "description":"cuzahe",
      "timezone":7,
      "location":"mabuva",
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
      "id":908,
      "user_id":1894,
      "title":"voremi",
      "description":"cuzahe",
      "timezone":"7",
      "location":"mabuva",
      "type":"working",
      "likes_count":0,
      "ctime":1342588187,
      "utime":1342588187,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="9b5671ea8511caa9698645a8c8101929"></a>


`POST days/909/delete`

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
        "id":910,
        "user_id":1896,
        "title":"bamuhuyugunehofafikahada",
        "description":"fexaxaximucutitobaboxojomosihiyiwurozicijalarasohokakowunilozegodumahipotasegezicepidekoxoludorelalorakebatemotidebesixifekeyapecudozidapuhapapojoyubupadumazalabivubuzitepehabivupovazucizanidizumuvipitawujunawayigunekiluyikuluxejitaribukicasavuyehevodogi",
        "timezone":0,
        "location":"facepehaneluwobiduvocama",
        "type":"trip",
        "likes_count":0,
        "ctime":1342588187,
        "utime":1342588187,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="df4531de7b8d0c78a064ac42646b685b"></a>


`POST /days/911/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="c8ac75d814b24f9357a04df3c1440f87"></a>


`POST /days/912/unfavourite`

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
        "id":913,
        "user_id":1903,
        "title":"goyinahasibipuvacosogipa",
        "description":"cinikidewekudeseyuwesenepapotujonuhukegapofozudusugejotuwerihujowiteyukipihilelajomolapenewofapasegogodogejovovakevolebunusozevonuhorinuvunipesunituvoxeribiwogeviciyiholuhacuyolopekinuzipujudajanevuyeregofakowuwejegexodepejumudetamegocixibojuyogabayajilo",
        "timezone":0,
        "location":"fazizibusakukezizacaceja",
        "type":"holiday",
        "likes_count":0,
        "ctime":1342588188,
        "utime":1342588188,
        "is_ended":0
      },
      {
        "id":914,
        "user_id":1903,
        "title":"kimuhigogaficohubacomozi",
        "description":"cecogolijaxudovapoterayulibodehapewuyehekagixuniresehigobekapojazazuledolehejusudegiyidusicedilapizasawalajoyasakulekigabejatofefahugayofelajadobiyecamalogapekoporuvimuxubabawatoloxuwesakelobamowegegafegalagavoxopoyevemecigifawejamihosovuvipogakakalukiko",
        "timezone":0,
        "location":"raluborulavapedetuwebuzo",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342588188,
        "utime":1342588188,
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
      "from":913
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
        "id":914,
        "user_id":1903,
        "title":"kimuhigogaficohubacomozi",
        "description":"cecogolijaxudovapoterayulibodehapewuyehekagixuniresehigobekapojazazuledolehejusudegiyidusicedilapizasawalajoyasakulekigabejatofefahugayofelajadobiyecamalogapekoporuvimuxubabawatoloxuwesakelobamowegegafegalagavoxopoyevemecigifawejamihosovuvipogakakalukiko",
        "timezone":0,
        "location":"raluborulavapedetuwebuzo",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342588188,
        "utime":1342588188,
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
      "from":913,
      "to":914
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
        "id":916,
        "user_id":1905,
        "title":"xufabaducemetowuwefetimo",
        "description":"rotenewasagovawayikoyuxanabomujamamujedalevelojedodapagadexidaroharikorobibicevabufoxetaropovekajurosemosifowuyuwalomatavexinerugemunusekuyawuboyikirapejiyutiruvayebimimirehoyecesojecosanenajejepewavenipocibawoxayuwiyezipevunegelasuletivosimitemiziyuxifo",
        "timezone":0,
        "location":"yorulujajasagasoyiyefeyu",
        "type":"working",
        "likes_count":0,
        "ctime":1342588188,
        "utime":1342588188,
        "is_ended":0
      },
      {
        "id":917,
        "user_id":1904,
        "title":"dubetagozemoyajoselokope",
        "description":"mucosebumenolayuniteyimutelohazoyanolinuyasehojodazariyesebumutebezivikopabutesuloyadukufevokizetuwimegaheyarowahocenigowujamepehitosuxufuzolowonucajevahajoluyokonapezofupisehehehoravufarobikegulugepihabuneforikenadohojehotinahomufozatimuhajokuwinahukima",
        "timezone":0,
        "location":"beziyuteculuxujosajuwuza",
        "type":"working",
        "likes_count":0,
        "ctime":1342588188,
        "utime":1342588188,
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
      "from":916
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
        "id":917,
        "user_id":1904,
        "title":"dubetagozemoyajoselokope",
        "description":"mucosebumenolayuniteyimutelohazoyanolinuyasehojodazariyesebumutebezivikopabutesuloyadukufevokizetuwimegaheyarowahocenigowujamepehitosuxufuzolowonucajevahajoluyokonapezofupisehehehoravufarobikegulugepihabuneforikenadohojehotinahomufozatimuhajokuwinahukima",
        "timezone":0,
        "location":"beziyuteculuxujosajuwuza",
        "type":"working",
        "likes_count":0,
        "ctime":1342588188,
        "utime":1342588188,
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
      "from":916,
      "to":917
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
        "id":923,
        "user_id":1908,
        "title":"xeridavideguboxupelaremi",
        "description":"jayexuzitahasiyunufecevufiwokomovexojufayifoxanibovaziyabovekebasuvuvuzokajehusepikizetucikiwipikelajixorayubigobifuxuzumelewatakajorakejedexezuxayocutihavafihisigetonaxoloyisupironefonuxomahatilidunapuvikikucupijokutepakujakonitanebewivakufulisokibupewu",
        "timezone":0,
        "location":"gekonevidirosevajurexici",
        "type":"day-off",
        "likes_count":0,
        "ctime":1342588189,
        "utime":1342588189,
        "is_ended":0
      },
      {
        "id":924,
        "user_id":1908,
        "title":"sucakemuluyamociyekahaki",
        "description":"citicidulolojitedihutehotijotinocejavizacexiyotafaxukapasutelefinireyimazemuzayagubozotonibuselatamosusokanejimihifefuxojurucafodoluraluhujolugokeyijoforopowonukuvacazefezidagipazuxamiyahowosesigoreconajofifotarohafefiyafogucirotometuyulasagetilutojoriju",
        "timezone":0,
        "location":"relahocizagayucotecalola",
        "type":"working",
        "likes_count":0,
        "ctime":1342588189,
        "utime":1342588189,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="753fee95a5b3bdea84b7e19c72ffe391"></a>


`POST moments/75/update`

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
      "description":"fuzigufuribuvupodiwilovivuvilocopafuyetixokopukoleduzujovafexewihahakatevayececinehidogutedoruduzicemopexiruvoleyowajayalasazuyugugovoyohiragakawedahagocutatozuseribidecojexokoyiwepayoyovojorubelavijujocakixebonotijodajixulufuxukavoxuyekopemazepeyokedegi"
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
      "id":75,
      "day_id":929,
      "description":"fuzigufuribuvupodiwilovivuvilocopafuyetixokopukoleduzujovafexewihahakatevayececinehidogutedoruduzicemopexiruvoleyowajayalasazuyugugovoyohiragakawedahagocutatozuseribidecojexokoyiwepayoyovojorubelavijujocakixebonotijodajixulufuxukavoxuyekopemazepeyokedegi",
      "img_url":"",
      "likes_count":0,
      "ctime":1342588190
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="b12993d80e5d069f13794c5c3f583cec"></a>


`POST moments/76/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="cf7ac7e1148a299458f0040f9a8690c6"></a>


`POST moments/77/comment`

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
      "text":"wabateyayukiwanulakocemojiludopuvobiyupuwulobunizufahowigekexuhorefigokatovotefogevizidewipomukafirehamuwetinufoguhenelexubexilazalecugucukowikanohacolusijiyopuwuduwevuhanavugepilofupujulerudiyekopatukebademosujuvutawakidiyasewemiduvazujipakuxaxigotiduca"
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
      "text":"wabateyayukiwanulakocemojiludopuvobiyupuwulobunizufahowigekexuhorefigokatovotefogevizidewipomukafirehamuwetinufoguhenelexubexilazalecugucukowikanohacolusijiyopuwuduwevuhanavugepilofupujulerudiyekopatukebademosujuvutawakidiyasewemiduvazujipakuxaxigotiduca",
      "moment":{
        "id":77,
        "day_id":931,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342588190,
        "utime":1342588190,
        "cip":0
      },
      "user":{
        "id":1921,
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
        "ctime":1342588190,
        "utime":1342588190,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1921,
      "moment_id":77,
      "ctime":1342588190,
      "utime":1342588190,
      "id":15
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
      "ctime":1342588190,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":1922,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342588190
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
      "first_name":"javewerucatibikoruyutipa",
      "last_name":"mepopeluyibafodojizufomo",
      "occupation":"labekexoyigikezicoyemore",
      "location":"kizateyalakudawukiyohoja",
      "birthday":"1913-00-18"
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
      "birthday":"1913-00-18",
      "ctime":1342588191,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"javewerucatibikoruyutipa",
      "id":1923,
      "last_name":"mepopeluyibafodojizufomo",
      "location":"kizateyalakudawukiyohoja",
      "occupation":"labekexoyigikezicoyemore",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342588191
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
      "first_name":"zikomedozugagujoyidovamo",
      "birthday":"1926-00-20"
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
      "birthday":"1926-00-20",
      "ctime":1342588191,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"zikomedozugagujoyidovamo",
      "id":1924,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "uip":2130706433,
      "utime":1342588191
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
      "id":3,
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
      "id":4,
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
        "ctime":1342588191,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":1928,
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
        "utime":1342588191
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="27bcab1430556914451ef01fa22c1c19"></a>


`POST users/1929/days/`

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
        "id":932,
        "user_id":1929,
        "title":"nexihusominafufocivuhaka",
        "description":"sihexadafidadogoyayukocobobacagosibiravuruzosaligepizojulefimejaxetinijakexamerosahoxosezuwigapamepuvudafafokojazotugidehuricepinanecolesoyalecexugahehijubidozoviyufedubayihawaxagalisolofijagarayunaticozetomixotefebocegejimupiwamisigoyumemebarepowowacami",
        "timezone":0,
        "location":"povenixiciloronitixiruxi",
        "type":"working",
        "likes_count":0,
        "ctime":1342588191,
        "utime":1342588191,
        "is_ended":0
      },
      {
        "id":933,
        "user_id":1929,
        "title":"gafebegumoyovoviyobiwute",
        "description":"letoxisawalujulihuporogevojokapukelexalojusotadabovojabasevamexutebokikojajafibaduwiwupifenotemiricazitemajonewofocamomobuhokoguhebevonewuyegobikalutumoxonenogobebuzicukufotabahixakevecenibojazexuxuveyuxofutikimoyebunipihurehigalalezecafopikajejehuxukava",
        "timezone":0,
        "location":"zalecereyovelehoxajoxako",
        "type":"working",
        "likes_count":0,
        "ctime":1342588191,
        "utime":1342588191,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="638f1e3f646091a3a594238c1fabcb57"></a>


`POST users/1931/item/`

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
      "ctime":1342588192,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":1931,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "utime":1342588192
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
        "ctime":1342588192,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":1934,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588192
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="b3e121e063ddf4cde91eb71d0ed787d3"></a>


`POST users/1935/followers`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="b3e121e063ddf4cde91eb71d0ed787d3"></a>


`POST users/1935/followers`

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
        "ctime":1342588192,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":1936,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588192
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
        "ctime":1342588192,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":1938,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588192
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="7435c2c465ffe6ea5ebbefa0c2a7de75"></a>


`POST users/1939/following`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="7435c2c465ffe6ea5ebbefa0c2a7de75"></a>


`POST users/1939/following`

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
        "ctime":1342588192,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":1940,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":0,
        "utime":1342588192
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="46f7806e7d980a097202878146dca1e8"></a>


`POST users/1942/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="ce0896c063569972cb157c084d4b35a1"></a>


`POST users/1944/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
