<?php
class odTwitterException extends Exception
{
  protected $result;

  public function __construct($message, $result = null)
  {
    $this->result = $result;
    parent::__construct($message);
  }

  public function getResult()
  {
    return $this->result;
  }
}
