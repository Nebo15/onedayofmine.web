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
  protected $_db_table_name = 'user_settings';
	const NOTIFICATIONS_PERIOD_NOW = 'now';
	const NOTIFICATIONS_PERIOD_TWICE_DAY = 'twice_day';
	const NOTIFICATIONS_PERIOD_DAILY = 'daily';
	const NOTIFICATIONS_PERIOD_WEEKLY = 'weekly';
	const NOTIFICATIONS_PERIOD_NEVER = 'never';

  public
      $notifications_period_fb,
      $notifications_new_days,
      $notifications_new_comments,
      $notifications_new_replays,
      $notifications_related_activity,
      $notifications_shooting_photos,
      $photos_save_original,
      $photos_save_filtered,
      $social_share_facebook,
      $social_share_twitter;

	protected function _createValidator()
	{
		$validator = new lmbValidator();
		$validator->addRule(new lmbValidValueRule('notifications_period_fb', self::getNotificationPeriods()));
		$validator->addRule(new lmbValidValueRule('notifications_new_days', [0, 1]));
		$validator->addRule(new lmbValidValueRule('notifications_new_comments', [0, 1]));
		$validator->addRule(new lmbValidValueRule('notifications_new_replays', [0, 1]));
		$validator->addRule(new lmbValidValueRule('notifications_related_activity', [0, 1]));
		$validator->addRule(new lmbValidValueRule('notifications_shooting_photos', [0, 1]));
		$validator->addRule(new lmbValidValueRule('photos_save_original', [0, 1]));
		$validator->addRule(new lmbValidValueRule('photos_save_filtered', [0, 1]));
		$validator->addRule(new lmbValidValueRule('social_share_facebook', [0, 1]));
		$validator->addRule(new lmbValidValueRule('social_share_twitter', [0, 1]));
		return $validator;
	}

  function exportForApi(array $properties = null)
  {
    return parent::exportForApi([
      'notifications_period_fb', 'notifications_new_days', 'notifications_new_comments',
	    'notifications_new_replays', 'notifications_related_activity', 'notifications_shooting_photos',
	    'photos_save_original', 'photos_save_filtered', 'social_share_facebook', 'social_share_twitter'
    ]);
  }

  static function createDefault()
  {
    $item = new UserSettings();
	  $item->notifications_period_fb = self::NOTIFICATIONS_PERIOD_TWICE_DAY;
	  $item->notifications_new_days = 1;
    $item->notifications_new_days = 1;
    $item->notifications_new_comments = 1;
    $item->notifications_new_replays = 1;
    $item->notifications_related_activity = 1;
    $item->notifications_shooting_photos = 1;
    $item->photos_save_original = 1;
    $item->photos_save_filtered = 1;
    $item->social_share_facebook = 1;
    $item->social_share_twitter = 0;
    return $item;
  }

  static function createQuiet()
  {
    $item = new UserSettings();
	  $item->notifications_period_fb = self::NOTIFICATIONS_PERIOD_NEVER;
    $item->notifications_new_days = 0;
    $item->notifications_new_comments = 0;
    $item->notifications_new_replays = 0;
    $item->notifications_related_activity = 0;
    $item->notifications_shooting_photos = 0;
    $item->photos_save_original = 0;
    $item->photos_save_filtered = 0;
    $item->social_share_facebook = 0;
    $item->social_share_twitter = 0;
    return $item;
  }

	static function getNotificationPeriods()
	{
		return [
			self::NOTIFICATIONS_PERIOD_NOW,
			self::NOTIFICATIONS_PERIOD_TWICE_DAY,
			self::NOTIFICATIONS_PERIOD_DAILY,
			self::NOTIFICATIONS_PERIOD_WEEKLY,
			self::NOTIFICATIONS_PERIOD_NEVER,
		];
	}
}
