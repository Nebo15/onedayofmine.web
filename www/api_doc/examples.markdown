# API #
 Version: 07.08.12 22:35:34

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#CurrentDay'>CurrentDay</a> ###
1. <a href='#aef4d0c381bfa1dccfdd2216f8f188ef'>Start</a>
1. <a href='#cbad16697e3ffed4670242666474b25b'>GetCurrentDay</a>
1. <a href='#69e8f640ca26b9cc716ecf64942b8619'>CreateMoment</a>
1. <a href='#9e59ff5a39376390cb691df3c733dffc'>Update</a>
1. <a href='#edffd7a5f673999b16ade68463815ffe'>Finish</a>

### <a href='#Day'>Day</a> ###
1. <a href='#ee20261a86ef4343d90c66d70c8c2d64'>Item</a>
1. <a href='#8f2afb598b452cfad4eb1a7ae24be42a'>Item_Many</a>
1. <a href='#c19fc41a7f93de419c9975a9aa1c22a6'>CommentCreate</a>
1. <a href='#36b7f3f041e299c379632978bb1dd49d'>ShareDay</a>
1. <a href='#187eeda967e32a222612fbdb45463354'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#a61f99b852e1d54bb23391db532496be'>Update</a>
1. <a href='#94f899a8a91491430aa3d01272c688c6'>DeleteDay</a>
1. <a href='#97f532917f44d75444a353ff748cf8c1'>RestoreDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#b40b35b760376d82a8e831e93a5519e0'>AddToFavourites</a>
1. <a href='#77e1dad7e8898a51c9e61ce266eb5607'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#dfe9011192eab272cf2bde3358e86ed0'>CreateComplaint</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#0ef947fa1bde7b2bfd8b3d02f5d49c73'>Update</a>
1. <a href='#39a482dd2561ebecf1056b0263f90123'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#75fe03c61e6a9c36dd89fa341ffb34e6'>Update</a>
1. <a href='#7b2bd2a9bf29b33b19541bd68625ee74'>Delete</a>
1. <a href='#d44b4cf9277418d9628f9e02cb1847e3'>Comment</a>

### <a href='#My'>My</a> ###
1. <a href='#7c42c715a02e964a2889306b19fe292c'>Profile</a>
1. <a href='#469f2a8ab70c10e7b8a6c9890ba465ef'>UpdateProfile</a>
1. <a href='#85578e28a8c20f5cd81c7ca1e4de3b08'>Settings</a>
1. <a href='#93fdb34170033523c95e7443bb659e3d'>UpdateSettings</a>

### <a href='#Social'>Social</a> ###
1. <a href='#71917347c17968e3b4669c7949094d34'>FacebookFiends</a>
1. <a href='#6dad9b463ea3565903496bc1edd56282'>TwitterConnect</a>
1. <a href='#3292f47a05d97e9f9f13470ea62f442c'>GetNewNews</a>

### <a href='#User'>User</a> ###
1. <a href='#554e42cda745a0d2b5e81c86bfc574df'>UserByIdDays</a>
1. <a href='#73ae8695e19bf775ce0acdd1ec53f280'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#32b048714ae6af5b2efb4bb536bf5d06'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#6d7369350e532d223fcfcda23249a7b9'>FollowingByUserId</a>
1. <a href='#80cf9f117ce14ef8321b1ec279d648c6'>Follow</a>
1. <a href='#9d4fa0ce6b52a81c475c7567f4b34d42'>Unfollow</a>
1. <a href='#b6a64e411df3885324cb5c0d6b5215e6'>Search</a>


## API methods ##

### Auth ###
<a name='Auth'></a>
#### IsLoggedIn ####
<a name="f3fe153a8e0372904ddc25f133cecd23"></a>
Returns user authentication status.

`GET auth/is_logged_in`



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>bool</td><td>-</td><td>TRUE if user is logged id, else - FALSE</td></tr>

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
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string[118]</td><td>token</td><td>Y</td><td>Facebook access token</td></tr>

