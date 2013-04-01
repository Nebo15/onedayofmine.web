HOST: http://api.onedayofmin.com/

--- ODOM ---

--
Формат ответа
Ответы от API выглядят следующим образом:
<pre>
{
  "code": HTTP response code,
  "status": HTTP status,
  "result": result object/array,
  "errors": [ <string>, <string>, ... ]
}
</pre>
В случае, когда для выполнения запроса требуется авторизация, которой нехватает, возвращается code: 503. В этом случае нужно получить новый access_token от Facebook и выполнить /auth/login.
--

--
Аутентификация
Все запросы от имени пользователя должны сопровождаться параметром `token` со значением, для которого предварительно был выполнен запрос /auth/login.
Параметр `token` всегда передаётся в query-части запроса, даже если тип запроса не GET.
--


--
Работа со списками
Для всех запросов, где в ответ возвращаются списки, которые могут иметь большое количество элементов, работают следующие параметры:

* from - id объекта в списке, ограничивающий результат сверху (сначала). Т.е. если список 5,4,3,2,1 и при предыдущем запросе были загружены элементы 5,4,3, то в параметр from нужно передавать 3.
* to - id объекта в списке, ограничивающий результат снизу (с конца). Т.е. если список 5,4,3,2,1, и ранее были загружены элементы 1 и 2, то в параметр to следует передавать 2.
* limit - ограничение на количество возвращаемых элементов. Максимальное значение, и значение по умолчанию - 100.
--

--
Особенности этого сервиса для описания API

* Он пока что в описании ответа распознаёт толко JS-объекты, поэтому выражения вида `{true}` следует читать как просто `true`, а `{[элементы]}` как просто `[элементы]`
* В параметрах запроса он распознаёт только JSON, поэтому `Accept: application/json` нужно читать как `Accept: application/x-www-form-urlencoded`. Параметры передаются просто как тело POST-запроса.
--

-- Auth --

Получить параметры авторизации
GET /auth/parameters
> Accept: applications/json
< 200
< Content-Type: application/json
{
    "facebook": {
        "appid": "395096410536617",
        "namespace": "one-day-of-mine"
    },
    "twitter": {
        "consumer_key": "7jJVJCSS3rAkfyBc1LbOQ"
    }
}

Проверить, залогинен ли текущий пользователь
GET /auth/is_logged_in
> Accept: application/json
< 200
< Content-Type: application/json
{true}

Аутентифицировать пользователя.
Вместе с токеном из facebook передаётся ещё и device token для отправки PUSH-уведомлений на текущее устройство.
POST /auth/login
> Accept: application/json
{
  "token":"AAAFnVo0zuqkBAB465NWZA0bAMYMOsaUWunwOK86JaaBzRkIYjUu1eWfguQZBdJy3yRJh5itpdJJyeZCYmMzJbtVJtQk9NvwnZBHvZC7yoqo1RgTTgX4np"
  "device_token": "APNS device token"
}
< 200
< Content-Type: application/json
{
    "id":4018,
    "name":"User Name",
    "sex":"male",
    "image_36":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_72":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "birthday":"1980-08-08",
    "occupation":"Paleonthologist",
    "location": "London, GB",
    "followers_count": 15,
    "following_count": 28,
    "favourites_count": 19,
    "days_count": 13,
    "email":"test@example.com"
}

Логаут нужен, чтобы отключить уведомления пользвоателя на данном устройстве.
POST /auth/logout
> Accept: application/json
{
    "device_token": "APNS device token"
}
< 200
< Content-Type: application/json
null



-- Days --
Получить список интересных дней
GET /days/interesting
< 200
< Content-Type: application/json
{[
  {
    "id": 1987,
    "user": {
      "id": 4160,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "occupation":"Paleonthologist",
      "location": "London, GB"
    },
    "image_266":"http://onedayofmine.com/users/4160/days/9a37fde110418f5dda8bc31b1e25d615ec7e1a39_200x200.jpeg",
    "image_532":"http://onedayofmine.com/users/4160/days/9a37fde110418f5dda8bc31b1e25d615ec7e1a39_400x400.jpeg",
    "title":"One fine day",
    "type":"working day",
    "likes_count":1452,
    "comments_count": 134,
    "views_count": 2000,
    "is_favorite":true
  }
]}

