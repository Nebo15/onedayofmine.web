# 1. Общие положения #

Пользователь регистрируется за пределами back-end'а. На него передается только facebook'овский access_token.
Делается запрос на /auth/login, в ответ приходит sessid, который нужно выставлять в куку
'SESSID'(или передавать GET или POST параметром 'SESSID'), для всех приватных запросов.

    Структура ответа:
    {
      'code'   => <http code>
      'status' => <http status>,
      'result' => <mixed>,
      'errors' => [ <string>, <string>, ... ]
    }

Поля code и status для клиентов, которые почему-то не умеют нормально обрабатывать стандартные HTTP-шные коды и статусы.

! Если в ответе присутствует поле fake = true, это значит, что вызов еще не реализован и ответ берется просто из конфига.

# 3. Описание API #

## 3.1 Аутентификация  ##

### 3.1.1 Регистрация/аутентификация /auth/login - публичный ###

Описание:

    Запрос:
      'fb_access_token' => <string 255>    
    Ответ(поле result):
      'session' => <int 11>
      'user' => информация о пользователе
      
Пример:

      {
        "fb_access_token":"AAAFnVo0zuqkBADJUOZCLgTXLZCJWpfrZA8wv3g9ZATMKsnkRV5yaQPXmS1ZCiSMJxaC3EjKsEvKk0HRrVZBaGwRqLV1hK8LaivOZAdkcnThVUbTceEOGVpG"
      }
      {
        "sessid":"jpmr9m0kbo48bcqdk2gm5seb14",
        "user":{
          "ctime":1341001582,
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
          "utime":1341001582
     }

### 3.1.2 Проверка сессии /auth/is_logged_in - приватный ###
    Запрос: пустой
    Ответ: <boolean>

### 3.1.3 Выход /auth/logout - публичный ###
    Запрос: пустой
    Ответ: пустой


## 3.2 Новости ##

GET /news?from=<id последней присутствующей в приложении новости>&to=<id первой присутствующей в приложении новости>

[TO DISCUSS] Как пушить на телефон новости?

## 3.3 Дни ##

GET /my/days/following?from=<dayId>&to=<dayId>
GET /my/days/new?from=<dayId>&to=<dayId>
GET /my/days/interesting?from=<dayId>&to=<dayId>

GET /days/search - должен уметь искать по неполной строке

## 3.4 День ##

+GET /days/<dayId>/item - '/item' потом уберу

+GET /days/<dayId>/comment
GET /days/<dayId>/like
+-GET /days/<dayId>/share

## 3.5 Моменты ##
+GET /moments/<momentId>/comment
GET /moments/<momentId>/like

POST /moments/<momentId>/comments/<commentId>/update

## 3.6 Моё ##
+GET /my/days
+POST /my/days/<dayId>/delete
+POST /my/days/<dayId>/restore
+POST /my/days/<dayId>/update

+-POST /my/days/<dayId>/moments/<momentId>/update

GET /my/favourites
POST /my/favourites
POST /my/favourites/<dayId>/delete

+GET /my/following
+POST /users/<userId>/follow
+POST /users/<userId>/unfollow
+GET /my/followers

GET /my/profile
POST /my/profile/update

GET /my/settings
POST /my/settings/<settingId>

## 3.7 Добавление дней ##
GET /my/currentDay - запрашивается при старте приложения, возвращает текущий наполняемый день пользователя
POST /my/currentDay/start
POST /my/currentDay/addMoment
POST /my/currentDay/finish

## 3.8 Пользователи ##
GET /users/<userId>
GET /users/<userId>/days
GET /users/<userId>/following
GET /users/<userId>/followers
GET /users/<userId>/activity
GET /users/search

## 3.9 Соц. сети ##
GET /social/facebook_friends
POST /social/facebook_invite
POST /social/twitter_connect
POST /social/email_invite

## 3.10 Жалобы ##
POST /complaints/create