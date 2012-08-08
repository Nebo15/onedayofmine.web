# API #
 Version: 08.08.12 14:32:27

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
1. <a href='#743dc2b9bbcaf32da01c54b328e615d2'>Item</a>
1. <a href='#ff732341e60c99b67fc0c4ebf515f89e'>Item_Many</a>
1. <a href='#7d5002d912c01aa1f0a30b459030e980'>CommentCreate</a>
1. <a href='#812598073036abdacb9b559bf0dfdf7a'>ShareDay</a>
1. <a href='#e29b2cef80808f10cca8b28d3b7a21cf'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#02fd5ad66dde37a20ac1f8704a2565b7'>Update</a>
1. <a href='#918df5c021e8ab70648013960bc45adc'>DeleteDay</a>
1. <a href='#d31d98c7cefa6223b97a5c2acb9d1fd7'>RestoreDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#ce6a33b6af74411bdace9ff73c60a40c'>AddToFavourites</a>
1. <a href='#5b7c18063c45aafd13c75de38ee33c24'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#63647e9ce3e94ac7de3b241627175e56'>CreateComplaint</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#197b9e6cc49c0d7ee23a498c49bb170c'>Update</a>
1. <a href='#2722535e0c1a1b3fd116d9dd8296336d'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#8b0e8c82a7352729e894e4177bc59723'>Update</a>
1. <a href='#7a63743d281ac797720a86f7aa17a39d'>Delete</a>
1. <a href='#5eca921ccce5dfb2673b0a4c2c07d80f'>Comment</a>

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
1. <a href='#b8497d9b65e3bd7c6a68a523c44839af'>UserByIdDays</a>
1. <a href='#dcde970a1c75cc2c50f7551003eb16db'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#8bf6e13ac0684731c68355e36e9296a3'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#ad483848f3f6730439f5167ba1f84c7b'>FollowingByUserId</a>
1. <a href='#0bd7823dfc7113bbf6886181aa2520f2'>Follow</a>
1. <a href='#66e8e0e1eeaab29b82aaf5d45c7beb2c'>Unfollow</a>
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
      "token":"AAAFnVo0zuqkBAMdqrQE...6tVZCDSgPHYFjb1nXqCO"
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
        "id":2841,
        "fb_uid":"100004087981387",
        "twitter_uid":null,
        "name":"bar bar",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/2841\/4d87b34251e4ea3c5cd732cab38c96750ffc9592_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/2841\/4d87b34251e4ea3c5cd732cab38c96750ffc9592_140x140.jpeg",
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
      "type":"Working"
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
      "id":5459,
      "user_id":2849,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2849\/days\/ab7116a8741f0978a07515358f4e61a8c2ef19c7_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2849\/days\/ab7116a8741f0978a07515358f4e61a8c2ef19c7_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"0",
      "location":null,
      "type":"Working",
      "likes_count":0,
      "ctime":1344425515,
      "utime":1344425515,
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
      "id":5461,
      "user_id":2851,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2851\/days\/4377ae768582b4ceaeaa135920d6b0a08378e352_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2851\/days\/4377ae768582b4ceaeaa135920d6b0a08378e352_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working",
      "likes_count":0,
      "ctime":1344425515,
      "utime":1344425515,
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
      "id":1276,
      "day_id":5463,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/2853\/days\/5463\/503a36058d128322b13b210a82d856b912ca2447_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/2853\/days\/5463\/503a36058d128322b13b210a82d856b912ca2447_400x400.jpg",
      "image_shoot_time":"133713",
      "likes_count":0,
      "ctime":1344425516
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
      "type":"Working"
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
      "id":5465,
      "user_id":2855,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2855\/days\/5a1451e82e72c8d4b2ccea41e7b2e49753f1a2df_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2855\/days\/5a1451e82e72c8d4b2ccea41e7b2e49753f1a2df_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":"1",
      "location":"foobar",
      "type":"Working",
      "likes_count":0,
      "ctime":1344425517,
      "utime":1344425517,
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
<a name="743dc2b9bbcaf32da01c54b328e615d2"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/5467/item`

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
      "id":5467,
      "fb_uid":"fooba",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2858\/days\/c43e76b576d8eb0278b0d5200ff29e7177450211_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2858\/days\/c43e76b576d8eb0278b0d5200ff29e7177450211_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working",
      "likes_count":0,
      "ctime":1344425517,
      "utime":1344425517,
      "is_ended":0,
      "user":{
        "id":2858,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_140x140.jpeg",
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
          "id":392,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344425517,
          "utime":1344425517,
          "user":{
            "id":2858,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":393,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344425517,
          "utime":1344425517,
          "user":{
            "id":2858,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_140x140.jpeg",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":1
          }
        },
        {
          "id":394,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobar",
          "likes_count":0,
          "ctime":1344425517,
          "utime":1344425517,
          "user":{
            "id":2858,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "pic_small":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_70x70.jpeg",
            "pic_big":"http:\/\/onedayofmine.dev\/users\/2858\/29dcb0028694fa83e20e83667556ada245543b9f_140x140.jpeg",
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
          "id":1278,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344425517,
          "comments_count":1,
          "comments":[
            {
              "id":345,
              "user_name":"foo foo",
              "text":"foobar",
              "likes_count":0,
              "ctime":1344425517,
              "utime":1344425517,
              "moment_id":1278,
              "user":{
                "id":2859,
                "fb_uid":"100004093051334",
                "twitter_uid":0,
                "name":"foo foo",
                "sex":"male",
                "pic_small":"http:\/\/onedayofmine.dev\/users\/2859\/49fdff437a04e0a89364a886dd844a623d0cb947_70x70.jpeg",
                "pic_big":"http:\/\/onedayofmine.dev\/users\/2859\/49fdff437a04e0a89364a886dd844a623d0cb947_140x140.jpeg",
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
          "id":1279,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344425517,
          "comments_count":0,
          "comments":[
            
          ]
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="ff732341e60c99b67fc0c4ebf515f89e"></a>
Get few days in one request.

`GET days/5468;5469;763/item`

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
<tr><td>[type]</td><td>5468 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>5469 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>763 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "5468":{
        "id":5468,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2860\/days\/ca88ffc20f75e101ba3831719fcfc3f16e65ed96_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2860\/days\/ca88ffc20f75e101ba3831719fcfc3f16e65ed96_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425517,
        "utime":1344425517,
        "is_ended":0,
        "user":{
          "id":2860,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2860\/cd8cefe5be86a2163c5badfb66c79290adad0896_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2860\/cd8cefe5be86a2163c5badfb66c79290adad0896_140x140.jpeg",
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
            "id":1280,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344425517,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "5469":{
        "id":5469,
        "fb_uid":"fooba",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2861\/days\/bd63fd511bd3228398d525879661632e9135f72d_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2861\/days\/bd63fd511bd3228398d525879661632e9135f72d_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425517,
        "utime":1344425517,
        "is_ended":0,
        "user":{
          "id":2861,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2861\/4620e9f2a8672a3deb42ffc70c9218f58885fae6_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2861\/4620e9f2a8672a3deb42ffc70c9218f58885fae6_140x140.jpeg",
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
            "id":1281,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_small":"http:\/\/onedayofmine.dev\/",
            "image_big":"http:\/\/onedayofmine.dev\/",
            "image_shoot_time":0,
            "likes_count":0,
            "ctime":1344425517,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "763":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="7d5002d912c01aa1f0a30b459030e980"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/5471/comment_create`

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
      "id":396,
      "user_id":2865,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344425519,
      "utime":1344425519,
      "day_id":5471
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="812598073036abdacb9b559bf0dfdf7a"></a>
Share a day

