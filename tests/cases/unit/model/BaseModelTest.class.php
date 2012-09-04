<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class BaseModelTest extends odUnitTestCase
{
  function testTimeConversation()
  {
    $valid_iso = '2005-08-09T18:31:42+03:00';
    list($stamp, $timezone) = BaseModelForTest::isoToStamp($valid_iso);
    $iso = BaseModelForTest::stampToIso($stamp, $timezone);
    $this->assertEqual($valid_iso, $iso);

    $valid_iso = '2009-01-02T03:04:05+06:07';
    list($stamp, $timezone) = BaseModelForTest::isoToStamp($valid_iso);
    $iso = BaseModelForTest::stampToIso($stamp, $timezone);
    $this->assertEqual($valid_iso, $iso);

    $valid_iso = '2009-01-02T03:04:05-06:07';
    list($stamp, $timezone) = BaseModelForTest::isoToStamp($valid_iso);
    $iso = BaseModelForTest::stampToIso($stamp, $timezone);
    $this->assertEqual($valid_iso, $iso);

    $valid_iso = '2009-01-02T03:04:05-06:07';
    list($stamp, $timezone) = BaseModelForTest::isoToStamp($valid_iso);
    $iso = BaseModelForTest::stampToIso($stamp, $timezone);
    $this->assertEqual($valid_iso, $iso);

    list($plus_stamp, $timezone) = BaseModelForTest::isoToStamp('1970-01-01T01:02:03+03:00');
    list($minus_stamp, $timezone) = BaseModelForTest::isoToStamp('1970-01-01T07:02:03-03:00');
    $this->assertEqual($plus_stamp, $minus_stamp);
  }
}

class BaseModelForTest extends BaseModel {}