Список новых дней
GET /days/new
< 200
< Content-Type: application/json
{"See /days/interesting"}

Поиск дней
GET /days/search
> Content-Type:application/json
{query: "Paris"}
< 200
< Content-Type: application/json
{"See /days/interesting"}

Список дней людей, за которыми я слежу (following)
GET /days/following
< 200
< Content-Type: application/json
{"See /days/interesting"}

Список моих дней
GET /days/my
< 200
< Content-Type: application/json
{[
  {
    "id": 1987,
    "user": {
      "id": 4160,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "occupation":"Paleonthologist",
      "location": "London, GB"
    },
    "image_266":"http://onedayofmine.com/users/4160/days/9a37fde110418f5dda8bc31b1e25d615ec7e1a39_200x200.jpeg",
    "image_532":"http://onedayofmine.com/users/4160/days/9a37fde110418f5dda8bc31b1e25d615ec7e1a39_400x400.jpeg",
    "title":"One fine day",
    "type":"working day",
    "likes_count":1452,
    "comments_count": 134,
    "views_count": 2000,
    "is_deleted": false
  }
]}


Список дней, добавленных в "избранное"
GET /days/favourite
< 200
< Content-Type: application/json
{"See /days/interesting"}

Данные одного дня
GET /days/1922
< 200
< Content-Type: application/json
{
    "id": 1987,
    "user": {
      "id": 4160,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "occupation":"Paleonthologist",
      "location": "London, GB"
    },
    "image_266":"http://onedayofmine.com/users/4160/days/9a37fde110418f5dda8bc31b1e25d615ec7e1a39_200x200.jpeg",
    "image_532":"http://onedayofmine.com/users/4160/days/9a37fde110418f5dda8bc31b1e25d615ec7e1a39_400x400.jpeg",
    "title":"One fine day",
    "type":"working day",
    "likes_count":1452,
    "comments_count": 134,
    "views_count": 2000,
    "is_favorite":true,
    "is_liked": false,
    "moments":[
        {
          "id":587,
          "time": "2005-08-09T18:31:42+03:00",
          "description":"This is when i've ate my cat. Delicious!",
          "image_266":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
          "image_532":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
          "likes_count": 25,
          "comments_count": 40,
          "is_liked": false
        }
    ],
    "comments_count":28,
    "comments":[
        {
          "id": 1241,
          "user": {
            "id": 4160,
            "name": "User Name",
            "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
            "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
            "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
            "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
            "sex":"male",
            "occupation":"Paleonthologist",
            "location": "London, GB"
          },
          "text": "Lorem ipsum! Dolor sit amet..."
        }
    ],
    "final_description": "It was the awesome day!"
}

Данные текущего дня пользователя (если есть)
GET /days/current
< 200
< Content-Type: application/json
{"Данные дня (см. /days/:id)"}

Прокомментировать день
POST /days/1926/comment
> Accept: application/json
{
  "text": "Nice work!"
}
< 200
< Content-Type: application/json
{
  "id": 1241,
  "user": {
    "id": 4160,
    "name": "User Name",
    "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "sex":"male",
    "occupation":"Paleonthologist",
    "location": "London, GB",
  },
  "text": "Nice work!"
}

Получить список комментариев к дню
GET /days/1926/comments
< 200
< Content-Type: application/json
{[
    {
      "id": 1241,
      "user": {
        "id": 4160,
        "name": "User Name",
        "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
        "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
        "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
        "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
        "sex":"male",
        "occupation":"Paleonthologist",
        "location": "London, GB",
      },
      "text": "Lorem ipsum! Dolor sit amet..."
    }
]}

Поделиться днём (в подключенных сервисах: FB, Twitter)
POST /days/1927/share
> Accept: application/json
< 200
< Content-Type: application/json
null


