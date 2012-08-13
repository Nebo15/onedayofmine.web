# API #
 Version: 13.08.12 17:51:58

## Table of contents: ##
<a name='toc'></a>

### <a href='#Auth'>Auth</a> ###
1. <a href='#f3fe153a8e0372904ddc25f133cecd23'>IsLoggedIn</a>
1. <a href='#bbc87c2030342e7f8609accf937e12ee'>Login</a>

### <a href='#Day'>Day</a> ###
1. <a href='#07b70d12a636e89153d8c4e8ed1d5bd4'>Item</a>
1. <a href='#4940cffb479844fcf2ed7a1774a4fbc7'>Item_Many</a>
1. <a href='#a8360f3545f91abdd86e1c037c51e371'>CommentCreate</a>
1. <a href='#2c21452c7f408d717c6cc14fad4f0d6b'>ShareDay</a>
1. <a href='#c5ae0aeaa27577efbe1ad0d913fcb5a8'>Like</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#58bef24f0b9f6f2ead334c22890a53b7'>AddToFavourites</a>
1. <a href='#3eee470f7b7255cdc142a5f91498e6b3'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#2a745393972745222ea3423302eb97c6'>Types</a>
1. <a href='#b5bdb63e7c03a8de662552f731bd88c5'>CreateComplaint</a>

### <a href='#DaysGuest'>DaysGuest</a> ###
1. <a href='#364665bd3f398422a817f0ec97fcea19'>Item</a>
1. <a href='#dc0938826de4af5d1f42a8e081715176'>Item_Many</a>
1. <a href='#09f10c6db22580edd1ebac5ba800cc23'>Search</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#2a745393972745222ea3423302eb97c6'>Types</a>
1. <a href='#c7cd7241d8da52f2739131a5f9f27f36'>CreateComplaint</a>

### <a href='#DaysOwner'>DaysOwner</a> ###
1. <a href='#63bbaaed06ef382e262c395e07ba56ee'>Start</a>
1. <a href='#d3582c434c67f08d47c4153d7a1e548b'>CreateMoment</a>
1. <a href='#61670a56f7e20c94d682905fb9883fa2'>Update</a>
1. <a href='#cab3fcf832b345439db9e591e0da955e'>Finish</a>
1. <a href='#06400a13ba76fb1c6d77933ef4567de8'>DeleteDay</a>
1. <a href='#9bd2b0aab3b6c34a28a92b9cd17eff28'>RestoreDay</a>

### <a href='#DayUser'>DayUser</a> ###
1. <a href='#6768c7acb035502bb04a274e8046dd4a'>Item</a>
1. <a href='#b75e3ef09f14493660ad98bfa102e09e'>CommentCreate</a>
1. <a href='#f95427281693ada6b91e6c4b4b40c066'>ShareDay</a>
1. <a href='#5b29951656fb733addbdcdcebac94123'>Like</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#d2b66bba3c9cb323f6bada380289f1ec'>AddToFavourites</a>
1. <a href='#a48d0abf9fc891b1fe46bd6cdf1d60f9'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>

### <a href='#MomentComments'>MomentComments</a> ###
1. <a href='#45f4ae25d8b10b053bed6e3bcf66dff1'>Update</a>
1. <a href='#74439bd54bf45524430888cd5061648c'>Delete</a>

### <a href='#Moments'>Moments</a> ###
1. <a href='#0696d34c6825fa91cf100cd32a459b9f'>Update</a>
1. <a href='#0eecdcd55eed4d93342aca34068bcb14'>Delete</a>
1. <a href='#cdc24d5cdec24b8cd12a80b94306ee59'>Comment</a>

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
1. <a href='#76126fa1456cc3a145c98af28706f07f'>UserByIdDays</a>
1. <a href='#f24e754d150092f47c1e3e6128648efb'>UserById</a>
1. <a href='#0907aac9dba2a8f9700b9333f7e36795'>Followers</a>
1. <a href='#cbefb0a5fec15825a8bb831c144a308a'>FollowersByUserId</a>
1. <a href='#774c23c770724885bdc9325b3159b700'>Following</a>
1. <a href='#8279a0d062bdef358233988ee83e6658'>FollowingByUserId</a>
1. <a href='#2cc69bd972871c4927349d6c4ae7eb47'>Follow</a>
1. <a href='#141c0c92b8bd428a6d85f9e8aab26f99'>Unfollow</a>
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
      "token":"AAAFnVo0zuqkBAJIZBEj...cofiMH4rcma608AVw1vV"
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
      "token":"AAAFnVo0zuqkBANLPdWB...tifk6MbQlXp0yeT8Uk2y"
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
<tr><td>[type]</td><td>favourites_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":35093,
      "fb_uid":"100004093051334",
      "twitter_uid":0,
      "name":"foo foo",
      "sex":"female",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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

