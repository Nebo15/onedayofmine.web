# API #
 Version: 21.07.12 17:51:34

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Complaints'>Complaints</a> ###
1. <a href='#65ef80358f4144bb81aded7e6c383cc8'>Create</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#9e59ff5a39376390cb691df3c733dffc'>Update</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#5dedd5a7571283e28452894c9d3ef657'>Item</a>
1. <a href='#4fa3b2e8440a8f6b09b2ec0165007b83'>Item_Many</a>
1. <a href='#5bb342d106de22ff74d251241810c27b'>CommentCreate</a>
1. <a href='#de77b967a33b4a2595ecbd342f4c32df'>Update</a>
1. <a href='#9e2abd230034f46e41a172983029060e'>DeleteDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#9561d1d781249664c3e7fc919da7b808'>AddToFavourites</a>
1. <a href='#c3ef60d04b02e63919297eb1db6f2ac4'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#c11bc5dc5319d5e6584f09da54580661'>Update</a>
1. <a href='#0f552d86e0f0192e962e75d9bc777219'>Delete</a>
1. <a href='#6dec861bdc79fd2634c2b404de0be080'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#3d82563d7faa5e246fb6a69128b0cce4'>UpdateProfile_Partial</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#News'>News</a> ###
1. <a href='#3292f47a05d97e9f9f13470ea62f442c'>GetNewNews</a>
1. <a href='#bf045aead4bc883ec2790cceb0b1d763'>GetOldNews</a>
1. <a href='#b30c9537f557a3acdb24d4a011ecde80'>GetNewsRange</a>
1. <a href='#fa4f9074df4c377a4bbc29888ef9776b'>GetLastNews</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>

