(function(){
// Get the current url path for "self"
var getQunitPath = function(){
	var scripts = document.getElementsByTagName('script');
	for(var i=0;i< scripts.length; i++){
		var src = scripts[i].getAttribute('src');
		if( src && src.indexOf('qunit-bootstrap.js') !== -1 ){
			return src.replace('qunit-bootstrap.js', '');
		}
	}
};
var getModuleName = function(){
	var url = document.URL;
	m = url.match(/.modules\/([^\/]*)/);
	return ( m[1] ) ? m[1] + '::' : '';
};
//Always include jQuery ( unless already included )
if( !window.jQuery ){
	document.write( '<script type="text/javascript" src="' + getQunitPath()+ '../../jquery-1.7.1.min.js' + '"></script>');
}
var qunitWaitCount =0;
var qunitWaitForJQuery = function( callback ){
	if( window.jQuery ){
		callback();
		return ;
	}
	if( qunitWaitCount < 1000 ){
		qunitWaitCount++;
		setTimeout(function(){
			qunitWaitForJQuery( callback );
		},10)
	}
};
// Check for the url for runQunitTests argument
if( document.URL.indexOf('runQunitTests') != -1 ){
	document.write('' +
			'<link rel="stylesheet" href="' + getQunitPath() + 'qunit.css" type="text/css" media="screen" />' +
			'<script type="text/javascript" src="' + getQunitPath() + 'qunit.js"></script>' + 
			'<script type="text/javascript" src="' + getQunitPath() + 'inject.js"></script>'
	);
	window.qunitSetup = function(){
		// get the module name we are testing
		var orgModule = window.module;
		window.module = function( name, testEnvironment ){
			orgModule( getModuleName() + name, testEnvironment);
		};
		jQuery('#runQunitLink').remove();
		jQuery('body').prepend( '<h1 id="qunit-header">QUnit Test Runner</h1>' +
				'<h2 id="qunit-banner"></h2>'+
				'<div id="qunit-testrunner-toolbar"></div>' +
				'<h2 id="qunit-userAgent"></h2>' +
				'<ol id="qunit-tests"></ol>' +
				'<div id="qunit-fixture">test markup, will be hidden</div>' );
		QUnit.config.autostart = false;
	};
	// run qunit set: 
	qunitWaitForJQuery( function(){
		jQuery( document ).ready( window.qunitSetup );
	});
} else {
	window.addRunTestLink = function(){
		var url = document.URL;
		url += ( url.indexOf('?') === -1 )? '?' : '&';
		url += 'runQunitTests=1';
		jQuery('body').append( 
			jQuery('<a />')
			.attr({
				'id':'runQunitLink',
				'href' : url
			})
			.text( 'run qunit tests')
			.css({ 
				'position': 'absolute', 
				'display': 'block',
				'top': '0px',  
				'right': '0px', 
				'background':'#eee',
				'padding': '5px'
			})
		);
	};
	// if not running unit tests provide a link:
	qunitWaitForJQuery( function(){
		jQuery(document).ready( window.addRunTestLink );
	});
	
}

})();
