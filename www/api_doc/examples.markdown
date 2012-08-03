# API #
 Version: 03.08.12 15:44:21

## Table of contents: ##
<a name='toc'></a>

### <a href='#Day'>Day</a> ###
1. <a href='#1ce616290e75db9efef3de03f495ad1f'>Item</a>
1. <a href='#3acb99edc8864013718355ef2bcfd531'>Item_Many</a>
1. <a href='#b8b31f0a9a3a1cd47f1a04e462d3bd79'>CommentCreate</a>
1. <a href='#065b7dd5cc980cc6a58dddf43cf5cd0e'>ShareDay</a>
1. <a href='#d26238e07fd9b43526c74efebfbe5fbb'>Like</a>
1. <a href='#e52764beaf00d2aa3b73fd19012611b4'>Update</a>
1. <a href='#2be7cf05394d6eb80a20d2f55a005dab'>DeleteDay</a>
1. <a href='#b39005bc3ac1f5dcef1f9613c9c80e5a'>RestoreDay</a>
1. <a href='#9a54a19098a30dcbd74124cbddb1ab6c'>GetFavouriteDays</a>
1. <a href='#74b4fa8d0bfc9145c072404533ac1cd0'>AddToFavourites</a>
1. <a href='#e81e571972e3e90ba7a512162e8b73d7'>RemoveFromFavourites</a>
1. <a href='#1c5e784108f8a36beb283dc7a3e34030'>GetFollowingUsersDays</a>
1. <a href='#ed1af553a9d8b9117548d9a3996ebab5'>GetNewDays</a>
1. <a href='#58c74019b980810ae9e042bb65573a7a'>GetInterestingDays</a>
1. <a href='#f2c5afe4a024dc21f1c43ff206afb8f1'>CurrentUserDays</a>
1. <a href='#bdbebf26e7d0327181a566595a2fcd56'>TypeNames</a>
1. <a href='#443a01b0faf45ee2c2b338662245a77f'>CreateComplaint</a>


## API methods ##

### Day ###
<a name='Day'></a>
#### Item ####
<a name="1ce616290e75db9efef3de03f495ad1f"></a>
Returns basic Day entity by given Day ID.

