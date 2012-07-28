<?php
lmb_require('src/model/BaseModel.class.php');

/**
 * @method null setNotificationsNewDays($int)
 * @method null setNotificationsNewComments($int)
 * @method null setNotificationsRelatedActivity($int)
 * @method null setNotificationsShootingPhotos($int)
 * @method null setPhotosSaveOriginal($int)
 * @method null setPhotosSaveFiltered($int)
 * @method null setSocialShareFacebook($int)
 * @method null setSocialShareTwitter($int)
 */
class UserSettings extends BaseModel
{
  static function createDefault()
  {
    $item = new UserSettings();
    $item->setNotificationsNewDays(1);
    $item->setNotificationsNewComments(1);
    $item->setNotificationsRelatedActivity(1);
    $item->setNotificationsShootingPhotos(1);
    $item->setPhotosSaveOriginal(1);
    $item->setPhotosSaveFiltered(1);
    $item->setSocialShareFacebook(1);
    $item->setSocialShareTwitter(1);
    return $item;
  }
}
