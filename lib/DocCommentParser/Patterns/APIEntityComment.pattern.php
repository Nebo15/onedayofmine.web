<?php
class APIEntityCommentPattern extends AbstractCommentPattern {
  public function apply(DocComment $doc_comment) {
    $doc_comment->declareToken('category');
    if($doc_comment->category == 'field') {
      $doc_comment->declareToken('type');
      $doc_comment->declareToken('name');
    }
  }
}