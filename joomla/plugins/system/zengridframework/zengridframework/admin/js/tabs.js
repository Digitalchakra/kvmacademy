/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

/**
 * Tabs behavior
 *
 * @package		Joomla!
 * @subpackage	JavaScript
 * @since		1.5
 */
var JTabs = new Class({

	getOptions: function(){
		return {

			display: 0,

			onActive: function(title, description){
				description.setStyle('display', 'block');
				title.addClass('open').removeClass('closed');
			},

			onBackground: function(title, description){
				description.setStyle('display', 'none');
				title.addClass('closed').removeClass('open');
			}
		};
	},

	initialize: function(dlist, options){
		this.dlist = $(dlist);
		this.setOptions(this.getOptions(), options);
		this.titles = this.dlist.getElements('dt');
		this.descriptions = this.dlist.getElements('dd');
		this.content = new Element('div').injectAfter(this.dlist).addClass('current');

		for (var i = 0, l = this.titles.length; i < l; i++){
			var title = this.titles[i];
			var description = this.descriptions[i];
			title.setStyle('cursor', 'pointer');
			title.addEvent('click', this.display.bind(this, i));
			description.injectInside(this.content);
		}

		if ($chk(this.options.display)) this.display(this.options.display);

		if (this.options.initialize) this.options.initialize.call(this);
	},

	hideAllBut: function(but){
		for (var i = 0, l = this.titles.length; i < l; i++){
			if (i != but) this.fireEvent('onBackground', [this.titles[i], this.descriptions[i]])
		}
	},

	display: function(i){
		this.hideAllBut(i);
		this.fireEvent('onActive', [this.titles[i], this.descriptions[i]])
	}
});

JTabs.implement(new Events);
JTabs.implement(new Options);


jQuery(document).ready(function(){	

	// Check for logo settings and create toggle behavior
	var logoTypeField = jQuery('#paramslogoType');
	if (logoTypeField)
	{
		logoTypeField.change(logoOptionsToggle);
		logoOptionsToggle();
	}

	function logoOptionsToggle()
	{
		var logoTextOptions  = jQuery('#jbtemplate div table tbody tr td .logo_as_text_fields').parent().parent();
		    logoImageOptions = jQuery('#jbtemplate div table tbody tr td .logo_as_image_fields').parent().parent();
		    fadeIn           = [];
		    fadeOut          = [];

		var logoTypeFieldValue = logoTypeField.val();

		if (logoTypeFieldValue == 'image')
		{
			fadeIn  = logoImageOptions;
			fadeOut = logoTextOptions;
		}
		else if (logoTypeFieldValue == 'text')
		{
			fadeIn  = logoTextOptions;
			fadeOut = logoImageOptions;
		}

		jQuery.each(fadeOut, function(key, item) { jQuery(item).fadeOut(); });
		jQuery.each(fadeIn, function(key, item) { jQuery(item).fadeIn(); });
	}
});

tmpBtn = {};
tmpOldValue = {};

function zenClearCache(btn, cache, msgWaiting, msgDone, msgError, msgNoCache)
{
	if (cache == 'css' || cache == 'js')
	{
		var oldValue = jQuery(btn).val();
		jQuery(btn).val(msgWaiting);
		jQuery(btn).attr('disabled','disabled');
		
		var url = parseURL(window.location.href);
		url.params.push({'name': 'clearcache', 'value': cache});
		url = buildURL(url);
		
		jQuery.ajax({
			'url': url,
			'success': function(response)
			{
				response = jQuery.parseJSON(response);
				
				if (response.result == 1)
				{
					jQuery(btn).val(msgDone);
				}
				else if (response.result == -1)
				{
					jQuery(btn).val(msgNoCache);
				}
				else if (response.result == 0)
				{
					jQuery(btn).val(msgError);
				}
				
				tmpBtn[cache] = btn;
				tmpOldValue[cache] = oldValue;
				var t = setTimeout("jQuery(tmpBtn['"+cache+"']).val(tmpOldValue['"+cache+"']).removeAttr('disabled');", 2000);
			}
		});
	}
}

/*
 * Parse URL
 *
 * @author Anderson Grudtner Martins
 */
function parseURL(urlString)
{
	var url = urlString.split('?');
	var tmp = url[0].split('://');
	
	var urlObj = {
		'completeUrl' : urlString,
		'protocol'    : tmp[0],
		'url'         : url[0],
		'queryString' : url[1],
		'params'      : [],
		'hash'        : null
	};
	
	if (url.length > 1)
	{
		// Hash
		var queryString = url[1].split('#');
		if (queryString.length > 1)
		{
			urlObj.hash = queryString[1];
		}
		
		// GET
		queryString = queryString[0].split('&');
		for (i = 0; i < queryString.length; i++)
		{
			var param = queryString[i].split('=');
			urlObj.params[i] = {
				'name'  : param[0],
				'value' : param[1]
			}
		}
	}
	
	return urlObj;
}

/*
 * Build URL
 *
 * @author Anderson Grudtner Martins
 */
function buildURL(parsedURL)
{
	var url = parsedURL.url;
	
	if (parsedURL.params.length > 0)
	{
		url += '?';
		
		var param;
		for (var i = 0; i < parsedURL.params.length; i++)
		{
			if (i > 0) url += '&';
			
			param = parsedURL.params[i];
			url += param.name + '=' + param.value;
		}
	}
	
	if (parsedURL.hash != null)
	{
		url += '#' + parsedURL.hash;
	}
	
	return url;
}
