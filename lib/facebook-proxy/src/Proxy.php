<?php
require_once(__DIR__.'/../src/CallRequest.php');

class Proxy
{
  function process($http_request_params)
  {
    switch ($http_request_params['action'])
    {
      case 'create_object':
        $this->doCreateObjectPage(CallRequest::create(json_decode($http_request_params['params'])));
        break;
      default:
        return 'Unknown action';
    }
  }

  function doCreateObjectPage(CallRequest $request)
  {
    if(!file_exists($request->path))
      mkdir(basename($request->path), 0775, true);
    $og_url = 'http://'.$_SERVER['SERVER_NAME'].$request->path;

    file_put_contents($request->path, $this->createObjectXml($request, $og_url));
  }

  protected function createObjectXml(CallRequest $request, $object_url)
  {
    $ns = $request->app_namespace;
    $og_object_content = (array) $request->og_props;
    $og_object_content['fb:app_id'] = $request->app_id;
    $og_object_content['og:type'] = $ns.':'.$request->og_type;
    $og_object_content['og:url'] = $object_url;
    $xml = '<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# '.$ns.': http://ogp.me/ns/fb/'.$ns.'#">'."\n";
    foreach($og_object_content as $property => $content)
      $xml .= '<meta property="'.$property.'" content="'.$content.'" />'."\n";

    return $xml;
  }
}
