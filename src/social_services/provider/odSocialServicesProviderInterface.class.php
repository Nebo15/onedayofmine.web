<?php
interface odSocialServicesProviderInterface {
  const METHOD_PUT    = 'PUT';
  const METHOD_POST   = 'POST';
  const METHOD_GET    = 'GET';
  const METHOD_DELETE = 'DELETE';

  public static function getConfig();
  public function __construct(array $config = null);
}