Залайкать день
POST /days/1928/like
> Accept: application/json
< 200
< Content-Type: application/json
null


Отменить лайк дня
POST /days/1928/unlike
> Accept: application/json
< 200
< Content-Type: application/json
null


Создать (начать) новый день
POST /days/start
> Accept: application/json
{
  "title":"First day of the rest of my life",
  "type":"working"
}
< 200
< Content-Type: application/json
{"Данные дня (см. /days/:id)"}

Добавить момент к дню
POST /days/1942/add_moment
> Accept: application/json
{
  "description":"This is when i've ate my cat. Delicious!",
  "image_content":"<base64-encoded image>",
  "time": "2005-08-09T18:31:42+03:00"
}
< 200
< Content-type: application/json
{
  "id":587,
  "time": "2005-08-09T18:31:42+03:00",
  "description":"This is when i've ate my cat. Delicious!",
  "image_266":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
  "image_532":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
  "likes_count": 0,
  "comemnts_count": 0
}

Завершить день
POST /days/1942/finish
> Accept: application/json
{
  "final_description": "This was a nice day!",
  "cover": "<base64-encoded image>"
}
< 200
< Content-Type: application/json
{"Данные дня (см. /days/:id)"}

Отредактировать день.
Все поля необязательные. Если поле не указано - то его значение не изменяется после вызова функции.
POST /days/1929/update
> Accept: application/json
{
  "title":"First day of the rest of my life",
  "type":"working",
  "cover": "<base64-encoded image>"
}
< 200
< Content-Type: application/json
{"Данные дня (см. /days/:id)"}

Удалить (не окончательно) день
POST /days/1930/delete
> Accept: application/json
< 200
< Content-Type: application/json
null


Восстановить ранее удалённый день
POST /days/1932/restore
> Accept: application/json
< 200
< Content-Type: application/json
null


Отметить день текущим
POST /days/1932/mark_current
> Accept: application/json
< 200
< Content-Type: application/json
null


Добавить день в избранное
POST /days/1939/mark_favourite
< 200
< Content-Type: application/json
null


Удалить день из избранного
POST /days/1940/unmark_favourite
> Accept: application/json
< 200
< Content-Type: application/json
null


Пожаловаться на день
POST /days/1960/complain
> Accept: application/json
{
  "text":"Hey! It's porn, dude!"
}
< 200
< Content-Type: application/json
{
  "id":24,
  "day_id": 1960,
  "text":"Hey! It's porn, dude!",
}

Словарь типов дней
GET /days/types
< 200
< Content-Type: application/json
{[
  "working",
  "day off",
  "holiday",
  "trip",
  "special event"
]}


Анализ дня импортированного из внешних источников
POST /days/analyze_external_day
> Accept: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}
< 200
< Content-Type: application/json
{
	type: 'Working day',
	title: 'My perfect working day in New York',
	description: 'some text about'
}

-- Moments --

Залайкать момент
POST /moments/600/like
< 200
< Content-Type: application/json
null


Отменить лайк момента
POST /moments/600/unlike
< 200
< Content-Type: application/json
null


Прокомментировать момент дня
POST /moments/600/comment
> Accept: application/json
{
  "text":"Brool story, co!"
}
< 200
< Content-Type: application/json
{
  "id": 1241,
  "user": {
    "id": 4160,
    "name": "User Name",
    "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "sex":"male",
    "occupation":"Paleonthologist",
    "location": "London, GB",
  },
  "text": "Brool story, co!"
}


Получить список комментариев к моментам
GET /moments/1926/comments
< 200
< Content-Type: application/json
{[
    {
      "id": 1241,
      "user": {
        "id": 4160,
        "name": "User Name",
        "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
        "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
        "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
        "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
        "sex":"male",
        "occupation":"Paleonthologist",
        "location": "London, GB",
      },
      "text": "Lorem ipsum! Dolor sit amet..."
    }
]}

