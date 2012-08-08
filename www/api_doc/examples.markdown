# API #
 Version: 08.08.12 22:57:55

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Day'>Day</a> ###
1. <a href='#13baa033facb7c3ebeb9fee8adf3c0bb'>Item</a>
1. <a href='#e8f5b711629a6ac1c0b02dda9c4cb93c'>Item_Many</a>
1. <a href='#d02c1421b14a33caf969b80c80930b8b'>CommentCreate</a>
1. <a href='#745945ebc47606a7e5fe701a220393c8'>ShareDay</a>
1. <a href='#5dec314ec5d041c187afdac0b99675d8'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#c8e55d4ec9960292e004dfd7b5a49305'>AddToFavourites</a>
1. <a href='#8bef0c90e737b61e5c89fbb268a8cee2'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#196c5071791176f0b8e55313639c5370'>CreateComplaint</a>

### <a href='#DaysGuest'>DaysGuest</a> ###
1. <a href='#68db84694264b30f97f496fc471a9fcb'>Item</a>
1. <a href='#4664b8914b07fe4bca1cc18837ee1258'>Item_Many</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#2ff1def39d617f73f7e8c0833733f944'>CreateComplaint</a>

### <a href='#DaysOwner'>DaysOwner</a> ###
1. <a href='#63bbaaed06ef382e262c395e07ba56ee'>Start</a>
1. <a href='#abf38c5e0717c5bc00acddfcea581b46'>CreateMoment</a>
1. <a href='#d09ca1768064b4068e833a1b14d62645'>Update</a>
1. <a href='#c99664bac0b8083e5f2329b7f8d77f50'>Finish</a>
1. <a href='#fce78c396cad7420bbc647a492e7debb'>DeleteDay</a>
1. <a href='#097b431bc0add0c857687e19e37fbe2f'>RestoreDay</a>

### <a href='#DayUser'>DayUser</a> ###
1. <a href='#4b592e606c8fb4bede6578845de11e0d'>Item</a>
1. <a href='#ebf83b09e20d6129123dda19ff873d6a'>CommentCreate</a>
1. <a href='#6ec3ceb9cd45e22b7325637660912daa'>ShareDay</a>
1. <a href='#a3a68524f62772d795c8e8e406324938'>Like</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#bcfee7a055fbc409b4180da3f1610575'>AddToFavourites</a>
1. <a href='#6640c727c29cadf0fcd5144380def7e9'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#4860532cbdc99450d98c706cdc38b7c3'>Update</a>
1. <a href='#ded2da4fd2dd112cd5c2a3066b73c349'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#93ca40519b7d5b90e05d5015fa0726f2'>Update</a>
1. <a href='#c2afd60a0d6034c90bc001136c38ba57'>Delete</a>
1. <a href='#3b21097f1ed7861c0af420f3e12a2a01'>Comment</a>

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
1. <a href='#3ad105cfe28e1fdab3477353f485bd39'>UserByIdDays</a>
1. <a href='#55632229e9f147f4eed3a9aa491768a9'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#4a8aa9deffa2eab5d7528ef873fde1bb'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#1ba22cdb8b6636c648c875ab30ea0405'>FollowingByUserId</a>
1. <a href='#38a502c4276438af7fd0448bb392fbcd'>Follow</a>
1. <a href='#32a731fb49f1262b912b6a574d5f3cf8'>Unfollow</a>
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
      "token":"AAAFnVo0zuqkBAKQtg12...s7LAZAY7gaQjpY1AocEF"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:User'>User</a></td><td>user <span class='label label-important'>Removed</span></td><td>Authorized user information</td></tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>twitter_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>sex</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_36</td><td>[description]</td></tr>
<tr><td>[type]</td><td>image_72</td><td>[description]</td></tr>
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":9662,
      "fb_uid":"100004087981387",
      "twitter_uid":null,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/onedayofmine.dev\/users\/9662\/cd434c4548ad9633c6690b89402bfabd3284cfcf_36x36.jpeg",
      "image_72":"http:\/\/onedayofmine.dev\/users\/9662\/cd434c4548ad9633c6690b89402bfabd3284cfcf_72x72.jpeg",
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


<a href="#toc">^ back to Table of conetens</a>

* * *

