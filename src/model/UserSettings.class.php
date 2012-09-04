<?php
lmb_require('src/model/base/BaseModel.class.php');

/**
 * @api
 * @method null setNotificationsNewDays($int)
 * @method null setNotificationsNewComments($int)
 * @method null setNotificationsNewReplays($int)
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

  function exportForApi(array $properties = null)
  {
    return parent::exportForApi(array(
      'notifications_new_days', 'notifications_new_comments', 'notifications_new_replays',
      'notifications_related_activity', 'notifications_shooting_photos', 'photos_save_original',
      'photos_save_filtered', 'social_share_facebook', 'social_share_twitter'
    ));
  }

  static function createDefault(User $user)
  {
    $item = new UserSettings();
    $item->setUser($user);
    $item->setNotificationsNewDays(1);
    $item->setNotificationsNewComments(1);
    $item->setNotificationsNewReplays(1);
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
    $item->setNotificationsNewReplays(0);
    $item->setNotificationsRelatedActivity(0);
    $item->setNotificationsShootingPhotos(0);
    $item->setPhotosSaveOriginal(0);
    $item->setPhotosSaveFiltered(0);
    $item->setSocialShareFacebook(0);
    $item->setSocialShareTwitter(0);
    return $item;
  }
}