Отредактировать момент.
Поля, которые не переданы в этом запросе, не будут изменены.
POST /moments/598/update
> Accept: application/json
{
  "description":"This is when i've ate my cat. Delicious!",
  "time": "2005-08-09T18:31:42+03:00"
  "image_content":"<base64-encoded image>",
}
< 200
< Content-Type: application/json
{
  "id":587,
  "time": "2005-08-09T18:31:42+03:00",
  "description":"This is when i've ate my cat. Delicious!",
  "image_266":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
  "image_532":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
  "likes_count": 25,
  "comemnts_count": 40
}

Удалить момент из дня (окончательно)
POST /moments/599/delete
< 200
< Content-Type: application/json
null


-- Comments --
Удалить комментарий к дню
POST /day_comments/169/delete
< 200
< Content-Type: application/json
null


Удалить комментарий к моменту
POST /moment_comments/170/delete
< 200
< Content-Type: application/json
null


-- My --
GET /my/profile
> Accept: application/json
< 200
< Content-Type: application/json
{
    "id": 4160,
    "name": "User Name",
    "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "sex":"male",
    "birthday":"1980-08-08",
    "occupation":"Paleonthologist",
    "location": "London, GB",
    "followers_count": 15,
    "following_count": 28,
    "favourites_count": 13,
    "days_count": 13,
    "email":"test@example.com"
}

POST /my/profile
> Accept: application/json
{
  "name":"Batman",
  "occupation":"Avenger",
  "location":"Gotham, USA",
  "email":"batman@marvel.com",
  "birthday":"1990-01-02",
  "sex": "male",
  "image_content":"<base64-encoded image>"
}
< 200
< Content-Type: application/json
{
    "id": 4160,
    "name": "User Name",
    "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
    "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
    "sex":"male",
    "birthday":"1980-08-08",
    "occupation":"Paleonthologist",
    "location": "London, GB",
    "followers_count": 15,
    "following_count": 28,
    "favourites_count": 13,
    "days_count": 13,
    "email":"test@example.com"
}

GET /my/settings
< 200
< Content-Type: application/json
{
  "id":10729,
  "notifications_new_days":1,
  "notifications_new_comments":0,
  "notifications_related_activity":1,
  "notifications_shooting_photos":0,
  "photos_save_original":1,
  "photos_save_filtered":0,
  "social_share_facebook":0,
  "social_share_twitter":0
}

POST /my/settings
> Accept: application/json
{
  "notifications_new_days":1,
  "notifications_new_comments":1,
  "notifications_related_activity":1,
  "notifications_shooting_photos":1,
  "photos_save_original":1,
  "photos_save_filtered":1
}
< 200
< Content-Type: application/json
{
  "notifications_new_days":1,
  "notifications_new_comments":1,
  "notifications_related_activity":1,
  "notifications_shooting_photos":1,
  "photos_save_original":1,
  "photos_save_filtered":1,
  "social_share_facebook":0,
  "social_share_twitter":0,
}

Получить список новостей.
Текст новости может размечаться ссылками вида &lt;a href="odom://&lt;item>/&lt;id>[/&lt;subitem>/&lt;subitem_id>]">Text&lt;/a>
Item может быть один из:

* user
* day
* moment

Subitem на данный момент есть только "comments"

link - URI обеъкта, который нужно показывать при клике на новость целиком.

GET /my/news
< 200
< Content-Type: application/json
{[
  {
    "id":602,
    "time": 2130706433,
    "text": "<a href='odom://users/1'>Christofer</a> created day <a href='odom://days/4'>My awesome day</a>"
    "link": "odom://days/4"
  }
]}

-- Users --

Поиск пользователей
GET /users/search
> Content-Type:application/json
{query: "John"}
< 200
< Content-Type: application/json
{[
  {
      "id": 4160,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "occupation":"Paleonthologist",
      "location": "London, GB",
      "following": true
  }
]}

GET /users/4162
< 200
< Content-Type: application/json
{
  "id": 4162,
  "name": "User Name",
  "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
  "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
  "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
  "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
  "sex":"male",
  "birthday":"1980-08-08",
  "occupation":"Paleonthologist",
  "location": "London, GB",
  "followers_count": 15,
  "following_count": 28,
  "days_count": 13,
  "following":true,
}

