<?php
lmb_require('src/service/social_photo_source/BasePhotoSource.class.php');

class CachedPhotoSource extends BasePhotoSource
{
	const TTL = 300;
	/**
	 * @var BaseSocialPhotoSource
	 */
	protected $source;

	function __construct(BasePhotoSource $source)
	{
		$this->source = $source;
	}

	function getPhotos($from_stamp = null, $to_stamp = null)
	{
		$cache = lmbToolkit::instance()->getCache('photo_sources');
		$key = get_class($this->source).'_'.lmbToolkit::instance()->getUser()->id.'_'.$from_stamp.'_'.$to_stamp;

		if(!$result = $cache->get($key))
		{
			$result = $this->source->getPhotos($from_stamp, $to_stamp);
			$cache->set($key, $result, self::TTL);
		}
		return $result;
	}
}