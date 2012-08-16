# API #
 Version: 15.08.12 20:38:36

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>
1. <a href='#a4f262f1ba860bb2759f57a1a5438a7d'>Login_WrongAccessToken</a>

### <a href='#Day'>Day</a> ###
1. <a href='#59bb11f2b83e78fd4d4efb55bf2eb5d0'>Item</a>
1. <a href='#6309b0ac948b43412e5e8e6cc69c14c2'>Item_Many</a>
1. <a href='#2bd3ce1d5c97910fb27910ecd9d51263'>CommentCreate</a>
1. <a href='#40c5e5548b1985672e0a30f415f970e2'>ShareDay</a>
1. <a href='#ba3bcccb88ce5cad54300024539a0ccf'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#f1f72ef4a12473ea2e0cd48d0d4ef5c0'>GetFavouriteDays</a>
1. <a href='#38dc9c2606756890b77a26cd7b746604'>AddToFavourites</a>
1. <a href='#a2278c8afcff2eb75ca6709e150b31dc'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#2a745393972745222ea3423302eb97c6'>Types</a>
1. <a href='#3789c415d0e3fb0f8afbae6926cd796f'>CreateComplaint</a>

### <a href='#DaysGuest'>DaysGuest</a> ###
1. <a href='#b6f80b0eca3041c0a7087a8a655f970e'>Item</a>
1. <a href='#fd794d2acd4c99a6f86c8570c5f4afca'>Item_Many</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#2a745393972745222ea3423302eb97c6'>Types</a>
1. <a href='#5f6f7cf49d8a8c3f9f89b040705d0b7c'>CreateComplaint</a>

### <a href='#DaysOwner'>DaysOwner</a> ###
1. <a href='#63bbaaed06ef382e262c395e07ba56ee'>Start</a>
1. <a href='#c34dd66da92652c0c3f1547695ed75c5'>CreateMoment</a>
1. <a href='#3fc3bfb73af35564223b3c15010dd5dc'>Update</a>
1. <a href='#22f4469a5d63f172629f782061a62e80'>Finish</a>
1. <a href='#012550a73c98965016b8f447f81a0eea'>DeleteDay</a>
1. <a href='#65c8ee54126b0553b8bc8972f5c62f91'>RestoreDay</a>

### <a href='#DayUser'>DayUser</a> ###
1. <a href='#08450599bfb826e933a60c5554f76de7'>Item</a>
1. <a href='#55a23a54f784d835b9f122ac706244cb'>CommentCreate</a>
1. <a href='#bb088a6a50270041d97309467f3af1b8'>ShareDay</a>
1. <a href='#8cb86c9664b169d2ee78a64e2a9683a9'>Like</a>
1. <a href='#f1f72ef4a12473ea2e0cd48d0d4ef5c0'>GetFavouriteDays</a>
1. <a href='#74f7478d29a5072389164f062a84bf4e'>AddToFavourites</a>
1. <a href='#a6117290aec453e6d8f98bb114daf831'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#e02f5df7b4f592e3638eaf7cb5cb66a2'>Update</a>
1. <a href='#ca978dc251797b8ef14c0236e0977274'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#a215aaecc12a50f771cfbc72b78c2964'>Update</a>
1. <a href='#6ca06c230f97737608da63b5f8cdfb5b'>Delete</a>
1. <a href='#a968ec564617327f6b4c6373bee5a77d'>Comment</a>

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
1. <a href='#4e36e20f525e5104988a279d51d1a0a9'>UserByIdDays</a>
1. <a href='#3558efaa6dde6875fb4f864de1809179'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#21dd53618900e80581241f7a0351f565'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#176e09bcc505cb5297d8f74478a564e3'>FollowingByUserId</a>
1. <a href='#691d4373d9c46706e3257e49ef235a5d'>Follow</a>
1. <a href='#e93aa2c2ad8c39f02ae66ade33162e8f'>Unfollow</a>
1. <a href='#b6a64e411df3885324cb5c0d6b5215e6'>Search</a>


## API methods ##

### Auth ###
<a name='Auth'></a>
#### IsLoggedIn ####
<a name="f3fe153a8e0372904ddc25f133cecd23"></a>
Returns user authentication status.

