var Colors=new function(){this.ColorFromHSV=function(_1,_2,_3){var _4=new Color();_4.SetHSV(_1,_2,_3);return _4;};this.ColorFromRGB=function(r,g,b){var _8=new Color();_8.SetRGB(r,g,b);return _8;};this.ColorFromHex=function(_9){var _a=new Color();_a.SetHexString(_9);return _a;};function Color(){var _b=0;var _c=0;var _d=0;var _e=0;var _f=0;var _10=0;this.SetRGB=function(r,g,b){if(isNaN(r)||isNaN(g)||isNaN(b)){return false;}r=r/255;_b=r>1?1:r<0?0:r;g=g/255;_c=g>1?1:g<0?0:g;b=b/255;_d=b>1?1:b<0?0:b;calculateHSV();return true;};this.Red=function(){return Math.round(_b*255);};this.Green=function(){return Math.round(_c*255);};this.Blue=function(){return Math.round(_d*255);};this.SetHSV=function(h,s,v){if(isNaN(h)||isNaN(s)||isNaN(v)){return false;}_e=(h>=360)?359.99:(h<0)?0:h;_f=(s>1)?1:(s<0)?0:s;_10=(v>1)?1:(v<0)?0:v;calculateRGB();return true;};this.Hue=function(){return _e;};this.Saturation=function(){return _f;};this.Value=function(){return _10;};this.SetHexString=function(_17){if(_17==null||typeof (_17)!="string"){return false;}if(_17.substr(0,1)=="#"){_17=_17.substr(1);}if(_17.length!=6){return false;}var r=parseInt(_17.substr(0,2),16);var g=parseInt(_17.substr(2,2),16);var b=parseInt(_17.substr(4,2),16);return this.SetRGB(r,g,b);};this.HexString=function(){var _1b=this.Red().toString(16);if(_1b.length==1){_1b="0"+_1b;}var _1c=this.Green().toString(16);if(_1c.length==1){_1c="0"+_1c;}var _1d=this.Blue().toString(16);if(_1d.length==1){_1d="0"+_1d;}return ("#"+_1b+_1c+_1d).toUpperCase();};this.Complement=function(){var _1e=(_e>=180)?_e-180:_e+180;var _1f=(_10*(_f-1)+1);var _20=(_10*_f)/_1f;var _21=new Color();_21.SetHSV(_1e,_20,_1f);return _21;};function calculateHSV(){var max=Math.max(Math.max(_b,_c),_d);var min=Math.min(Math.min(_b,_c),_d);_10=max;_f=0;if(max!=0){_f=1-min/max;}_e=0;if(min==max){return;}var _24=(max-min);if(_b==max){_e=(_c-_d)/_24;}else{if(_c==max){_e=2+((_d-_b)/_24);}else{_e=4+((_b-_c)/_24);}}_e=_e*60;if(_e<0){_e+=360;}}function calculateRGB(){_b=_10;_c=_10;_d=_10;if(_10==0||_f==0){return;}var _25=(_e/60);var i=Math.floor(_25);var f=_25-i;var p=_10*(1-_f);var q=_10*(1-_f*f);var t=_10*(1-_f*(1-f));switch(i){case 0:_b=_10;_c=t;_d=p;break;case 1:_b=q;_c=_10;_d=p;break;case 2:_b=p;_c=_10;_d=t;break;case 3:_b=p;_c=q;_d=_10;break;case 4:_b=t;_c=p;_d=_10;break;default:_b=_10;_c=p;_d=q;break;}}}}();function Position(x,y){this.X=x;this.Y=y;this.Add=function(val){var _2e=new Position(this.X,this.Y);if(val!=null){if(!isNaN(val.X)){_2e.X+=val.X;}if(!isNaN(val.Y)){_2e.Y+=val.Y;}}return _2e;};this.Subtract=function(val){var _30=new Position(this.X,this.Y);if(val!=null){if(!isNaN(val.X)){_30.X-=val.X;}if(!isNaN(val.Y)){_30.Y-=val.Y;}}return _30;};this.Min=function(val){var _32=new Position(this.X,this.Y);if(val==null){return _32;}if(!isNaN(val.X)&&this.X>val.X){_32.X=val.X;}if(!isNaN(val.Y)&&this.Y>val.Y){_32.Y=val.Y;}return _32;};this.Max=function(val){var _34=new Position(this.X,this.Y);if(val==null){return _34;}if(!isNaN(val.X)&&this.X<val.X){_34.X=val.X;}if(!isNaN(val.Y)&&this.Y<val.Y){_34.Y=val.Y;}return _34;};this.Bound=function(_35,_36){var _37=this.Max(_35);return _37.Min(_36);};this.Check=function(){var _38=new Position(this.X,this.Y);if(isNaN(_38.X)){_38.X=0;}if(isNaN(_38.Y)){_38.Y=0;}return _38;};this.Apply=function(_39){if(typeof (_39)=="string"){_39=document.getElementById(_39);}if(_39==null){return;}if(!isNaN(this.X)){_39.style.left=this.X+"px";}if(!isNaN(this.Y)){_39.style.top=this.Y+"px";}};}var pointerOffset=new Position(0,navigator.userAgent.indexOf("Firefox")>=0?1:0);var circleOffset=new Position(5,5);var arrowsOffset=new Position(0,4);var arrowsLowBounds=new Position(0,-4);var arrowsUpBounds=new Position(0,251);var circleLowBounds=new Position(-5,-5);var circleUpBounds=new Position(250,250);function correctOffset(pos,_3b,neg){if(neg){return pos.Subtract(_3b);}return pos.Add(_3b);}function hookEvent(_3d,_3e,_3f){if(typeof (_3d)=="string"){_3d=document.getElementById(_3d);}if(_3d==null){return;}if(_3d.addEventListener){_3d.addEventListener(_3e,_3f,false);}else{if(_3d.attachEvent){_3d.attachEvent("on"+_3e,_3f);}}}function unhookEvent(_40,_41,_42){if(typeof (_40)=="string"){_40=document.getElementById(_40);}if(_40==null){return;}if(_40.removeEventListener){_40.removeEventListener(_41,_42,false);}else{if(_40.detachEvent){_40.detachEvent("on"+_41,_42);}}}function cancelEvent(e){e=e?e:window.event;if(e.stopPropagation){e.stopPropagation();}if(e.preventDefault){e.preventDefault();}e.cancelBubble=true;e.cancel=true;e.returnValue=false;return false;}function getMousePos(_44){_44=_44?_44:window.event;var pos;if(isNaN(_44.layerX)){pos=new Position(_44.offsetX,_44.offsetY);}else{pos=new Position(_44.layerX,_44.layerY);}return correctOffset(pos,pointerOffset,true);}function getEventTarget(e){e=e?e:window.event;return e.target?e.target:e.srcElement;}function absoluteCursorPostion(_47){_47=_47?_47:window.event;if(isNaN(window.scrollX)){return new Position(_47.clientX+document.documentElement.scrollLeft+document.body.scrollLeft,_47.clientY+document.documentElement.scrollTop+document.body.scrollTop);}else{return new Position(_47.clientX+window.scrollX,_47.clientY+window.scrollY);}}function dragObject(_48,_49,_4a,_4b,_4c,_4d,_4e,_4f){if(typeof (_48)=="string"){_48=document.getElementById(_48);}if(_48==null){return;}if(_4a!=null&&_4b!=null){var _50=_4a.Min(_4b);_4b=_4a.Max(_4b);_4a=_50;}var _51=null;var _52=null;var _53=false;var _54=false;var _55=false;function dragStart(_56){if(_53||!_54||_55){return;}_53=true;if(_4c!=null){_4c(_56,_48);}_51=absoluteCursorPostion(_56);_52=new Position(parseInt(_48.style.left),parseInt(_48.style.top));_52=_52.Check();hookEvent(document,"mousemove",dragGo);hookEvent(document,"mouseup",dragStopHook);return cancelEvent(_56);}function dragGo(_57){if(!_53||_55){return;}var _58=absoluteCursorPostion(_57);_58=_58.Add(_52).Subtract(_51);_58=_58.Bound(_4a,_4b);_58.Apply(_48);if(_4d!=null){_4d(_58,_48);}return cancelEvent(_57);}function dragStopHook(_59){dragStop();return cancelEvent(_59);}function dragStop(){if(!_53||_55){return;}unhookEvent(document,"mousemove",dragGo);unhookEvent(document,"mouseup",dragStopHook);_51=null;_52=null;if(_4e!=null){_4e(_48);}_53=false;}this.Dispose=function(){if(_55){return;}this.StopListening(true);_48=null;_49=null;_4a=null;_4b=null;_4c=null;_4d=null;_4e=null;_55=true;};this.StartListening=function(){if(_54||_55){return;}_54=true;hookEvent(_49,"mousedown",dragStart);};this.StopListening=function(_5a){if(!_54||_55){return;}unhookEvent(_49,"mousedown",dragStart);_54=false;if(_5a&&_53){dragStop();}};this.IsDragging=function(){return _53;};this.IsListening=function(){return _54;};this.IsDisposed=function(){return _55;};if(typeof (_49)=="string"){_49=document.getElementById(_49);}if(_49==null){_49=_48;}if(!_4f){this.StartListening();}}function arrowsDown(e,_5c){var pos=getMousePos(e);if(getEventTarget(e)==_5c){pos.Y+=parseInt(_5c.style.top);}pos=correctOffset(pos,arrowsOffset,true);pos=pos.Bound(arrowsLowBounds,arrowsUpBounds);pos.Apply(_5c);arrowsMoved(pos);}function circleDown(e,_5f){var pos=getMousePos(e);if(getEventTarget(e)==_5f){pos.X+=parseInt(_5f.style.left);pos.Y+=parseInt(_5f.style.top);}pos=correctOffset(pos,circleOffset,true);pos=pos.Bound(circleLowBounds,circleUpBounds);pos.Apply(_5f);circleMoved(pos);}function arrowsMoved(pos,_62){pos=correctOffset(pos,arrowsOffset,false);currentColor.SetHSV((256-pos.Y)*359.99/255,currentColor.Saturation(),currentColor.Value());colorChanged("arrows");}function circleMoved(pos,_64){pos=correctOffset(pos,circleOffset,false);currentColor.SetHSV(currentColor.Hue(),1-pos.Y/255,pos.X/255);colorChanged("circle");}function colorChanged(_65){var hr=document.location.href;var el=hr.substr(hr.indexOf("#")+1);window.opener.document.getElementById(el).value=currentColor.HexString();window.opener.document.getElementById(el).style.backgroundColor=currentColor.HexString();document.getElementById("hexBox").value=currentColor.HexString();document.getElementById("redBox").value=currentColor.Red();document.getElementById("greenBox").value=currentColor.Green();document.getElementById("blueBox").value=currentColor.Blue();document.getElementById("hueBox").value=Math.round(currentColor.Hue());var str=(currentColor.Saturation()*100).toString();if(str.length>4){str=str.substr(0,4);}document.getElementById("saturationBox").value=str;str=(currentColor.Value()*100).toString();if(str.length>4){str=str.substr(0,4);}document.getElementById("valueBox").value=str;if(_65=="arrows"||_65=="box"){document.getElementById("gradientBox").style.backgroundColor=Colors.ColorFromHSV(currentColor.Hue(),1,1).HexString();}if(_65=="box"){var el=document.getElementById("arrows");el.style.top=(256-currentColor.Hue()*255/359.99-arrowsOffset.Y)+"px";var pos=new Position(currentColor.Value()*255,(1-currentColor.Saturation())*255);pos=correctOffset(pos,circleOffset,true);pos.Apply("circle");endMovement();}document.getElementById("quickColor").style.backgroundColor=currentColor.HexString();}function endMovement(){document.getElementById("staticColor").style.backgroundColor=currentColor.HexString();}function hexBoxChanged(e){currentColor.SetHexString(document.getElementById("hexBox").value);colorChanged("box");}function redBoxChanged(e){currentColor.SetRGB(parseInt(document.getElementById("redBox").value),currentColor.Green(),currentColor.Blue());colorChanged("box");}function greenBoxChanged(e){currentColor.SetRGB(currentColor.Red(),parseInt(document.getElementById("greenBox").value),currentColor.Blue());colorChanged("box");}function blueBoxChanged(e){currentColor.SetRGB(currentColor.Red(),currentColor.Green(),parseInt(document.getElementById("blueBox").value));colorChanged("box");}function hueBoxChanged(e){currentColor.SetHSV(parseFloat(document.getElementById("hueBox").value),currentColor.Saturation(),currentColor.Value());colorChanged("box");}function saturationBoxChanged(e){currentColor.SetHSV(currentColor.Hue(),parseFloat(document.getElementById("saturationBox").value)/100,currentColor.Value());colorChanged("box");}function valueBoxChanged(e){currentColor.SetHSV(currentColor.Hue(),currentColor.Saturation(),parseFloat(document.getElementById("valueBox").value)/100);colorChanged("box");}function fixPNG(_72){if(!document.body.filters){return;}var _73=navigator.appVersion.split("MSIE");var _74=parseFloat(_73[1]);if(_74<5.5||_74>=7){return;}var _75=(_72.id)?"id='"+_72.id+"' ":"";var _76="display:inline-block;"+_72.style.cssText;var _77="<span "+_75+" style=\""+"width:"+_72.width+"px; height:"+_72.height+"px;"+_76+";"+"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"+"(src='"+_72.src+"', sizingMethod='scale');\"></span>";_72.outerHTML=_77;}function fixGradientImg(){fixPNG(document.getElementById("gradientImg"));}