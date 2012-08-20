# API #
 Version: 20.08.12 10:20:28

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>
1. <a href='#a4f262f1ba860bb2759f57a1a5438a7d'>Login_WrongAccessToken</a>

### <a href='#Day'>Day</a> ###
1. <a href='#ef373742d7b81ab2450b0bd5df0e03d1'>Item</a>
1. <a href='#8050047d0b63697801fcaa25d3b2d0db'>Item_Many</a>
1. <a href='#fcc6ca7c0a78759128955bd7379e9e2e'>CommentCreate</a>
1. <a href='#ca7fe1c02cc58b36aa0cf243d0ea4d27'>ShareDay</a>
1. <a href='#27426171fe48463c33f02f9da1a8fdaf'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#f1f72ef4a12473ea2e0cd48d0d4ef5c0'>GetFavouriteDays</a>
1. <a href='#268aa40cec297e9503f26d2bcaf575c0'>AddToFavourites</a>
1. <a href='#8724a105271cbdb73107e0c3e05733ee'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#2a745393972745222ea3423302eb97c6'>Types</a>
1. <a href='#1cc6fc5f15f6bc443baa55e2fd8bb7d6'>CreateComplaint</a>

### <a href='#DaysGuest'>DaysGuest</a> ###
1. <a href='#ca3dcacd4e884f01b5f57b71740badd6'>Item</a>
1. <a href='#df5eb12b3a9460fc58c36d7acba8494f'>Item_Many</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#2a745393972745222ea3423302eb97c6'>Types</a>
1. <a href='#cf20e89b0d982ec26d604c2430cedd5d'>CreateComplaint</a>

### <a href='#DaysOwner'>DaysOwner</a> ###
1. <a href='#63bbaaed06ef382e262c395e07ba56ee'>Start</a>
1. <a href='#55c7c26044e4bcc2573faa0b0ab4206d'>CreateMoment</a>
1. <a href='#30d19929fcacf92b6e38da8ce4d9640b'>Update</a>
1. <a href='#32e4f54a46fbd57a8085d7e48f3dc8cd'>Finish</a>
1. <a href='#4325f303413b06a45dc31cb077cd5e7e'>DeleteDay</a>
1. <a href='#b6feb4609073710de0e4ce12260e974d'>RestoreDay</a>

### <a href='#DayUser'>DayUser</a> ###
1. <a href='#f39bc6acc6e7cb4aca0102ba414b5029'>Item</a>
1. <a href='#84a1617eaf8efe95e49df332b7a22ef3'>CommentCreate</a>
1. <a href='#94d0aa2a35cc5d04c1eba3945925a654'>ShareDay</a>
1. <a href='#5e28623249093a016aadf3b983a2b72d'>Like</a>
1. <a href='#f1f72ef4a12473ea2e0cd48d0d4ef5c0'>GetFavouriteDays</a>
1. <a href='#37c0e91a1af6c16161815b5ca51a1c66'>AddToFavourites</a>
1. <a href='#06a177235c078f88d425076ac92376fd'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#9a58788017220fbd6cb0b829d5dfcab8'>Update</a>
1. <a href='#7c6f91613946633b99a8d355cb2525be'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#6cbbafda3f8964d852a6f45b049500b5'>Update</a>
1. <a href='#d7496c6eecda50825f96efcd648fe615'>Delete</a>
1. <a href='#9c890a14c3ce814b55f90f8612e22b0b'>Comment</a>

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
1. <a href='#c5686c9b1ca79411c6ae20b4c3ce7fae'>UserByIdDays</a>
1. <a href='#7ee91cc0c78a211134f12cd86bf960e5'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#c49c56bca0363c8b1fd423b1dea6de2f'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#d633d3179f17502992637b21806057a2'>FollowingByUserId</a>
1. <a href='#18979d0117bf39ba531d21573b724252'>Follow</a>
1. <a href='#c389f9f7e0dd138628fe7664d129d042'>Unfollow</a>
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
      "token":"AAAFnVo0zuqkBAADuZBG...ZBZCKxUF42pi6fd8HkDO"
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
      "token":"AAAFnVo0zuqkBACGmEMn...QZBpKIKKssVEwaMJI3Yj"
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
      "id":9593,
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
      "token":"Wrong_access_token"
    }




