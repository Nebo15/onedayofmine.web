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

    Запрос:
      'fb_access_token' => <string 255>
    Ответ(поле result):
      'session' => <int 11>
      'user' => информация о пользователе

### 3.1.2 Проверка сессии /auth/is_logged_in - приватный ###
    Запрос: пустой
    Ответ: <boolean>

### 3.1.3 Выход /auth/logout - публичный ###
    Запрос: пустой
    Ответ: пустой


## 3.2 Пользователи ##

### 3.2.1 Дни указанного пользователя /user/days/{id} - публичный ###
    Запрос: ответ
    Ответ (поле result):
      "id": <int 11> 42,
      "title": <string 255> "My loooooooooooooong day",
      "img_url": <string 255> "http:\/\/upload.wikimedia.org\/wikipedia\/commons\/8\/84\/Example.svg",
      "description": <string 1023> "Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nQuisque volutpat egestas elit, id ornare risus cursus non.\nInteger consequat dignissim nisi, non tincidunt metus interdum non.\nPhasellus purus sem, convallis vitae rutrum nec, vulputate in ante.\nVestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.\nDuis congue dolor et dolor lacinia scelerisque. Suspendisse potenti.\nMauris non ultricies mi. Aliquam erat volutpat. Pellentesque non justo\nfacilisis tellus semper venenatis scelerisque ultricies justo.\nNullam ultricies mattis placerat. Maecenas metus est, convallis\nadipiscing mollis eget, porttitor nec sem. Nulla elementum pretium\nturpis, id fermentum magna mollis a. Donec sit amet eleifend arcu.'",
      "ctime": <int 11> 1330000000

### 3.2.1 Дни текущего пользователя /user/days/ - публичный ###
    Запрос: ответ
    Ответ:


### 3.2.1 Список fb-друзей с установленным приложением ###
    Запрос: пустой
    Ответ: [
      {
        'user_id' =>   <int 11>,
        'name' => <string>,
        'gender' => 'female'|'male',
        'link' => <string>,
        'timezone' => <int>,
        '' =>
      },
    ]


## 3. Дни ##

### 3.1 список дней по критериям (место, возраст автора, профессия, тематические тэги) ###

### 3.2 просмотр дня /day/item/$id ###
Запрос: {}
Ответ: {    'id' => <int 11>,   'user' => {     'user_id' => <int 11>,     'fb_user_id' => <string 16>   },      'title' => <string 255>,   'description' => <string 1023>,   'start_time' => <timestamp>,   'ctime' => <timestamp>,   'utime' => <timestamp>,   'likes_count' => <int 11>,   'moments' => [   ],   'comments' => [   ] }

3.3 просмотр нескольких дней /day/items/$id1,$id2,$id3...
Запрос: {}
Ответ: {
}

3.4 создание дня  - [tag_name], day_type, occupation) - day_id
3.5 редактирование дня - [tag_name], top_photo_id
3.6 завершение дня - day_id
3.7 добавление части  - day_id, type, fb_id, timestamp, description - moment
3.8 комментирование дня - day_id, text - day_comment

4. Моменты
4.1 обновление части - moment_id, fb_id, timestamp, description - moment
4.2 комментирование момента - moment_id, text - moment_comment
4.3 удаление части  - moment_id
4.4 расшаривание части в fb - id'шник записи на стене

5. Прочее
5.1 создание жалобы модератору - day_id, text - complaint_id
5.2 саджест для поиска - text - [text]
5.3 полнотекстовый поиск - text - [user], [day], [moment]
5.4 список моих дней [day]
