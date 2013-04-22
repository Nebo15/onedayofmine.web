<?php
class DiaryMobilePageRegexpParser extends ContentPageParser
{
	public function getTitle($content)
	{
		return "Тут был бы заголовок, но это просто превью";
	}

	public function getUsername($content)
	{
		return "%username%";
	}

	public function getUserpic($content)
	{
		return 'http://onedayofmine.s3.amazonaws.com/users/default_image_72.png';
	}

	public function getDate($content)
	{
		return '2013-04-14';
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
		if(preg_match('#<div class="postInner">(.*?)<a name=\'more1end\'>#isU', $content, $out)) {
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
