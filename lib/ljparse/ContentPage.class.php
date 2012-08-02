<?php
class ContentPage {
  private $title;
  private $username;
  private $userpic;
  private $date;
  private $description;
  private $moments = array();
  private $content;
  /**
   * @var ContentPageParser
   */
  protected $concreteParser;

  public function __construct(ContentPageParser $concreteParser) {
    $this->concreteParser = $concreteParser;
  }

  public function getRemoteContent($community, $id) {
    $this->content = file_get_contents("http://{$community}.livejournal.com/{$id}.html");
  }

  public function setContent($content) {
    $this->content = $content;
  }

  public function getTitle() {
    return $this->title = $this->concreteParser->getTitle($this->content);
  }

  public function getUsername() {
    return $this->username = $this->concreteParser->getUsername($this->content);
  }

  public function getUserpic() {
    return $this->userpic = $this->concreteParser->getUserpic($this->content);
  }

  public function getDate() {
    return $this->date = $this->concreteParser->getDate($this->content);
  }

  public function getDescription() {
    return $this->description = $this->concreteParser->getDescription($this->content);
  }

  public function getMoments() {
    return $this->moments = $this->concreteParser->getMoments($this->content);
  }

  public function getData() {
    return array(
      'title' => $this->title ?: $this->getTitle(),
      'username' => $this->username ?: $this->getUsername(),
      'userpic' => $this->userpic ?: $this->getUserpic(),
      'date' => $this->date ?: $this->getDate(),
      'description' => $this->description ?: $this->getDescription(),
      'moments' => count($this->moments) > 0 || is_null($this->moments) ? $this->moments : $this->getMoments()
     );
  }
}
