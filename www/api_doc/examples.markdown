# API #
 Version: 07.08.12 18:55:28

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
1. <a href='#3c86a1a3eb083f77ebb7f8964658f75c'>Item</a>
1. <a href='#105ef4ce91b338ed522ac9c1f5ef0e7e'>Item_Many</a>
1. <a href='#aff88cdbf49450ae0e4ed09df8b74a49'>CommentCreate</a>
1. <a href='#08d1dc671b4441ec2be2c6a6e77abfa2'>ShareDay</a>
1. <a href='#f1541b6b4a1f27020fe235ee0349dd98'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#8017d1bf200a002243292e3a060c5ea1'>Update</a>
1. <a href='#8cd60e2145544d0ebf223b2a1329a21d'>DeleteDay</a>
1. <a href='#e5ddd5151077d1f0d32266dc2179abcc'>RestoreDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#a59650d997e641dbcd33395f7ad7ef43'>AddToFavourites</a>
1. <a href='#0f4f863a29262626f72c87c5bff89b81'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#42e1406117c5804b2d802879e087e623'>CreateComplaint</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#f1e41ed23798796d47d64b4f2f865186'>Update</a>
1. <a href='#2726f9dce9311d3691b66985ad0b48c4'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#bc8fa6a2802dd7dd1b34ce15e6a31c6f'>Update</a>
1. <a href='#14f80f271df38723ba58e1a75df2613c'>Delete</a>
1. <a href='#6a33493757deb2ddf116c432afd736d3'>Comment</a>

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
1. <a href='#db80ebd765e62860edd847b3e4c8e8d0'>UserByIdDays</a>
1. <a href='#0b2729f4d079238e08b2917df0bbe21a'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#1826fc1d0328996ca0ef04df72aad862'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#1013357f9d2d6ca63f637496a886746e'>FollowingByUserId</a>
1. <a href='#b7065b1bc1ea4ab47cc9ad82b4a3d638'>Follow</a>
1. <a href='#1a7d7cb45cce0c317021b23137f591cf'>Unfollow</a>
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
      "token":"AAAFnVo0zuqkBAJnPOVu...VFd5sDky0ZC3L0iZAZA6"
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
        "id":826,
        "fb_uid":"100004087981387",
        "twitter_uid":null,
        "name":"bar bar",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/826\/4618d9ae45c378a1670440501e2644397ec3870c_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/826\/4618d9ae45c378a1670440501e2644397ec3870c_140x140.jpeg",
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
      "id":652,
      "user_id":834,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/834\/days\/f34afb945b6ab4f1a6cb44ce639bfceda43a519b_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/834\/days\/f34afb945b6ab4f1a6cb44ce639bfceda43a519b_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"0",
      "location":null,
      "type":"working",
      "likes_count":0,
      "ctime":1344354862,
      "utime":1344354862,
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
      "id":654,
      "user_id":836,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/836\/days\/6f2be868b01c1ad927c2a57e1f4385d3d0727e3e_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/836\/days\/6f2be868b01c1ad927c2a57e1f4385d3d0727e3e_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1344354863,
      "utime":1344354863,
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
      "id":59,
      "day_id":656,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/838\/days\/656\/87a51ceb50011f4033a25d580438ac24151c0def_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/838\/days\/656\/87a51ceb50011f4033a25d580438ac24151c0def_400x400.jpg",
      "image_shoot_time":"133713",
      "likes_count":0,
      "ctime":1344354864
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
      "id":658,
      "user_id":840,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/840\/days\/76f347eaeec51d6a6b299c62f3c67f4d1e667ce1_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/840\/days\/76f347eaeec51d6a6b299c62f3c67f4d1e667ce1_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1344354864,
      "utime":1344354865,
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
<a name="3c86a1a3eb083f77ebb7f8964658f75c"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/660/item`

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
      "id":660,
      "fb_uid":"fooba",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/843\/days\/77cdebba4968668a36ab5acbb631e7d081b6836b_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/843\/days\/77cdebba4968668a36ab5acbb631e7d081b6836b_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1344354865,
      "utime":1344354865,
      "is_ended":0,
      "user":{
        "id":843,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_140x140.jpeg",
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
          "id":56,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344354865,
          "utime":1344354865,
          "user":{
            "id":843,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":57,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344354865,
          "utime":1344354865,
          "user":{
            "id":843,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":58,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344354865,
          "utime":1344354865,
          "user":{
            "id":843,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/843\/cd5f0749a0d7e3cc48eefe31a64c644928f3ab3b_140x140.jpeg",
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
          "id":61,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344354865,
          "comments_count":1,
          "comments":[
            {
              "id":12,
              "user_name":"foo foo",
              "text":"foobar",
              "likes_count":0,
              "ctime":1344354865,
              "utime":1344354865,
              "moment_id":61,
              "user":{
                "id":844,
                "fb_uid":"100004093051334",
                "twitter_uid":0,
                "name":"foo foo",
                "sex":"male",
                "pic_small":"http:\/\/onedayofmine.dev\/users\/844\/63e7a58b2054b108d9d65c1849905932a0a13875_70x70.jpeg",
                "pic_big":"http:\/\/onedayofmine.dev\/users\/844\/63e7a58b2054b108d9d65c1849905932a0a13875_140x140.jpeg",
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
          "id":62,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344354865,
          "comments_count":0,
          "comments":[
            
          ]
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="105ef4ce91b338ed522ac9c1f5ef0e7e"></a>
Get few days in one request.

`GET days/661;662;924/item`

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
<tr><td>[type]</td><td>661 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>662 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>924 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "661":{
        "id":661,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/845\/days\/314324c201de603c2e3cde8a0f807a24c59f1e20_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/845\/days\/314324c201de603c2e3cde8a0f807a24c59f1e20_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354865,
        "utime":1344354865,
        "is_ended":0,
        "user":{
          "id":845,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/845\/b6c630dfe6000b3e3c468bea6e081354177551d6_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/845\/b6c630dfe6000b3e3c468bea6e081354177551d6_140x140.jpeg",
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
            "id":63,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344354865,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "662":{
        "id":662,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/846\/days\/0a42443fe0ed7647320433c3f9698cb0fa9098d5_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/846\/days\/0a42443fe0ed7647320433c3f9698cb0fa9098d5_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354865,
        "utime":1344354865,
        "is_ended":0,
        "user":{
          "id":846,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/846\/23c798ca6f0e3273f3473cf1f3ed348f459d3bdf_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/846\/23c798ca6f0e3273f3473cf1f3ed348f459d3bdf_140x140.jpeg",
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
            "id":64,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344354865,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "924":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="aff88cdbf49450ae0e4ed09df8b74a49"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/664/comment_create`

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
      "id":60,
      "user_id":850,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344354866,
      "utime":1344354866,
      "day_id":664
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="08d1dc671b4441ec2be2c6a6e77abfa2"></a>
Share a day