### Day ###
<a name='Day'></a>
#### Item ####
<a name="07b70d12a636e89153d8c4e8ed1d5bd4"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/24149`

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
      "id":24149,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1344869447,
      "utime":1344869447,
      "is_ended":0,
      "user":{
        "id":35101,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
          "id":822,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869447,
          "utime":1344869447,
          "user":{
            "id":35102,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":823,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869447,
          "utime":1344869447,
          "user":{
            "id":35103,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":824,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869447,
          "utime":1344869447,
          "user":{
            "id":35104,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
          "id":5774,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344869447,
          "comments_count":4
        },
        {
          "id":5775,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344869447,
          "comments_count":4
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="4940cffb479844fcf2ed7a1774a4fbc7"></a>
Get few days in one request.

`GET days/24150;24151;857/item`

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
<tr><td>[type]</td><td>24150 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>24151 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>857 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "24150":{
        "id":24150,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869447,
        "utime":1344869447,
        "is_ended":0,
        "user":{
          "id":35106,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
            "id":5776,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344869447,
            "comments_count":0
          }
        ]
      },
      "24151":{
        "id":24151,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869447,
        "utime":1344869447,
        "is_ended":0,
        "user":{
          "id":35107,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
            "id":5777,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344869447,
            "comments_count":0
          }
        ]
      },
      "857":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="a8360f3545f91abdd86e1c037c51e371"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/24153/comment_create`

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
      "id":826,
      "user_id":35111,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344869448,
      "utime":1344869448,
      "day_id":24153
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="2c21452c7f408d717c6cc14fad4f0d6b"></a>
Share a day

`POST days/24154/share`

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
      "id":"100004087981387_401554699903237"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="c5ae0aeaa27577efbe1ad0d913fcb5a8"></a>