GET /users/4160/days/
< 200
< Content-Type: application/json
{"See days/interesting"}

GET /users/4168/followers
< 200
< Content-Type: application/json
{[
  {
      "id": 4160,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "birthday":"1980-08-08",
      "occupation":"Paleonthologist",
      "location": "London, GB",
      "followers_count": 15,
      "following_count": 28,
      "days_count": 13,
      "following": true
  }
]}

GET /users/4168/following
< 200
< Content-Type: application/json
{[
  {
      "id": 4160,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "occupation":"Paleonthologist",
      "location": "London, GB",
      "following": true
  }
]}

POST /users/4175/follow
< 200
< Content-Type: application/json
null


POST /users/4177/unfollow
< 200
< Content-Type: application/json
null


GET /users/4177/activity
< 200
< Content-Type: application/json
{"See /my/news"}


-- Social --
GET /social/facebook_friends
< 200
< Content-Type: application/json
{[
  {
    "uid":"100004093051334",
    "name":"User Name",
    "image_50":"http://profile.ak.fbcdn.net/hprofile-ak-snc4/174597_20531316728_2866555_s.jpg",
    "image_150":"http://profile.ak.fbcdn.net/hprofile-ak-snc4/174597_20531316728_2866555_l.jpg",
    "user": {
      "id": 4162,
      "name": "User Name",
      "image_36":"http://onedayofmine.com/users/4160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_72":"http://onedayofmine.com/users/40160/1326c8f64ebb7473370300236384dc228e9f34e0_70x70.jpeg",
      "image_96":"http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "image_192": "http://onedayofmine.dev/users/4018/1326c8f64ebb7473370300236384dc228e9f34e0_140x140.jpeg",
      "sex":"male",
      "occupation":"Paleonthologist",
      "location": "London, GB",
      "following":true,
    }
  }
]}

POST /social/facebook_invite
> Accept: application/json
{
  "uid":"100004093051334"
}
< 200
< Content-Type: application/json
null


POST /social/twitter_connect
> Accept: application/json
{
  "access_token":"637083468-nBzWGwpdfgTqrg2H3DZwnSgBWwMkbNmxVrwCVepx",
  "access_token_secret":"4jWX2ozuXHcY4yRwqjFBUfV08t7kFjfxBR1OCV7Y0"
}
< 200
< Content-Type: application/json
null


POST /social/email_invite
> Accept: application/json
{
  "email": "text@example.com",
  "name": "Recepient Name"
}
< 200
< Content-Type: application/json
null



-- Instagram --


Привязка аккаунта (сохранение токена и id пользователя) с последующим редиректом на oauth_redirect_url (может содержать только относительный путь и параметры)
POST /instagram/login?oauth_redirect_url=%url%
> Accept: application/json
{
    token: "oiasdhasiudhsdisuhdiaudhiu987318hadiauh",
    id: "12312398241"
}
< 200
< Content-Type: application/json
null


Информация о пользователе
GET /instagram/user
< 200
< Content-Type: application/json
{
  id: "91283918273912381927_918239183712",
  image: "http://someurl.com/adsdadasd"
  image_width: 312,
  image_height: 312,
  name: "Vasisualiy Lohankin",
  photos_count: 23
}


Сколько то фотографий с 1234 unix-time (количество зависит от сервиса)
GET /instagram/photos/?from=1234
< 200
< Content-Type: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    thumb_width: 150,
    thumb_height: 150,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}


Все фотографии с 1234 по 1235 unix-time
GET /instagram/photos/?from=1234&to=1235
< 200
< Content-Type: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    thumb_width: 150,
    thumb_height: 150,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}


Возвращает не меньше 3 (может быть и больше) фотографий объединенных в дни
GET /instagram/days/
< 200
< Content-Type: application/json
{[
  [
    {
      id: "8511704824",
      title: "IMG_0050",
      image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
      image_width: 612,
      image_height: 612,
      thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
      thumb_width: 150,
      thumb_height: 150,
      location_latitude: 46.048938,
      location_longitude: 14.524719,
      location_name: "some name",
      tags: [],
      time: 12311376187
    },
    ...
  ],
  [
    ...,
    ...,
    ...
  ],
  ...
]}

