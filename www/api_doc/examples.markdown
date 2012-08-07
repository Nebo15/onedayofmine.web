# API #
 Version: 07.08.12 17:02:15

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
1. <a href='#a9f188477a29a57d862cf6bc8ca93369'>Item</a>
1. <a href='#f054aaa930a281032bcb4e0302cee117'>Item_Many</a>
1. <a href='#6b12a3115b9a7063a46c52677a97f649'>CommentCreate</a>
1. <a href='#437eb1c05383940b9d037ea73207cc57'>ShareDay</a>
1. <a href='#9be44e3dda39d025b59364534eb4600d'>Like</a>
1. <a href='#d40553d4369e29387c97e5b8f078b566'>Update</a>
1. <a href='#884c2fc8bea0ab570ce5d84680ea05d7'>DeleteDay</a>
1. <a href='#7b782aeeb96058088ed84b0e221f0b45'>RestoreDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#2e45e8b6fe749a4be75e49721666d31b'>AddToFavourites</a>
1. <a href='#1ba59504a4bf2d9ad3e87ae2b6587b6e'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#969b45a924776e1293c8ca33e0ae291f'>CreateComplaint</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#058f53efd3e971ea34a364db59f2ae5f'>Update</a>
1. <a href='#947714a57b855e26c3a097169401058b'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#d7d906bf3ac90a3dc9bb0437df792c86'>Update</a>
1. <a href='#de1108fc047a8991b1c9500268d73397'>Delete</a>
1. <a href='#dd262e0b66c345195a413c21bc6b3875'>Comment</a>

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
1. <a href='#e1a5c2429a9ef7c339951d762c694226'>UserByIdDays</a>
1. <a href='#4beb0bc5141edef59eaf74f7333f0fc7'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#760e28104e5420ab797e29e17a7d67a3'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#d89f3f9272a22c36dfc53e7cad4a0b34'>FollowingByUserId</a>
1. <a href='#f64003292a2ec8b916ed06006df3bd68'>Follow</a>
1. <a href='#f759b79021d897664194fda347130294'>Unfollow</a>


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
      "token":"AAAFnVo0zuqkBADH1kTQ...0enm7lKQaar7ACFZCF7n"
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
        "id":4132,
        "fb_uid":"100004087981387",
        "twitter_uid":null,
        "name":"bar bar",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4132\/f657d9420b7733502a39af58a8c11a38bf63c323_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4132\/f657d9420b7733502a39af58a8c11a38bf63c323_140x140.jpeg",
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
      "id":2807,
      "user_id":4140,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4140\/days\/d975eb97576a17365158eb45d4c6d0300cf5fdd0_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4140\/days\/d975eb97576a17365158eb45d4c6d0300cf5fdd0_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"0",
      "location":null,
      "type":"working",
      "likes_count":0,
      "ctime":1344348097,
      "utime":1344348097,
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
      "id":2809,
      "user_id":4142,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4142\/days\/6f0cf44204a0d3fb7013175b350dcf517b2a7de7_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4142\/days\/6f0cf44204a0d3fb7013175b350dcf517b2a7de7_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1344348097,
      "utime":1344348097,
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
      "id":558,
      "day_id":2811,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/4144\/days\/2811\/82fa0fbc4a6f182ec4ab5590ce5493256df3b53e_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/4144\/days\/2811\/82fa0fbc4a6f182ec4ab5590ce5493256df3b53e_400x400.jpg",
      "image_shoot_time":"133713",
      "likes_count":0,
      "ctime":1344348098
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
      "id":2813,
      "user_id":4146,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4146\/days\/2fdac458eea96c2ed4b2c4a95562335b5f5aba8b_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4146\/days\/2fdac458eea96c2ed4b2c4a95562335b5f5aba8b_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1344348099,
      "utime":1344348099,
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
<a name="a9f188477a29a57d862cf6bc8ca93369"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/2815/item`

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
      "id":2815,
      "fb_uid":"fooba",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4149\/days\/91f14d15354189228a27b1d83e2c7aad1bc83971_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4149\/days\/91f14d15354189228a27b1d83e2c7aad1bc83971_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1344348099,
      "utime":1344348099,
      "is_ended":0,
      "user":{
        "id":4149,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_140x140.jpeg",
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
          "id":173,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344348099,
          "utime":1344348099,
          "user":{
            "id":4149,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":174,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344348099,
          "utime":1344348099,
          "user":{
            "id":4149,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":175,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344348099,
          "utime":1344348099,
          "user":{
            "id":4149,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/4149\/bca9b36c1dec98c000367251be87c2a95cdbd352_140x140.jpeg",
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
          "id":560,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344348099,
          "comments_count":1,
          "comments":[
            {
              "id":125,
              "user_name":"foo foo",
              "text":"foobar",
              "likes_count":0,
              "ctime":1344348099,
              "utime":1344348099,
              "moment_id":560,
              "user":{
                "id":4150,
                "fb_uid":"100004093051334",
                "twitter_uid":0,
                "name":"foo foo",
                "sex":"male",
                "pic_small":"http:\/\/onedayofmine.dev\/users\/4150\/04aa8b4fd64f4367cf6cc24988b4e025a0a5b017_70x70.jpeg",
                "pic_big":"http:\/\/onedayofmine.dev\/users\/4150\/04aa8b4fd64f4367cf6cc24988b4e025a0a5b017_140x140.jpeg",
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
          "id":561,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344348099,
          "comments_count":0,
          "comments":[
            
          ]
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="f054aaa930a281032bcb4e0302cee117"></a>
Get few days in one request.

`GET days/2816;2817;903/item`

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
<tr><td>[type]</td><td>2816 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>2817 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>903 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "2816":{
        "id":2816,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4151\/days\/61d47b6c6479e878e5e368b460c1a05be83c3abb_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4151\/days\/61d47b6c6479e878e5e368b460c1a05be83c3abb_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348099,
        "utime":1344348099,
        "is_ended":0,
        "user":{
          "id":4151,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4151\/840bc6c4c4dea1c9c5a24a645ede203a9d3166df_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4151\/840bc6c4c4dea1c9c5a24a645ede203a9d3166df_140x140.jpeg",
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
            "id":562,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344348099,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "2817":{
        "id":2817,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4152\/days\/a17336f9e3cec1f5041be005f03df09d2f39a4cf_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4152\/days\/a17336f9e3cec1f5041be005f03df09d2f39a4cf_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348099,
        "utime":1344348099,
        "is_ended":0,
        "user":{
          "id":4152,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4152\/98e1d63f242668cee443dad17cb8f416eb9eca44_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4152\/98e1d63f242668cee443dad17cb8f416eb9eca44_140x140.jpeg",
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
            "id":563,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344348099,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "903":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="6b12a3115b9a7063a46c52677a97f649"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/2819/comment_create`

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
      "id":177,
      "user_id":4156,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344348100,
      "utime":1344348100,
      "day_id":2819
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="437eb1c05383940b9d037ea73207cc57"></a>
Share a day

