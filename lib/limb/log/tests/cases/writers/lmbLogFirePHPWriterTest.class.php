<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/log/src/writers/lmbLogFirePHPWriter.class.php');
lmb_require('limb/toolkit/src/lmbToolkit.class.php');
lmb_require('limb/net/src/lmbNetTools.class.php');
lmb_require('limb/net/src/lmbHttpResponse.class.php');

class lmbLogFirePHPWriterTest extends UnitTestCase {

  function testWrite()
  {
    lmbToolkit::merge(new lmbNetTools());
    lmbToolkit::instance()->setResponse(new lmbHttpResponseForLogTest());
    $writer = new lmbLogFirePHPWriter(new lmbUri('firePHP://localhost/?check_extension=0'));
    $writer->write(new lmbLogEntry(LOG_ERR, 'foo'));
    $headers = lmbToolkit::instance()->getResponse()->getHeaders();
    $this->assertPattern('/Error/', $headers[4]);
    $this->assertPattern('/foo/', $headers[4]);
  }

  function testSetErrorLevel()
  {
    lmbToolkit::merge(new lmbNetTools());
    lmbToolkit::instance()->setResponse(new lmbHttpResponseForLogTest());
    $writer = new lmbLogFirePHPWriter(new lmbUri('firePHP://localhost/?check_extension=0'));
    $writer->setErrorLevel(LOG_WARNING);

    $result = $writer->write(new lmbLogEntry(LOG_ERR, 'foo'));
    $result = $writer->write(new lmbLogEntry(LOG_NOTICE, 'foonotice'));

    $headers = lmbToolkit::instance()->getResponse()->getHeaders();

    $this->assertPattern('/Error/', $headers[4]);
    $this->assertPattern('/foo/', $headers[4]);
    $this->assertNoPattern('/Notice/', $headers[4]);
    $this->assertNoPattern('/foonotice/', $headers[4]);

  }

  function testSetErrorLevelByDSN()
  {
    lmbToolkit::merge(new lmbNetTools());
    lmbToolkit::instance()->setResponse(new lmbHttpResponseForLogTest());
    $writer = new lmbLogFirePHPWriter(new lmbUri('firePHP://localhost/?check_extension=0&level='.LOG_WARNING));

    $result = $writer->write(new lmbLogEntry(LOG_ERR, 'foo'));
    $result = $writer->write(new lmbLogEntry(LOG_NOTICE, 'foonotice'));

    $headers = lmbToolkit::instance()->getResponse()->getHeaders();

    $this->assertPattern('/Error/', $headers[4]);
    $this->assertPattern('/foo/', $headers[4]);
    $this->assertNoPattern('/Notice/', $headers[4]);
    $this->assertNoPattern('/foonotice/', $headers[4]);
  }
}

class lmbHttpResponseForLogTest extends lmbHttpResponse {

    function getHeaders()
    {
        return $this->headers;
    }
}

