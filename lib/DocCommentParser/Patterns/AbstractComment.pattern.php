<?php
abstract class AbstractCommentPattern {
  abstract public function apply(DocComment $doc_comment);
}