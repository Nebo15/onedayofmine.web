<?php

class User extends lmbActiveRecord
{
  protected $_db_table_name = 'user';

  protected $_default_sort_params = array('id'=>'asc');


}