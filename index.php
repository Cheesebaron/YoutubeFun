<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>YouTube Embed Video</title>
<script type="text/javascript">
	function pickcolor(elm)
	{
		window.open("colorpicker/colorpicker.htm#"+elm.id,"","location=0,status=0,scrollbars=0,width=550,height=305");
	}

	function addLoadEvent(func) {
		  var oldonload = window.onload;
		  if (typeof window.onload != 'function') {
		    window.onload = func;
		  } else {
		    window.onload = function() {
		      oldonload();
		      func();
		    }
		  }
	}
	function prepareInputsForHints() {
		  var inputs = document.getElementsByTagName("input");
		  for (var i=0; i<inputs.length; i++){
		    if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
		      inputs[i].onmouseover = function () {
		        this.parentNode.getElementsByTagName("span")[0].style.display = "block";
		      }
		      inputs[i].onmouseout = function () {
		        this.parentNode.getElementsByTagName("span")[0].style.display = "none";
		      }
		    }
		  }
		  var selects = document.getElementsByTagName("select");
		  for (var k=0; k<selects.length; k++){
		    if (selects[k].parentNode.getElementsByTagName("span")[0]) {
		      selects[k].onmouseover = function () {
		        this.parentNode.getElementsByTagName("span")[0].style.display = "block";
		      }
		      selects[k].onmouseout = function () {
		        this.parentNode.getElementsByTagName("span")[0].style.display = "none";
		      }
		    }
		  }
		}
		addLoadEvent(prepareInputsForHints);
</script>
<style type="text/css">
dl {
  position: relative;
  width: 350px;
}
dt {
  clear: both;
  float:left;
  width: 130px;
  padding: 4px 0 2px 0;
  text-align: left;
}
dd {
  float: left;
  width: 200px;
  margin: 0 0 8px 0;
  padding-left: 6px;
}
.hint {
  display:none;
  position: absolute;
  right: -250px;
  width: 200px;
  border: 1px solid #c93;
  padding: 10px 12px;
  background: #ffc;
}

.form, .embedcode {
	display: block;
	clear: both;
}

code {
	background-color: #ddd;
	display: block;
	border: 1px solid #afafaf;
}


body { padding:50px 100px; font:12px Verdana, Geneva, sans-serif;
 }

input, textarea {
 padding: 8px;
 width: 200px;
}

