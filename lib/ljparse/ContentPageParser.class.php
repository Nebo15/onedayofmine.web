<?php
abstract class ContentPageParser {
  abstract public function getTitle($content);
  abstract public function getUsername($content);
  abstract public function getDate($content);
  abstract public function getDescription($content);
  abstract public function getMoments($content);
}