### Day ###
<a name='Day'></a>
#### Item ####
<a name="13baa033facb7c3ebeb9fee8adf3c0bb"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/8988/item`

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
<tr><td>bool</td><td>is_favorite</td><td></td></tr>
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
      "id":8988,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working",
      "likes_count":0,
      "ctime":1344455840,
      "utime":1344455840,
      "is_ended":0,
      "user":{
        "id":9670,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1
      },
      "is_favorite":true,
      "comments_count":4,
      "comments":[
        {
          "id":730,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455840,
          "utime":1344455840,
          "user":{
            "id":9671,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":731,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455840,
          "utime":1344455840,
          "user":{
            "id":9672,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":732,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455840,
          "utime":1344455840,
          "user":{
            "id":9673,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
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
          "id":2191,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":"http:\/\/onedayofmine.dev\/",
          "image_532":"http:\/\/onedayofmine.dev\/",
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344455840
        },
        {
          "id":2192,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":"http:\/\/onedayofmine.dev\/",
          "image_532":"http:\/\/onedayofmine.dev\/",
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344455840
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="e8f5b711629a6ac1c0b02dda9c4cb93c"></a>
Get few days in one request.

`GET days/8989;8990;799/item`

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
<tr><td>[type]</td><td>8989 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>8990 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>799 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "8989":{
        "id":8989,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455840,
        "utime":1344455840,
        "is_ended":0,
        "user":{
          "id":9675,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1
        },
        "is_favorite":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":2193,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":"http:\/\/onedayofmine.dev\/",
            "image_532":"http:\/\/onedayofmine.dev\/",
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344455840
          }
        ]
      },
      "8990":{
        "id":8990,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455840,
        "utime":1344455840,
        "is_ended":0,
        "user":{
          "id":9676,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":1
        },
        "is_favorite":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":2194,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":"http:\/\/onedayofmine.dev\/",
            "image_532":"http:\/\/onedayofmine.dev\/",
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344455840
          }
        ]
      },
      "799":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="d02c1421b14a33caf969b80c80930b8b"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/8992/comment_create`

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
      "id":734,
      "user_id":9680,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344455841,
      "utime":1344455841,
      "day_id":8992
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="745945ebc47606a7e5fe701a220393c8"></a>
Share a day

`POST days/8993/share`

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
      "id":"100004087981387_391872014200425"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="5dec314ec5d041c187afdac0b99675d8"></a>


