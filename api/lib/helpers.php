<?php

class Helpers {
	/*static function textToXHTML($input, $allowed){
		$texy = new Texy();
		
		// texy2 settings, change it if you want to allow users to do more/less with texy2/xhtml syntax
		// by default just some xhtml tags are allowed and no texy formatting
		$texy->allowedClasses = Texy::NONE;
		$texy->allowedStyles = Texy::NONE;
		$texy->allowedTags = array(
			'strong' => Texy::NONE,
			'em' => Texy::NONE,
			'p' => Texy::NONE,
			'ul' => Texy::NONE,
			'ol' => Texy::NONE,
			'li' => Texy::NONE,
			'br' => Texy::NONE,
			'hr' => Texy::NONE,
			'pre' => Texy::NONE,
			'code' => Texy::NONE,
			'table' => Texy::NONE,
			'tr' => Texy::NONE,
			'th' => Texy::NONE,
			'td' => array('class'),
			'tbody' => Texy::NONE,
			'thead' => Texy::NONE,
			'blockquote' => Texy::NONE,
			'h2' => Texy::NONE,
			'h3' => Texy::NONE,
			'h4' => Texy::NONE,
			'sup' => Texy::NONE,
			'sub' => Texy::NONE,
			'ins' => Texy::NONE,
			'del' => Texy::NONE,
			'a' => array('href','title','rel'),
			'img' => array('src','alt','title')
		);
		$texy->obfuscateEmail = false;
		$texy->htmlModule->passComment = false; // insert xhtml comments?
		$texy->htmlOutputModule->removeOptional = false; // remove optional endtags?
		
		$texy->allowed['blocks'] = false;
		$texy->allowed['blockquote'] = false;
		$texy->allowed['emoticon'] = false;
		$texy->allowed['figure'] = false;
		$texy->allowed['heading/underlined'] = false;
		$texy->allowed['heading/surrounded'] = false;
		$texy->allowed['horizline'] = false;
		$texy->allowed['html/comment'] = false;
		$texy->allowed['image'] = false;
		$texy->allowed['image/definition'] = false;
		$texy->allowed['link/definition'] = false;
		$texy->allowed['link/reference'] = false;
		$texy->allowed['link/url'] = false;
		$texy->allowed['link/email'] = false;
		$texy->allowed['list'] = false;
		$texy->allowed['list/definition'] = false;
		$texy->allowed['longwords'] = true; // divide long words?
		$texy->allowed['phrase/strong'] = false;
		$texy->allowed['phrase/em'] = false;
		$texy->allowed['phrase/em-alt'] = false;
		$texy->allowed['phrase/ins'] = false;
		$texy->allowed['phrase/del'] = false;
		$texy->allowed['phrase/sup'] = false;
		$texy->allowed['phrase/sup-alt'] = false;
		$texy->allowed['phrase/sub'] = false;
		$texy->allowed['phrase/sub-alt'] = false;
		$texy->allowed['phrase/span'] = false;
		$texy->allowed['phrase/span-alt'] = false;
		$texy->allowed['phrase/cite'] = false;
		$texy->allowed['phrase/acronym'] = false;
		$texy->allowed['phrase/acronym-alt'] = false;
		$texy->allowed['phrase/code'] = false;
		$texy->allowed['phrase/quote'] = false;
		$texy->allowed['phrase/quicklink'] = false;
		$texy->allowed['script'] = false;
		$texy->allowed['table'] = false;
		
		// processing
		$output = $texy->process($input);
		$output = eregi_replace ('<!--[^>]*-->', '', $output);
		$output = trim($output);
		return $output;
	}*/

	public static function encodePassword($email, $pwd) {
		$trans = array("ě"=>"e","š"=>"s","č"=>"c","ř"=>"r","ž"=>"z","ý"=>"y","á"=>"a","í"=>"i","é"=>"e","ť"=>"t","ď"=>"d","ň"=>"n","ů"=>"u","ú"=>"u","ľ"=>"l","ó"=>"o","à"=>"a","â"=>"a","ã"=>"a","ä"=>"a","å"=>"a","æ"=>"ae","ç"=>"c","è"=>"e","ê"=>"e","ë"=>"e","ì"=>"i","î"=>"i","ï"=>"i","ð"=>"d","ñ"=>"n","ò"=>"o","ô"=>"o","õ"=>"o","ö"=>"o","ø"=>"eu","ù"=>"u","û"=>"u","ü"=>"u","þ"=>"th",
		             "Ě"=>"E","Š"=>"S","Č"=>"C","Ř"=>"R","Ž"=>"Z","Ý"=>"Y","Á"=>"A","Í"=>"I","É"=>"E","Ť"=>"T","Ď"=>"D","Ň"=>"N","Ů"=>"U","Ú"=>"U","Ľ"=>"L","Ó"=>"O","À"=>"A","Â"=>"A","Ã"=>"A","Ä"=>"A","Å"=>"A","Æ"=>"AE","Ç"=>"C","È"=>"E","Ê"=>"E","Ë"=>"E","Ì"=>"I","Î"=>"I","Ï"=>"I","Ð"=>"D","Ñ"=>"N","Ò"=>"O","Ô"=>"O","Õ"=>"O","Ö"=>"O","Ø"=>"EU","Ù"=>"U","Û"=>"U","Ü"=>"U","Þ"=>"TH");

		$dst = strtr($email, $trans);
		$dst = strtolower($dst);
		$dst = preg_replace('/([[:space:]]|[\-])+/i', ' ', $dst);
		$dst = preg_replace('/[^a-z0-9\-\_]{1,}/i', ' ', $dst);
		$dst = trim($dst);
		$dst = strtr($dst, ' ', '-');

		return (sha1($dst . Settings::PASSWORD_SEED . $pwd));
	}

	public static function isValidEMail($email) {
		return preg_match('/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@(([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.))*[A-Za-z0-9]{1,63}\.[a-zA-Z]{2,6}$/i', $email);
	}

	public static function generateHash($length = 255) {
		return substr(base64_encode(sha1(SETTINGS::PASSWORD_SEED . time())), 0, $length);
	}
}