`POST days/665/share`

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
      "id":"100004087981387_277784968989528"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="f1541b6b4a1f27020fe235ee0349dd98"></a>


`POST days/666/like`



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
      "from":670,
      "to":667,
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
        "id":669,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/855\/days\/56639ee20ca8e01bbefafb4c4d950968a867ab11_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/855\/days\/56639ee20ca8e01bbefafb4c4d950968a867ab11_400x400.jpeg",
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354869,
        "utime":1344354869,
        "is_ended":0,
        "user":{
          "id":855,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/855\/bc3afad444cc87fcae50a80c53a93be6e00e4678_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/855\/bc3afad444cc87fcae50a80c53a93be6e00e4678_140x140.jpeg",
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
<a name="8017d1bf200a002243292e3a060c5ea1"></a>
Updates a day

`POST days/673/update`

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
      "id":673,
      "user_id":857,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/857\/days\/6bc032b3c6d23d26e87acf4f8b352b056bfd4725_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/857\/days\/6bc032b3c6d23d26e87acf4f8b352b056bfd4725_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobar",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1344354870,
      "utime":1344354870,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="8cd60e2145544d0ebf223b2a1329a21d"></a>
Deletes a day

`POST days/674/delete`

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
<a name="e5ddd5151077d1f0d32266dc2179abcc"></a>
Restore a deleted day

`POST days/676/restore`

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
      "from":681,
      "to":678,
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
        "id":680,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/866\/days\/aa03d6ea921dc583d8379e01b6b1f725f2414da9_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/866\/days\/aa03d6ea921dc583d8379e01b6b1f725f2414da9_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354874,
        "utime":1344354874,
        "is_ended":0,
        "user":{
          "id":866,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/866\/108eec14b76b5780b60e314e5d42f0198b59824b_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/866\/108eec14b76b5780b60e314e5d42f0198b59824b_140x140.jpeg",
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
<a name="a59650d997e641dbcd33395f7ad7ef43"></a>


`POST /days/683/favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="0f4f863a29262626f72c87c5bff89b81"></a>


`POST /days/684/unfavourite`




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
      "from":688,
      "to":685,
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
        "id":687,
        "user_id":873,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/873\/days\/da8d25272db1a51d272c52f5e84a55194b5c613b_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/873\/days\/da8d25272db1a51d272c52f5e84a55194b5c613b_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354875,
        "utime":1344354875,
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
      "from":694,
      "to":690,
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
        "id":693,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/874\/days\/f25c57e72bda545fbd3b63317ce4f6cd50e1c558_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/874\/days\/f25c57e72bda545fbd3b63317ce4f6cd50e1c558_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354875,
        "utime":1344354875,
        "is_ended":0,
        "user":{
          "id":874,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/874\/bb23a279e7ee0c9def17a2b804b6ffacc0743c5a_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/874\/bb23a279e7ee0c9def17a2b804b6ffacc0743c5a_140x140.jpeg",
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
      "from":695,
      "to":698,
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
        "id":696,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/876\/days\/fb0250a869a061258b12a11674adf8ca74ef9fb5_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/876\/days\/fb0250a869a061258b12a11674adf8ca74ef9fb5_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":3,
        "ctime":1344268476,
        "utime":1344354876,
        "is_ended":0,
        "user":{
          "id":876,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/876\/67f46991882f93052887a04f2eb5e916b558ab7e_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/876\/67f46991882f93052887a04f2eb5e916b558ab7e_140x140.jpeg",
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
      "from":703,
      "to":700,
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
        "id":702,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/878\/days\/22f9ebf6a7c5b876eb520f2e04a20b926cadbfaf_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/878\/days\/22f9ebf6a7c5b876eb520f2e04a20b926cadbfaf_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354876,
        "utime":1344354876,
        "is_ended":0,
        "user":{
          "id":878,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/878\/d39e1a22e81f6c4f75519218399e28c21252e8ba_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/878\/d39e1a22e81f6c4f75519218399e28c21252e8ba_140x140.jpeg",
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
<a name="42e1406117c5804b2d802879e087e623"></a>


`POST /days/704/create_complaint`

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
      "ctime":1344354877,
      "id":12
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### MomentComments ###
<a name='MomentComments'></a>
#### Update ####
<a name="f1e41ed23798796d47d64b4f2f865186"></a>


`POST /moment_comments/13/update`

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
      "id":13,
      "user_id":888,
      "user_name":"bar bar",
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1344354893,
      "utime":1344354893,
      "moment_id":68
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="2726f9dce9311d3691b66985ad0b48c4"></a>


`POST /moment_comments/15/delete`

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
<a name="bc8fa6a2802dd7dd1b34ce15e6a31c6f"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/72/update`

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
      "id":72,
      "day_id":715,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/898\/days\/715\/6051f34293481901f6b615e7ae0bc18bbdf1bb98_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/898\/days\/715\/6051f34293481901f6b615e7ae0bc18bbdf1bb98_400x400.jpg",
      "image_shoot_time":0,
      "likes_count":0,
      "ctime":1344354895
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="14f80f271df38723ba58e1a75df2613c"></a>
Delete a moment.

`POST moments/73/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="6a33493757deb2ddf116c432afd736d3"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/74/comment`

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
      "id":17,
      "user_id":900,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344354896,
      "utime":1344354896,
      "moment_id":74
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
      "id":901,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/901\/af6e15a6a36f5b36d0c6688e9f4d944d79acc95f_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/901\/af6e15a6a36f5b36d0c6688e9f4d944d79acc95f_140x140.jpeg",
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
      "id":902,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/902\/9713d30bb7572ecc48460dbd79ecff4dd2ff19c7_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/902\/9713d30bb7572ecc48460dbd79ecff4dd2ff19c7_140x140.jpeg",
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
      "id":768,
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
      "id":770,
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
        "id":930,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/930\/a25582fe3d487022f239add72f0899af0a87d52d_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/930\/a25582fe3d487022f239add72f0899af0a87d52d_140x140.jpeg",
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
      "id":931,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/931\/9e046cf340be05153166d64e37208beede81daa5_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/931\/9e046cf340be05153166d64e37208beede81daa5_140x140.jpeg",
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
      "from":92,
      "to":89,
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
        "id":91,
        "recipient_id":934,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1344354905,
        "user":{
          "id":938,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/938\/20644ff4ae138dabb2efe5d98f6da7f5ae0c8639_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/938\/20644ff4ae138dabb2efe5d98f6da7f5ae0c8639_140x140.jpeg",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":725,
          "user_id":937,
          "fb_uid":"fooba",
          "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/937\/days\/e1882085f6bd3c1a082b8e4ae12bf9603b6f2e4f_200x200.jpeg",
          "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/937\/days\/e1882085f6bd3c1a082b8e4ae12bf9603b6f2e4f_400x400.jpeg",
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "timezone":0,
          "location":"foobarfoobarfoobarfoobarf",
          "type":"working",
          "likes_count":0,
          "ctime":1344354905,
          "utime":1344354905,
          "is_ended":0
        },
        "moment":{
          "id":78,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344354905
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="db80ebd765e62860edd847b3e4c8e8d0"></a>
Returns days of specified user

`GET users/974/days/`

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
        "id":732,
        "user_id":974,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/974\/days\/88258357a9bae4c87b2dcf1afcfc29d2e567015d_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/974\/days\/88258357a9bae4c87b2dcf1afcfc29d2e567015d_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354922,
        "utime":1344354922,
        "is_ended":0
      },
      {
        "id":733,
        "user_id":974,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/974\/days\/8104f252ad3b10b42466076c0e475c0a67c02be0_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/974\/days\/8104f252ad3b10b42466076c0e475c0a67c02be0_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1344354922,
        "utime":1344354922,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="0b2729f4d079238e08b2917df0bbe21a"></a>
Returns days of specified user

`GET users/976/item/`

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
      "id":976,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/976\/d1d96e7fa72febd726a3c76fe3c7e0aac605f8c6_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/976\/d1d96e7fa72febd726a3c76fe3c7e0aac605f8c6_140x140.jpeg",
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
        "id":981,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/981\/32e78ac356ab71f185da8502b1c4cc44ae9075b3_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/981\/32e78ac356ab71f185da8502b1c4cc44ae9075b3_140x140.jpeg",
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
<a name="1826fc1d0328996ca0ef04df72aad862"></a>
Returns list of users that follow selected user.

`GET users/982/followers`

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
        "id":983,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/983\/c49943727257a539d3bb3cab4a28ab184ac2572b_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/983\/c49943727257a539d3bb3cab4a28ab184ac2572b_140x140.jpeg",
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
        "id":985,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/985\/a7a774351e1fd282373b911cb3cec8e502ebcfb2_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/985\/a7a774351e1fd282373b911cb3cec8e502ebcfb2_140x140.jpeg",
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
<a name="1013357f9d2d6ca63f637496a886746e"></a>
Returns list of users that is followed by selected user.

`GET users/986/following`

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
        "id":987,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/987\/ce0c630528bc4169b3e37e7c1efbfa0464472793_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/987\/ce0c630528bc4169b3e37e7c1efbfa0464472793_140x140.jpeg",
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
<a name="b7065b1bc1ea4ab47cc9ad82b4a3d638"></a>
Start following selected user.

`POST users/989/follow`

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
<a name="1a7d7cb45cce0c317021b23137f591cf"></a>
Stop following selected user.

`POST users/991/unfollow`

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
      "from":992,
      "to":995,
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
        "id":993,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"fooA",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/993\/0bae1963e915f6db54d9308f6af294a19b98a091_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/993\/0bae1963e915f6db54d9308f6af294a19b98a091_140x140.jpeg",
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