Возвращает сколько-то дней, начиная с 1234 unix-time
GET /instagram/days/?from=1234
< 200
< Content-Type: application/json
{"См. /instagram/days/"}

POST /instagram/logout
> Accept: application/json
{}
< 200
< Content-Type: application/json
null

-- Flickr --


Привязка аккаунта (сохранение токена и id пользователя) с последующим редиректом на oauth_redirect_url (может содержать только относительный путь и параметры)
POST /instagram/login?oauth_redirect_url=%url%
> Accept: application/json
{
    token: "oiasdhasiudhsdisuhdiaudhiu987318hadiauh",
    id: "12312398241"
}
< 200
< Content-Type: application/json
null


Информация о пользователе
GET /flickr/user
< 200
< Content-Type: application/json
{
  id: "91283918273912381927_918239183712",
  image: "http://someurl.com/adsdadasd"
  image_width: 312,
  image_height: 312,
  name: "Vasisualiy Lohankin",
  photos_count: 23
}


Сколько то фотографий с 1234 unix-time (количество зависит от сервиса)
GET /flickr/photos/?from=1234
< 200
< Content-Type: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    thumb_width: 150,
    thumb_height: 150,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}


Все фотографии с 1234 по 1235 unix-time
GET /flickr/photos/?from=1234&to=1235
< 200
< Content-Type: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    thumb_width: 150,
    thumb_height: 150,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}


Возвращает не меньше 3(может быть и больше) фотографий объединенных в дни
GET /flickr/days/
< 200
< Content-Type: application/json
{[
  [
    {
      id: "8511704824",
      title: "IMG_0050",
      image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
      image_width: 612,
      image_height: 612,
    	thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    	thumb_width: 150,
    	thumb_height: 150,
      location_latitude: 46.048938,
      location_longitude: 14.524719,
      location_name: "some name",
      tags: [],
      time: 12311376187
    },
    ...,
    ...
  ],
  [
    ...,
    ...
  ],
  ...
]}


Возвращает сколько-то дней, начиная с 1234 unix-time
GET /flickr/days/?from=1234
< 200
< Content-Type: application/json
{"См. /flickr/days/"}


POST /flickr/logout
> Accept: application/json
{}
< 200
< Content-Type: application/json
nul

-- Facebook --


Сколько то фотографий с 1234 unix-time (количество зависит от сервиса)
GET /facebook/photos/?from=1234
< 200
< Content-Type: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    thumb_width: 150,
    thumb_height: 300,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}


Все фотографии с 1234 по 1235 unix-time
GET /facebook/photos/?from=1234&to=1235
< 200
< Content-Type: application/json
{[
  {
    id: "8511704824",
    title: "IMG_0050",
    image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
    image_width: 612,
    image_height: 612,
    thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    thumb_width: 150,
    thumb_height: 150,
    location_latitude: 46.048938,
    location_longitude: 14.524719,
    location_name: "some name",
    tags: [],
    time: 12311376187
  }
]}


Возвращает не меньше 3(может быть и больше) фотографий объединенных в дни
GET /facebook/days/
< 200
< Content-Type: application/json
{[
  [
    {
      id: "8511704824",
      title: "IMG_0050",
      image: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
      image_width: 612,
      image_height: 612,
    	thumb: "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_n.jpg",
    	thumb_width: 150,
    	thumb_height: 150,
      location_latitude: 46.048938,
      location_longitude: 14.524719,
      location_name: "some name",
      tags: [],
      time: 12311376187
    },
    ...,
    ...
  ],
  [
    ...,
    ...
  ],
  ...
]}


Возвращает сколько-то дней, начиная с 1234 unix-time
GET /facebook/days/?from=1234
< 200
< Content-Type: application/json
{"См. /flickr/days/"}
nul
