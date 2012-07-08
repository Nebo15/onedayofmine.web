<?php
class MainPage {
  protected $content;
  /**
   * @var MainPageParser
   */
  protected $concreteParser;

  public function __construct(MainPageParser $concreteParser) {
    $this->concreteParser = $concreteParser;
  }

  public function getRemoteContent($community, $pages = 1) {
    $this->content = '';
    for($i = 0; $i < $pages; $i++) {
      $this->content .= file_get_contents("http://{$community}.livejournal.com/?skip=".($i*30));
    }
  }

  public function setContent($content) {
    $this->content = $content;
  }

  public function getLinksToContentPages() {
    return $this->concreteParser->getLinksToContentPages($this->content);
  }
}
