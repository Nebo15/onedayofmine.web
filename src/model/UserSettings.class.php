<?php
lmb_require('src/model/base/BaseModel.class.php');

/**
 * @api
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
  protected function _defineRelations()
  {
    $this->_belongs_to = array (
      'user' => array (
        'field' => 'user_settings_id',
        'class' => 'User',
      )
    );
  }

  function exportForApi()
  {
    $result = new stdClass();
    $result->notifications_new_days = $this->notifications_new_days;
    $result->notifications_new_comments = $this->notifications_new_comments;
    $result->notifications_related_activity = $this->notifications_related_activity;
    $result->notifications_shooting_photos = $this->notifications_shooting_photos;
    $result->photos_save_original = $this->photos_save_original;
    $result->photos_save_filtered = $this->photos_save_filtered;
    $result->social_share_facebook = $this->social_share_facebook;
    $result->social_share_twitter = $this->social_share_twitter;
    return $result;
  }

  static function createDefault(User $user)
  {
    $item = new UserSettings();
    $item->setUser($user);
    $item->setNotificationsNewDays(1);
    $item->setNotificationsNewComments(1);
    $item->setNotificationsRelatedActivity(1);
    $item->setNotificationsShootingPhotos(1);
    $item->setPhotosSaveOriginal(1);
    $item->setPhotosSaveFiltered(1);
    $item->setSocialShareFacebook(1);
    $item->setSocialShareTwitter(0);
    return $item;
  }

  static function createQuiet(User $user)
  {
    $item = new UserSettings();
    $item->setUser($user);
    $item->setNotificationsNewDays(0);
    $item->setNotificationsNewComments(0);
    $item->setNotificationsRelatedActivity(0);
    $item->setNotificationsShootingPhotos(0);
    $item->setPhotosSaveOriginal(0);
    $item->setPhotosSaveFiltered(0);
    $item->setSocialShareFacebook(0);
    $item->setSocialShareTwitter(0);
    return $item;
  }
}
