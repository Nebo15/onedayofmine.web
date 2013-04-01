<?php
class MobilePageRegexpParser extends ContentPageParser
{
	public function getTitle($content)
	{
		if(preg_match('#<h3 class="item-header">([^<]*)</h3>#is', $content, $out)) {
			return trim($out[1]);
		} else {
			new lmbException('Title not found.');
		}
	}

	public function getUsername($content)
	{
		if(preg_match('#<h1>[\s]*<a href="http://m.livejournal.com/read/user/([^"]*)"#is', $content, $out)) {
			return trim($out[1]);
		} else {
			new lmbException('Username not found.');
		}
	}

	public function getUserpic($content)
	{
		if(preg_match('#<img class="userpic" src="([^"]*)"#is', $content, $out)) {
			return trim($out[1]);
		} else {
			new lmbException('Userpic not found.');
		}
	}

	public function getDate($content)
	{
		if(preg_match('#<p class="item-meta">(.*?)</p>#is', $content, $out)) {
			return trim(strip_tags($out[1]));
		} else {
			new lmbException('Date not found.');
		}
	}

	public function getDescription($content)
	{
		$content = $this->_getPostBody($content);
		$content = $this->_stripUserpicks($content);

		if(!preg_match('#(.*?)<a name="cutid1"></a>#isU', $content, $out)) {
			return null;
		} else {
			return $this->_sanitizeText($out[1]);
		}
	}

	public function getMoments($content)
	{
		$content = $this->_getPostBody($content);
		$content = $this->_stripUserpicks($content);
		$content = trim(strip_tags($content, '<img>'));

		// strip unnecessary image data and insert MOMENT END tag
		$content = '<!--MSTART-->' . preg_replace('#<img.+src="([^"]*)"[^>]*>#isU', '<img src="\\1" /><!--MEND--><!--MSTART-->', $content);

		// split body into posts
		preg_match_all('#<!--MSTART-->(.*?)<img src="([^"]*)" /><!--MEND-->#is', $content, $out);
		$moments_count = count($out[0]);
		if($moments_count == 0) {
			return null;
		} else {
			$moments = array();
			for($i = 0; $i < $moments_count; $i++) {
				$moments[] = array(
					'description' => $this->_sanitizeText($out[1][$i]),
					'img' => $out[2][$i]
				);
			}
			return $moments;
		}
	}

	private function _getPostBody($content)
	{
		if(preg_match('#<div class="item-text">(.*?)</div>[\s]*<p class="item-tags">#isU', $content, $out)) {
			return $out[1];
		} else {
			new lmbException('Post body not found.');
		}
	}

	private function _stripUserpicks($content)
	{
		return preg_replace('#<img[\s]+class="i-ljuser-userhead"[^>]*>#is', '', $content);
	}

	private function _sanitizeText($text)
	{
		$text = str_replace('</p>', PHP_EOL, $text);
		$text = str_replace('<br />', PHP_EOL, $text);
		$text = preg_replace('#^[\s\d\.]*#is', '', $text);
		$text = preg_replace('#[\s\d\.]*$#is', '', $text);
		$text = trim($text);

		return trim(html_entity_decode(strip_tags($text)));
	}
}