`POST days/5472/share`

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
      "id":"100004087981387_392988427430799"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="e29b2cef80808f10cca8b28d3b7a21cf"></a>


`POST days/5473/like`



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
      "from":5477,
      "to":5474,
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
        "id":5476,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2870\/days\/37ab1335a39eff825ca44b0c327a8510fafbfee9_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2870\/days\/37ab1335a39eff825ca44b0c327a8510fafbfee9_400x400.jpeg",
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425520,
        "utime":1344425520,
        "is_ended":0,
        "user":{
          "id":2870,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2870\/d95af791d0a82b74f61c85369490b4b0bfaa77db_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2870\/d95af791d0a82b74f61c85369490b4b0bfaa77db_140x140.jpeg",
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
<a name="02fd5ad66dde37a20ac1f8704a2565b7"></a>
Updates a day

`POST days/5480/update`

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
      "type":"Working"
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
      "id":5480,
      "user_id":2872,
      "fb_uid":"100004087981387",
      "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2872\/days\/c2f940aabcc3526b860bb1ed20aa06253c14fce5_200x200.jpeg",
      "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2872\/days\/c2f940aabcc3526b860bb1ed20aa06253c14fce5_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobar",
      "timezone":"1",
      "location":"foobar",
      "type":"Working",
      "likes_count":0,
      "ctime":1344425521,
      "utime":1344425521,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="918df5c021e8ab70648013960bc45adc"></a>
Deletes a day

`POST days/5481/delete`

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
<a name="d31d98c7cefa6223b97a5c2acb9d1fd7"></a>
Restore a deleted day

`POST days/5483/restore`

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
      "from":5488,
      "to":5485,
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
        "id":5487,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2881\/days\/b2e34653ac7f475a0be807168e7c6764fe12046e_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2881\/days\/b2e34653ac7f475a0be807168e7c6764fe12046e_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425523,
        "utime":1344425523,
        "is_ended":0,
        "user":{
          "id":2881,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2881\/6a12790dd8dd404fbb0b6b4450f09b5867b2429e_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2881\/6a12790dd8dd404fbb0b6b4450f09b5867b2429e_140x140.jpeg",
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
<a name="ce6a33b6af74411bdace9ff73c60a40c"></a>


`POST /days/5490/favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="5b7c18063c45aafd13c75de38ee33c24"></a>


`POST /days/5491/unfavourite`




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
      "from":5495,
      "to":5492,
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
        "id":5494,
        "user_id":2888,
        "fb_uid":"100004093051334",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2888\/days\/ce4e40f45bcbf39977617becd73e29c32b19a52e_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2888\/days\/ce4e40f45bcbf39977617becd73e29c32b19a52e_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425524,
        "utime":1344425524,
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
      "from":5501,
      "to":5497,
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
        "id":5500,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2889\/days\/1d1954536b2bc19946345365d709baece54a7197_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2889\/days\/1d1954536b2bc19946345365d709baece54a7197_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425524,
        "utime":1344425524,
        "is_ended":0,
        "user":{
          "id":2889,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2889\/23294ab8f579f7b451c9ff4964e3aa83d9b42013_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2889\/23294ab8f579f7b451c9ff4964e3aa83d9b42013_140x140.jpeg",
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
      "from":5502,
      "to":5505,
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
        "id":5503,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2891\/days\/5901ec8295322cfd95e0c5a030cedb07eff9e74a_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2891\/days\/5901ec8295322cfd95e0c5a030cedb07eff9e74a_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":3,
        "ctime":1344339125,
        "utime":1344425525,
        "is_ended":0,
        "user":{
          "id":2891,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2891\/842b857b4298ab102c40dc4e94e69d2ea6cc14f2_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2891\/842b857b4298ab102c40dc4e94e69d2ea6cc14f2_140x140.jpeg",
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
      "from":5510,
      "to":5507,
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
        "id":5509,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2893\/days\/b841eebfcf14c551f31dcb55c9885b2f14266252_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2893\/days\/b841eebfcf14c551f31dcb55c9885b2f14266252_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425525,
        "utime":1344425525,
        "is_ended":0,
        "user":{
          "id":2893,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2893\/40b4c7e596560d9ff64003dd983334d93961fc46_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2893\/40b4c7e596560d9ff64003dd983334d93961fc46_140x140.jpeg",
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
      "Working",
      "Day-off",
      "Holiday",
      "Trip",
      "Special event"
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateComplaint ####
<a name="63647e9ce3e94ac7de3b241627175e56"></a>


`POST /days/5511/create_complaint`

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
      "ctime":1344425526,
      "id":79
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### MomentComments ###
<a name='MomentComments'></a>
#### Update ####
<a name="197b9e6cc49c0d7ee23a498c49bb170c"></a>


`POST /moment_comments/346/update`

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
      "id":346,
      "user_id":2903,
      "user_name":"bar bar",
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1344425530,
      "utime":1344425530,
      "moment_id":1285
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="2722535e0c1a1b3fd116d9dd8296336d"></a>


`POST /moment_comments/348/delete`

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
<a name="8b0e8c82a7352729e894e4177bc59723"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/1289/update`

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
      "id":1289,
      "day_id":5522,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_small":"http:\/\/onedayofmine.dev\/\/users\/2913\/days\/5522\/b0cb3c60fd5084547ad7efd3a9226742a417b104_200x200.jpg",
      "image_big":"http:\/\/onedayofmine.dev\/\/users\/2913\/days\/5522\/b0cb3c60fd5084547ad7efd3a9226742a417b104_400x400.jpg",
      "image_shoot_time":0,
      "likes_count":0,
      "ctime":1344425531
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="7a63743d281ac797720a86f7aa17a39d"></a>
Delete a moment.

`POST moments/1290/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="5eca921ccce5dfb2673b0a4c2c07d80f"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/1291/comment`

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
      "id":350,
      "user_id":2915,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344425532,
      "utime":1344425532,
      "moment_id":1291
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
      "id":2916,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/2916\/d20b365e4d89acce0e6b9f06d726270e743fea28_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/2916\/d20b365e4d89acce0e6b9f06d726270e743fea28_140x140.jpeg",
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
      "id":2917,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/2917\/8d3262688f48ca0eb8973b8313bd6be752a7db86_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/2917\/8d3262688f48ca0eb8973b8313bd6be752a7db86_140x140.jpeg",
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
      "id":9608,
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
      "id":9610,
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
        "id":2945,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/2945\/5822f1b0bce5b9670dd5d76577dc778346e62130_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/2945\/5822f1b0bce5b9670dd5d76577dc778346e62130_140x140.jpeg",
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
      "id":2946,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/2946\/4ff23ffcbfc22406f43af4e4c356bf860e14302a_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/2946\/4ff23ffcbfc22406f43af4e4c356bf860e14302a_140x140.jpeg",
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
      "from":1256,
      "to":1253,
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
        "id":1255,
        "recipient_id":2949,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1344425538,
        "user":{
          "id":2953,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "pic_small":"http:\/\/onedayofmine.dev\/users\/2953\/fdb0f5a32848f60afbfabc403f281343bbaaedc0_70x70.jpeg",
          "pic_big":"http:\/\/onedayofmine.dev\/users\/2953\/fdb0f5a32848f60afbfabc403f281343bbaaedc0_140x140.jpeg",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":5532,
          "user_id":2952,
          "fb_uid":"fooba",
          "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2952\/days\/a301cd0249210b8d5a6da9838540d1dcdbf13df3_200x200.jpeg",
          "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2952\/days\/a301cd0249210b8d5a6da9838540d1dcdbf13df3_400x400.jpeg",
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "timezone":0,
          "location":"foobarfoobarfoobarfoobarf",
          "type":"Working",
          "likes_count":0,
          "ctime":1344425538,
          "utime":1344425538,
          "is_ended":0
        },
        "moment":{
          "id":1295,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_small":"http:\/\/onedayofmine.dev\/",
          "image_big":"http:\/\/onedayofmine.dev\/",
          "image_shoot_time":0,
          "likes_count":0,
          "ctime":1344425538
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="b8497d9b65e3bd7c6a68a523c44839af"></a>
Returns days of specified user

`GET users/2989/days/`

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
        "id":5539,
        "user_id":2989,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2989\/days\/a1519b9e4b5a638d4297eca9c1da4c989c538855_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2989\/days\/a1519b9e4b5a638d4297eca9c1da4c989c538855_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425543,
        "utime":1344425543,
        "is_ended":0
      },
      {
        "id":5540,
        "user_id":2989,
        "fb_uid":"100004087981387",
        "cover_image_small":"http:\/\/onedayofmine.dev\/\/users\/2989\/days\/82d26f22896da18a5c479ebf4a45db02ab651cf5_200x200.jpeg",
        "cover_image_big":"http:\/\/onedayofmine.dev\/\/users\/2989\/days\/82d26f22896da18a5c479ebf4a45db02ab651cf5_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344425543,
        "utime":1344425543,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="dcde970a1c75cc2c50f7551003eb16db"></a>
Returns days of specified user

`GET users/2991/item/`

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
      "id":2991,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "pic_small":"http:\/\/onedayofmine.dev\/users\/2991\/8fb10f0577a71b863a9b55bf05f84ec622238032_70x70.jpeg",
      "pic_big":"http:\/\/onedayofmine.dev\/users\/2991\/8fb10f0577a71b863a9b55bf05f84ec622238032_140x140.jpeg",
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
        "id":2996,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/2996\/b51dd5adf7e9592fcf1c662443860dde3f59423e_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/2996\/b51dd5adf7e9592fcf1c662443860dde3f59423e_140x140.jpeg",
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
<a name="8bf6e13ac0684731c68355e36e9296a3"></a>
Returns list of users that follow selected user.

`GET users/2997/followers`

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
        "id":2998,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/2998\/a21be122c649ea818977036c355fb8b6ee75208c_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/2998\/a21be122c649ea818977036c355fb8b6ee75208c_140x140.jpeg",
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
        "id":3000,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/3000\/58e2790185e35fe2a8e197923beb59ff642e00cf_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/3000\/58e2790185e35fe2a8e197923beb59ff642e00cf_140x140.jpeg",
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
<a name="ad483848f3f6730439f5167ba1f84c7b"></a>
Returns list of users that is followed by selected user.

`GET users/3001/following`

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
        "id":3002,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/3002\/677bd5139119216487787a221e348266f052cca7_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/3002\/677bd5139119216487787a221e348266f052cca7_140x140.jpeg",
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
<a name="0bd7823dfc7113bbf6886181aa2520f2"></a>
Start following selected user.

`POST users/3004/follow`

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
<a name="66e8e0e1eeaab29b82aaf5d45c7beb2c"></a>
Stop following selected user.

`POST users/3006/unfollow`

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
      "from":3007,
      "to":3010,
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
        "id":3008,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"fooA",
        "sex":"female",
        "pic_small":"http:\/\/onedayofmine.dev\/users\/3008\/ac32bd7e4326982788795192668d5845dd377294_70x70.jpeg",
        "pic_big":"http:\/\/onedayofmine.dev\/users\/3008\/ac32bd7e4326982788795192668d5845dd377294_140x140.jpeg",
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
