<?php
lmb_require('src/model/base/BaseModel.class.php');

class NewsRecipient extends BaseModel
{
  protected $_db_table_name = 'news_recipient';

  public $news_id;
  public $user_id;
  public $is_published;

  function setNews(News $news)
  {
    $this->news_id = $news->id;
  }

  function setUser(User $user)
  {
    $this->user_id = $user->id;
  }
}
