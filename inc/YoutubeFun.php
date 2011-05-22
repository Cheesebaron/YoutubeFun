<?php
class YoutubeFun {
	private $URL = "";
	
	public function setURL($URL) {
		$this->URL = $URL;
	}
	
	public function getURL() {
		return $this->URL;
	}
	
	public function getVideoID($URL = NULL) {
		$videoURL = "";
		if ($URL == NULL) {
			if ($this->URL == NULL) {
				return NULL;
			} else {
				$videoURL = $this->URL;
			}
		} else {
			$videoURL = $URL;
		}
		$matches = array();
		preg_match('/.+(\?|&)v=([a-zA-Z0-9\-\_]+).*/', $videoURL, $matches);
		return $matches[2];
	}
	
	public function getEmbedCode($videoID = NULL, $height = "385", $width = "640", $allowFullScreen = "true", $allowScriptAccess = "always", $related = "true",
								 $loop = "false", $autoplay = "false", $border = "false", $color1 = "0x3a3a3a", $color2 = "0x999999", $iframe = "false") {
		$hd = "";
		$fs = "";
		$rel = "rel=0&amp;";
		$lp = "";
		$ap = "";
		$br = "";
		$returnVal = "";
		
		if ($videoID == NULL) {return "<p>Video URL was not supplied</p>";}
		if ($height == "1280" && $width == "745") {$hd = "hd=1&amp;";}
		if ($allowFullScreen == "false") {$fs = "fs=0&amp;";}
		else {$fs = "fs=1&amp;";}
		if ($related == "true") {$rel = "";}
		if ($loop == "true") {$lp = "loop=1&amp;";}
		if ($autoplay == "true") {$ap = "autoplay=1&amp;";}
		if ($border == "true") {$br = "border=1&amp;";}
		
		if ($iframe == "false") {
			$returnVal = "
			<object width=". $width ." height=". $height .">
				<param name=\"movie\" value=\"http://www.youtube.com/v/". $videoID ."?"
											 . $fs
											 ."hl=en_US&amp;"
											 . $rel
											 . $hd
											 . $lp
											 . $ap
											 . $br
												 ."color1=". $color1 ."&amp;color2=". $color2 ."\">
				</param>
				<param name=\"allowFullScreen\" value=". $allowFullScreen ."></param>
				<param name=\"allowscriptaccess\" value=". $allowScriptAccess ."></param>
				<embed src=\"http://www.youtube.com/v/". $videoID ."?"
											 		   . $fs
											 		   ."hl=en_US&amp;"
											 		   . $rel
											 		   . $hd
											 		   . $lp
											 		   . $ap
											 		   . $br
											 		   ."color1=". $color1 ."&amp;color2=". $color2 ."\n type=\"application/x-shockwave-flash\" allowscriptaccess="
											 		   . $allowScriptAccess
											 		   ."\n allowfullscreen=". $allowFullScreen
											 		   ."\n width=". $width
											 		   ."\n height=". $height ."></embed>
			</object>";
		} elseif ($iframe == "true") {
			$returnVal = "
			<iframe title=\"YouTube video player\" class=\"youtube-player\" type=\"text/html\" width=".$width
			." height=".$height." src=\"http://www.youtube.com/embed/".$videoID."?".$rel.$hd."\" frameborder=\"0\"></iframe>";
		}
		return $returnVal;
	}
	
	public function embedCodeToPlain($html) {
    	$search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript 
                 "'<[/!]*?[^<>]*?>'si",          // Strip out HTML tags 
                 "'([rn])[s]+'",                // Strip out white space 
                 "'&(quot|#34);'i",                // Replace HTML entities 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i", 
                 "'&(copy|#169);'i", 
                 "'&#(d+);'e");                    // evaluate as php 

		$replace = array ("", 
                 "", 
                 "\1", 
                 "\"", 
                 "&", 
                 "<", 
                 ">", 
                 " ", 
                 chr(161), 
                 chr(162), 
                 chr(163), 
                 chr(169), 
                 "chr(\1)"); 

		return preg_replace($search, $replace, $html);
	}
}