input[type~="text"] {
 border: solid 1px #E5E5E5;
font: normal 12px Verdana, Tahoma, sans-serif;
box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;/* Default property recognized by some browsers- a Good practice to include it*/
-moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;/*For Mozilla Firefox Browsers*/
-webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;/*For Webkite browsers - Chrome and Safari*/
	background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #EEEEEE), to(#FFFFFF));/*Chrome and Safari*/
 background: -moz-linear-gradient(top, #FFFFFF, #EEEEEE 1px, #FFFFFF 25px);/* Firefox Browsers */
background: #FFFFFF url('form_background.png') left top repeat-x;
	-moz-border-radius:12px 12px 12px 12px;
-webkit-border-radius: 12px 12px 12px 12px;
}

textarea {
 width: 400px;
 max-width: 400px;
 height: 150px;
 line-height: 150%;	
 }

.form label {
 color: #999999;
 }

.submit input { 
	background: #F6F6F6 -webkit-gradient(linear, 0% 0%, 0% 100%, from(white), to(#EFEFEF));
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(white), to(#EFEFEF));
	border: 1px solid #CCC;
	border-bottom-left-radius: 12px 12px;
	border-bottom-right-radius: 12px 12px;
	border-top-left-radius: 12px 12px;
	border-top-right-radius: 12px 12px;
	color: black;
	cursor: pointer;
	height: 2.0833em;
	overflow: visible;
	padding: 0px 0.5em;
	vertical-align: middle;
	white-space: nowrap;
}

</style>
</head>
<body>
<div id="wrapper">
<h1>YouTube video embedder</h1>
<?php
	require_once 'inc/YoutubeFun.php';
	$debug = true;
	$yt = new YoutubeFun;
	$fullscreen = "false";
	$related = "false";
	$scripts = "true";
	$loop = "false";
	$autoplay = "false";
	$width = "";
	$height = "";
	$border = "false";
	$color1 = "0x3a3a3a";
	$color2 = "0x999999";
	$iframe = "false";
	$showembed = FALSE;
	
	if ($_POST["refresh"] != NULL) {
		if ($_POST["tubevid"] != NULL) {
			$yt->setURL($_POST["tubevid"]);
			$showembed = TRUE;
		}
		
		if ($_POST["fullscreen"] != NULL) {$fullscreen = "true";}
		if ($_POST["related"] != NULL) {$related = "true";}
		if ($_POST["scripts"] != NULL) {$scripts = "false";}
		if ($_POST["loop"] != NULL) {$loop = "true";}
		if ($_POST["autoplay"] != NULL) {$autoplay = "true";}
		if ($_POST["border"] != NULL) {$border = "true";}
		if ($_POST["color1"] != NULL) {$color1 = preg_replace("/\#/", "0x", $_POST["color1"]);}
		if ($_POST["color2"] != NULL) {$color2 = preg_replace("/\#/", "0x", $_POST["color2"]);}
		if ($_POST["iframe"] != NULL) {$iframe = "true";}
		
		if ($_POST["resolution"] != NULL) {
			switch ($_POST["resolution"]) {
    			case 1:
    				if ($iframe == "false") {
    					$width = "1280";
        				$height = "745";	
    				} else {
    					$width = "960";
        				$height = "745";
    				}
        			break;
    			case 2:
    				if ($iframe == "false") {
        				$width = "853";
        				$height = "505";
    				} else {
    					$width = "640";
        				$height = "505";
    				}
        			break;
    			case 3:
    				if ($iframe == "false") {
        				$width = "640";
        				$height = "385";
    				} else {
    					$width = "480";
        				$height = "385";
    				}
       				break;
       			case 4:
       				if ($iframe == "false") {
        				$width = "560";
        				$height = "340";
       				} else {
       					$width = "425";
        				$height = "344";
       				}
       				break;
       			default:
			    	if ($iframe == "false") {
        				$width = "640";
        				$height = "385";
    				} else {
    					$width = "480";
        				$height = "385";
    				}
			}
		}
		
		$embedcode = $yt->getEmbedCode($yt->getVideoID(NULL), $height, $width, $fullscreen, $scripts, $related, $loop, $autoplay, $border, $color1, $color2, $iframe);
		echo $embedcode;
	}
?>
<div class="form">
<form method="post" action="">
<dl>
	<dt>
		<label for="tubevid">Youtube URL</label>
	</dt>
	<dd>
		<input type="text" name="tubevid" id="tubevid" value="<?php echo $_POST["tubevid"] ?>"/>
		<span class="hint">Enter the full URL to the YouTube video<span class="hint-pointer">&nbsp;</span></span>
	</dd>
	<dt>
  		<label for="resolution">Resolution</label>
	</dt>
	<dd>
  		<select name="resolution" id="resolution">
    		<option value="0">Normal   | Iframe</option>
  			<option value="1">1280x745 | 960x745</option>
  			<option value="2">853x505  | 640x505</option>
  			<option value="3">640x385  | 480x385</option>
  			<option value="4">560x340  | 425x344</option>
  		</select>
  		<span class="hint res">Pick your wanted resolution, left resolutions are for Normal video embedding, right resolutions are for YouTube Beta Iframe embedding.<span class="hint-pointer">&nbsp;</span></span>
	</dd>
	<dt>
		<label for="fullscreen">Allow fullscreen</label>
	</dt>
	<dd>
		<input type="checkbox" name="fullscreen" value="true" id="fullscreen" checked="checked"/>
		<span class="hint">Choose whether to allow fullscreen or not.</span>
	</dd>
	<dt>
		<label for="related">Show related videos</label>
	</dt>
	<dd>
		<input type="checkbox" name="related" value="true" id="related" checked="checked" />
		<span class="hint">Choose whether to show related videos when yours end.</span>
	</dd>
	<dt>
		<label for="scripts">Disallow script access</label>
	</dt>
	<dd>
		<input type="checkbox" name="scripts" value="false" id="scripts" />
		<span class="hint">Choose whether to disallow script access.</span>
	</dd>
	<dt>
		<label for="loop">Loop</label>
	</dt>
	<dd>
		<input type="checkbox" name="loop" value="true" id="loop" />
		<span class="hint">Choose whether to loop the video or not</span>
  	</dd>
  	<dt>
  		<label for="autoplay">Autoplay</label>	
  	</dt>
  	<dd>
  		<input type="checkbox" name="autoplay" value="true" id="autoplay" />
  		<span class="hint">Choose this if you want the video to autostart</span>
  	</dd>
  	<dt>
  		<label for="color1">Color1</label>	
  	</dt>
  	<dd>
  		<input type="text" name="color1" id="color1" onclick="pickcolor(this)"/>
  		<span class="hint">Click this field to open color picker.</span>	
  	</dd>
	<dt>
		<label for="color2">Color2</label>	
	</dt>
	<dd>
		<input type="text" name="color2" id="color2" onclick="pickcolor(this)"/>
		<span class="hint">Click this field to open color picker.</span>
	</dd>
  	<dt>
  		<label for="border">Border</label>
  	</dt>
  	<dd>
  		<input type="checkbox" name="border" value="true" id="border" />
  		<span class="hint">Choose whether you want a border or not.</span>
  	</dd>
	<dt>
		<label for="border">Load in Iframe</label>
	</dt>
	<dd>
		<input type="checkbox" name="iframe" value="true" id="iframe" />
		<span class="hint">Embeds video in Iframe, this is YouTube beta and does not support colors or borders.</span>
	</dd>
	<dt class="submit">
		<input type='submit' value='Embed' name='refresh' />
	</dt>
</dl>
</form>
</div>
<div class="embedcode">
<pre>Embed code:<br/><code><?php if($showembed) { ?><?php echo htmlspecialchars($embedcode, ENT_QUOTES); ?><?php } ?></code></pre>
</div></div>
</body>
</html>