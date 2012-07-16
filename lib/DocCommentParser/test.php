<?php
include_once 'DocCommentParser.class.php';
include_once 'DocComment.class.php';
include_once 'Patterns/AbstractComment.pattern.php';
include_once 'Patterns/APIComment.pattern.php';

$entities = DocCommentParser::tokenize('  /**
   * @api description Starts a day
   * @api input param string title Title name for this day
   * @api input param string description Description for this day
   * @api input param int timezone UTC time zone offset
   * @api input param string occupation Thing that user are planning to do during current day
   * @api input param string type One of pre-defined types: {working, day-off, holiday, trip, special_event}
   * @api input option string foo Bar
   * @api result int id Day ID
   * @api result int user_id
   * @api result string title
   * @api result string description
   * @api result int timezone UTC time zone
   * @api result string occupation
   * @api result string type One of pre-defined types: {working, day-off, holiday, trip, special_event}
   * @api result int|null likes_count
   * @api result int ctime Creation time, unix timestamp
   * @api result int utime Last update time, unix timestamp
   * @api result boolean is_ended Always FALSE for new days
   */');

$entities->applyPattern(new APICommentPattern());

var_dump($entities->getFilteredGroup('api', function(DocComment $comment) {
  if($comment->category == 'input') {
    return true;
  }
}));