<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="ef373742d7b81ab2450b0bd5df0e03d1"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/4983`

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
      "id":4983,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345447185,
      "utime":1345447185,
      "is_ended":0,
      "user":{
        "id":9601,
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
          "id":593,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447185,
          "utime":1345447185,
          "user":{
            "id":9602,
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
          "id":594,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447185,
          "utime":1345447185,
          "user":{
            "id":9603,
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
          "id":595,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447186,
          "utime":1345447186,
          "user":{
            "id":9604,
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
          "id":3923,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345447185,
          "comments_count":4
        },
        {
          "id":3924,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345447185,
          "comments_count":4
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="8050047d0b63697801fcaa25d3b2d0db"></a>
Get few days in one request.

`GET days/4984;4985;499/item`

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
<tr><td>[type]</td><td>4984 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>4985 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>499 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "4984":{
        "id":4984,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447186,
        "utime":1345447186,
        "is_ended":0,
        "user":{
          "id":9606,
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
            "id":3925,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345447186,
            "comments_count":0
          }
        ]
      },
      "4985":{
        "id":4985,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447186,
        "utime":1345447186,
        "is_ended":0,
        "user":{
          "id":9607,
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
            "id":3926,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345447186,
            "comments_count":0
          }
        ]
      },
      "499":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="fcc6ca7c0a78759128955bd7379e9e2e"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/4987/comment_create`

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
      "id":597,
      "user_id":9611,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1345447187,
      "utime":1345447187,
      "day_id":4987
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="ca7fe1c02cc58b36aa0cf243d0ea4d27"></a>
Share a day

`POST days/4988/share`

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
#### Like ####
<a name="27426171fe48463c33f02f9da1a8fdaf"></a>