`POST days/24155/like`



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
      "from":24159,
      "to":24156,
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
        "id":24158,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869452,
        "utime":1344869452,
        "is_ended":0,
        "user":{
          "id":35116,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24165,
      "to":24162,
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
        "id":24164,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869452,
        "utime":1344869452,
        "is_ended":0,
        "user":{
          "id":35118,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="58bef24f0b9f6f2ead334c22890a53b7"></a>


`POST /days/24167/mark_favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="3eee470f7b7255cdc142a5f91498e6b3"></a>


`POST /days/24168/unmark_favourite`




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
      "from":24172,
      "to":24169,
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
        "id":24171,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869453,
        "utime":1344869453,
        "is_ended":0,
        "user":{
          "id":35125,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24178,
      "to":24174,
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
        "id":24177,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869453,
        "utime":1344869453,
        "is_ended":0,
        "user":{
          "id":35126,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24179,
      "to":24182,
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
        "id":24180,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":3,
        "ctime":1344783054,
        "utime":1344869454,
        "is_ended":0,
        "user":{
          "id":35128,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24187,
      "to":24184,
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
        "id":24186,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869454,
        "utime":1344869454,
        "is_ended":0,
        "user":{
          "id":35130,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="b5bdb63e7c03a8de662552f731bd88c5"></a>


`POST /days/24188/create_complaint`

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
      "ctime":1344869455,
      "id":357
    }


<a href="#toc">^ back to Table of conetens</a>

* * *

### DaysGuest ###
<a name='DaysGuest'></a>
#### Item ####
<a name="364665bd3f398422a817f0ec97fcea19"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/24189`

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
      "id":24189,
      "fb_uid":"fooba",
      "image_266":"http:\/\/static.onedayofmine.dev\/35134\/days\/3cebcb223d0a68cc2d08feae3590db3018f7ed04_266x266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/35134\/days\/3cebcb223d0a68cc2d08feae3590db3018f7ed04_532x532.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1344869455,
      "utime":1344869455,
      "is_ended":0,
      "user":{
        "id":35134,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
          "id":827,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869455,
          "utime":1344869455,
          "user":{
            "id":35135,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":828,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869455,
          "utime":1344869455,
          "user":{
            "id":35136,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":829,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869455,
          "utime":1344869455,
          "user":{
            "id":35137,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
          "id":5778,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344869455,
          "comments_count":4
        },
        {
          "id":5779,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344869455,
          "comments_count":4
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="dc0938826de4af5d1f42a8e081715176"></a>
Get few days in one request.

`GET days/24190;24191;897/item`

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
<tr><td>[type]</td><td>24190 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>24191 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>897 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "24190":{
        "id":24190,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869455,
        "utime":1344869455,
        "is_ended":0,
        "user":{
          "id":35139,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
            "id":5780,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344869455,
            "comments_count":0
          }
        ]
      },
      "24191":{
        "id":24191,
        "fb_uid":"fooba",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869455,
        "utime":1344869455,
        "is_ended":0,
        "user":{
          "id":35140,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
            "id":5781,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "image_266":null,
            "image_532":null,
            "time":"1970-01-01T00:00:00+00:00",
            "likes_count":0,
            "ctime":1344869455,
            "comments_count":0
          }
        ]
      },
      "897":null
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
      "from":24196,
      "to":24193,
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
        "id":24195,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"AfooA",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869456,
        "utime":1344869456,
        "is_ended":0,
        "user":{
          "id":35142,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24203,
      "to":24199,
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
        "id":24202,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/35144\/days\/d5f98f67bfe4e8d6ef6691a88f11a9ab90f192c8_266x266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/35144\/days\/d5f98f67bfe4e8d6ef6691a88f11a9ab90f192c8_532x532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869456,
        "utime":1344869456,
        "is_ended":0,
        "user":{
          "id":35144,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24204,
      "to":24207,
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
        "id":24205,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/35146\/days\/ff62a70ab3bb63ed85e9af0f760e6064d87b3a95_266x266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/35146\/days\/ff62a70ab3bb63ed85e9af0f760e6064d87b3a95_532x532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":3,
        "ctime":1344783057,
        "utime":1344869457,
        "is_ended":0,
        "user":{
          "id":35146,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="c7cd7241d8da52f2739131a5f9f27f36"></a>


`POST /days/24209/create_complaint`

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
      "ctime":1344869458,
      "id":358
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
      "id":24210,
      "fb_uid":"100004087981387",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1344869458,
      "utime":1344869458,
      "is_ended":0,
      "user":{
        "id":35151,
        "fb_uid":"100004087981387",
        "twitter_uid":0,
        "name":"bar bar",
        "sex":"male",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="d3582c434c67f08d47c4153d7a1e548b"></a>
Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.

`POST days/24213/moment_create`

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
      "id":5782,
      "day_id":24213,
      "description":"foobarfoobarfoobarfo...foobarfoobarfoobarfo",
      "image_266":"http:\/\/static.oneday...f78b089_266x266.jpeg",
      "image_532":"http:\/\/static.oneday...f78b089_532x532.jpeg",
      "time":"2005-08-09T18:31:42+03:00",
      "likes_count":0,
      "ctime":1344869459
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="61670a56f7e20c94d682905fb9883fa2"></a>
Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.

`POST days/24215/update`

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
      "id":24215,
      "user_id":35156,
      "fb_uid":"100004087981387",
      "image_266":"http:\/\/static.onedayofmine.dev\/35156\/days\/e1b792386559c38ec85f31bf578fe8bf74a2fbea_266x266.jpeg",
      "image_532":"http:\/\/static.onedayofmine.dev\/35156\/days\/e1b792386559c38ec85f31bf578fe8bf74a2fbea_532x532.jpeg",
      "title":"foobar",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobar",
      "type":"Working day",
      "likes_count":0,
      "ctime":1344869459,
      "utime":1344869460,
      "is_ended":0
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Finish ####
<a name="cab3fcf832b345439db9e591e0da955e"></a>
Finish current day.

`POST days/24216/finish`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="06400a13ba76fb1c6d77933ef4567de8"></a>
Deletes a day

`POST days/24218/delete`

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
<a name="9bd2b0aab3b6c34a28a92b9cd17eff28"></a>
Restore a deleted day

`POST days/24220/restore`

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
<a name="6768c7acb035502bb04a274e8046dd4a"></a>
Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.

`GET days/24222/item`

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
      "id":24222,
      "fb_uid":"fooba",
      "image_266":null,
      "image_532":null,
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "location":"foobarfoobarfoobarfoobarf",
      "type":"Working day",
      "likes_count":0,
      "ctime":1344869462,
      "utime":1344869462,
      "is_ended":0,
      "user":{
        "id":35170,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
          "id":831,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869462,
          "utime":1344869462,
          "user":{
            "id":35171,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":832,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869462,
          "utime":1344869462,
          "user":{
            "id":35172,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
            "birthday":"1990-01-02",
            "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
            "location":"",
            "followers_count":0,
            "following_count":0,
            "days_count":0
          }
        },
        {
          "id":833,
          "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "likes_count":0,
          "ctime":1344869462,
          "utime":1344869462,
          "user":{
            "id":35173,
            "fb_uid":"fooba",
            "twitter_uid":0,
            "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
            "sex":"female",
            "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
            "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="b75e3ef09f14493660ad98bfa102e09e"></a>
Creates comment for <a href="#Entity:Day">day</a> and returns it.

`POST days/24223/comment_create`

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
      "id":835,
      "user_id":35175,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344869462,
      "utime":1344869462,
      "day_id":24223
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="f95427281693ada6b91e6c4b4b40c066"></a>
Share a day

`POST days/24224/share`

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
      "id":"100004087981387_401554699903237"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="5b29951656fb733addbdcdcebac94123"></a>


`POST days/24225/like`



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
      "from":24229,
      "to":24226,
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
        "id":24228,
        "fb_uid":"100004093051334",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869463,
        "utime":1344869463,
        "is_ended":0,
        "user":{
          "id":35180,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="d2b66bba3c9cb323f6bada380289f1ec"></a>


`POST /days/24231/mark_favourite`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="a48d0abf9fc891b1fe46bd6cdf1d60f9"></a>


`POST /days/24232/unmark_favourite`




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
      "from":24236,
      "to":24233,
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
        "id":24235,
        "fb_uid":"100004093051334",
        "image_266":"http:\/\/static.onedayofmine.dev\/35187\/days\/45c0887304142cdb275a52556b9767c5d8b688da_266x266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/35187\/days\/45c0887304142cdb275a52556b9767c5d8b688da_532x532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869464,
        "utime":1344869464,
        "is_ended":0,
        "user":{
          "id":35187,
          "fb_uid":"100004093051334",
          "twitter_uid":0,
          "name":"foo foo",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":24241,
      "to":24238,
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
        "id":24240,
        "fb_uid":"100004087981387",
        "image_266":"http:\/\/static.onedayofmine.dev\/35188\/days\/b0bffd0f38d83d88a725025716a8bbe9cc5803f7_266x266.jpeg",
        "image_532":"http:\/\/static.onedayofmine.dev\/35188\/days\/b0bffd0f38d83d88a725025716a8bbe9cc5803f7_532x532.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869465,
        "utime":1344869465,
        "is_ended":0,
        "user":{
          "id":35188,
          "fb_uid":"100004087981387",
          "twitter_uid":0,
          "name":"bar bar",
          "sex":"male",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="45f4ae25d8b10b053bed6e3bcf66dff1"></a>


`POST /moment_comments/1217/update`

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
      "id":1217,
      "user_id":35196,
      "text":"foobarfo",
      "likes_count":0,
      "ctime":1344869483,
      "utime":1344869483,
      "moment_id":5787
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="74439bd54bf45524430888cd5061648c"></a>


`POST /moment_comments/1219/delete`

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
<a name="0696d34c6825fa91cf100cd32a459b9f"></a>
Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.

`POST moments/5791/update`

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
      "id":5791,
      "day_id":24252,
      "description":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "image_266":"http:\/\/static.oneday...1dbb6dc_266x266.jpeg",
      "image_532":"http:\/\/static.oneday...1dbb6dc_532x532.jpeg",
      "time":"1970-01-01T00:00:00+00:00",
      "likes_count":0,
      "ctime":1344869484
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Delete ####
<a name="0eecdcd55eed4d93342aca34068bcb14"></a>
Delete a moment.

`POST moments/5792/delete`




<a href="#toc">^ back to Table of conetens</a>

* * *
#### Comment ####
<a name="cdc24d5cdec24b8cd12a80b94306ee59"></a>
Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.

`POST moments/5793/comment`

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
      "id":1221,
      "user_id":35208,
      "text":"foobarfoobarfoobarfo...oobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1344869484,
      "utime":1344869484,
      "moment_id":5793
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
<tr><td>[type]</td><td>favourites_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":35209,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<tr><td>[type]</td><td>favourites_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>email</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":35210,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"foobarfoobarfoobarfoobarf",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/35210\/266e64102768a9da0e2b5076e13b3f8df5080b82_36x36.jpeg",
      "image_72":"http:\/\/static.onedayofmine.dev\/35210\/266e64102768a9da0e2b5076e13b3f8df5080b82_72x72.jpeg",
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
      "id":43531,
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
      "id":43533,
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
        "id":35238,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "id":35239,
      "fb_uid":"100004087981387",
      "twitter_uid":637083468,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
      "from":788,
      "to":785,
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
        "id":787,
        "recipient_id":35241,
        "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob likes bar bar",
        "ctime":1344869493,
        "user":{
          "id":35245,
          "fb_uid":"fooba",
          "twitter_uid":0,
          "name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
          "sex":"female",
          "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
          "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
          "birthday":"1990-01-02",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfo",
          "location":"",
          "followers_count":0,
          "following_count":0,
          "days_count":0
        },
        "day":{
          "id":24262,
          "user_id":35244,
          "fb_uid":"fooba",
          "image_266":null,
          "image_532":null,
          "title":"foobarfoobarfoobarfoobarf",
          "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
          "location":"foobarfoobarfoobarfoobarf",
          "type":"Working day",
          "likes_count":0,
          "ctime":1344869493,
          "utime":1344869493,
          "is_ended":0
        },
        "moment":{
          "id":5797,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "image_266":null,
          "image_532":null,
          "time":"1970-01-01T00:00:00+00:00",
          "likes_count":0,
          "ctime":1344869493
        }
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *

### User ###
<a name='User'></a>
#### UserByIdDays ####
<a name="76126fa1456cc3a145c98af28706f07f"></a>
Returns days of specified user

`GET users/35281/days/`

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
        "id":24269,
        "user_id":35281,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869514,
        "utime":1344869514,
        "is_ended":0
      },
      {
        "id":24270,
        "user_id":35281,
        "fb_uid":"100004087981387",
        "image_266":null,
        "image_532":null,
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "location":"foobarfoobarfoobarfoobarf",
        "type":"Working day",
        "likes_count":0,
        "ctime":1344869514,
        "utime":1344869514,
        "is_ended":0
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### UserById ####
<a name="f24e754d150092f47c1e3e6128648efb"></a>
Returns days of specified user

`GET users/35283/item/`

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
      "id":35283,
      "fb_uid":"100004087981387",
      "twitter_uid":0,
      "name":"bar bar",
      "sex":"male",
      "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
      "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
        "id":35288,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="cbefb0a5fec15825a8bb831c144a308a"></a>
Returns list of users that follow selected user.

`GET users/35289/followers`

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
        "id":35290,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
        "id":35292,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="8279a0d062bdef358233988ee83e6658"></a>
Returns list of users that is followed by selected user.

`GET users/35293/following`

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
        "id":35294,
        "fb_uid":"100004093051334",
        "twitter_uid":0,
        "name":"foo foo",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
<a name="2cc69bd972871c4927349d6c4ae7eb47"></a>
Start following selected user.

`POST users/35296/follow`

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
<a name="141c0c92b8bd428a6d85f9e8aab26f99"></a>
Stop following selected user.

`POST users/35298/unfollow`

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
      "from":35299,
      "to":35302,
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
        "id":35300,
        "fb_uid":"fooba",
        "twitter_uid":0,
        "name":"fooA",
        "sex":"female",
        "image_36":"http:\/\/static.onedayofmine.dev\/default_36.png",
        "image_72":"http:\/\/static.onedayofmine.dev\/default_72.png",
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