`GET days/1496/item`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>1</td><td>Day ID</td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>Day ID</td></tr>
<tr><td>string</td><td>user_name</td><td></td></tr>
<tr><td>int</td><td>user_id</td><td></td></tr>
<tr><td>string</td><td>title</td><td></td></tr>
<tr><td>int</td><td>timezone</td><td>UTC time zone offset</td></tr>
<tr><td>string</td><td>occupation</td><td></td></tr>
<tr><td>string</td><td>location</td><td>Text value of longitude and latitude separated by coma. See: Yahoo PlaceFinder API</td></tr>
<tr><td>int</td><td>type</td><td>One of pre-defined types, see: GET day/type_names request</td></tr>
<tr><td>int</td><td>likes_count</td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time</td></tr>
<tr><td>int</td><td>utime</td><td>Last update time</td></tr>
<tr><td>bool</td><td>is_ended</td><td>TRUE if day is ended, else - FALSE</td></tr>
<tr><td><a href='#Entity:Moment[3]'>Moment[3]</a></td><td>moments</td><td>Array of day moments</td></tr>
<tr><td>int</td><td>comments_count</td><td>Count of comments to this day</td></tr>
<tr><td><a href='#Entity:Comment[3]'>Comment[3]</a></td><td>comments</td><td>Array of day first comments</td></tr>
<tr><td>bool</td><td>is_favorited</td><td>True if this article is added to current user favourites. If user is not logged in then field is omited.</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_img_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_img_big</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1496,
      "user_id":2171,
      "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
      "fb_uid":"fooba",
      "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2171\/days\/5e29b1bbf1edf5ba642f8eb912a9ba44b20db2d8_200x200.jpeg",
      "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2171\/days\/5e29b1bbf1edf5ba642f8eb912a9ba44b20db2d8_400x400.jpeg",
      "title":"foobarfoobarfoobarfoobarf",
      "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
      "timezone":0,
      "location":"foobarfoobarfoobarfoobarf",
      "type":"working",
      "likes_count":0,
      "ctime":1343997853,
      "utime":1343997853,
      "is_ended":0,
      "is_favorited":false,
      "comments_count":0,
      "comments":[
        
      ],
      "moments":[
        {
          "id":219,
          "day_id":1496,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "img_small":"http:\/\/onedayofmine.dev\/",
          "img_big":"http:\/\/onedayofmine.dev\/",
          "likes_count":0,
          "ctime":1343997853,
          "comments_count":0,
          "comments":[
            
          ]
        },
        {
          "id":220,
          "day_id":1496,
          "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
          "img_small":"http:\/\/onedayofmine.dev\/",
          "img_big":"http:\/\/onedayofmine.dev\/",
          "likes_count":0,
          "ctime":1343997853,
          "comments_count":0,
          "comments":[
            
          ]
        }
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Item_Many ####
<a name="3acb99edc8864013718355ef2bcfd531"></a>
Get few days in one request.

`GET days/1497;1498;336/item`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>ids <span class='label label-important'>Removed</span></td><td>1</td><td>List of ID's, that was separated by ";".</td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td><a href='#Entity:Day'>Day[]</a></td><td>days <span class='label label-important'>Removed</span></td><td>Associative array of (day_id => Day)</td></tr>
<tr><td>[type]</td><td>1497 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>1498 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>
<tr><td>[type]</td><td>336 <span class='label label-important'>Removed</span></td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "1497":{
        "id":1497,
        "user_id":2173,
        "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "fb_uid":"fooba",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2173\/days\/811c4f10ac788d763d1de00917f443180d41e071_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2173\/days\/811c4f10ac788d763d1de00917f443180d41e071_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1343997853,
        "utime":1343997853,
        "is_ended":0,
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":221,
            "day_id":1497,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "img_small":"http:\/\/onedayofmine.dev\/",
            "img_big":"http:\/\/onedayofmine.dev\/",
            "likes_count":0,
            "ctime":1343997853,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "1498":{
        "id":1498,
        "user_id":2174,
        "user_name":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoob",
        "fb_uid":"fooba",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2174\/days\/1464cc28ee17458f2725673baa8b2c51e65e4ce4_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2174\/days\/1464cc28ee17458f2725673baa8b2c51e65e4ce4_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1343997853,
        "utime":1343997853,
        "is_ended":0,
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ],
        "moments":[
          {
            "id":222,
            "day_id":1498,
            "description":"description foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfooba",
            "img_small":"http:\/\/onedayofmine.dev\/",
            "img_big":"http:\/\/onedayofmine.dev\/",
            "likes_count":0,
            "ctime":1343997853,
            "comments_count":0,
            "comments":[
              
            ]
          }
        ]
      },
      "336":null
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CommentCreate ####
<a name="b8b31f0a9a3a1cd47f1a04e462d3bd79"></a>
Create moment in specified day

`POST days/1500/comment_create`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>1</td><td></td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Comment contents</td></tr>

</table>
###### Example request: ######
    {
      "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo"
    }



##### Response: #####
###### Fields: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>string</td><td>text</td><td>Same text as inputed to verifi successfull delivery</td></tr>
<tr><td>int</td><td>id</td><td>Comment ID</td></tr>
<tr><td>int</td><td>day_id</td><td></td></tr>
<tr><td><a href='#Entity:Day'>Day</a></td><td>day <span class='label label-important'>Removed</span></td><td></td></tr>
<tr><td>string</td><td>user_name</td><td></td></tr>
<tr><td>int</td><td>user_id</td><td></td></tr>
<tr><td><a href='#Entity:User'>User</a></td><td>user <span class='label label-important'>Removed</span></td><td></td></tr>
<tr><td>int</td><td>ctime</td><td>Creation time</td></tr>
<tr><td>int</td><td>utime</td><td>Update time</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":45,
      "user_id":2178,
      "user_name":"bar bar",
      "text":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
      "likes_count":0,
      "ctime":1343997854,
      "utime":1343997854,
      "day_id":1500
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### ShareDay ####
<a name="065b7dd5cc980cc6a58dddf43cf5cd0e"></a>
Share a day

`POST days/1501/share`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>1</td><td></td></tr>

</table>
###### Example request: ######
    empty

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
      "id":"100004087981387_374654105938220"
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Like ####
<a name="d26238e07fd9b43526c74efebfbe5fbb"></a>


`POST days/1502/like`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    "TODO"


<a href="#toc">^ back to Table of conetens</a>

* * *
#### Update ####
<a name="e52764beaf00d2aa3b73fd19012611b4"></a>
Updates a day

`POST days/1503/update`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>1</td><td></td></tr>
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
<tr><td>[type]</td><td>user_name</td><td>[description]</td></tr>
<tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_img_small</td><td>[description]</td></tr>
<tr><td>[type]</td><td>cover_img_big</td><td>[description]</td></tr>
<tr><td>[type]</td><td>title</td><td>[description]</td></tr>
<tr><td>[type]</td><td>occupation</td><td>[description]</td></tr>
<tr><td>[type]</td><td>timezone</td><td>[description]</td></tr>
<tr><td>[type]</td><td>location</td><td>[description]</td></tr>
<tr><td>[type]</td><td>type</td><td>[description]</td></tr>
<tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>ctime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>utime</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr>
<tr><td>[type]</td><td>is_favorited</td><td>[description]</td></tr>
<tr><td>[type]</td><td>comments_count</td><td>[description]</td></tr>
<tr><td>[type]</td><td>comments</td><td>[description]</td></tr>

</table>
###### Example response: ######
    {
      "id":1503,
      "user_id":2183,
      "user_name":"bar bar",
      "fb_uid":"100004087981387",
      "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2183\/days\/763e8b3903a15d69667d61ac6c54119f829d6279_200x200.jpeg",
      "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2183\/days\/763e8b3903a15d69667d61ac6c54119f829d6279_400x400.jpeg",
      "title":"foobar",
      "occupation":"foobar",
      "timezone":"1",
      "location":"foobar",
      "type":"working",
      "likes_count":0,
      "ctime":1343997855,
      "utime":1343997856,
      "is_ended":0,
      "is_favorited":false,
      "comments_count":0,
      "comments":[
        
      ]
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
#### DeleteDay ####
<a name="2be7cf05394d6eb80a20d2f55a005dab"></a>
Deletes a day

`POST days/1504/delete`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>1</td><td></td></tr>

</table>
###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RestoreDay ####
<a name="b39005bc3ac1f5dcef1f9613c9c80e5a"></a>
Restore a deleted day

`POST days/1506/restore`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>day_id <span class='label label-important'>Removed</span></td><td>1</td><td></td></tr>

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
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":1508,
      "to":1511,
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
        "id":1509,
        "user_id":2192,
        "user_name":"foo foo",
        "fb_uid":"100004093051334",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2192\/days\/f7bd70993a1c249556dbbde4e9c6c2dfdb97dab7_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2192\/days\/f7bd70993a1c249556dbbde4e9c6c2dfdb97dab7_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1343997857,
        "utime":1343997857,
        "is_ended":0,
        "is_favorited":true,
        "comments_count":0,
        "comments":[
          
        ]
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### AddToFavourites ####
<a name="74b4fa8d0bfc9145c072404533ac1cd0"></a>


`POST /days/1513/favourite`

##### Request: #####

###### Example request: ######
    empty

##### Response: #####

###### Example response: ######
    empty
<a href="#toc">^ back to Table of conetens</a>

* * *
#### RemoveFromFavourites ####
<a name="e81e571972e3e90ba7a512162e8b73d7"></a>


`POST /days/1514/unfavourite`

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
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":1515,
      "to":1518,
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
        "id":1516,
        "user_id":2199,
        "user_name":"foo foo",
        "fb_uid":"100004093051334",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2199\/days\/59444a97872aadc31a3ebebc9e600dfa52ec7cf5_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2199\/days\/59444a97872aadc31a3ebebc9e600dfa52ec7cf5_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1343997858,
        "utime":1343997858,
        "is_ended":0,
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ]
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetNewDays ####
<a name="ed1af553a9d8b9117548d9a3996ebab5"></a>
Returns array of news days. One of input params can be omited, but not both.

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
<tr><td>int</td><td>from</td><td></td><td></td></tr>
<tr><td>int</td><td>to</td><td></td><td></td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":1520,
      "to":1524,
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
        "id":1521,
        "user_id":2200,
        "user_name":"bar bar",
        "fb_uid":"100004087981387",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2200\/days\/2102180074e122c808be9d8a5c517984ae4c1f62_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2200\/days\/2102180074e122c808be9d8a5c517984ae4c1f62_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1343997859,
        "utime":1343997859,
        "is_ended":0,
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ]
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### GetInterestingDays ####
<a name="58c74019b980810ae9e042bb65573a7a"></a>
Returns array of days. Input params can be omited, but ignoring both params can give long array as result.

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
<tr><td>int</td><td>from</td><td></td><td></td></tr>
<tr><td>int</td><td>to</td><td></td><td></td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":1525,
      "to":1528,
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
        "id":1526,
        "user_id":2202,
        "user_name":"bar bar",
        "fb_uid":"100004087981387",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2202\/days\/cba38b78e1a19a49c9aa6532a2729220233fe23a_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2202\/days\/cba38b78e1a19a49c9aa6532a2729220233fe23a_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":3,
        "ctime":1343911460,
        "utime":1343997860,
        "is_ended":0,
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ]
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### CurrentUserDays ####
<a name="f2c5afe4a024dc21f1c43ff206afb8f1"></a>


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
<tr><td>[type]</td><td>from</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>to</td><td></td><td>[description]</td></tr>
<tr><td>[type]</td><td>limit</td><td></td><td>[description]</td></tr>