`POST days/8994/like`



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
      "from":8998,
      "to":8995,
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
        "id":8997,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455842,
        "utime":1344455842,
        "is_ended":0,
        "user":{
          "id":9685,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
      "from":9004,
      "to":9001,
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
        "id":9003,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455842,
        "utime":1344455842,
        "is_ended":0,
        "user":{
          "id":9687,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":4
        },
        "is_favorite":true
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="c8e55d4ec9960292e004dfd7b5a49305"></a>


`POST /days/9006/favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="8bef0c90e737b61e5c89fbb268a8cee2"></a>


`POST /days/9007/unfavourite`




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
      "from":9011,
      "to":9008,
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
        "id":9010,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455843,
        "utime":1344455843,
        "is_ended":0,
        "user":{
          "id":9694,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":1,
          "following_count":0,
          "days_count":4
        },
        "is_favorite":false
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
      "from":9017,
      "to":9013,
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
        "id":9016,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455844,
        "utime":1344455844,
        "is_ended":0,
        "user":{
          "id":9695,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
      "from":9018,
      "to":9021,
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
        "id":9019,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":3,
        "ctime":1344369444,
        "utime":1344455844,
        "is_ended":0,
        "user":{
          "id":9697,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
      "from":9026,
      "to":9023,
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
        "id":9025,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455844,
        "utime":1344455844,
        "is_ended":0,
        "user":{
          "id":9699,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3
        },
        "is_favorite":false,
        "is_deleted":0
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
<a name="196c5071791176f0b8e55313639c5370"></a>


`POST /days/9027/create_complaint`

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
      "ctime":1344455845,
      "id":119
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### DaysGuest ###
<a name='DaysGuest'></a>
#### Item ####
<a name="68db84694264b30f97f496fc471a9fcb"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/9028/item`

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
<tr><td>bool</td><td>is_favorited <span class='label label-important'>Removed</span></td><td></td></tr>
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
      "id":9028,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working",
      "likes_count":0,
      "ctime":1344455845,
      "utime":1344455845,
      "is_ended":0,
      "user":{
        "id":9703,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
          "id":735,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455845,
          "utime":1344455845,
          "user":{
            "id":9704,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":736,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455845,
          "utime":1344455845,
          "user":{
            "id":9705,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":737,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455845,
          "utime":1344455845,
          "user":{
            "id":9706,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
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
          "id":2195,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":"http:\/\/onedayofmine.dev\/",
          "image_532":"http:\/\/onedayofmine.dev\/",
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344455845
        },
        {
          "id":2196,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":"http:\/\/onedayofmine.dev\/",
          "image_532":"http:\/\/onedayofmine.dev\/",
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344455845
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="4664b8914b07fe4bca1cc18837ee1258"></a>
Get few days in one request.

`GET days/9029;9030;805/item`

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
<tr><td>[type]</td><td>9029 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>9030 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>805 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "9029":{
        "id":9029,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455845,
        "utime":1344455845,
        "is_ended":0,
        "user":{
          "id":9708,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
            "id":2197,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":"http:\/\/onedayofmine.dev\/",
            "image_532":"http:\/\/onedayofmine.dev\/",
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344455845
          }
        ]
      },
      "9030":{
        "id":9030,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455845,
        "utime":1344455845,
        "is_ended":0,
        "user":{
          "id":9709,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
            "id":2198,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":"http:\/\/onedayofmine.dev\/",
            "image_532":"http:\/\/onedayofmine.dev\/",
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344455845
          }
        ]
      },
      "805":null
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
      "from":9035,
      "to":9032,
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
        "id":9034,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455846,
        "utime":1344455846,
        "is_ended":0,
        "user":{
          "id":9711,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
      "from":9042,
      "to":9038,
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
        "id":9041,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/onedayofmine.dev\/users\/9713\/days\/4d5b5a6d5d42f4bbfe4b4276de166d35cc4ba61b_266x200.jpeg",
        "image_532":"http:\/\/onedayofmine.dev\/users\/9713\/days\/4d5b5a6d5d42f4bbfe4b4276de166d35cc4ba61b_532x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455846,
        "utime":1344455846,
        "is_ended":0,
        "user":{
          "id":9713,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
      "from":9043,
      "to":9046,
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
        "id":9044,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/onedayofmine.dev\/users\/9715\/days\/7ce45551bee183ad72e04720954e9da1cbc2848d_266x200.jpeg",
        "image_532":"http:\/\/onedayofmine.dev\/users\/9715\/days\/7ce45551bee183ad72e04720954e9da1cbc2848d_532x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":3,
        "ctime":1344369447,
        "utime":1344455847,
        "is_ended":0,
        "user":{
          "id":9715,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
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
<a name="2ff1def39d617f73f7e8c0833733f944"></a>


`POST /days/9048/create_complaint`

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
      "ctime":1344455848,
      "id":120
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
<tr><td>int</td><td>timezone <span class='label label-important'>Removed</span></td><td>Y</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td>N</td><td>If omited, then user profile occupation will be used</td></tr>
<tr><td>string</td><td>latlong <span class='label label-important'>Removed</span></td><td>N</td><td>"[Latitude],[Longitude]" of place, where day was created</td></tr>
<tr><td>string</td><td>type</td><td>Y</td><td>One of pre-defined types, see: GET day/type_names request</td></tr>
<tr><td>[type]</td><td>location</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "title":"foobarfoobarfoobarfoobarf",
      "location":"foobarfoobarfoobarfoobarf",
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
      "id":9049,
      "user_id":9720,
      "fb_uid":"100004087981387",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working",
      "likes_count":0,
      "ctime":1344455848,
      "utime":1344455848,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CreateMoment ####
<a name="abf38c5e0717c5bc00acddfcea581b46"></a>
Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.

`POST days/9051/moment_create`

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
<tr><td>int</td><td>time</td><td>N</td><td>ISO time, when picture was created. If omited, current time will be used.</td></tr>

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
      "id":2199,
      "day_id":9051,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_266":"http:\/\/onedayofmine.dev\/\/users\/9722\/days\/9051\/5c57a55ba5988feb2e04e691dc3d1cb512aacd7f_266x200.jpeg",
      "image_532":"http:\/\/onedayofmine.dev\/\/users\/9722\/days\/9051\/5c57a55ba5988feb2e04e691dc3d1cb512aacd7f_532x400.jpeg",
      "time":"2005-08-09T18:31:42+03:00",
      "likes_count":0,
      "ctime":1344455849
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="d09ca1768064b4068e833a1b14d62645"></a>
Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.

`POST days/9053/update`

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
      "type":"Working",
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
      "id":9053,
      "user_id":9724,
      "fb_uid":"100004087981387",
      "image_266":"http:\/\/onedayofmine.dev\/users\/9724\/days\/d9be42d9c72e6e94924446f2862c8650688d0780_266x200.jpeg",
      "image_532":"http:\/\/onedayofmine.dev\/users\/9724\/days\/d9be42d9c72e6e94924446f2862c8650688d0780_532x400.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobar",
      "type":"Working",
      "likes_count":0,
      "ctime":1344455849,
      "utime":1344455850,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="c99664bac0b8083e5f2329b7f8d77f50"></a>
Finish current day.

`POST days/9054/finish`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="fce78c396cad7420bbc647a492e7debb"></a>
Deletes a day

`POST days/9056/delete`

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
<a name="097b431bc0add0c857687e19e37fbe2f"></a>
Restore a deleted day

`POST days/9058/restore`

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
<a name="4b592e606c8fb4bede6578845de11e0d"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/9060/item`

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
<tr><td>bool</td><td>is_favorited <span class='label label-important'>Removed</span></td><td></td></tr>
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
<tr><td>[type]</td><td>is_favorite</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":9060,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working",
      "likes_count":0,
      "ctime":1344455852,
      "utime":1344455852,
      "is_ended":0,
      "user":{
        "id":9738,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
        "birthday":"1990-01-02",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
        "location":"",
        "followers_count":0,
        "following_count":0,
        "days_count":1
      },
      "is_favorite":true,
      "comments_count":4,
      "comments":[
        {
          "id":739,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455852,
          "utime":1344455852,
          "user":{
            "id":9739,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":740,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455852,
          "utime":1344455852,
          "user":{
            "id":9740,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":741,
          "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344455852,
          "utime":1344455852,
          "user":{
            "id":9741,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/onedayofmine.dev\/",
            "image_72":"http:\/\/onedayofmine.dev\/",
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
<a name="ebf83b09e20d6129123dda19ff873d6a"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/9061/comment_create`

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
      "id":743,
      "user_id":9743,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344455852,
      "utime":1344455852,
      "day_id":9061
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="6ec3ceb9cd45e22b7325637660912daa"></a>
Share a day

`POST days/9062/share`

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
      "id":"100004087981387_391872014200425"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="a3a68524f62772d795c8e8e406324938"></a>


`POST days/9063/like`



##### Response: #####

###### Example response: ######
    "TODO"


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
      "from":9067,
      "to":9064,
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
        "id":9066,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455853,
        "utime":1344455853,
        "is_ended":0,
        "user":{
          "id":9748,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":4
        },
        "is_favorite":true
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="bcfee7a055fbc409b4180da3f1610575"></a>


`POST /days/9069/favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="6640c727c29cadf0fcd5144380def7e9"></a>


`POST /days/9070/unfavourite`




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
      "from":9074,
      "to":9071,
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
        "id":9073,
        "fb_uid":"100004093051334",
        "image_266":"http:\/\/onedayofmine.dev\/users\/9755\/days\/185b79cb45d9dde8399535e3e2f35f517f6a869d_266x200.jpeg",
        "image_532":"http:\/\/onedayofmine.dev\/users\/9755\/days\/185b79cb45d9dde8399535e3e2f35f517f6a869d_532x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455854,
        "utime":1344455854,
        "is_ended":0,
        "user":{
          "id":9755,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1982-08-08",
          "occupation":"",
          "location":"",
          "followers_count":1,
          "following_count":0,
          "days_count":4
        },
        "is_favorite":false
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
      "from":9079,
      "to":9076,
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
        "id":9078,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/onedayofmine.dev\/users\/9756\/days\/b1c27e97a2d386e433ebd19b51c81a7a13d0ab7c_266x200.jpeg",
        "image_532":"http:\/\/onedayofmine.dev\/users\/9756\/days\/b1c27e97a2d386e433ebd19b51c81a7a13d0ab7c_532x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455854,
        "utime":1344455855,
        "is_ended":0,
        "user":{
          "id":9756,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1980-08-08",
          "occupation":"",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":3
        },
        "is_favorite":false,
        "is_deleted":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### MomentComments ###
<a name='MomentComments'></a>
#### Update ####
<a name="4860532cbdc99450d98c706cdc38b7c3"></a>


`POST /moment_comments/922/update`

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
      "id":922,
      "user_id":9764,
      "user_name":"bar bar",
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1344455859,
      "utime":1344455859,
      "moment_id":2204
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="ded2da4fd2dd112cd5c2a3066b73c349"></a>


`POST /moment_comments/924/delete`

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
<a name="93ca40519b7d5b90e05d5015fa0726f2"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/2208/update`

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
      "id":2208,
      "day_id":9090,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_266":"http:\/\/onedayofmine.dev\/",
      "image_532":"http:\/\/onedayofmine.dev\/",
      "time":"1970-01-01T00:00:00+00:00",
      "likes_count":0,
      "ctime":1344455860
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="c2afd60a0d6034c90bc001136c38ba57"></a>
Delete a moment.

`POST moments/2209/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="3b21097f1ed7861c0af420f3e12a2a01"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/2210/comment`

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
      "id":926,
      "user_id":9776,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344455860,
      "utime":1344455860,
      "moment_id":2210
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
      "id":9777,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/onedayofmine.dev\/",
      "image_72":"http:\/\/onedayofmine.dev\/",
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
<tr><td>[type]</td><td>image_content</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "name":"foobarfoobarfoobarfoobarf",
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
      "id":9778,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"male",
      "image_36":"http:\/\/onedayofmine.dev\/users\/9778\/2b70980ff4048de8011a536a80f2c611a8f186e8_36x36.jpeg",
      "image_72":"http:\/\/onedayofmine.dev\/users\/9778\/2b70980ff4048de8011a536a80f2c611a8f186e8_72x72.jpeg",
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
      "id":16506,
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
      "id":16508,
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
        "id":9806,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
<tr><td>[type]</td><td>birthday</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>followers_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>following_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>days_count</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":9807,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/onedayofmine.dev\/",
      "image_72":"http:\/\/onedayofmine.dev\/",
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
      "from":2130,
      "to":2127,
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
        "id":2129,
        "recipient_id":9810,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1344455865,
        "user":{
          "id":9814,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/onedayofmine.dev\/",
          "image_72":"http:\/\/onedayofmine.dev\/",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":9100,
          "user_id":9813,
          "fb_uid":"fooba",
          "image_266":null,
          "image_532":null,
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "location":"foobarfoobarfoobarfoobarf",
          "type":"Working",
          "likes_count":0,
          "ctime":1344455865,
          "utime":1344455865,
          "is_ended":0
        },
        "moment":{
          "id":2214,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":"http:\/\/onedayofmine.dev\/",
          "image_532":"http:\/\/onedayofmine.dev\/",
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344455865
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="3ad105cfe28e1fdab3477353f485bd39"></a>
Returns days of specified user

`GET users/9850/days/`

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
        "id":9107,
        "user_id":9850,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455872,
        "utime":1344455872,
        "is_ended":0
      },
      {
        "id":9108,
        "user_id":9850,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working",
        "likes_count":0,
        "ctime":1344455872,
        "utime":1344455872,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="55632229e9f147f4eed3a9aa491768a9"></a>
Returns days of specified user

`GET users/9852/item/`

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

</table>
###### Example response: ######
    {
      "id":9852,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/onedayofmine.dev\/",
      "image_72":"http:\/\/onedayofmine.dev\/",
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
        "id":9857,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
<a name="4a8aa9deffa2eab5d7528ef873fde1bb"></a>
Returns list of users that follow selected user.

`GET users/9858/followers`

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
        "id":9859,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
        "id":9861,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
<a name="1ba22cdb8b6636c648c875ab30ea0405"></a>
Returns list of users that is followed by selected user.

`GET users/9862/following`

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
        "id":9863,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"male",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
<a name="38a502c4276438af7fd0448bb392fbcd"></a>
Start following selected user.

`POST users/9865/follow`

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
<a name="32a731fb49f1262b912b6a574d5f3cf8"></a>
Stop following selected user.

`POST users/9867/unfollow`

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
      "from":9868,
      "to":9871,
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
        "id":9869,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"fooA",
        "sex":"female",
        "image_36":"http:\/\/onedayofmine.dev\/",
        "image_72":"http:\/\/onedayofmine.dev\/",
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