`GET auth/is_logged_in`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>token</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "token":"AAAFnVo0zuqkBALDEcpp...CZBVelmAF7mWcbMsU3V6"
    }



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
Authorizes and returns User.

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
      "token":"AAAFnVo0zuqkBABZB4RQ...pUUetgUZAFqmnsTVReOK"
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
<tr><td>[type]</td><td>image_36</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_72</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_96</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_192</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>favourites_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":836,
      "fb_uid":"100004093051334",
      "twitter_uid":0,
      "name":"foo foo",
      "sex":"female",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
      "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
      "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
      "birthday":"1982-08-08",
      "occupation":"",
      "location":"",
      "followers_count":1,
      "following_count":1,
      "days_count":0,
      "favourites_count":0,
      "email":"foo_mczsniz_foo@tfbnw.net"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Login_WrongAccessToken ####
<a name="a4f262f1ba860bb2759f57a1a5438a7d"></a>


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
<tr><td>[type]</td><td>token</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "token":"foobarfooba"
    }




<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="59bb11f2b83e78fd4d4efb55bf2eb5d0"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/540`

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
<tr><td>bool</td><td>is_favourite</td><td></td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":540,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345051070,
      "utime":1345051070,
      "is_ended":0,
      "user":{
        "id":844,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1
      },
      "is_favourite":true,
      "comments_count":4,
      "comments":[
        {
          "id":35,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051070,
          "utime":1345051070,
          "user":{
            "id":845,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":36,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051070,
          "utime":1345051070,
          "user":{
            "id":846,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":37,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051070,
          "utime":1345051070,
          "user":{
            "id":847,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        }
      ],
      "moments":[
        {
          "id":65,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345051070,
          "comments_count":4
        },
        {
          "id":66,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345051070,
          "comments_count":4
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="6309b0ac948b43412e5e8e6cc69c14c2"></a>
Get few days in one request.

`GET days/541;542;932/item`

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
<tr><td>[type]</td><td>541 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>542 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>932 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "541":{
        "id":541,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051077,
        "utime":1345051077,
        "is_ended":0,
        "user":{
          "id":849,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1
        },
        "is_favourite":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":67,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345051077,
            "comments_count":0
          }
        ]
      },
      "542":{
        "id":542,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051077,
        "utime":1345051077,
        "is_ended":0,
        "user":{
          "id":850,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1
        },
        "is_favourite":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":68,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345051077,
            "comments_count":0
          }
        ]
      },
      "932":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="2bd3ce1d5c97910fb27910ecd9d51263"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/544/comment_create`

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
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>day_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":39,
      "user_id":854,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1345051102,
      "utime":1345051102,
      "day_id":544
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="40c5e5548b1985672e0a30f415f970e2"></a>
Share a day

`POST days/545/share`

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
      "id":"100004087981387_265868036858126"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="ba3bcccb88ce5cad54300024539a0ccf"></a>


