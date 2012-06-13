<?php
class odMock
{
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
}