### <a href='#User'>User</a> ###
1. <a href='#ff25aee41a2e513e84f2d336a0b50952'>UserByIdDays</a>
1. <a href='#0cce88dc71410e1fc9b2c69e2d9eac45'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#57eb61fd09110fc6fc2aa65512ad55e7'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#5504582f4af511746c983f2ae32cc198'>FollowingByUserId</a>
1. <a href='#ae252bb0fd1f456ccb11a6c2ff259b23'>Follow</a>
1. <a href='#8ba46294b994e8952c65cd0a28812330'>Unfollow</a>


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
      "sessid":"5hl4ejhg9196k799kv5iivejr0",
      "user":{
        "birthday":"1992-08-08",
        "ctime":1342882281,
        "current_location":"",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "id":81331,
        "last_name":"foo",
        "occupation":"",
        "sex":"male",
        "timezone":"3",
        "utime":1342882281
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Complaints ###
<a name='Complaints'></a>
#### Create ####
<a name="65ef80358f4144bb81aded7e6c383cc8"></a>


`POST /complaints/11867/create`

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
      "text":"lolewu"
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
      "text":"lolewu",
      "ctime":1342882283,
      "id":391
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
      "title":"bicugomajururoyoxajomafo",
      "description":"yeyohepuxelonihuvesuxiwahogofedatatalewerecatebisokigariyufagegukuzohodubabomagatitutenofotizukeyedadecalaxufacusoxidececusawakokixitusadibesafexawumugivupizuhelayafihefepulohexagecixulililovuyobajelirakawohotibubusikawuwotokoxobedojisaduwunusivezaluzemo",
      "timezone":0,
      "location":"vuwugokavuyogoyijaromohu",
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
      "id":11868,
      "user_id":81339,
      "title":"bicugomajururoyoxajomafo",
      "description":"yeyohepuxelonihuvesuxiwahogofedatatalewerecatebisokigariyufagegukuzohodubabomagatitutenofotizukeyedadecalaxufacusoxidececusawakokixitusadibesafexawumugivupizuhelayafihefepulohexagecixulililovuyobajelirakawohotibubusikawuwotokoxobedojisaduwunusivezaluzemo",
      "timezone":"0",
      "location":"vuwugokavuyogoyijaromohu",
      "type":"holiday",
      "likes_count":null,
      "ctime":1342882283,
      "utime":1342882283,
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
      "id":11869,
      "user_id":81340,
      "title":"rataxoluvikefofocutiyico",
      "description":"malolozafupuhonatotoxijaninaxodewibehajiyulanuketayinesasefiyezovucazenuhucowibipudafucucemunivelukifujivigoxefifemefihewogefurivubuwelitofiyebasimucocumefohogatebipidefeyatufilohilejurinuhoyabupomoyocutotufapiruvuxilihofevegewocokapazezaliraneziwiwafaju",
      "timezone":0,
      "location":"cabohuxerosojacivudugewo",
      "type":"working",
      "likes_count":0,
      "ctime":1342882283,
      "utime":1342882283,
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
      "description":"garadeleyafegilerotuxewisemiluroyetanalijivifawoyitovigiwobesozixorexawasivuvipodemuwolomizacuturejilarasexizidavobijigoxaxudixoyafehukugelatihidecivegonaposikisiyujeyipetexawajumahotowelivocihakojefu",
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
      "id":4172,
      "day_id":11871,
      "description":"garadeleyafegilerotuxewisemiluroyetanalijivifawoyitovigiwobesozixorexawasivuvipodemuwolomizacuturejilarasexizidavobijigoxaxudixoyafehukugelatihidecivegonaposikisiyujeyipetexawajumahotowelivocihakojefu",
      "img_url":"\/media\/81342\/day\/11871\/da7526300b44c58747d3e0146605f5f9bb79c423.png",
      "likes_count":null,
      "ctime":1342882284
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
      "title":"pepizu",
      "description":"yawita",
      "timezone":1,
      "location":"soleye",
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
      "id":11872,
      "user_id":81343,
      "title":"pepizu",
      "description":"yawita",
      "timezone":"1",
      "location":"soleye",
      "type":"working",
      "likes_count":0,
      "ctime":1342882284,
      "utime":1342882284,
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
<a name="5dedd5a7571283e28452894c9d3ef657"></a>
Returns basic Day entity by given Day ID.

`POST days/11874/item`

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
      "id":11874,
      "user_id":81345,
      "title":"lajetalojexepetecerubizi",
      "description":"cevesatazufijenuxakaranogudurebonozexohupijusuvixarihadizekomijagegabizizemodegakunoyoduyipiyulafohafevapewomatuwenoyosugegadojejimiweremiculowebezucowexalutogajomayanenikukedipaloteyihepacobemineravaracajelujupacirewekubehiyoxiwosivolazucetojofufufixaya",
      "timezone":0,
      "location":"mecayuzirosomurujofepawu",
      "type":"day-off",
      "likes_count":0,
      "ctime":1342882284,
      "utime":1342882284,
      "is_ended":0,
      "moments":[
        {
          "id":4173,
          "day_id":11874,
          "description":"description bemezenadecelukizoyugucemixayajulujedumecilikobenugoyebesumoyurerutotazutijagenohomazipokahexuriweginekesokuburepaliragucihu",
          "img_url":"",
          "likes_count":0,
          "ctime":1342882284
        },
        {
          "id":4174,
          "day_id":11874,
          "description":"description desobabatizozopiyadedufesonalukifagagejuweruzagujefihevudecihidimerorusihehemifowehasabukalonicayotiseburefaveyisasefofitige",
          "img_url":"",
          "likes_count":0,
          "ctime":1342882284
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="4fa3b2e8440a8f6b09b2ec0165007b83"></a>
Get few days in one request.

`POST days/11875;11876;705/item`

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
<tr><td>[type]</td><td><s>11875</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>11876</s></td><td>[description]</td></tr>
<tr><td>[type]</td><td><s>705</s></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "11875":{
        "id":11875,
        "user_id":81347,
        "title":"zagacokecoxehoxafitiyuvo",
        "description":"sutatefotenavajifuzotusopoticebohoyazawometelasizojorakavatunoromiwirogazujibazutesejamadeyoziliceyoxawucagafebunofutoyuxumuluhidefujuwidanejifuhetubowunevufakehihonabofizicajenajisanaledojiyobegijegitabujefukimapuhagerixifuvelarorewofayebewikemolobahupi",
        "timezone":0,
        "location":"riyehezaviporikifejalura",
        "type":"working",
        "likes_count":0,
        "ctime":1342882284,
        "utime":1342882284,
        "is_ended":0,
        "moments":[
          {
            "id":4175,
            "day_id":11875,
            "description":"description vipanawojakafoworizeyarowopizigoyowiyofetikujapusihiruhisuxohakexasoxubikemonarenuvavarixicapikirahixecesizenolanegehuvajuju",
            "img_url":"",
            "likes_count":0,
            "ctime":1342882284
          }
        ]
      },
      "11876":{
        "id":11876,
        "user_id":81348,
        "title":"gajenowakubebemawinuzixi",
        "description":"tumipimusadapezafirawenehazesesecaxosemelimazigaxujoduziyutifizepuyegirozatunufiticujajezawamolarejutupocetofubukawofazafojopotedaduborazetafocixugacageziyijovitujonuxigorijozesagokizebuyerowenadacunepatuyodiyejewesugihuhafohewehesuniwiducajekasacuretulu",
        "timezone":0,
        "location":"neyotibazeriworicitajufi",
        "type":"working",
        "likes_count":0,
        "ctime":1342882284,
        "utime":1342882284,
        "is_ended":0,
        "moments":[
          {
            "id":4176,
            "day_id":11876,
            "description":"description yepodepiwiyiramohirikalozojivivovejurukikezulisoyehekozelexetoxibelofufidanipahiliwugofobaxotohobokapitosehekivodipejobewufi",
            "img_url":"",
            "likes_count":0,
            "ctime":1342882284
          }
        ]
      },
      "705":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="5bb342d106de22ff74d251241810c27b"></a>
Create moment in specified day

`POST days/11878/comment_create`

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
      "text":"sihucovayexavenodecedozoboburoyedehazahujabalixiyuwaruvoponemimosowowanahifofafazudowuhitoregawuxonotawusarucoyavasobubotozutowikehamacadoyamugeyuwuwusimomakevotaxadujeremacojapayizozigirowililetigawuhexezakijebeyuwalivewawemixoponuziguripuyojupabanoheza"
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
      "text":"sihucovayexavenodecedozoboburoyedehazahujabalixiyuwaruvoponemimosowowanahifofafazudowuhitoregawuxonotawusarucoyavasobubotozutowikehamacadoyamugeyuwuwusimomakevotaxadujeremacojapayizozigirowililetigawuhexezakijebeyuwalivewawemixoponuziguripuyojupabanoheza",
      "day":{
        "id":11878,
        "user_id":81352,
        "title":"pipumunoyoxipupikuxeredi",
        "location":"juxapahihetogolayohawuko",
        "type":"day-off",
        "is_ended":0,
        "timezone":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1342882285,
        "utime":1342882285,
        "cip":0
      },
      "user":{
        "id":81352,
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
        "ctime":1342882284,
        "utime":1342882284,
        "cip":0,
        "followers":{
          
        }
      },
      "cip":2130706433,
      "user_id":81352,
      "day_id":11878,
      "ctime":1342882285,
      "utime":1342882285,
      "id":509
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="de77b967a33b4a2595ecbd342f4c32df"></a>
Updates a day

`POST days/11879/update`

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
      "title":"jowufe",
      "description":"lapiri",
      "timezone":4,
      "location":"bagazu",
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
      "id":11879,
      "user_id":81353,
      "title":"jowufe",
      "description":"lapiri",
      "timezone":"4",
      "location":"bagazu",
      "type":"working",
      "likes_count":0,
      "ctime":1342882285,
      "utime":1342882285,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="9e2abd230034f46e41a172983029060e"></a>
Deletes a day

`POST days/11880/delete`

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
        "id":11881,
        "user_id":81355,
        "title":"rurowupefimimahagifelumi",
        "description":"vuzacozutowaxanobimugureciyowaloyetazozomotewebuwitahemeyecolikewaluveneferupovedimiyuvujupohufaziyozizavicegutekavedidikogorewizojugebuyahayamegerevovalaxakoreluhohepajujeyopabaluxezegujonuzuyepemakubocumociwihotebufepokisevenekudipakaxinoyulodirewazato",
        "timezone":0,
        "location":"gekikigumelukacuvidegixu",
        "type":"day-off",
        "likes_count":0,
        "ctime":1342882285,
        "utime":1342882285,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="9561d1d781249664c3e7fc919da7b808"></a>


`POST /days/11882/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="c3ef60d04b02e63919297eb1db6f2ac4"></a>


`POST /days/11883/unfavourite`

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
      "from":11884,
      "to":11885
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
      "from":11887,
      "to":11888
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
      "from":11890,
      "to":11892
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
        "id":11891,
        "user_id":81365,
        "title":"mafemamazaluvemorofoteva",
        "description":"jedezanicumuvilagulareruzihoketomuciyibaliwazejadohobupakuvodilokicedajirasoluwitahobuvetidubimibitasasefeyijodawewuhogufevexeruvecikovicodimemeseduzexavokoxapokofokujisiyateletihozawovejogukonikumoladejutogihiferazigecigicozisidaremudaseruxogiwayamamomi",
        "timezone":0,
        "location":"sunayodovemafipufadilexi",
        "type":"holiday",
        "likes_count":2,
        "ctime":1342795886,
        "utime":1342882286,
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
        "id":11894,
        "user_id":81367,
        "title":"vagupevepalubovucinuvogu",
        "description":"wilulepuladepetihinekaxurupogovabezipimupigazuvelemokevuheriyinurilazufimivijitowapanefosohigopuhuceyexiroxufivuvefetecedezediginesimiwafodehujahijuwejutejuvigevutemilogibimemoyotofatukasanumexapetacupakanuwisifurutuxidijitevepijoluvuzesotejugutuxijazoro",
        "timezone":0,
        "location":"pigekocupesehuvifuhefita",
        "type":"working",
        "likes_count":0,
        "ctime":1342882286,
        "utime":1342882286,
        "is_ended":0
      },
      {
        "id":11895,
        "user_id":81367,
        "title":"sugexizunuxomanapehatibu",
        "description":"recodocecimofuzugodixunigilekinuvovuhudegizinulorihinocogicizipogesifoxikuwuverevuwesudukalevuduhomipexudowuyihojabacaxihewajuzoticevugurawimaguhewejoticiremobecamucovovifetecuruhuranopacatahugoreniyezanonosanucazivituriyuhatulejenemabasodasehovagiyubute",
        "timezone":0,
        "location":"rivisaxicubunenugizebuyi",
        "type":"day-off",
        "likes_count":0,
        "ctime":1342882286,
        "utime":1342882286,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="c11bc5dc5319d5e6584f09da54580661"></a>


`POST moments/4181/update`

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
      "description":"hehojahuratileholapapuhinojuhetipadufivopihaxivesekefosolapojegujevivihebikudagumocohohovulafozizozohedewifusivabuverazezemabirafiviwutomupajehefarofifazogudubelovetiyalijoxocasowuhuyerahozecicutojozodemaxibigukixevimahijeyefofigajelokekiyohedarurazupehi"
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
      "id":4181,
      "day_id":11900,
      "description":"hehojahuratileholapapuhinojuhetipadufivopihaxivesekefosolapojegujevivihebikudagumocohohovulafozizozohedewifusivabuverazezemabirafiviwutomupajehefarofifazogudubelovetiyalijoxocasowuhuyerahozecicutojozodemaxibigukixevimahijeyefofigajelokekiyohedarurazupehi",
      "img_url":"",
      "likes_count":0,
      "ctime":1342882287
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="0f552d86e0f0192e962e75d9bc777219"></a>


`POST moments/4182/delete`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="6dec861bdc79fd2634c2b404de0be080"></a>


`POST moments/4183/comment`

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
      "text":"dacobekisuzawohudurojocerijudunebixawenicirufutewezabajomomonawiroriyazaroyonocebaladotoleguhamutakogetuyosijovewelubapikokowupizugehudeposunigetohowufariwilebijesigovonisazukopolenipadepivizaxosakixuyiyumerabalirusokejawegoxutekifedagolusixazicogiwirowu"
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
      "text":"dacobekisuzawohudurojocerijudunebixawenicirufutewezabajomomonawiroriyazaroyonocebaladotoleguhamutakogetuyosijovewelubapikokowupizugehudeposunigetohowufariwilebijesigovonisazukopolenipadepivizaxosakixuyiyumerabalirusokejawegoxutekifedagolusixazicogiwirowu",
      "moment":{
        "id":4183,
        "day_id":11902,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1342882287,
        "utime":1342882287,
        "cip":0,
        "day":{
          "id":11902,
          "user_id":81380,
          "title":"helewizasevupecenuxobego",
          "location":"ditexijizamotabixexidoye",
          "type":"holiday",
          "is_ended":0,
          "timezone":0,
          "likes_count":0,
          "is_deleted":0,
          "ctime":1342882287,
          "utime":1342882287,
          "cip":0
        }
      },
      "user":{
        "id":81380,
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
        "ctime":1342882287,
        "utime":1342882287,
        "cip":0,
        "followers":{
          
        }
      },
      "cip":2130706433,
      "user_id":81380,
      "moment_id":4183,
      "ctime":1342882287,
      "utime":1342882287,
      "id":1602
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
      "ctime":1342882287,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":81381,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "utime":1342882287
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
      "first_name":"zaketazelubuwecaboxevova",
      "last_name":"cirirusuhutezakaximanusu",
      "occupation":"jamocayorokekegihopeseku",
      "location":"wugisonelebanoduwijifava",
      "birthday":"1938-01-22"
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
      "birthday":"1938-01-22",
      "ctime":1342882287,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"zaketazelubuwecaboxevova",
      "id":81382,
      "last_name":"cirirusuhutezakaximanusu",
      "location":"wugisonelebanoduwijifava",
      "occupation":"jamocayorokekegihopeseku",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "uip":2130706433,
      "utime":1342882287
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
      "first_name":"jajurolawazudefejowariyi",
      "birthday":"1932-01-17"
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
      "birthday":"1932-01-17",
      "ctime":1342882287,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"jajurolawazudefejowariyi",
      "id":81383,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "uip":2130706433,
      "utime":1342882287
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
      "id":547,
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
      "id":548,
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
Get list of news that was created after specified news. SQL logic representation: SELECT ... FROM ... WHERE id > $last ORDER BY DESC LIMIT 100

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
      "last":51761
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:News[100]'>News[100]</a></td><td><s>-</s></td><td>List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":51762,
        "recipient_id":81386,
        "user_id":81388,
        "text":"bar loves foo",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882288
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetOldNews ####
<a name="bf045aead4bc883ec2790cceb0b1d763"></a>
Get list of news that was created before specified news. SQL logic representation: SELECT ... FROM ... WHERE id < $first ORDER BY DESC LIMIT 100

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
<tr><td>int</td><td><s>last</s></td><td>1</td><td>ID of latest present in application news</td></tr>
<tr><td>[type]</td><td>first</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "first":51766
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:News[100]'>News[100]</a></td><td><s>-</s></td><td>List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>
<tr><td>[type]</td><td>2</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":51765,
        "recipient_id":81389,
        "user_id":81392,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882288
      },
      {
        "id":51764,
        "recipient_id":81389,
        "user_id":81391,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882288
      },
      {
        "id":51763,
        "recipient_id":81389,
        "user_id":81390,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882288
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewsRange ####
<a name="b30c9537f557a3acdb24d4a011ecde80"></a>
Get specified range of news. SQL logic representation: SELECT ... FROM ... WHERE $first < id AND id < $last ORDER BY DESC LIMIT 100

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
<tr><td>int</td><td>last</td><td>1</td><td>Highest limit of range</td></tr>
<tr><td>[type]</td><td>first</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "first":51770,
      "last":51773
    }



##### Response: #####
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:News[100]'>News[100]</a></td><td><s>-</s></td><td>List of news in specified range</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":51772,
        "recipient_id":81396,
        "user_id":81400,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882288
      },
      {
        "id":51771,
        "recipient_id":81396,
        "user_id":81399,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882288
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetLastNews ####
<a name="fa4f9074df4c377a4bbc29888ef9776b"></a>
Get list of latest news. SQL logic representation: SELECT ... FROM ... ORDER BY DESC LIMIT 100

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
<tr><td><a href='#Entity:News[100]'>News[100]</a></td><td><s>List</s></td><td>of news</td></tr>
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
<tr><td>[type]</td><td>50</td><td>[description]</td></tr>
<tr><td>[type]</td><td>51</td><td>[description]</td></tr>
<tr><td>[type]</td><td>52</td><td>[description]</td></tr>
<tr><td>[type]</td><td>53</td><td>[description]</td></tr>
<tr><td>[type]</td><td>54</td><td>[description]</td></tr>
<tr><td>[type]</td><td>55</td><td>[description]</td></tr>
<tr><td>[type]</td><td>56</td><td>[description]</td></tr>
<tr><td>[type]</td><td>57</td><td>[description]</td></tr>
<tr><td>[type]</td><td>58</td><td>[description]</td></tr>
<tr><td>[type]</td><td>59</td><td>[description]</td></tr>
<tr><td>[type]</td><td>60</td><td>[description]</td></tr>
<tr><td>[type]</td><td>61</td><td>[description]</td></tr>
<tr><td>[type]</td><td>62</td><td>[description]</td></tr>
<tr><td>[type]</td><td>63</td><td>[description]</td></tr>
<tr><td>[type]</td><td>64</td><td>[description]</td></tr>
<tr><td>[type]</td><td>65</td><td>[description]</td></tr>
<tr><td>[type]</td><td>66</td><td>[description]</td></tr>
<tr><td>[type]</td><td>67</td><td>[description]</td></tr>
<tr><td>[type]</td><td>68</td><td>[description]</td></tr>
<tr><td>[type]</td><td>69</td><td>[description]</td></tr>
<tr><td>[type]</td><td>70</td><td>[description]</td></tr>
<tr><td>[type]</td><td>71</td><td>[description]</td></tr>
<tr><td>[type]</td><td>72</td><td>[description]</td></tr>
<tr><td>[type]</td><td>73</td><td>[description]</td></tr>
<tr><td>[type]</td><td>74</td><td>[description]</td></tr>
<tr><td>[type]</td><td>75</td><td>[description]</td></tr>
<tr><td>[type]</td><td>76</td><td>[description]</td></tr>
<tr><td>[type]</td><td>77</td><td>[description]</td></tr>
<tr><td>[type]</td><td>78</td><td>[description]</td></tr>
<tr><td>[type]</td><td>79</td><td>[description]</td></tr>
<tr><td>[type]</td><td>80</td><td>[description]</td></tr>
<tr><td>[type]</td><td>81</td><td>[description]</td></tr>
<tr><td>[type]</td><td>82</td><td>[description]</td></tr>
<tr><td>[type]</td><td>83</td><td>[description]</td></tr>
<tr><td>[type]</td><td>84</td><td>[description]</td></tr>
<tr><td>[type]</td><td>85</td><td>[description]</td></tr>
<tr><td>[type]</td><td>86</td><td>[description]</td></tr>
<tr><td>[type]</td><td>87</td><td>[description]</td></tr>
<tr><td>[type]</td><td>88</td><td>[description]</td></tr>
<tr><td>[type]</td><td>89</td><td>[description]</td></tr>
<tr><td>[type]</td><td>90</td><td>[description]</td></tr>
<tr><td>[type]</td><td>91</td><td>[description]</td></tr>
<tr><td>[type]</td><td>92</td><td>[description]</td></tr>
<tr><td>[type]</td><td>93</td><td>[description]</td></tr>
<tr><td>[type]</td><td>94</td><td>[description]</td></tr>
<tr><td>[type]</td><td>95</td><td>[description]</td></tr>
<tr><td>[type]</td><td>96</td><td>[description]</td></tr>
<tr><td>[type]</td><td>97</td><td>[description]</td></tr>
<tr><td>[type]</td><td>98</td><td>[description]</td></tr>
<tr><td>[type]</td><td>99</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":51974,
        "recipient_id":81403,
        "user_id":81603,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51973,
        "recipient_id":81403,
        "user_id":81602,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51972,
        "recipient_id":81403,
        "user_id":81601,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51971,
        "recipient_id":81403,
        "user_id":81600,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51970,
        "recipient_id":81403,
        "user_id":81599,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51969,
        "recipient_id":81403,
        "user_id":81598,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51968,
        "recipient_id":81403,
        "user_id":81597,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51967,
        "recipient_id":81403,
        "user_id":81596,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51966,
        "recipient_id":81403,
        "user_id":81595,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51965,
        "recipient_id":81403,
        "user_id":81594,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51964,
        "recipient_id":81403,
        "user_id":81593,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51963,
        "recipient_id":81403,
        "user_id":81592,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51962,
        "recipient_id":81403,
        "user_id":81591,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51961,
        "recipient_id":81403,
        "user_id":81590,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51960,
        "recipient_id":81403,
        "user_id":81589,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51959,
        "recipient_id":81403,
        "user_id":81588,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51958,
        "recipient_id":81403,
        "user_id":81587,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51957,
        "recipient_id":81403,
        "user_id":81586,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51956,
        "recipient_id":81403,
        "user_id":81585,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51955,
        "recipient_id":81403,
        "user_id":81584,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51954,
        "recipient_id":81403,
        "user_id":81583,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51953,
        "recipient_id":81403,
        "user_id":81582,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51952,
        "recipient_id":81403,
        "user_id":81581,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51951,
        "recipient_id":81403,
        "user_id":81580,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51950,
        "recipient_id":81403,
        "user_id":81579,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51949,
        "recipient_id":81403,
        "user_id":81578,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51948,
        "recipient_id":81403,
        "user_id":81577,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51947,
        "recipient_id":81403,
        "user_id":81576,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51946,
        "recipient_id":81403,
        "user_id":81575,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51945,
        "recipient_id":81403,
        "user_id":81574,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51944,
        "recipient_id":81403,
        "user_id":81573,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51943,
        "recipient_id":81403,
        "user_id":81572,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51942,
        "recipient_id":81403,
        "user_id":81571,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51941,
        "recipient_id":81403,
        "user_id":81570,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51940,
        "recipient_id":81403,
        "user_id":81569,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51939,
        "recipient_id":81403,
        "user_id":81568,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51938,
        "recipient_id":81403,
        "user_id":81567,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51937,
        "recipient_id":81403,
        "user_id":81566,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51936,
        "recipient_id":81403,
        "user_id":81565,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51935,
        "recipient_id":81403,
        "user_id":81564,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51934,
        "recipient_id":81403,
        "user_id":81563,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51933,
        "recipient_id":81403,
        "user_id":81562,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51932,
        "recipient_id":81403,
        "user_id":81561,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51931,
        "recipient_id":81403,
        "user_id":81560,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51930,
        "recipient_id":81403,
        "user_id":81559,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51929,
        "recipient_id":81403,
        "user_id":81558,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51928,
        "recipient_id":81403,
        "user_id":81557,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51927,
        "recipient_id":81403,
        "user_id":81556,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51926,
        "recipient_id":81403,
        "user_id":81555,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51925,
        "recipient_id":81403,
        "user_id":81554,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51924,
        "recipient_id":81403,
        "user_id":81553,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51923,
        "recipient_id":81403,
        "user_id":81552,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51922,
        "recipient_id":81403,
        "user_id":81551,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51921,
        "recipient_id":81403,
        "user_id":81550,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51920,
        "recipient_id":81403,
        "user_id":81549,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51919,
        "recipient_id":81403,
        "user_id":81548,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51918,
        "recipient_id":81403,
        "user_id":81547,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51917,
        "recipient_id":81403,
        "user_id":81546,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51916,
        "recipient_id":81403,
        "user_id":81545,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51915,
        "recipient_id":81403,
        "user_id":81544,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51914,
        "recipient_id":81403,
        "user_id":81543,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51913,
        "recipient_id":81403,
        "user_id":81542,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51912,
        "recipient_id":81403,
        "user_id":81541,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51911,
        "recipient_id":81403,
        "user_id":81540,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51910,
        "recipient_id":81403,
        "user_id":81539,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51909,
        "recipient_id":81403,
        "user_id":81538,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51908,
        "recipient_id":81403,
        "user_id":81537,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51907,
        "recipient_id":81403,
        "user_id":81536,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51906,
        "recipient_id":81403,
        "user_id":81535,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51905,
        "recipient_id":81403,
        "user_id":81534,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51904,
        "recipient_id":81403,
        "user_id":81533,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51903,
        "recipient_id":81403,
        "user_id":81532,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51902,
        "recipient_id":81403,
        "user_id":81531,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51901,
        "recipient_id":81403,
        "user_id":81530,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51900,
        "recipient_id":81403,
        "user_id":81529,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51899,
        "recipient_id":81403,
        "user_id":81528,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51898,
        "recipient_id":81403,
        "user_id":81527,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51897,
        "recipient_id":81403,
        "user_id":81526,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51896,
        "recipient_id":81403,
        "user_id":81525,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51895,
        "recipient_id":81403,
        "user_id":81524,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51894,
        "recipient_id":81403,
        "user_id":81523,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51893,
        "recipient_id":81403,
        "user_id":81522,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51892,
        "recipient_id":81403,
        "user_id":81521,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51891,
        "recipient_id":81403,
        "user_id":81520,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51890,
        "recipient_id":81403,
        "user_id":81519,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51889,
        "recipient_id":81403,
        "user_id":81518,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51888,
        "recipient_id":81403,
        "user_id":81517,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51887,
        "recipient_id":81403,
        "user_id":81516,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51886,
        "recipient_id":81403,
        "user_id":81515,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51885,
        "recipient_id":81403,
        "user_id":81514,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51884,
        "recipient_id":81403,
        "user_id":81513,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51883,
        "recipient_id":81403,
        "user_id":81512,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51882,
        "recipient_id":81403,
        "user_id":81511,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51881,
        "recipient_id":81403,
        "user_id":81510,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51880,
        "recipient_id":81403,
        "user_id":81509,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51879,
        "recipient_id":81403,
        "user_id":81508,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51878,
        "recipient_id":81403,
        "user_id":81507,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51877,
        "recipient_id":81403,
        "user_id":81506,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51876,
        "recipient_id":81403,
        "user_id":81505,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
      },
      {
        "id":51875,
        "recipient_id":81403,
        "user_id":81504,
        "text":"foo loves bar",
        "day_id":0,
        "moment_id":0,
        "ctime":1342882289
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
        "ctime":1342882292,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":81626,
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
        "utime":1342882292
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="ff25aee41a2e513e84f2d336a0b50952"></a>


`POST users/81627/days/`

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
        "id":11909,
        "user_id":81627,
        "title":"gomejehipojifabikepijivu",
        "description":"kecamidikubumuyurafopocumepehusogotofujivelegegukeruboyixitalewodilelowabeleroduboyakunekelorelovubapukoduxomutisonamajujorubasoyozipecogumoyefoxosewagawucuyorumojabewejeyepayixovosaviwujorupapugihavojoxuxojolakadanubutovevedayebobeluhesibatedupowiniheva",
        "timezone":0,
        "location":"jexutekizecaromapayipoxu",
        "type":"special_event",
        "likes_count":0,
        "ctime":1342882293,
        "utime":1342882293,
        "is_ended":0
      },
      {
        "id":11910,
        "user_id":81627,
        "title":"delocakumifasezimofuhiyo",
        "description":"cowakazebewekoyuracexikiwagatatowiyatulohefowamidisazaluhowutividosusasuhunaxapapebikikodesuvijufawucitehenajafukelosokubasumatobimabememulocosiwafixijurusabivazedumohurotojedameseyagibusakibetajavodejucogewonibinebifopigoxuvadiwezacavehobudahojeficobeku",
        "timezone":0,
        "location":"jovizobijohocacabifiyaba",
        "type":"trip",
        "likes_count":0,
        "ctime":1342882293,
        "utime":1342882293,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="0cce88dc71410e1fc9b2c69e2d9eac45"></a>


`POST users/81629/item/`

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
      "ctime":1342882293,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "fb_uid":"100004093051334",
      "first_name":"foo",
      "id":81629,
      "last_name":"foo",
      "location":"",
      "occupation":"",
      "sex":"male",
      "timezone":3,
      "twitter_access_token":"",
      "twitter_access_token_secret":"",
      "utime":1342882293
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
        "ctime":1342882293,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":81634,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342882293
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="57eb61fd09110fc6fc2aa65512ad55e7"></a>


`POST users/81635/followers`

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
        "ctime":1342882293,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":81636,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342882293
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
        "ctime":1342882293,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":81638,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342882293
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="5504582f4af511746c983f2ae32cc198"></a>


`POST users/81639/following`

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
        "ctime":1342882293,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_n.jpg",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_t.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-snc4\/273807_100004087981387_670665721_q.jpg",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1342526485,
        "fb_uid":"100004087981387",
        "first_name":"bar",
        "id":81640,
        "last_name":"bar",
        "location":"",
        "occupation":"",
        "sex":"male",
        "timezone":3,
        "twitter_access_token":"",
        "twitter_access_token_secret":"",
        "utime":1342882293
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="ae252bb0fd1f456ccb11a6c2ff259b23"></a>


`POST users/81642/follow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="8ba46294b994e8952c65cd0a28812330"></a>


`POST users/81644/unfollow`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