`POST days/2820/share`

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
      "id":"100004087981387_428876383822942"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="9be44e3dda39d025b59364534eb4600d"></a>


`POST days/2821/like`



##### Response: #####

###### Example response: ######
    "TODO"


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="d40553d4369e29387c97e5b8f078b566"></a>
Updates a day

`POST days/2822/update`

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
      "id":2822,
      "user_id":4161,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4161\/days\/60695941f8f153904b606df2e7d945952870b0c3_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4161\/days\/60695941f8f153904b606df2e7d945952870b0c3_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobar",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1344348101,
      "utime":1344348102,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="884c2fc8bea0ab570ce5d84680ea05d7"></a>
Deletes a day

`POST days/2823/delete`

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
<a name="7b782aeeb96058088ed84b0e221f0b45"></a>
Restore a deleted day

`POST days/2825/restore`

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
      "from":2830,
      "to":2827,
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
        "id":2829,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4170\/days\/04a92176554801f4d6a6f23d8d700ea9f2d30cb2_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4170\/days\/04a92176554801f4d6a6f23d8d700ea9f2d30cb2_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348104,
        "utime":1344348104,
        "is_ended":0,
        "user":{
          "id":4170,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4170\/2dcd46c5bb3ab98ffb2637022fca22a56e126755_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4170\/2dcd46c5bb3ab98ffb2637022fca22a56e126755_140x140.jpeg",
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
<a name="2e45e8b6fe749a4be75e49721666d31b"></a>


`POST /days/2832/favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="1ba59504a4bf2d9ad3e87ae2b6587b6e"></a>


`POST /days/2833/unfavourite`




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
      "from":2837,
      "to":2834,
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
        "id":2836,
        "user_id":4177,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4177\/days\/c16146bfb4693746e9429b82494e2cd1e6841738_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4177\/days\/c16146bfb4693746e9429b82494e2cd1e6841738_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348105,
        "utime":1344348105,
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
      "from":2843,
      "to":2839,
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
        "id":2842,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4178\/days\/eb3b29140274946862fd1d6b570a18a68829b2bb_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4178\/days\/eb3b29140274946862fd1d6b570a18a68829b2bb_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348106,
        "utime":1344348106,
        "is_ended":0,
        "user":{
          "id":4178,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4178\/aaa59c041f70f4634c8667e254ace81a0b23bde3_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4178\/aaa59c041f70f4634c8667e254ace81a0b23bde3_140x140.jpeg",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3,
          "is_followed":false,
          "is_follower":false
        },
        "is_favorited":false
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
      "from":2844,
      "to":2847,
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
        "id":2845,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4180\/days\/9568b248ec9c5142fb0dbf8bf8e3c59a62b41afa_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4180\/days\/9568b248ec9c5142fb0dbf8bf8e3c59a62b41afa_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":3,
        "ctime":1344261706,
        "utime":1344348106,
        "is_ended":0,
        "user":{
          "id":4180,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4180\/3abb1d805a8f453e0fc73cb22b712b4c58223ed1_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4180\/3abb1d805a8f453e0fc73cb22b712b4c58223ed1_140x140.jpeg",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":2,
          "is_followed":false,
          "is_follower":false
        },
        "is_favorited":false
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
      "from":2852,
      "to":2849,
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
        "id":2851,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4182\/days\/67341d2831231dbd971ba2c8d82845dabcb88eca_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4182\/days\/67341d2831231dbd971ba2c8d82845dabcb88eca_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348107,
        "utime":1344348107,
        "is_ended":0,
        "user":{
          "id":4182,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4182\/9df217f903049a37556dee6a347acc94272fe70c_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4182\/9df217f903049a37556dee6a347acc94272fe70c_140x140.jpeg",
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
<a name="969b45a924776e1293c8ca33e0ae291f"></a>


`POST /days/2853/create_complaint`

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
      "ctime":1344348108,
      "id":53
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### MomentComments ###
<a name='MomentComments'></a>
#### Update ####
<a name="058f53efd3e971ea34a364db59f2ae5f"></a>


`POST /moment_comments/126/update`

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
      "id":126,
      "user_id":4192,
      "user_name":"bar bar",
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1344348112,
      "utime":1344348112,
      "moment_id":567
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="947714a57b855e26c3a097169401058b"></a>


`POST /moment_comments/128/delete`

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
<a name="d7d906bf3ac90a3dc9bb0437df792c86"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/571/update`

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
      "id":571,
      "day_id":2864,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/4202\/days\/2864\/5b4cd5dc3f5cbdb33eb2152775692ce66aafe150_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/4202\/days\/2864\/5b4cd5dc3f5cbdb33eb2152775692ce66aafe150_400x400.jpg",
      "image_shoot_time":0,
      "likes_count":0,
      "ctime":1344348113
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="de1108fc047a8991b1c9500268d73397"></a>
Delete a moment.

`POST moments/572/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="dd262e0b66c345195a413c21bc6b3875"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/573/comment`

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
      "id":130,
      "user_id":4204,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344348116,
      "utime":1344348116,
      "moment_id":573
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
      "id":4205,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/4205\/b71920f35bf18b00e5d91fcab16c9949dd5d9f38_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/4205\/b71920f35bf18b00e5d91fcab16c9949dd5d9f38_140x140.jpeg",
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
      "id":4206,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/4206\/797422481144b9e324086d432a432f17912b7624_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/4206\/797422481144b9e324086d432a432f17912b7624_140x140.jpeg",
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
      "id":3958,
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
      "id":3960,
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
        "id":4234,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4234\/5d8df61052696c47dbe9a441c908423423afd547_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4234\/5d8df61052696c47dbe9a441c908423423afd547_140x140.jpeg",
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
      "id":4235,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/4235\/bc51826fa933cbc67b9668fcb026c2bb5f8d6d81_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/4235\/bc51826fa933cbc67b9668fcb026c2bb5f8d6d81_140x140.jpeg",
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
      "from":549,
      "to":546,
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
        "id":548,
        "recipient_id":4238,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1344348126,
        "user":{
          "id":4242,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/4242\/36b92a699ff6ce4be974d165c58dd0058c279f59_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/4242\/36b92a699ff6ce4be974d165c58dd0058c279f59_140x140.jpeg",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":2874,
          "user_id":4241,
          "fb_uid":"fooba",
          "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4241\/days\/455957c68755e091949759b8f156d79a4e4639a8_200x200.jpeg",
          "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4241\/days\/455957c68755e091949759b8f156d79a4e4639a8_400x400.jpeg",
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "timezone":0,
          "location":"foobarfoobarfoobarfoobarf",
          "type":"working",
          "likes_count":0,
          "ctime":1344348126,
          "utime":1344348126,
          "is_ended":0
        },
        "moment":{
          "id":577,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344348126
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="e1a5c2429a9ef7c339951d762c694226"></a>
Returns days of specified user

`GET users/4278/days/`

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
        "id":2881,
        "user_id":4278,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4278\/days\/54cfdcf09cf17fa1beb5f9c274732be9728f38fa_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4278\/days\/54cfdcf09cf17fa1beb5f9c274732be9728f38fa_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348131,
        "utime":1344348131,
        "is_ended":0
      },
      {
        "id":2882,
        "user_id":4278,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/4278\/days\/8c8163289cd34d4a4e389b4a5f4d7cb13c117e66_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/4278\/days\/8c8163289cd34d4a4e389b4a5f4d7cb13c117e66_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344348131,
        "utime":1344348131,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="4beb0bc5141edef59eaf74f7333f0fc7"></a>
Returns days of specified user

`GET users/4280/item/`

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
      "id":4280,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/4280\/292ceaf9ca9001e8b43c1047d5ebabe9a0c0280e_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/4280\/292ceaf9ca9001e8b43c1047d5ebabe9a0c0280e_140x140.jpeg",
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
        "id":4285,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4285\/13a785ea07889b604dc7445f523d7fa57b58086c_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4285\/13a785ea07889b604dc7445f523d7fa57b58086c_140x140.jpeg",
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
<a name="760e28104e5420ab797e29e17a7d67a3"></a>
Returns list of users that follow selected user.

`GET users/4286/followers`

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
        "id":4287,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4287\/00c6da404f1a03ed466e1e48b222ef6699102e3e_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4287\/00c6da404f1a03ed466e1e48b222ef6699102e3e_140x140.jpeg",
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
        "id":4289,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4289\/d080d1be26aef837ec0157597821476aa7850dac_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4289\/d080d1be26aef837ec0157597821476aa7850dac_140x140.jpeg",
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
<a name="d89f3f9272a22c36dfc53e7cad4a0b34"></a>
Returns list of users that is followed by selected user.

`GET users/4290/following`

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
        "id":4291,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/4291\/93f31734a236f7c7d53f9d26b8faf8ef073c2b09_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/4291\/93f31734a236f7c7d53f9d26b8faf8ef073c2b09_140x140.jpeg",
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
<a name="f64003292a2ec8b916ed06006df3bd68"></a>
Start following selected user.

`POST users/4293/follow`

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
<a name="f759b79021d897664194fda347130294"></a>
Stop following selected user.

`POST users/4295/unfollow`

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
