<?php
class MainPageRegexpParser extends MainPageParser {
  public function getLinksToContentPages($source) {
    // Find all links to full pages
    if(preg_match_all('#<a[\s]+href="http://[^/]*/([0-9]*)\.html"[\s]+class="subj-link"[\s]*>#isUu', $source, $out)) {
      return $out[1];
    } else {
      return null;
    }
  }
}
