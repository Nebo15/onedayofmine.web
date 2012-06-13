<?php
class odMock
{
  static function user()
  {
    $user = new stdClass();
    $user->cip = 2130706433;
    $user->ctime = 1339621518;
    $user->fb_name = "Foo";
    $user->fb_profile_url = "http://www.facebook.com/profile.php?id=100003921268738";
    $user->fb_profile_utime = "1339136917";
    $user->fb_uid ="100003921268738";
    $user->id = 1;
    $user->pic_big = "http://profile.ak.fbcdn.net/hprofile-ak-snc4/369578_100003921268738_1696883803_n.jpg";
    $user->pic_small = "http://profile.ak.fbcdn.net/hprofile-ak-snc4/369578_100003921268738_1696883803_t.jpg";
    $user->pic_square = "http://profile.ak.fbcdn.net/hprofile-ak-snc4/369578_100003921268738_1696883803_q.jpg";
    $user->sex = "male";
    $user->timezone = "3";
    $user->utime = 1339621518;
    return $user;
  }

  static function day()
  {
    $day = new stdClass;
    $day->id = 42;
    $day->title = 'My loooooooooooooong day';
    $day->img_url = 'http://upload.wikimedia.org/wikipedia/commons/8/84/Example.svg';
    $day->description = <<<EOD
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Quisque volutpat egestas elit, id ornare risus cursus non.
Integer consequat dignissim nisi, non tincidunt metus interdum non.
Phasellus purus sem, convallis vitae rutrum nec, vulputate in ante.
Vestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.
Duis congue dolor et dolor lacinia scelerisque. Suspendisse potenti.
Mauris non ultricies mi. Aliquam erat volutpat. Pellentesque non justo
facilisis tellus semper venenatis scelerisque ultricies justo.
Nullam ultricies mattis placerat. Maecenas metus est, convallis
adipiscing mollis eget, porttitor nec sem. Nulla elementum pretium
turpis, id fermentum magna mollis a. Donec sit amet eleifend arcu.'
EOD;
    $day->ctime = 1330000000;
    return $day;
  }

  static function dayComment()
  {
    $comment = new stdClass();
    $comment->id = 422;
    $comment->user_id = 1;
    $comment->day_id = 42;
    $comment->text = <<<EOD
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Quisque volutpat egestas elit, id ornare risus cursus non.
Integer consequat dignissim nisi, non tincidunt metus interdum non.
Phasellus purus sem, convallis vitae rutrum nec, vulputate in ante.
Vestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.
EOD;
    $comment->likes_count = 123;
    $comment->ctime = 1331000000;
    return $comment;
  }

  static function moment()
  {
    $moment = new stdClass();
    $moment->id = 11;
    $moment->day_id = 42;
    $moment->description = <<<EOD
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Quisque volutpat egestas elit, id ornare risus cursus non.
Integer consequat dignissim nisi, non tincidunt metus interdum non.
Phasellus purus sem, convallis vitae rutrum nec, vulputate in ante.
Vestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.
EOD;
    $moment->type = 'photo';
    $moment->likes_count = 43;
    $moment->ctime = 1330500000;
    return $moment;
  }

  static function momentComment()
  {
    $comment = new stdClass();
    $comment->id = 111;
    $comment->user_id = 1;
    $comment->moment_id = 11;
    $comment->text = <<<EOD
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Quisque volutpat egestas elit, id ornare risus cursus non.
Integer consequat dignissim nisi, non tincidunt metus interdum non.
Phasellus purus sem, convallis vitae rutrum nec, vulputate in ante.
Vestibulum id purus risus. Phasellus eu sapien et dui tempus pharetra.
EOD;
    $comment->likes_count = 123;
    $comment->ctime = 1331000000;
    return $comment;
  }
}
