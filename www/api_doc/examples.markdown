# API examples #

 Version: 11.07.12 16:41:09

## My - Profile ##

`POST {{host}}/my/profile`

Request: `empty`

Response: 

    {
      "id":24,
      "first_name":"foo",
      "last_name":"foo",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"",
      "occupation":"",
      "birthday":"1992-08-08",
      "sex":"male",
      "ctime":1342014069,
      "utime":1342014069
    }

## My - UpdateProfile ##

`POST {{host}}/my/profile`

Request: 

    {
      "first_name":"susokugituciwelozayodugi",
      "last_name":"sizavawadayumopanezileru",
      "occupation":"motobafayedicolizeduhimi",
      "location":"pokalijorohoyaveculopolu",
      "birthday":"1914-01-20"
    }

Response: 

    {
      "id":25,
      "first_name":"susokugituciwelozayodugi",
      "last_name":"sizavawadayumopanezileru",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"pokalijorohoyaveculopolu",
      "occupation":"motobafayedicolizeduhimi",
      "birthday":"1914-01-20",
      "sex":"male",
      "ctime":1342014069,
      "utime":1342014069,
      "uip":2130706433
    }

## My - UpdateProfile_Partial ##

`POST {{host}}/my/profile`

Request: 

    {
      "first_name":"yuyepadugikofobasoyehuge",
      "birthday":"1982-01-05"
    }

Response: 

    {
      "id":26,
      "first_name":"yuyepadugikofobasoyehuge",
      "last_name":"foo",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "location":"",
      "occupation":"",
      "birthday":"1982-01-05",
      "sex":"male",
      "ctime":1342014069,
      "utime":1342014069,
      "uip":2130706433
    }

