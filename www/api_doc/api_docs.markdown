# API examples #
 Version: 29.06.12 20:09:39

## Auth - IsLoggedIn ##
Url: {{host}}auth/is_logged_in
Method: POST
Request: empty
Response: 
```false
```


## Auth - Login ##
Url: {{host}}auth/login/
Method: POST
Request: 
```{
  "fb_access_token":"AAAFnVo0zuqkBAGnPZC4q8oFwk1YQko9YYJSNi3MHdk5JxUY3735n3sq9a6Us3itsQmoAv6fUPQHMINH8wcEhxWKZCQLir9XraZCCzlALYWSnw7F3ZAGH"
}
```
Response: 
```{
  "sessid":"08j921tulguig0j1v5bfq5cqj1",
  "user":{
    "ctime":1340989775,
    "fb_name":"foo",
    "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
    "fb_profile_utime":1340810718,
    "fb_timezone":"3",
    "fb_uid":"100004010804750",
    "id":1,
    "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
    "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
    "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
    "sex":"female",
    "utime":1340989775
  }
}
```


## Auth - Logout ##
Url: {{host}}auth/logout/
Method: POST
Request: empty
Response: 
```null
```


## Auth - Logout ##
Url: {{host}}auth/is_logged_in
Method: POST
Request: empty
Response: 
```false
```

