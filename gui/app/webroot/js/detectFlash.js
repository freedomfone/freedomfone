var MM_contentVersion = 10;
var plugin = (navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"]) ? navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin : 0;
if ( plugin ) {
    var words = navigator.plugins["Shockwave Flash"].description.split(" ");
    for (var i = 0; i < words.length; ++i)
	{
	    if (isNaN(parseInt(words[i])))
		continue;
	    var MM_PluginVersion = words[i];
	}


    var MM_FlashCanPlay = MM_PluginVersion >= MM_contentVersion;

}
else if (navigator.userAgent && navigator.userAgent.indexOf("MSIE")>=0
	 && (navigator.appVersion.indexOf("Win") != -1)) {
    document.write('<SCR' + 'IPT LANGUAGE=VBScript\> \n'); //FS hide this from IE4.5 Mac by splitting the tag
    document.write('on error resume next \n');
    document.write('MM_FlashCanPlay = ( IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash." & MM_contentVersion)))\n');
    document.write('</SCR' + 'IPT\> \n');
}

if (MM_PluginVersion) {
  if ( !MM_FlashCanPlay) {
    document.write("Update Flash Plugin to v10");
  } 

} else{
    document.write("Flash Plugin not Installed");
}