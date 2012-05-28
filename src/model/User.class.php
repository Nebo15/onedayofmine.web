<?php

/**
 *@SwaggerModel(
 *     id="user",
 *     description="some long description of the model"
 * )
 * @property integer $id
 */
class User extends lmbActiveRecord
{
  protected $_db_table_name = 'user';
  protected $_default_sort_params = array('id'=>'asc');
}