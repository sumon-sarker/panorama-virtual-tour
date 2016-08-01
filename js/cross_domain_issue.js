/*CUSTOM CROSS DOMAIN FIX*/
function setCrossDomain(){
	if (typeof CROSS_DOMAIN_PATH!='undefined') {
		crossDomainTargetUrl = CROSS_DOMAIN_PATH;
	}
}
setCrossDomain();

/*ADD THIS CODE TO "KolorBootstrap.js"*/