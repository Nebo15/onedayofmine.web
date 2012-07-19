# Entities #
### Complaint ###
<a name="Entity:Complaint"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr><tr><td>[type]</td><td>text</td><td>[description]</td></tr><tr><td>[type]</td><td>day_id</td><td>[description]</td></tr><tr><td>[type]</td><td>ctime</td><td>[description]</td></tr><tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
</table>

* * *
### Day ###
<a name="Entity:Day"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>int</td><td>id</td><td>User ID</td></tr><tr><td>[type]</td><td>user_id</td><td>[description]</td></tr><tr><td>[type]</td><td>title</td><td>[description]</td></tr><tr><td>[type]</td><td>description</td><td>[description]</td></tr><tr><td>[type]</td><td>location</td><td>[description]</td></tr><tr><td>[type]</td><td>type</td><td>[description]</td></tr><tr><td>[type]</td><td>is_ended</td><td>[description]</td></tr><tr><td>[type]</td><td>timezone</td><td>[description]</td></tr><tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr><tr><td>[type]</td><td>is_deleted</td><td>[description]</td></tr><tr><td>[type]</td><td>ctime</td><td>[description]</td></tr><tr><td>[type]</td><td>utime</td><td>[description]</td></tr><tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
</table>

* * *
### DayComment ###
<a name="Entity:DayComment"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr><tr><td>[type]</td><td>user_id</td><td>[description]</td></tr><tr><td>[type]</td><td>day_id</td><td>[description]</td></tr><tr><td>[type]</td><td>text</td><td>[description]</td></tr><tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr><tr><td>[type]</td><td>ctime</td><td>[description]</td></tr><tr><td>[type]</td><td>utime</td><td>[description]</td></tr><tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
</table>

* * *
### Moment ###
<a name="Entity:Moment"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr><tr><td>[type]</td><td>day_id</td><td>[description]</td></tr><tr><td>[type]</td><td>description</td><td>[description]</td></tr><tr><td>[type]</td><td>image_ext</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_id</td><td>[description]</td></tr><tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr><tr><td>[type]</td><td>ctime</td><td>[description]</td></tr><tr><td>[type]</td><td>utime</td><td>[description]</td></tr><tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
</table>

* * *
### MomentComment ###
<a name="Entity:MomentComment"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr><tr><td>[type]</td><td>user_id</td><td>[description]</td></tr><tr><td>[type]</td><td>moment_id</td><td>[description]</td></tr><tr><td>[type]</td><td>text</td><td>[description]</td></tr><tr><td>[type]</td><td>likes_count</td><td>[description]</td></tr><tr><td>[type]</td><td>ctime</td><td>[description]</td></tr><tr><td>[type]</td><td>utime</td><td>[description]</td></tr><tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
</table>

* * *
### News ###
<a name="Entity:News"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>uint(11)</td><td>id</td><td>News ID</td></tr><tr><td>uint(11)</td><td>recipient_id</td><td>Recipient ID - user, that shoud recieve message</td></tr><tr><td>uint(11)</td><td>user_id</td><td>User ID - uset, that created news event</td></tr><tr><td>string(255)</td><td>text</td><td>Text of news message</td></tr><tr><td>uint(11)</td><td>day_id</td><td>ID of day, on wich this news is linked to.</td></tr><tr><td>uint(11)</td><td>moment_id</td><td>ID of moment, on wich this news is linked to.</td></tr><tr><td>uint(11)</td><td>ctime</td><td>Unix timestamp, time of news creation</td></tr>
</table>

* * *
### User ###
<a name="Entity:User"></a>
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
<tr><td>[type]</td><td>id</td><td>[description]</td></tr><tr><td>[type]</td><td>user_settings_id</td><td>[description]</td></tr><tr><td>[type]</td><td>first_name</td><td>[description]</td></tr><tr><td>[type]</td><td>last_name</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_uid</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_access_token</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_profile_url</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_profile_utime</td><td>[description]</td></tr><tr><td>[type]</td><td>timezone</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_pic_big</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_pic_square</td><td>[description]</td></tr><tr><td>[type]</td><td>fb_pic_small</td><td>[description]</td></tr><tr><td>[type]</td><td>twitter_access_token</td><td>[description]</td></tr><tr><td>[type]</td><td>twitter_access_token_secret</td><td>[description]</td></tr><tr><td>[type]</td><td>location</td><td>[description]</td></tr><tr><td>[type]</td><td>occupation</td><td>[description]</td></tr><tr><td>[type]</td><td>birthday</td><td>[description]</td></tr><tr><td>[type]</td><td>sex</td><td>[description]</td></tr><tr><td>[type]</td><td>ctime</td><td>[description]</td></tr><tr><td>[type]</td><td>utime</td><td>[description]</td></tr><tr><td>[type]</td><td>cip</td><td>[description]</td></tr>
</table>

* * *

