<?php
lmb_require('src/model/BaseModel.class.php');

/**
 *@SwaggerModel(
 *     id="user",
 *     description="some long description of the model"
 * )
 * @property integer $id
 */
class User extends lmbActiveRecord
{

}