`POST days/546/like`



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
      "from":550,
      "to":547,
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
        "id":549,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051138,
        "utime":1345051138,
        "is_ended":0,
        "user":{
          "id":859,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
#### GetFavouriteDays ####
<a name="f1f72ef4a12473ea2e0cd48d0d4ef5c0"></a>
Returns favourite based on <a href="#range-request">range-request</a>.

`GET days/favourite`

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
      "from":556,
      "to":553,
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
        "id":555,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051145,
        "utime":1345051145,
        "is_ended":0,
        "user":{
          "id":861,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":4
        },
        "is_favourite":true
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="38dc9c2606756890b77a26cd7b746604"></a>


`POST /days/558/mark_favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="a2278c8afcff2eb75ca6709e150b31dc"></a>


`POST /days/559/unmark_favourite`




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
      "from":563,
      "to":560,
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
        "id":562,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051169,
        "utime":1345051169,
        "is_ended":0,
        "user":{
          "id":868,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":1,
          "following_count":0,
          "days_count":4
        },
        "is_favourite":false
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
      "from":569,
      "to":565,
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
        "id":568,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051176,
        "utime":1345051176,
        "is_ended":0,
        "user":{
          "id":869,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
      "from":570,
      "to":573,
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
        "id":571,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":3,
        "ctime":1344964783,
        "utime":1345051183,
        "is_ended":0,
        "user":{
          "id":871,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
      "from":578,
      "to":575,
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
        "id":577,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051190,
        "utime":1345051190,
        "is_ended":0,
        "user":{
          "id":873,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3
        },
        "is_favourite":false,
        "is_deleted":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Types ####
<a name="2a745393972745222ea3423302eb97c6"></a>
Returns list of acceptable types.

`GET days/types`



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
      "Working day",
      "Day off",
      "Holiday",
      "Trip",
      "Special event"
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateComplaint ####
<a name="3789c415d0e3fb0f8afbae6926cd796f"></a>


`POST /days/579/create_complaint`

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
      "ctime":1345051207,
      "id":56
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### DaysGuest ###
<a name='DaysGuest'></a>
#### Item ####
<a name="b6f80b0eca3041c0a7087a8a655f970e"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/580`

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
<tr><td>bool</td><td>is_favourite <span class='label label-important'>Removed</span></td><td></td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":580,
      "fb_uid":"fooba",
      "image_266":"http:\/\/static.onedayofmine.dev\/877\/days\/88c726e8344afdacae331e09e5d9adb151f0670e_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/877\/days\/88c726e8344afdacae331e09e5d9adb151f0670e_532.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345051213,
      "utime":1345051213,
      "is_ended":0,
      "user":{
        "id":877,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1
      },
      "comments_count":4,
      "comments":[
        {
          "id":40,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051213,
          "utime":1345051213,
          "user":{
            "id":878,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":41,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051213,
          "utime":1345051213,
          "user":{
            "id":879,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":42,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051213,
          "utime":1345051213,
          "user":{
            "id":880,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        }
      ],
      "moments":[
        {
          "id":69,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345051213,
          "comments_count":4
        },
        {
          "id":70,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345051213,
          "comments_count":4
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="fd794d2acd4c99a6f86c8570c5f4afca"></a>
Get few days in one request.

`GET days/581;582;977/item`

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
<tr><td>[type]</td><td>581 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>582 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>977 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "581":{
        "id":581,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051220,
        "utime":1345051220,
        "is_ended":0,
        "user":{
          "id":882,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1
        },
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":71,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345051220,
            "comments_count":0
          }
        ]
      },
      "582":{
        "id":582,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051220,
        "utime":1345051220,
        "is_ended":0,
        "user":{
          "id":883,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1
        },
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":72,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345051220,
            "comments_count":0
          }
        ]
      },
      "977":null
    }


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
      "from":587,
      "to":584,
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
        "id":586,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051239,
        "utime":1345051239,
        "is_ended":0,
        "user":{
          "id":885,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
      "from":594,
      "to":590,
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
        "id":593,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/887\/days\/b7a72fbf74517ebc34f0ebf10a20e9bad998f411_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/887\/days\/b7a72fbf74517ebc34f0ebf10a20e9bad998f411_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051246,
        "utime":1345051246,
        "is_ended":0,
        "user":{
          "id":887,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
      "from":595,
      "to":598,
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
        "id":596,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/889\/days\/3d76622e81590b5119432126f28388b3bb814a34_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/889\/days\/3d76622e81590b5119432126f28388b3bb814a34_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":3,
        "ctime":1344964853,
        "utime":1345051254,
        "is_ended":0,
        "user":{
          "id":889,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
#### Types ####
<a name="2a745393972745222ea3423302eb97c6"></a>
Returns list of acceptable types.

`GET days/types`



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
      "Working day",
      "Day off",
      "Holiday",
      "Trip",
      "Special event"
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateComplaint ####
<a name="5f6f7cf49d8a8c3f9f89b040705d0b7c"></a>


`POST /days/600/create_complaint`

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
      "ctime":1345051269,
      "id":57
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### DaysOwner ###
<a name='DaysOwner'></a>
#### Start ####
<a name="63bbaaed06ef382e262c395e07ba56ee"></a>
Starts a day, returns created <a href="#Entity:Day">day</a>.

`POST days/start`

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
<tr><td>string</td><td>occupation</td><td>N</td><td>If omited, then user profile occupation will be used</td></tr>
<tr><td>string</td><td>location</td><td>N</td><td>If omited, then user profile occupation will be used</td></tr>
<tr><td>string</td><td>type</td><td>Y</td><td>One of pre-defined types, see: GET day/type_names request</td></tr>

</table>
###### Example request: ######
    {
      "title":"foobarfoobarfoobarfoobarf",
      "location":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "type":"Working day"
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
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>
<tr><td>[type]</td><td>user</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_favourite</td><td>[description]</td></tr>
<tr><td>[type]</td><td>comments_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>comments</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moments</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":601,
      "fb_uid":"100004087981387",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345051286,
      "utime":1345051286,
      "is_ended":0,
      "user":{
        "id":894,
        "fb_uid":"100004087981387",
        "twitter_uid":0,
        "name":"bar bar",
        "sex":"male",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
        "birthday":"1980-08-08",
        "occupation":"",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1
      },
      "is_favourite":false,
      "comments_count":0,
      "comments":[
        
      ],
      "moments":[
        
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateMoment ####
<a name="c34dd66da92652c0c3f1547695ed75c5"></a>
Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.

`POST days/604/moment_create`

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
<tr><td>string</td><td>image_content</td><td>Y</td><td>File contents, that was previously encoded by base64</td></tr>
<tr><td>time</td><td>ISO <span class='label label-important'>Removed</span></td><td>N</td><td>time of moment, when image was created</td></tr>
<tr><td>[type]</td><td>time</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_content":"\/9j\/4AAQSkZJRgABAQAA...J6muSdRzd2ZqrpY\/\/9k=",
      "time":"2005-08-09T18:31:42+03:00"
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
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>time</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":73,
      "day_id":604,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_266":"http:\/\/static.onedayofmine.dev\/897\/days\/604\/0050b9cbb527912bf6f2c52369053bd032a4b2d6_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/897\/days\/604\/0050b9cbb527912bf6f2c52369053bd032a4b2d6_532.jpeg",
      "time":"2005-08-09T18:31:42+03:00",
      "likes_count":0,
      "ctime":1345051315
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="3fc3bfb73af35564223b3c15010dd5dc"></a>
Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.

`POST days/608/update`

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
<tr><td>string</td><td>occupation</td><td>N</td><td>Can be omited, then user profile occupation will be used</td></tr>
<tr><td>string</td><td>type</td><td>N</td><td>One of pre-defined types, see: GET day/type_names request</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_content</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobar",
      "type":"Working day",
      "cover_content":"\/9j\/4AAQSkZJRgABAQAA...J6muSdRzd2ZqrpY\/\/9k="
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
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":608,
      "user_id":901,
      "fb_uid":"100004087981387",
      "image_266":"http:\/\/static.onedayofmine.dev\/901\/days\/b7d534fcfa6467a302320d645de4d35389aeee0b_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/901\/days\/b7d534fcfa6467a302320d645de4d35389aeee0b_532.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobar",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345051356,
      "utime":1345051357,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="22f4469a5d63f172629f782061a62e80"></a>
Finish current day.

`POST days/609/finish`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="012550a73c98965016b8f447f81a0eea"></a>
Deletes a day

`POST days/611/delete`

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
<a name="65c8ee54126b0553b8bc8972f5c62f91"></a>
Restore a deleted day

`POST days/613/restore`

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

### DayUser ###
<a name='DayUser'></a>
#### Item ####
<a name="08450599bfb826e933a60c5554f76de7"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/615/item`

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
<tr><td>bool</td><td>is_favourite</td><td></td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":615,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345051446,
      "utime":1345051446,
      "is_ended":0,
      "user":{
        "id":915,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1
      },
      "is_favourite":true,
      "comments_count":4,
      "comments":[
        {
          "id":44,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051446,
          "utime":1345051446,
          "user":{
            "id":916,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":45,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051446,
          "utime":1345051446,
          "user":{
            "id":917,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":46,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345051446,
          "utime":1345051446,
          "user":{
            "id":918,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
            "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
            "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        }
      ],
      "moments":[
        
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="55a23a54f784d835b9f122ac706244cb"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/616/comment_create`

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
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>day_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":48,
      "user_id":920,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1345051454,
      "utime":1345051454,
      "day_id":616
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="bb088a6a50270041d97309467f3af1b8"></a>
Share a day

`POST days/617/share`

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
      "id":"100004087981387_391748447545250"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="8cb86c9664b169d2ee78a64e2a9683a9"></a>


`POST days/618/like`



##### Response: #####

###### Example response: ######
    "TODO"


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetFavouriteDays ####
<a name="f1f72ef4a12473ea2e0cd48d0d4ef5c0"></a>
Returns favourite based on <a href="#range-request">range-request</a>.

`GET days/favourite`

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
      "from":622,
      "to":619,
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
        "id":621,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051487,
        "utime":1345051487,
        "is_ended":0,
        "user":{
          "id":925,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":4
        },
        "is_favourite":true
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="74f7478d29a5072389164f062a84bf4e"></a>


`POST /days/624/mark_favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="a6117290aec453e6d8f98bb114daf831"></a>


`POST /days/625/unmark_favourite`




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
      "from":629,
      "to":626,
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
        "id":628,
        "fb_uid":"100004093051334",
        "image_266":"http:\/\/static.onedayofmine.dev\/932\/days\/4911dd5dc3158c740ed73e3e0e8258a933f8cd0f_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/932\/days\/4911dd5dc3158c740ed73e3e0e8258a933f8cd0f_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051509,
        "utime":1345051510,
        "is_ended":0,
        "user":{
          "id":932,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":1,
          "following_count":0,
          "days_count":4
        },
        "is_favourite":false
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
      "from":634,
      "to":631,
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
        "id":633,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/933\/days\/ce568efa6730b701c0d52341332d332bd9adafa2_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/933\/days\/ce568efa6730b701c0d52341332d332bd9adafa2_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345051519,
        "utime":1345051519,
        "is_ended":0,
        "user":{
          "id":933,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3
        },
        "is_favourite":false,
        "is_deleted":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### MomentComments ###
<a name='MomentComments'></a>
#### Update ####
<a name="e02f5df7b4f592e3638eaf7cb5cb66a2"></a>


`POST /moment_comments/65/update`

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
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moment_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":65,
      "user_id":941,
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1345051628,
      "utime":1345051629,
      "moment_id":78
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="ca978dc251797b8ef14c0236e0977274"></a>


`POST /moment_comments/67/delete`

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
<a name="a215aaecc12a50f771cfbc72b78c2964"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/82/update`

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
<tr><td>string</td><td>image_content</td><td>N</td><td>File contents, that was previously encoded by base64</td></tr>

</table>
###### Example request: ######
    {
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_content":"\/9j\/4AAQSkZJRgABAQAA...J6muSdRzd2ZqrpY\/\/9k="
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
<tr><td>[type]</td><td>image_266</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_532</td><td>[description]</td></tr>
<tr><td>[type]</td><td>time</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":82,
      "day_id":645,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_266":"http:\/\/static.onedayofmine.dev\/951\/days\/645\/a5d05bbefe95588ad497f032285d5702dd7147fa_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/951\/days\/645\/a5d05bbefe95588ad497f032285d5702dd7147fa_532.jpeg",
      "time":"1970-01-01T00:00:00+00:00",
      "likes_count":0,
      "ctime":1345051661
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="6ca06c230f97737608da63b5f8cdfb5b"></a>
Delete a moment.

`POST moments/83/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="a968ec564617327f6b4c6373bee5a77d"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/84/comment`

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
<tr><td>[type]</td><td>text</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>moment_id</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":69,
      "user_id":953,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1345051696,
      "utime":1345051696,
      "moment_id":84
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
<tr><td>[type]</td><td>image_36</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_72</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_96</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_192</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>favourites_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":954,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
      "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
      "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
      "birthday":"1980-08-08",
      "occupation":"",
      "location":"",
      "followers_count":0,
      "following_count":0,
      "days_count":0,
      "favourites_count":0,
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
<tr><td>[type]</td><td>sex</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_content</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"female",
      "occupation":"foobarfoobarfoobarfoobarf",
      "location":"foobarfoobarfoobarfoobarf",
      "email":"foobarfoobarfoobarfo@odm.com",
      "birthday":"1990-01-02",
      "image_content":"\/9j\/4AAQSkZJRgABAQAA...J6muSdRzd2ZqrpY\/\/9k="
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
<tr><td>[type]</td><td>image_36</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_72</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_96</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_192</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>favourites_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":955,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"female",
      "image_36":"http:\/\/static.onedayofmine.dev\/955\/be32eb696b2cd7239005c59df0b2b952ec823d18_36.jpeg",
      "image_72":"http:\/\/static.onedayofmine.dev\/955\/be32eb696b2cd7239005c59df0b2b952ec823d18_72.jpeg",
      "image_96":"http:\/\/static.onedayofmine.dev\/955\/be32eb696b2cd7239005c59df0b2b952ec823d18_96.jpeg",
      "image_192":"http:\/\/static.onedayofmine.dev\/955\/be32eb696b2cd7239005c59df0b2b952ec823d18_192.jpeg",
      "birthday":"1990-01-02",
      "occupation":"foobarfoobarfoobarfoobarf",
      "location":"foobarfoobarfoobarfoobarf",
      "followers_count":0,
      "following_count":0,
      "days_count":0,
      "favourites_count":0,
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
      "id":5043,
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
      "id":5045,
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
        "id":983,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
<tr><td>[type]</td><td>image_36</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_72</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_96</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_192</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":984,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
      "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
      "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
      "from":58,
      "to":55,
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
        "id":57,
        "recipient_id":987,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1345051966,
        "user":{
          "id":991,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
          "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
          "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":655,
          "user_id":990,
          "fb_uid":"fooba",
          "image_266":null,
          "image_532":null,
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "location":"foobarfoobarfoobarfoobarf",
          "type":"Working day",
          "likes_count":0,
          "ctime":1345051966,
          "utime":1345051966,
          "is_ended":0
        },
        "moment":{
          "id":88,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345051966
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="4e36e20f525e5104988a279d51d1a0a9"></a>
Returns days of specified user

`GET users/1027/days/`

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
        "id":662,
        "user_id":1027,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345052093,
        "utime":1345052093,
        "is_ended":0
      },
      {
        "id":663,
        "user_id":1027,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345052093,
        "utime":1345052093,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="3558efaa6dde6875fb4f864de1809179"></a>
Returns days of specified user

`GET users/1029/item/`

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
<tr><td>string</td><td>image_36</td><td>URL to small variant of user avatar</td></tr>
<tr><td>string</td><td>image_72</td><td>URL to big variant of user avatar</td></tr>
<tr><td>string</td><td>birthday</td><td>Date of user birthday in format "YYYY-MM-DD"</td></tr>
<tr><td>string</td><td>occupation</td><td>User occupation</td></tr>
<tr><td>string</td><td>location</td><td>User location. Usually, but not always, in format "[city], [country]".</td></tr>
<tr><td>int</td><td>followers_count</td><td>Count of users, that follow selected user</td></tr>
<tr><td>int</td><td>following_count</td><td>Count of users, that is followed by selected user</td></tr>
<tr><td>int</td><td>days_count</td><td>Count of days, that was created by selected user</td></tr>
<tr><td>bool</td><td>is_follower</td><td>TRUE if current logged in user if followed by selected user. Can be ommited if selected user is same as current logged in.</td></tr>
<tr><td>bool</td><td>is_followed</td><td>TRUE if selected user is followed by current logged in user. Can be ommited if selected user is same as current logged in.</td></tr>
<tr><td>[type]</td><td>image_96</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_192</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1029,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
      "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
      "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
        "id":1034,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
<a name="21dd53618900e80581241f7a0351f565"></a>
Returns list of users that follow selected user.

`GET users/1035/followers`

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
        "id":1036,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
        "id":1038,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
<a name="176e09bcc505cb5297d8f74478a564e3"></a>
Returns list of users that is followed by selected user.

`GET users/1039/following`

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
        "id":1040,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
<a name="691d4373d9c46706e3257e49ef235a5d"></a>
Start following selected user.

`POST users/1042/follow`

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
<a name="e93aa2c2ad8c39f02ae66ade33162e8f"></a>
Stop following selected user.

`POST users/1044/unfollow`

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
      "from":1045,
      "to":1048,
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
        "id":1046,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"fooA",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_image_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_image_72.png",
        "image_96":"http:\/\/static.onedayofmine.dev\/default_image_96.png",
        "image_192":"http:\/\/static.onedayofmine.dev\/default_image_192.png",
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
