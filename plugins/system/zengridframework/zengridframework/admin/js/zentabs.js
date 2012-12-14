/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

window.addEvent('domready', function() {

	$('style-form').addClass('jbTemplate');

	//remove the tabs panel from the accordion
	$('style-form').getElement('div.pane-sliders').getFirst('div.panel').addClass('tabspane').removeClass('panel');

	//add template style fieldsets to first panel
	if ($('tplStyleForm')){
		$('style-form').getFirst('div.width-60').getElement('fieldset.adminform > label, fieldset.adminform li#jform_title-lbl').destroy();
		($('style-form').getFirst('div.width-60').getElement('fieldset.adminform').getElement('span.mod-desc')).destroy();
		($('style-form').getFirst('div.width-60').getElement('fieldset.adminform')).replaces($('tplStyleForm'));
		}
	//add admin fieldsets to first panel
	if ($('menuSelect'))
		($('style-form').getLast('div.width-60').getElement('fieldset.adminform')).replaces($('menuSelect'));

	//create accordion for manipulation
	var myAccordion = new Fx.Accordion($$('div.pane-sliders > .panel > h3.title'), $$('div.pane-sliders > .panel > div.pane-slider'), {
		onActive: function(t,e) {
			t.addClass('pane-toggler-down');
			t.removeClass('pane-toggler');
			e.addClass('pane-down');
			e.removeClass('pane-hide');
			Cookie.write('jpanesliders',$$('div.pane-sliders > .panel > h3').indexOf(t));
		},
		onBackground: function(t,e) {
			t.addClass('pane-toggler');
			t.removeClass('pane-toggler-down');
			e.addClass('pane-hide');
			e.removeClass('pane-down');
			if ($$('div.pane-sliders > .panel > h3').length == $$('div.pane-sliders > .panel > h3').length)
				Cookie.write('jpanesliders',-1);
		},

		duration:400,
		opacity: false,
		alwaysHide: false
	});

	var menuAccordion = new Fx.Accordion($$('ul.tabs > li > a.parent'), $$('ul.tabs > li > ul'), {

		duration: 0,
		opacity: false,
		alwaysHide:false
	});

	//onClick function for tabs
	$$('#jbtabs a').addEvent('click', function() {
		var tab = this.getProperty('href');

		var selected = (tab.substr(1))+'-options';
		var handle = $(selected).getParent('div.panel').getElement('h3.title');
		var pane = $(selected).getParent('div.panel').getElement('div.pane-slider');
		//remove active class from all tabs
		$$('#jbtabs a').each(function(e) {
			e.removeClass('active');
		});
		//add active class to selected parent and child tab
		this.addClass('active');
		if (this.hasClass('child')){
			this.getParent('ul').getParent('li').getElement('a').addClass('active');
		}
		else
		{
			// Mark the first tab as selected, after click a parent tab
			$('jbtabs').getChildren('ul>li').getFirst('ul>li>a').addClass('active');
		}


		//bof work around for the joomla accordion not having an id bug
		$$('div.pane-sliders > .panel > h3.title').each(function(e) {
			e.removeClass('pane-toggler-down').addClass('pane-toggler');
		});
		$$('div.pane-sliders > .panel > div.pane-slider').each(function(e) {
			e.removeClass('pane-down').addClass('pane-hide');
		});
		handle.removeClass('pane-toggler').addClass('pane-toggler-down');
		pane.removeClass('pane-hide').addClass('pane-down');
		//eof work around for the joomla accordion not having an id bug
		//we toggle the panel
		myAccordion.display(pane);

		return false;
	});


	// Mark the first tab as selected
	$('jbtabs').getChildren('ul>li').getFirst('ul>li>a').addClass('active');

	$$('div.maincontentnav').getFirst('ul>li>a').addClass('active');
	//onClick function for maincontentnav tabs and other page tabs
	$$('div.maincontentnav a', 'a#accordionLink').addEvent('click', function() {
		var tab = this.getProperty('href');
		var url = 'http://www.joomlabamboo.com/images/stories/zengrid2/ZenGridFrameworkModulePositions.png';
		//if tab is modal or inactive we do nothing
		if ((tab == url)||(tab == '#')) {
			return;
		}
		var selected = (tab.substr(1))+'-options';
		var handle = $(selected).getParent('div.panel').getElement('h3.title');
		var pane = $(selected).getParent('div.panel').getElement('div.pane-slider');
		//bof work around for the joomla accordion not having an id bug
		$$('div.maincontentnav>ul>li>a').each(function(e) {
			e.removeClass('active');
			if (e.getProperty('href') == tab){
				e.addClass('active');
			}
		});
		$$('div.pane-sliders > .panel > h3.title').each(function(e) {
			e.removeClass('pane-toggler-down').addClass('pane-toggler');
		});
		$$('div.pane-sliders > .panel > div.pane-slider').each(function(e) {
			e.removeClass('pane-down').addClass('pane-hide');
		});
		handle.removeClass('pane-toggler').addClass('pane-toggler-down');
		pane.removeClass('pane-hide').addClass('pane-down');
		//eof work around for the joomla accordion not having an id bug
		//we toggle the panel
		myAccordion.display(pane);
		return false;
	});


	// Check for logo settings and create toggle behavior
	var logoTypeField = jQuery('#jform_params_logoType');
	if (logoTypeField)
	{
		logoTypeField.change(logoOptionsToggle);
		logoOptionsToggle();
	}

	function logoOptionsToggle()
	{
		var logoTextOptions  = jQuery('#logo-options + div fieldset ul li .logo_as_text_fields').parent();
			logoImageOptions = jQuery('#logo-options + div fieldset ul li .logo_as_image_fields').parent();
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

	// Check for module width settings and create toggle behavior
	var templatePositions = {
		'top'    : ['top1', 'top2', 'top3', 'top4'],
		'header' : ['header1', 'header2', 'header3', 'header4'],
		'grid1'  : ['grid1', 'grid2', 'grid3', 'grid4'],
		'grid2'  : ['grid5', 'grid6', 'grid7', 'grid8'],
		'grid3'  : ['grid9', 'grid10', 'grid11', 'grid12'],
		'grid4'  : ['grid13', 'grid14', 'grid15', 'grid16'],
		'grid5'  : ['grid17', 'grid18', 'grid19', 'grid20'],
		'grid6'  : ['grid21', 'grid22', 'grid23', 'grid24'],
		'bottom' : ['bottom1', 'bottom2', 'bottom3', 'bottom4', 'bottom5', 'bottom6']
	};

	jQuery.each(templatePositions, function(positionGroup, positions) {
		var opt = jQuery('#jform_params_' + positionGroup + 'Equal');
		if (opt)
		{
			opt.change(widthOptionsToggle);
			widthOptionsToggle(positionGroup);
		}
	});

	function widthOptionsToggle(positionGroup)
	{
		if (typeOf(positionGroup) != 'string')
		{
			positionGroup = positionGroup.target.id.replace('jform_params_', '').replace('Equal', '');
		}

		var equal = jQuery('#jform_params_' + positionGroup + 'Equal').val() == 1;

		jQuery.each(templatePositions[positionGroup], function(index, position) {
			var el = jQuery('#jform_params_' + position + 'Width').parent();

			if (equal)
			{
				el.fadeOut();
			}
			else
			{
				el.fadeIn();
			}
		});
	}
});

/*
 * Build URL
 *
 * @author Anderson Grudtner Martins
 */
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
