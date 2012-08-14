<?php
lmb_require('limb/fs/src/exception/lmbFileNotFoundException.class.php');

class ImageHelper {
  function getExifInfo($path)
  {
    if(!is_file($path))
      throw new lmbFileNotFoundException($path);

    return exif_read_data($path, null, true);
  }

  function exifGPSToDecemicalCords($exif)
  {
    $cords = $this->exifGPSToCords($exif);
    return array(
      'latitude'  => $cords['latitude']['degrees']+((($cords['latitude']['minutes']*60)+($cords['latitude']['seconds']))/3600),
      'longitude' => $cords['longitude']['degrees']+((($cords['longitude']['minutes']*60)+($cords['longitude']['seconds']))/3600)
    );
  }

  function exifGPSToCords($exif)
  {
    return [
      'latitude'  => $this->exifGPSSectionToCords($exif['GPS']['GPSLatitude']),
      'longitude' => $this->exifGPSSectionToCords($exif['GPS']['GPSLongitude']),
    ];
  }

  protected function exifGPSSectionToCords(array $latlong)
  {
    $degrees = count($latlong) > 0 ? $this->exifCordToFloat($latlong[0]) : 0;
    $minutes = count($latlong) > 1 ? $this->exifCordToFloat($latlong[1]) : 0;
    $seconds = count($latlong) > 2 ? $this->exifCordToFloat($latlong[2]) : 0;

    // Normalization
    $minutes += 60 * ($degrees - floor($degrees));
    $degrees = floor($degrees);

    $seconds += 60 * ($minutes - floor($minutes));
    $minutes = floor($minutes);

    // Weird data protection
    if($seconds >= 60)
    {
      $minutes += floor($seconds/60.0);
      $seconds -= 60*floor($seconds/60.0);
    }

    if($minutes >= 60)
    {
      $degrees += floor($minutes/60.0);
      $minutes -= 60*floor($minutes/60.0);
    }

    return array('degrees' => $degrees, 'minutes' => $minutes, 'seconds' => $seconds);
  }

  protected function exifCordToFloat($coordPart)
  {
    $parts = explode('/', $coordPart);

    if(count($parts) <= 0) // jic
      return 0;
    if(count($parts) == 1)
      return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);
  }

  function getMimeTypeByImageContent($content)
  {
    return (new finfo())->buffer($content, FILEINFO_MIME_TYPE);
  }

  function getImageExtensionByMimeType($mime_type)
  {
    lmb_assert_true($mime_type);

    if(false !== strpos($mime_type, 'JPEG image data'))
      return 'jpeg';

    $exts = array(
      'image/jpeg' => 'jpeg',
      'image/png'  => 'png',
      'image/gif'  => 'gif',
    );

    if(!isset($exts[$mime_type]))
      throw new lmbException("Unknown mime-type '{$mime_type}'");

    return $exts[$mime_type];
  }

  function getImageExtensionByImageContent($content)
  {
    return $this->getImageExtensionByMimeType($this->getMimeTypeByImageContent($content));
  }
}