</table>
###### Example request: ######
    {
      "token":"AAAFnVo0zuqkBAEaTuz4...l3D155lIWoPIh2wUa6ZA"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User</a></td><td>user</td><td>Authorized user information</td></tr>

</table>
###### Example response: ######
    {
      "user":{
        "id":1783,
        "fb_uid":"100004087981387",
        "twitter_uid":null,
        "name":"bar bar",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1783\/7db593bde9626e62945465ff88e768faf959b8e8_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1783\/7db593bde9626e62945465ff88e768faf959b8e8_140x140.jpeg",
        "birthday":"1980-08-08",
        "occupation":"",
        "location":null,
        "followers_count":0,
        "following_count":0,
        "days_count":0,
        "followers":[
          
        ],
        "following":[
          
        ],
        "email":"bar_gayttkq_bar@tfbnw.net"
      }
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### CurrentDay ###
<a name='CurrentDay'></a>
#### Start ####
<a name="aef4d0c381bfa1dccfdd2216f8f188ef"></a>
Starts a day, returns created <a href="#Entity:Day">day</a>.

`POST current_day/start`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>title</td><td>Y</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>Y</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td>N</td><td>If omited, then user profile occupation will be used</td></tr>
<tr><td>string</td><td>latlong <span class='label label-important'>Removed</span></td><td>N</td><td>"[Latitude],[Longitude]" of place, where day was created</td></tr>
<tr><td>string</td><td>type</td><td>Y</td><td>One of pre-defined types, see: GET day/type_names request</td></tr>

</table>
###### Example request: ######
    {
      "title":"foobarfoobarfoobarfoobarf",
      "timezone":0,
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "type":"working"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
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
      "id":4922,
      "user_id":1791,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1791\/days\/855330b8bdc7d884f0127d00ff6c4780dfaa6fb1_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1791\/days\/855330b8bdc7d884f0127d00ff6c4780dfaa6fb1_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"0",
      "location":null,
      "type":"working",
      "likes_count":0,
      "ctime":1344368086,
      "utime":1344368086,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetCurrentDay ####
<a name="cbad16697e3ffed4670242666474b25b"></a>
Returns current <a href="#Entity:Day">day</a>. Additional fields are listed below.

`GET current_day`



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Moment[3]'>Moment[3]</a></td><td>moments <span class='label label-important'>Removed</span></td><td>Array of day moments</td></tr>
<tr><td>int</td><td>comments_count <span class='label label-important'>Removed</span></td><td>Count of comments to this day</td></tr>
<tr><td><a href='#Entity:Comment[3]'>Comment[3]</a></td><td>comments <span class='label label-important'>Removed</span></td><td>Array of day first comments</td></tr>
<tr><td>bool</td><td>is_favorited <span class='label label-important'>Removed</span></td><td>True if this article is added to current user favourites. If user is not logged in then field is omited.</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
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
      "id":4924,
      "user_id":1793,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1793\/days\/2218c35dde8a3f59cb99cb47420320ca8d6f0c6e_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1793\/days\/2218c35dde8a3f59cb99cb47420320ca8d6f0c6e_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1344368086,
      "utime":1344368086,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateMoment ####
<a name="69e8f640ca26b9cc716ecf64942b8619"></a>
Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.

`POST current_day/moment_create`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>description</td><td>Y</td><td></td></tr>
<tr><td>string</td><td>image_name</td><td>Y</td><td>Requires image_content field.</td></tr>
<tr><td>string</td><td>image_content</td><td>Y</td><td>File contents, that was previously encoded by base64</td></tr>
<tr><td>int</td><td>image_shoot_time</td><td>N</td><td>Unix timestamp of time, when picture was created. If omited, current timestamp will be used.</td></tr>

</table>
###### Example request: ######
    {
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_name":"foobar.jpg",
      "image_content":"\/9j\/4AAQSkZJRgABAQAA...Bpbk4c\/SoY34PFWiGf\/Z",
      "image_shoot_time":133713
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>day_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>description</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_shoot_time</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1130,
      "day_id":4926,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/1795\/days\/4926\/0fd92a7e22f7c7e5c3f8a86a2336664ccc641a33_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/1795\/days\/4926\/0fd92a7e22f7c7e5c3f8a86a2336664ccc641a33_400x400.jpg",
      "image_shoot_time":"133713",
      "likes_count":0,
      "ctime":1344368087
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="9e59ff5a39376390cb691df3c733dffc"></a>
Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.

`POST current_day/update`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>title</td><td>N</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>N</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td>N</td><td>Can be omited, then user profile occupation will be used</td></tr>
<tr><td>string</td><td>latlong <span class='label label-important'>Removed</span></td><td>N</td><td>"[Latitude],[Longitude]" of place, where day was created</td></tr>
<tr><td>string</td><td>type</td><td>N</td><td>One of pre-defined types, see: GET day/type_names request</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":1,
      "location":"foobar",
      "type":"working"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
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
      "id":4928,
      "user_id":1797,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1797\/days\/b6c85e65007bcabcbad8a00d2aa85a1a04757db6_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1797\/days\/b6c85e65007bcabcbad8a00d2aa85a1a04757db6_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1344368088,
      "utime":1344368088,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="edffd7a5f673999b16ade68463815ffe"></a>
Finish current day.

`POST current_day/finish`




<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="ee20261a86ef4343d90c66d70c8c2d64"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/4930/item`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>Y</td><td>Day ID</td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User</a></td><td>user</td><td></td></tr>
<tr><td>int</td><td>comments_count</td><td></td></tr>
<tr><td><a href='#Entity:DayComment[0-3]'>DayComment[0-3]</a></td><td>comments</td><td>Few first comments</td></tr>
<tr><td><a href='#Entity:Moment'>Moment[]</a></td><td>moments</td><td>All day moments</td></tr>
<tr><td>bool</td><td>is_favorited</td><td></td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
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
      "id":4930,
      "fb_uid":"fooba",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1800\/days\/66664fc3250f6ce50e98c6e0380c736b9fe33960_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1800\/days\/66664fc3250f6ce50e98c6e0380c736b9fe33960_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1344368088,
      "utime":1344368088,
      "is_ended":0,
      "user":{
        "id":1800,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_140x140.jpeg",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1,
        "is_followed":false,
        "is_follower":false
      },
      "is_favorited":true,
      "comments_count":4,
      "comments":[
        {
          "id":347,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344368088,
          "utime":1344368088,
          "user":{
            "id":1800,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":348,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344368088,
          "utime":1344368088,
          "user":{
            "id":1800,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":349,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344368088,
          "utime":1344368088,
          "user":{
            "id":1800,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/1800\/2151b98c4b6993083ffbb96eece945c7e63354ee_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        }
      ],
      "moments":[
        {
          "id":1132,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344368088,
          "comments_count":1,
          "comments":[
            {
              "id":299,
              "user_name":"foo foo",
              "text":"foobar",
              "likes_count":0,
              "ctime":1344368088,
              "utime":1344368088,
              "moment_id":1132,
              "user":{
                "id":1801,
                "fb_uid":"100004093051334",
                "twitter_uid":0,
                "name":"foo foo",
                "sex":"male",
                "pic_small":"http:\/\/onedayofmine.dev\/users\/1801\/c16a812a256620a8cab1d7bb4f05de79ec38dd09_70x70.jpeg",
                "pic_big":"http:\/\/onedayofmine.dev\/users\/1801\/c16a812a256620a8cab1d7bb4f05de79ec38dd09_140x140.jpeg",
                "birthday":"1982-08-08",
                "occupation":"",
                "location":"",
                "followers_count":0,
                "following_count":0,
                "days_count":0
              }
            }
          ]
        },
        {
          "id":1133,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344368088,
          "comments_count":0,
          "comments":[
            
          ]
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="8f2afb598b452cfad4eb1a7ae24be42a"></a>
Get few days in one request.

`GET days/4931;4932;247/item`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>ids <span class='label label-important'>Removed</span></td><td>Y</td><td>List of ID's, that was separated by ";".</td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>days <span class='label label-important'>Removed</span></td><td>See GET days/:id/item</td></tr>
<tr><td>[type]</td><td>4931 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>4932 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>247 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "4931":{
        "id":4931,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1802\/days\/c415e7fcc1bf21450045a215f5c04b6a942287ca_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1802\/days\/c415e7fcc1bf21450045a215f5c04b6a942287ca_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368088,
        "utime":1344368088,
        "is_ended":0,
        "user":{
          "id":1802,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1802\/1cf3f915ca6bf8f560d550c023aef78b0e96d708_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1802\/1cf3f915ca6bf8f560d550c023aef78b0e96d708_140x140.jpeg",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1,
          "is_followed":false,
          "is_follower":false
        },
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":1134,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344368088,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "4932":{
        "id":4932,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1803\/days\/0febc054d556cdb402b30416f74e6166e217eb7c_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1803\/days\/0febc054d556cdb402b30416f74e6166e217eb7c_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368088,
        "utime":1344368088,
        "is_ended":0,
        "user":{
          "id":1803,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1803\/8e791af597fc55c0969fb96057b386d530444a2b_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1803\/8e791af597fc55c0969fb96057b386d530444a2b_140x140.jpeg",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1,
          "is_followed":false,
          "is_follower":false
        },
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":1135,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344368088,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "247":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="c19fc41a7f93de419c9975a9aa1c22a6"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/4934/comment_create`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>Y</td><td></td></tr>
<tr><td>string</td><td>text</td><td>Y</td><td>Comment contents</td></tr>

</table>
###### Example request: ######
    {
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>day_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":351,
      "user_id":1807,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344368089,
      "utime":1344368089,
      "day_id":4934
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="36b7f3f041e299c379632978bb1dd49d"></a>
Share a day

`POST days/4935/share`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>Y</td><td></td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":"100004087981387_120741434737689"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="187eeda967e32a222612fbdb45463354"></a>


`POST days/4936/like`



##### Response: #####

###### Example response: ######
    "TODO"


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Search ####
<a name="09f10c6db22580edd1ebac5ba800cc23"></a>


`GET days/search`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>query</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "query":"foo",
      "from":4940,
      "to":4937,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
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
        "id":4939,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1812\/days\/1f2128e0a3b841b20bee59c94a8ed5c076f12688_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1812\/days\/1f2128e0a3b841b20bee59c94a8ed5c076f12688_400x400.jpeg",
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368092,
        "utime":1344368092,
        "is_ended":0,
        "user":{
          "id":1812,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1812\/be1536d23aa08280bd64f757153b891c7f811385_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1812\/be1536d23aa08280bd64f757153b891c7f811385_140x140.jpeg",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":5
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="a61f99b852e1d54bb23391db532496be"></a>
Updates a day

`POST days/4943/update`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>Y</td><td></td></tr>
<tr><td>[type]</td><td>title</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "title":"foobar",
      "occupation":"foobar",
      "timezone":1,
      "location":"foobar",
      "type":"working"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
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
      "id":4943,
      "user_id":1814,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1814\/days\/4285e3fb7e9160ece3f4ec409f287b49b28992ef_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1814\/days\/4285e3fb7e9160ece3f4ec409f287b49b28992ef_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobar",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1344368092,
      "utime":1344368092,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="94f899a8a91491430aa3d01272c688c6"></a>
Deletes a day

`POST days/4944/delete`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>Y</td><td></td></tr>

</table>



<a href="#toc">^ back to Table of conetens</a>

* * *
#### RestoreDay ####
<a name="97f532917f44d75444a353ff748cf8c1"></a>
Restore a deleted day

`POST days/4946/restore`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>Y</td><td></td></tr>

</table>



<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFavouriteDays ####
<a name="9a54a19098a30dcbd74124cbddb1ab6c"></a>
Returns favourite based on <a href="#range-request">range-request</a>.

`GET days/favourites`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>from</td><td>N</td><td></td></tr>
<tr><td>int</td><td>to</td><td>N</td><td></td></tr>
<tr><td>int</td><td>limit</td><td>N</td><td></td></tr>

</table>
###### Example request: ######
    {
      "from":4951,
      "to":4948,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>day <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":4950,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1823\/days\/fc09777c2e05c437db4b5c823f48877ccf4839da_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1823\/days\/fc09777c2e05c437db4b5c823f48877ccf4839da_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368094,
        "utime":1344368094,
        "is_ended":0,
        "user":{
          "id":1823,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1823\/3d3c807750520757e7b48eeaf08430e0963207e0_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1823\/3d3c807750520757e7b48eeaf08430e0963207e0_140x140.jpeg",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":4,
          "is_followed":false,
          "is_follower":false
        },
        "is_favorited":true
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="b40b35b760376d82a8e831e93a5519e0"></a>


`POST /days/4953/favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="77e1dad7e8898a51c9e61ce266eb5607"></a>


`POST /days/4954/unfavourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFollowingUsersDays ####
<a name="1c5e784108f8a36beb283dc7a3e34030"></a>
Returns following users days based on <a href="#range-request">range-request</a>.

`GET days/following_users/`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>from</td><td>N</td><td></td></tr>
<tr><td>int</td><td>to</td><td>N</td><td></td></tr>
<tr><td>int</td><td>limit</td><td>N</td><td></td></tr>

</table>
###### Example request: ######
    {
      "from":4958,
      "to":4955,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>day <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":4957,
        "user_id":1830,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1830\/days\/4c6d75037b43acbbd9ed2d92bfcd7d86f2dc91f0_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1830\/days\/4c6d75037b43acbbd9ed2d92bfcd7d86f2dc91f0_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368095,
        "utime":1344368095,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>
Returns new days based on <a href="#range-request">range-request</a>.

`GET days/new/`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>from</td><td>N</td><td></td></tr>
<tr><td>int</td><td>to</td><td>N</td><td></td></tr>
<tr><td>int</td><td>limit</td><td>N</td><td></td></tr>

</table>
###### Example request: ######
    {
      "from":4964,
      "to":4960,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>day <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":4963,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1831\/days\/9594322fb9a3d9067898c5559172a0ba33fa560e_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1831\/days\/9594322fb9a3d9067898c5559172a0ba33fa560e_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368096,
        "utime":1344368096,
        "is_ended":0,
        "user":{
          "id":1831,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1831\/2e16f01635aec4ca16318bd59f292762c2a9c982_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1831\/2e16f01635aec4ca16318bd59f292762c2a9c982_140x140.jpeg",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetInterestingDays ####
<a name="58c74019b980810ae9e042bb65573a7a"></a>
Returns interesting days based on <a href="#range-request">range-request</a>.

`GET days/interesting/`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>from</td><td>N</td><td></td></tr>
<tr><td>int</td><td>to</td><td>N</td><td></td></tr>
<tr><td>int</td><td>limit</td><td>N</td><td></td></tr>

</table>
###### Example request: ######
    {
      "from":4965,
      "to":4968,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>day <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":4966,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1833\/days\/527c393ffb9167c3a0757eb013a78ab244111051_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1833\/days\/527c393ffb9167c3a0757eb013a78ab244111051_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":3,
        "ctime":1344281696,
        "utime":1344368096,
        "is_ended":0,
        "user":{
          "id":1833,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1833\/223de5850f0a6484cf0db364d3f7da87eaf1087b_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1833\/223de5850f0a6484cf0db364d3f7da87eaf1087b_140x140.jpeg",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":2
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CurrentUserDays ####
<a name="f2c5afe4a024dc21f1c43ff206afb8f1"></a>
Returns current user days based on <a href="#range-request">range-request</a>.

`GET days/my`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>from</td><td>N</td><td></td></tr>
<tr><td>int</td><td>to</td><td>N</td><td></td></tr>
<tr><td>int</td><td>limit</td><td>N</td><td></td></tr>

</table>
###### Example request: ######
    {
      "from":4973,
      "to":4970,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>day <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":4972,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1835\/days\/9472422eb9d8c563971b56c77ca7d9564a55508c_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1835\/days\/9472422eb9d8c563971b56c77ca7d9564a55508c_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368096,
        "utime":1344368096,
        "is_ended":0,
        "user":{
          "id":1835,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1835\/07d755c015c5c113ea795634e7d31c114f81ad19_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1835\/07d755c015c5c113ea795634e7d31c114f81ad19_140x140.jpeg",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3
        },
        "is_favorited":false
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### TypeNames ####
<a name="bdbebf26e7d0327181a566595a2fcd56"></a>
Returns list of acceptable types.

`GET days/type_names`



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>0</td><td>[description]</td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>
<tr><td>[type]</td><td>2</td><td>[description]</td></tr>
<tr><td>[type]</td><td>3</td><td>[description]</td></tr>
<tr><td>[type]</td><td>4</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      "working",
      "day-off",
      "holiday",
      "trip",
      "special_event"
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateComplaint ####
<a name="dfe9011192eab272cf2bde3358e86ed0"></a>


`POST /days/4974/create_complaint`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of abused comment</td></tr>
<tr><td>string</td><td>text</td><td>Y</td><td>Abuse description message</td></tr>

</table>
###### Example request: ######
    {
      "text":"foobar"
    }



##### Response: #####
###### Fields: ######
<table class="table">
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
      "text":"foobar",
      "ctime":1344368097,
      "id":74
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### MomentComments ###
<a name='MomentComments'></a>
#### Update ####
<a name="0ef947fa1bde7b2bfd8b3d02f5d49c73"></a>


`POST /moment_comments/300/update`

##### Request: #####
###### Params: ######
<table class="table">
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
      "text":"foobarfo"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moment_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":300,
      "user_id":1845,
      "user_name":"bar bar",
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1344368111,
      "utime":1344368112,
      "moment_id":1139
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="39a482dd2561ebecf1056b0263f90123"></a>


`POST /moment_comments/302/delete`

##### Request: #####
###### Params: ######
<table class="table">
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
      "text":"foobarfo"
    }




<a href="#toc">^ back to Table of conetens</a>

* * *

### Moments ###
<a name='Moments'></a>
#### Update ####
<a name="75fe03c61e6a9c36dd89fa341ffb34e6"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/1143/update`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>description</td><td>N</td><td></td></tr>
<tr><td>string</td><td>image_name</td><td>N</td><td>Requires image_content field.</td></tr>
<tr><td>string</td><td>image_content</td><td>N</td><td>File contents, that was previously encoded by base64</td></tr>

</table>
###### Example request: ######
    {
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_name":"foobar.jpg",
      "image_content":"\/9j\/4AAQSkZJRgABAQAA...Bpbk4c\/SoY34PFWiGf\/Z"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>day_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>description</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_shoot_time</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1143,
      "day_id":4985,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/1855\/days\/4985\/340df2fac02a4e219e00db06268c91730a5f0020_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/1855\/days\/4985\/340df2fac02a4e219e00db06268c91730a5f0020_400x400.jpg",
      "image_shoot_time":0,
      "likes_count":0,
      "ctime":1344368112
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="7b2bd2a9bf29b33b19541bd68625ee74"></a>
Delete a moment.

`POST moments/1144/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="d44b4cf9277418d9628f9e02cb1847e3"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/1145/comment`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>text</td><td>Y</td><td></td></tr>

</table>
###### Example request: ######
    {
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moment_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":304,
      "user_id":1857,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344368113,
      "utime":1344368113,
      "moment_id":1145
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### My ###
<a name='My'></a>
#### Profile ####
<a name="7c42c715a02e964a2889306b19fe292c"></a>
Returns <a href="#Entity:User">profile</a> of current logged in user.

`GET /my/profile`



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1858,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/1858\/1ddc6601059e76878557a06624d68dbf911a7f04_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/1858\/1ddc6601059e76878557a06624d68dbf911a7f04_140x140.jpeg",
      "birthday":"1980-08-08",
      "occupation":"",
      "location":"",
      "followers_count":0,
      "following_count":0,
      "days_count":0,
      "email":"bar_gayttkq_bar@tfbnw.net"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateProfile ####
<a name="469f2a8ab70c10e7b8a6c9890ba465ef"></a>
Changes fields of current user <a href="#Entity:User">profile</a> and returns them (with new values). You are free to make selective changes.

`POST /my/profile`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_name</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_content</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "name":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfoobarf",
      "location":"foobarfoobarfoobarfoobarf",
      "email":"foobarfoobarfoobarfo@odm.com",
      "birthday":"1990-01-02",
      "pic_name":"foobar.jpg",
      "pic_content":"\/9j\/4AAQSkZJRgABAQAA...Bpbk4c\/SoY34PFWiGf\/Z"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1859,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/1859\/461aef2d5cf208a394379cf10b3167a97be96839_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/1859\/461aef2d5cf208a394379cf10b3167a97be96839_140x140.jpeg",
      "birthday":"1990-01-02",
      "occupation":"foobarfoobarfoobarfoobarf",
      "location":"foobarfoobarfoobarfoobarf",
      "followers_count":0,
      "following_count":0,
      "days_count":0,
      "email":"foobarfoobarfoobarfo@odm.com"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Settings ####
<a name="85578e28a8c20f5cd81c7ca1e4de3b08"></a>


`GET /my/settings/`



##### Response: #####
###### Fields: ######
<table class="table">
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
<tr><td>[type]</td><td>social_share_facebook</td><td>[description]</td></tr>
<tr><td>[type]</td><td>social_share_twitter</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":8533,
      "notifications_new_days":1,
      "notifications_new_comments":0,
      "notifications_related_activity":1,
      "notifications_shooting_photos":0,
      "photos_save_original":1,
      "photos_save_filtered":0,
      "social_share_facebook":0,
      "social_share_twitter":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UpdateSettings ####
<a name="93fdb34170033523c95e7443bb659e3d"></a>


`POST /my/settings/`

##### Request: #####
###### Params: ######
<table class="table">
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
<table class="table">
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
<tr><td>[type]</td><td>social_share_facebook</td><td>[description]</td></tr>
<tr><td>[type]</td><td>social_share_twitter</td><td>[description]</td></tr>
<tr><td>[type]</td><td>uip</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":8535,
      "notifications_new_days":1,
      "notifications_new_comments":1,
      "notifications_related_activity":1,
      "notifications_shooting_photos":1,
      "photos_save_original":1,
      "photos_save_filtered":1,
      "social_share_facebook":0,
      "social_share_twitter":0,
      "uip":2130706433
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### Social ###
<a name='Social'></a>
#### FacebookFiends ####
<a name="71917347c17968e3b4669c7949094d34"></a>


`GET social/facebook_friends`



##### Response: #####
###### Fields: ######
<table class="table">
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
        "id":1887,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1887\/10fc56cd417a8089c9691b1896836ea58314356f_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1887\/10fc56cd417a8089c9691b1896836ea58314356f_140x140.jpeg",
        "birthday":"1982-08-08",
        "occupation":"",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":0,
        "user_info":null
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### TwitterConnect ####
<a name="6dad9b463ea3565903496bc1edd56282"></a>


`POST social/twitter_connect`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>access_token</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>access_token_secret</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "access_token":"637083468-nBzWGwpdfgTqrg2H3DZwnSgBWwMkbNmxVrwCVepx",
      "access_token_secret":"4jWX2ozuXHcY4yRwqjFBUfV08t7kFjfxBR1OCV7Y0"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>pic_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1888,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/1888\/3861817d3c79cce8ccee73d7d5bbd7ced5d37242_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/1888\/3861817d3c79cce8ccee73d7d5bbd7ced5d37242_140x140.jpeg",
      "birthday":"1980-08-08",
      "occupation":"",
      "location":"",
      "followers_count":0,
      "following_count":0,
      "days_count":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewNews ####
<a name="3292f47a05d97e9f9f13470ea62f442c"></a>
Returns news for current logged in user.

`GET social/news`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>from</td><td>Y</td><td></td></tr>
<tr><td>int</td><td>to</td><td>Y</td><td></td></tr>
<tr><td>int</td><td>limit</td><td>Y</td><td></td></tr>

</table>
###### Example request: ######
    {
      "from":1112,
      "to":1109,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:News'>News[]</a></td><td>- <span class='label label-important'>Removed</span></td><td>List of news. If you use the "from" option (wthout "to") and returned list is empty, than additionally HTTP 304 status code can be returned.</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":1111,
        "recipient_id":1891,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1344368122,
        "user":{
          "id":1895,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/1895\/77c4cadb9905b1f788f2ffc0bb319b08ffacb63c_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/1895\/77c4cadb9905b1f788f2ffc0bb319b08ffacb63c_140x140.jpeg",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":4995,
          "user_id":1894,
          "fb_uid":"fooba",
          "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1894\/days\/c7dc881a93e3eeeee53a7f5d6529cc9b2c42ec27_200x200.jpeg",
          "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1894\/days\/c7dc881a93e3eeeee53a7f5d6529cc9b2c42ec27_400x400.jpeg",
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "timezone":0,
          "location":"foobarfoobarfoobarfoobarf",
          "type":"working",
          "likes_count":0,
          "ctime":1344368122,
          "utime":1344368122,
          "is_ended":0
        },
        "moment":{
          "id":1149,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344368122
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="554e42cda745a0d2b5e81c86bfc574df"></a>
Returns days of specified user

`GET users/1931/days/`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of user</td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>days <span class='label label-important'>Removed</span></td><td></td></tr>
<tr><td>[type]</td><td>1</td><td>[description]</td></tr>

</table>
###### Example response: ######
    [
      {
        "id":5002,
        "user_id":1931,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1931\/days\/dc4ec35881434e7944ed3260efbafd710455033f_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1931\/days\/dc4ec35881434e7944ed3260efbafd710455033f_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368130,
        "utime":1344368130,
        "is_ended":0
      },
      {
        "id":5003,
        "user_id":1931,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/1931\/days\/6cd1f3a47cfa1d75e51777aae289094dd8d292bc_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/1931\/days\/6cd1f3a47cfa1d75e51777aae289094dd8d292bc_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344368130,
        "utime":1344368130,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="73ae8695e19bf775ce0acdd1ec53f280"></a>
Returns days of specified user

`GET users/1933/item/`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of user</td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>User ID</td></tr>
<tr><td>string</td><td>fb_uid</td><td>Facebook user ID</td></tr>
<tr><td>string</td><td>twitter_uid</td><td>Twitter user ID</td></tr>
<tr><td>string</td><td>name</td><td>Displayed name of the user</td></tr>
<tr><td>string</td><td>sex</td><td>Gender {male,female}.</td></tr>
<tr><td>string</td><td>pic_small</td><td>URL to small variant of user avatar</td></tr>
<tr><td>string</td><td>pic_big</td><td>URL to big variant of user avatar</td></tr>
<tr><td>string</td><td>birthday</td><td>Date of user birthday in format "YYYY-MM-DD"</td></tr>
<tr><td>string</td><td>occupation</td><td>User occupation</td></tr>
<tr><td>string</td><td>location</td><td>User location. Usually, but not always, in format "[city], [country]".</td></tr>
<tr><td>int</td><td>followers_count</td><td>Count of users, that follow selected user</td></tr>
<tr><td>int</td><td>following_count</td><td>Count of users, that is followed by selected user</td></tr>
<tr><td>int</td><td>days_count</td><td>Count of days, that was created by selected user</td></tr>
<tr><td>bool</td><td>is_follower</td><td>TRUE if current logged in user if followed by selected user. Can be ommited if selected user is same as current logged in.</td></tr>
<tr><td>bool</td><td>is_followed</td><td>TRUE if selected user is followed by current logged in user. Can be ommited if selected user is same as current logged in.</td></tr>

</table>
###### Example response: ######
    {
      "id":1933,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/1933\/1be6c0df3b62fee7c7d94263ae1f2bc0cd38a5d3_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/1933\/1be6c0df3b62fee7c7d94263ae1f2bc0cd38a5d3_140x140.jpeg",
      "birthday":"1980-08-08",
      "occupation":"",
      "location":"",
      "followers_count":1,
      "following_count":1,
      "days_count":0,
      "is_followed":true,
      "is_follower":true
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Followers ####
<a name="0907aac9dba2a8f9700b9333f7e36795"></a>
Returns list of users that follow current logged in user.

`GET users/followers`



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User[]</a></td><td>followers <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":1938,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1938\/9fbdb32bec584df74d0cc27e1afcdcbca1dc5165_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1938\/9fbdb32bec584df74d0cc27e1afcdcbca1dc5165_140x140.jpeg",
        "birthday":"1982-08-08",
        "occupation":"",
        "location":"",
        "followers_count":0,
        "following_count":1,
        "days_count":0,
        "is_followed":false
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowersByUserId ####
<a name="32b048714ae6af5b2efb4bb536bf5d06"></a>
Returns list of users that follow selected user.

`GET users/1939/followers`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of user</td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User[]</a></td><td>followers <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":1940,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1940\/87a8e6adf2d78754b92eae2fa6ce41328a3732b5_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1940\/87a8e6adf2d78754b92eae2fa6ce41328a3732b5_140x140.jpeg",
        "birthday":"1982-08-08",
        "occupation":"",
        "location":"",
        "followers_count":0,
        "following_count":1,
        "days_count":0,
        "is_followed":false
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Following ####
<a name="774c23c770724885bdc9325b3159b700"></a>
Returns list of users that is followed by current logged in user.

`GET users/following`



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User[]</a></td><td>followed <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":1942,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1942\/7744255b24040f39898d95eede789a050654b95b_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1942\/7744255b24040f39898d95eede789a050654b95b_140x140.jpeg",
        "birthday":"1982-08-08",
        "occupation":"",
        "location":"",
        "followers_count":1,
        "following_count":0,
        "days_count":0,
        "is_follower":false
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### FollowingByUserId ####
<a name="6d7369350e532d223fcfcda23249a7b9"></a>
Returns list of users that is followed by selected user.

`GET users/1943/following`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of user</td></tr>

</table>


##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User[]</a></td><td>followed <span class='label label-important'>Removed</span></td><td></td></tr>

</table>
###### Example response: ######
    [
      {
        "id":1944,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1944\/36d0f9e0e2945b6dd13a16e247f8806d15d7c25e_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1944\/36d0f9e0e2945b6dd13a16e247f8806d15d7c25e_140x140.jpeg",
        "birthday":"1982-08-08",
        "occupation":"",
        "location":"",
        "followers_count":1,
        "following_count":0,
        "days_count":0,
        "is_follower":false
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Follow ####
<a name="80cf9f117ce14ef8321b1ec279d648c6"></a>
Start following selected user.

`POST users/1946/follow`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of user that you want to follow</td></tr>

</table>



<a href="#toc">^ back to Table of conetens</a>

* * *
#### Unfollow ####
<a name="9d4fa0ce6b52a81c475c7567f4b34d42"></a>
Stop following selected user.

`POST users/1948/unfollow`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>Y</td><td>ID of user that should be unfollowed</td></tr>

</table>



<a href="#toc">^ back to Table of conetens</a>

* * *
#### Search ####
<a name="b6a64e411df3885324cb5c0d6b5215e6"></a>


`GET users/search`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>query</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "query":"foo",
      "from":1949,
      "to":1952,
      "limit":1
    }



##### Response: #####
###### Fields: ######
<table class="table">
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
        "id":1950,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"fooA",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/1950\/bea6cd4da0a8ef402c3159ca8333760eff3bb092_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/1950\/bea6cd4da0a8ef402c3159ca8333760eff3bb092_140x140.jpeg",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