</table>
###### Example request: ######
    {
      "from":1530,
      "to":1533,
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
        "id":1531,
        "user_id":2204,
        "user_name":"bar bar",
        "fb_uid":"100004087981387",
        "cover_img_small":"http:\/\/onedayofmine.dev\/\/users\/2204\/days\/e904dbd032b730b7b94312616f31dcaae3d93f2a_200x200.jpeg",
        "cover_img_big":"http:\/\/onedayofmine.dev\/\/users\/2204\/days\/e904dbd032b730b7b94312616f31dcaae3d93f2a_400x400.jpeg",
        "title":"foobarfoobarfoobarfoobarf",
        "occupation":"foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoo",
        "timezone":0,
        "location":"foobarfoobarfoobarfoobarf",
        "type":"working",
        "likes_count":0,
        "ctime":1343997860,
        "utime":1343997860,
        "is_ended":0,
        "is_deleted":true,
        "is_favorited":false,
        "comments_count":0,
        "comments":[
          
        ]
      }
    ]


<a href="#toc">^ back to Table of conetens</a>

* * *
#### TypeNames ####
<a name="bdbebf26e7d0327181a566595a2fcd56"></a>


`GET days/type_names`

##### Request: #####

###### Example request: ######
    empty

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
<a name="443a01b0faf45ee2c2b338662245a77f"></a>


`POST /days/1534/create_complaint`

##### Request: #####
###### Params: ######
<table class="table">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id <span class='label label-important'>Removed</span></td><td>1</td><td>ID of abused comment</td></tr>
<tr><td>string</td><td>text</td><td>1</td><td>Abuse description message</td></tr>

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
      "ctime":1343997861,
      "id":57
    }


<a href="#toc">^ back to Table of conetens</a>

* * *
