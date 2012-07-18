<?php
class APICommentPattern extends AbstractCommentPattern {
  public function apply(DocComment $doc_comment) {
    $doc_comment->declareToken('category');
    switch ($doc_comment->category) {
      case 'description':
        break;

      case 'input':
        $doc_comment->declareToken('required');
        $doc_comment->required = $doc_comment->required == 'param' ? true : false; // transform option and param to required flag

      case 'result':
        $doc_comment->declareToken('type');
        $doc_comment->declareToken('name');
        break;
    }
  }
}