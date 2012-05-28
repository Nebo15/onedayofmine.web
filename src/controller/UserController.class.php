<?php
lmb_require('limb/cms/src/controller/lmbObjectController.class.php');
lmb_require('src/model/User.class.php');

/**
 *@Swaggerresource(
 *     basePath="http://one-day.ru/api_doc",
 *     swaggerVersion="1",
 *     apiVersion="1"
 * )
 *@Swagger (
 *     path="/user",
 *     value="Users operations"
 *     )
 *@SwaggerProduces ('application/json')
 *
 */
class UserController extends lmbObjectController
{
  protected $_object_class_name = 'User';

  /**
   *@PUT
   *@SwaggerPath /
   *@SwaggerOperation(
   *     value="Add user",
   *     responseClass="user",
   *     multiValueResponse=false
   *     tags="MLR"
   * )
   *
   *@SwaggerError(code=403,reason="User Not Authorized")
   *@SwaggerParam(
   *     description="FaceBook id",
   *     required=true,
   *     allowMultiple=false,
   *     dataType="string",
   *     name="fb_user_id",
   *     paramType="body"
   * )
   */
  function doPut() {

  }

  /**
   *@GET
   *@SwaggerPath /
   *@SwaggerOperation(
   *     value="Get users",
   *     responseClass="user",
   *     multiValueResponse=true
   *     tags="MLR"
   * )
   *
   *@SwaggerError(code=403,reason="User Not Authorized")
   *@SwaggerParam(
   *     description="fake",
   *     required=false,
   *     allowMultiple=false,
   *     dataType="integer",
   *     name="fake",
   *     paramType="path"
   * )
   */
  function doDisplay() {
    return array();
  }

  /**
    *@GET
    *@SwaggerPath /{user_id}
    *@SwaggerOperation(
    *     value="Get user by {user_id}",
    *     responseClass="user",
    *     multiValueResponse=false
    *     tags="MLR"
    * )
    *@SwaggerError(code=400,reason="Invalid ID Provided")
    *@SwaggerError(code=403,reason="User Not Authorized")
    *@SwaggerError(code=404,reason="User Not Found")
    *@SwaggerParam(
    *     description="ID of the user being requested",
    *     required=true,
    *     allowMultiple=false,
    *     dataType="integer",
    *     name="user_id",
    *     paramType="path"
    * )
    */
  function doItem() {
    return null;
  }

  /**
   *@DELETE
   *@SwaggerPath /{user_id}
   *@SwaggerOperation(
   *     value="Delete user by {user_id}",
   *     responseClass="user",
   *     multiValueResponse=false
   *     tags="MLR"
   * )
   *@SwaggerError(code=400,reason="Invalid ID Provided")
   *@SwaggerError(code=403,reason="User Not Authorized")
   *@SwaggerError(code=404,reason="User Not Found")
   *@SwaggerParam(
   *     description="ID of the user being requested",
   *     required=true,
   *     allowMultiple=false,
   *     dataType="integer",
   *     name="user_id",
   *     paramType="path"
   * )
   */
  function doDelete() {

  }
}