`POST days/4989/like`



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
      "id":4989,
      "fb_uid":"100004093051334",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":1,
      "ctime":1345447187,
      "utime":1345447188,
      "is_ended":0,
      "user":{
        "id":9614,
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
      "from":4993,
      "to":4990,
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
        "id":4992,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447188,
        "utime":1345447188,
        "is_ended":0,
        "user":{
          "id":9616,
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
      "from":4999,
      "to":4996,
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
        "id":4998,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447189,
        "utime":1345447189,
        "is_ended":0,
        "user":{
          "id":9618,
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
<a name="268aa40cec297e9503f26d2bcaf575c0"></a>


`POST /days/5001/mark_favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="8724a105271cbdb73107e0c3e05733ee"></a>


`POST /days/5002/unmark_favourite`




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
      "from":5006,
      "to":5003,
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
        "id":5005,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447190,
        "utime":1345447190,
        "is_ended":0,
        "user":{
          "id":9625,
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
      "from":5012,
      "to":5008,
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
        "id":5011,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447191,
        "utime":1345447191,
        "is_ended":0,
        "user":{
          "id":9626,
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
      "from":5013,
      "to":5016,
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
        "id":5014,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":3,
        "ctime":1345360792,
        "utime":1345447192,
        "is_ended":0,
        "user":{
          "id":9628,
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
      "from":5021,
      "to":5018,
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
        "id":5020,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447192,
        "utime":1345447192,
        "is_ended":0,
        "user":{
          "id":9630,
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
<a name="1cc6fc5f15f6bc443baa55e2fd8bb7d6"></a>


`POST /days/5022/create_complaint`

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
      "ctime":1345447194,
      "id":72
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### DaysGuest ###
<a name='DaysGuest'></a>
#### Item ####
<a name="ca3dcacd4e884f01b5f57b71740badd6"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/5023`

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
      "id":5023,
      "fb_uid":"fooba",
      "image_266":"http:\/\/static.onedayofmine.dev\/9634\/days\/4bb8f8eb24027ed18fc793a0de0b4cb8df610913_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/9634\/days\/4bb8f8eb24027ed18fc793a0de0b4cb8df610913_532.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345447194,
      "utime":1345447194,
      "is_ended":0,
      "user":{
        "id":9634,
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
          "id":598,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447194,
          "utime":1345447194,
          "user":{
            "id":9635,
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
          "id":599,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447194,
          "utime":1345447194,
          "user":{
            "id":9636,
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
          "id":600,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447194,
          "utime":1345447194,
          "user":{
            "id":9637,
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
          "id":3927,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345447194,
          "comments_count":4
        },
        {
          "id":3928,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345447194,
          "comments_count":4
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="df5eb12b3a9460fc58c36d7acba8494f"></a>
Get few days in one request.

`GET days/5024;5025;937/item`

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
<tr><td>[type]</td><td>5024 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>5025 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>937 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "5024":{
        "id":5024,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447194,
        "utime":1345447194,
        "is_ended":0,
        "user":{
          "id":9639,
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
            "id":3929,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345447194,
            "comments_count":0
          }
        ]
      },
      "5025":{
        "id":5025,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447195,
        "utime":1345447195,
        "is_ended":0,
        "user":{
          "id":9640,
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
            "id":3930,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1345447195,
            "comments_count":0
          }
        ]
      },
      "937":null
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
      "from":5030,
      "to":5027,
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
        "id":5029,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447195,
        "utime":1345447195,
        "is_ended":0,
        "user":{
          "id":9642,
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
      "from":5037,
      "to":5033,
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
        "id":5036,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/9644\/days\/1260a307f1cc0047b69dffb14d9f8b678f790a16_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/9644\/days\/1260a307f1cc0047b69dffb14d9f8b678f790a16_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447196,
        "utime":1345447196,
        "is_ended":0,
        "user":{
          "id":9644,
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
      "from":5038,
      "to":5041,
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
        "id":5039,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/9646\/days\/8d59961a646f5b347e056a2e9272361191d238a5_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/9646\/days\/8d59961a646f5b347e056a2e9272361191d238a5_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":3,
        "ctime":1345360796,
        "utime":1345447197,
        "is_ended":0,
        "user":{
          "id":9646,
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
<a name="cf20e89b0d982ec26d604c2430cedd5d"></a>


`POST /days/5043/create_complaint`

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
      "ctime":1345447197,
      "id":73
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
      "id":5044,
      "fb_uid":"100004087981387",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345447198,
      "utime":1345447198,
      "is_ended":0,
      "user":{
        "id":9651,
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
<a name="55c7c26044e4bcc2573faa0b0ab4206d"></a>
Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.

`POST days/5047/moment_create`

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
      "id":3931,
      "day_id":5047,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_266":"http:\/\/static.onedayofmine.dev\/9654\/days\/5047\/cbcdc5b5d80e5a46e7df101e583ffb6512cfb3d1_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/9654\/days\/5047\/cbcdc5b5d80e5a46e7df101e583ffb6512cfb3d1_532.jpeg",
      "time":"2005-08-09T18:31:42+03:00",
      "likes_count":0,
      "ctime":1345447199
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="30d19929fcacf92b6e38da8ce4d9640b"></a>
Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.

`POST days/5051/update`

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
      "id":5051,
      "user_id":9658,
      "fb_uid":"100004087981387",
      "image_266":"http:\/\/static.onedayofmine.dev\/9658\/days\/81a61a462e2eedcbf43fa690151a883cf3f43dc7_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/9658\/days\/81a61a462e2eedcbf43fa690151a883cf3f43dc7_532.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobar",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345447205,
      "utime":1345447206,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="32e4f54a46fbd57a8085d7e48f3dc8cd"></a>
Finish current day.

`POST days/5052/finish`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="4325f303413b06a45dc31cb077cd5e7e"></a>
Deletes a day

`POST days/5054/delete`

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
<a name="b6feb4609073710de0e4ce12260e974d"></a>
Restore a deleted day

`POST days/5056/restore`

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
<a name="f39bc6acc6e7cb4aca0102ba414b5029"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/5058/item`

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
      "id":5058,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1345447208,
      "utime":1345447208,
      "is_ended":0,
      "user":{
        "id":9672,
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
          "id":602,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447208,
          "utime":1345447208,
          "user":{
            "id":9673,
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
          "id":603,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447208,
          "utime":1345447208,
          "user":{
            "id":9674,
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
          "id":604,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1345447208,
          "utime":1345447208,
          "user":{
            "id":9675,
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
<a name="84a1617eaf8efe95e49df332b7a22ef3"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/5059/comment_create`

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
      "id":606,
      "user_id":9677,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1345447209,
      "utime":1345447209,
      "day_id":5059
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="94d0aa2a35cc5d04c1eba3945925a654"></a>
Share a day

`POST days/5060/share`

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
#### Like ####
<a name="5e28623249093a016aadf3b983a2b72d"></a>


`POST days/5061/like`



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
      "id":5061,
      "fb_uid":"100004093051334",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":1,
      "ctime":1345447209,
      "utime":1345447210,
      "is_ended":0,
      "user":{
        "id":9680,
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
      "from":5065,
      "to":5062,
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
        "id":5064,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447210,
        "utime":1345447210,
        "is_ended":0,
        "user":{
          "id":9682,
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
<a name="37c0e91a1af6c16161815b5ca51a1c66"></a>


`POST /days/5067/mark_favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="06a177235c078f88d425076ac92376fd"></a>


`POST /days/5068/unmark_favourite`




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
      "from":5072,
      "to":5069,
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
        "id":5071,
        "fb_uid":"100004093051334",
        "image_266":"http:\/\/static.onedayofmine.dev\/9689\/days\/69462a4ccf895f9fbdf5113856a60f563e818bf0_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/9689\/days\/69462a4ccf895f9fbdf5113856a60f563e818bf0_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447211,
        "utime":1345447211,
        "is_ended":0,
        "user":{
          "id":9689,
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
      "from":5077,
      "to":5074,
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
        "id":5076,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/9690\/days\/9b6629a793c0e62ebd8e264554d9053fec6faa68_266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/9690\/days\/9b6629a793c0e62ebd8e264554d9053fec6faa68_532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447212,
        "utime":1345447212,
        "is_ended":0,
        "user":{
          "id":9690,
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
<a name="9a58788017220fbd6cb0b829d5dfcab8"></a>


`POST /moment_comments/861/update`

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
      "id":861,
      "user_id":9691,
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1345447213,
      "utime":1345447213,
      "moment_id":3935
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="7c6f91613946633b99a8d355cb2525be"></a>


`POST /moment_comments/863/delete`

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
<a name="6cbbafda3f8964d852a6f45b049500b5"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/3939/update`

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
      "id":3939,
      "day_id":5082,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_266":"http:\/\/static.onedayofmine.dev\/9701\/days\/5082\/a4edf2c7eb297133c850faa4579ea8210f640367_266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/9701\/days\/5082\/a4edf2c7eb297133c850faa4579ea8210f640367_532.jpeg",
      "time":"1970-01-01T00:00:00+00:00",
      "likes_count":0,
      "ctime":1345447214
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="d7496c6eecda50825f96efcd648fe615"></a>
Delete a moment.

`POST moments/3940/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="9c890a14c3ce814b55f90f8612e22b0b"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/3941/comment`

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
      "id":865,
      "user_id":9703,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1345447215,
      "utime":1345447215,
      "moment_id":3941
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
      "id":9704,
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
      "id":9705,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"female",
      "image_36":"http:\/\/static.onedayofmine.dev\/9705\/adc5ccd4bf25c99059f8a00772fc382b7cdd96f6_36.jpeg",
      "image_72":"http:\/\/static.onedayofmine.dev\/9705\/adc5ccd4bf25c99059f8a00772fc382b7cdd96f6_72.jpeg",
      "image_96":"http:\/\/static.onedayofmine.dev\/9705\/adc5ccd4bf25c99059f8a00772fc382b7cdd96f6_96.jpeg",
      "image_192":"http:\/\/static.onedayofmine.dev\/9705\/adc5ccd4bf25c99059f8a00772fc382b7cdd96f6_192.jpeg",
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
<tr><td>[type]</td><td>social_share_facebook</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>social_share_twitter</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "notifications_new_days":0,
      "notifications_new_comments":0,
      "notifications_related_activity":0,
      "notifications_shooting_photos":0,
      "photos_save_original":0,
      "photos_save_filtered":0,
      "social_share_facebook":0,
      "social_share_twitter":0
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
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
      "notifications_new_days":0,
      "notifications_new_comments":0,
      "notifications_related_activity":0,
      "notifications_shooting_photos":0,
      "photos_save_original":0,
      "photos_save_filtered":0,
      "social_share_facebook":0,
      "social_share_twitter":0
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
        "id":9733,
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
      "id":9734,
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
      "from":920,
      "to":917,
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
        "id":919,
        "recipient_id":9737,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1345447221,
        "user":{
          "id":9741,
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
          "id":5092,
          "user_id":9740,
          "fb_uid":"fooba",
          "image_266":null,
          "image_532":null,
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "location":"foobarfoobarfoobarfoobarf",
          "type":"Working day",
          "likes_count":0,
          "ctime":1345447221,
          "utime":1345447221,
          "is_ended":0
        },
        "moment":{
          "id":3945,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1345447221
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="c5686c9b1ca79411c6ae20b4c3ce7fae"></a>
Returns days of specified user

`GET users/9743/days/`

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
        "id":5093,
        "user_id":9743,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447222,
        "utime":1345447222,
        "is_ended":0
      },
      {
        "id":5094,
        "user_id":9743,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1345447222,
        "utime":1345447222,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="7ee91cc0c78a211134f12cd86bf960e5"></a>
Returns days of specified user

`GET users/9745/item/`

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
      "id":9745,
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
        "id":9750,
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
<a name="c49c56bca0363c8b1fd423b1dea6de2f"></a>
Returns list of users that follow selected user.

`GET users/9751/followers`

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
        "id":9752,
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
        "id":9754,
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
<a name="d633d3179f17502992637b21806057a2"></a>
Returns list of users that is followed by selected user.

`GET users/9755/following`

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
        "id":9756,
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
<a name="18979d0117bf39ba531d21573b724252"></a>
Start following selected user.

`POST users/9758/follow`

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
<a name="c389f9f7e0dd138628fe7664d129d042"></a>
Stop following selected user.

`POST users/9760/unfollow`

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
      "from":9761,
      "to":9764,
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
        "id":9762,
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
