/*custom.js
Adding custom javascript or jquery function
* Copyright (c) 2010, ECC UGM. All rights reserved.
* version: 0.0.9
*/

//check whether submit button save is click, prevent double post save
var isEnableSave = 0;

//button save click
function setEnableSave() {
	isEnableSave = 1;
}

/**
 * dialog function
 */

//show loading
function loadingShow() {
	if($('div[name="dialog-wrapper"]').html() == '') {
		$('div.loading').addClass('load').fadeIn();
	} else {
		$('div.loading').fadeIn();
	}
}

//hide loading
function loadingHidden() {
	$('div.loading').hide().removeClass('load');
}

//show dialog
function dialogShow(content, width) {
	$('div#ajax-message').html('');
	$('div.dialog').show();
	$('div.dialog div.content').attr('id', width);
	$('div.dialog div.content').html(content);
	fixedPosition();
}

//hide dialog
function dialogClosed() {
	$('body').attr('style', '');
	$('div.dialog').fadeOut().attr('id','');
	$('div.dialog .dialog-box').attr('style', '');
	$('div.dialog .dialog-box .content').html('').attr('id', '');
}

//dialog close action
function dialogActionClosed() {
	$("div.dialog .dialog-box .content").mouseup(function() {
		return false
	});
	//clode dialog
	$(document).mouseup(function(e) {
		if($(e.target).parent("div.dialog .dialog-box .content").length==0) {
			dialogClosed();
		}
	});

	$('.dialog .dialog-box input[type="button"]#closed').live('click',function(){
		dialogClosed();
	});
}

//dialog fixed position
function fixedPosition() { 
	var dialogHeight = $('.dialog .dialog-box').height();
	$('.dialog .dialog-box').css({
		//'position' : 'absolute',
		'top' : - dialogHeight / 2,
	});

	dialogActionClosed();
}

/**
 * form function
 */

//count total json (obj)
function countProperties(obj) {
	var prop;
	var propCount = 0;

	for (prop in obj) {
		propCount++;
	}
	return propCount;
}

//find existed string
function strpos (haystack, needle) {
	var i = (haystack+'').indexOf(needle, 0);
	return i === -1 ? false : i;
}

//clear input
function clearInput(form) {
	$(form).find(':input').each(function() {
		switch(this.type) {
			case 'password':
			case 'select-multiple':
			case 'select-one':
			case 'text':
			case 'textarea':
				$(this).val('');
				break;
			case 'checkbox':
			case 'radio':
				this.checked = false;
		}
	});
}

/**
 * main carousel
 */
function MainHeadline() {
	$(".article .carousel").jCarouselLite({
		visible: 1,
		start: 0,
		btnGo:
		[".article .button .1", ".article .button .2", ".article .button .3", ".article .button .4"]
	});
}
MainHeadline();

$(document).ready(function() {

	/* $.ajax({
		type: 'get',
		url: lastUrl,
		//dataType: 'json',
		success: function(render) {
			//alert(render);
			alert($('div#sidebar', render).html());
			//$('header div.usermenu').html($('div.usermenu', render).html());
		}
	}); */

	if($('div.dialog').attr('id') != 'apps') {
		fixedPosition();
	} else {
		//dialogActionClosed();
	}

	/**
	 * For general ajax submit
	 * redirect
	 *
	 * type
	 *	0 [show message]
	 *	1 [update grid-view]
	 *	2 [replace dialog]
	 *	3 [hide media-render]
	 *	4 [hide parent div]
	 *	5 [replace content or show dialog]
	 *	6 [replace header]
	 *
	 * msg [0,1,] => message
	 * value [0] => 0,1
	 * get [0,2,3,5,6] => url
	 *
	 */ 

	// Dialog and General Function Form
	$('div[name="post-on"] form, .dialog .dialog-box form').live('submit', function(event) {
		$(this).find('input[type="submit"]').addClass('active');
		var attrSave = '?&enablesave=' + isEnableSave;
		//var attrSave = '/enablesave/' + isEnableSave;
		var method  = $(this).attr('method');
		var url     = $(this).attr('action') + attrSave;
		var link     = $(this).attr('action');

		//Show Loading
		loadingShow();

		if(method != 'get') {
			var options = {
				type: 'GET',
				dataType: 'json',
				//data: { enablesave: isEnableSave },
				success: function(response) {
					//Hide Loading
					loadingHidden();

					var hasError = 0;
					if(countProperties(response) > 0) {
						for(i in response) {
							if(strpos(i,'_'))
								hasError = 1;
						}
						if(hasError == 1) {
							$('form[action="'+link+'"]').find('input[type="submit"]').removeClass('active');

							$('form[action="'+link+'"]').find('div.errorMessage').hide().html('');
							$('form[action="'+link+'"]').find('textarea').removeClass('error');
							$('form[action="'+link+'"]').find('input').removeClass('error');
							for(i in response) {
								$('form[action="'+link+'"]').find('div#ajax-message').html(response.msg);
								$('form[action="'+link+'"] #' + i ).addClass('error');					
								$('form[action="'+link+'"] #' + i + '_em_').show().html(response[i][0]);
							}
							fixedPosition();

						} else {
							$('form[action="'+link+'"]').find('input[type="submit"]').removeClass('active');

							$('form[action="'+link+'"]').find('div.errorMessage').hide().html('');
							$('form[action="'+link+'"]').find('textarea').removeClass('error');
							$('form[action="'+link+'"]').find('input').removeClass('error');

							if(response.type != 2) {
								dialogClosed();
							}
							if(response.redirect != null) {
								dialogClosed();
								location.href = response.redirect;
							} else {
								if(response.type == 0) {
									if(response.value == 1) {
										//js condition
									}
									$('div.form form div#ajax-message').html('');
									$('form[action="'+link+'"]').find('div#ajax-message').html(response.msg);
									$.scrollTo("div.body", {duration: 800, axis:"y"});

								} else if(response.type == 1) {
									var grid = $('#'+response.id).find('.grid-view').attr('id');
									$.fn.yiiGridView.update(grid);
									$('#'+response.id+' div#ajax-message').html(response.msg);
									clearInput('form[action="'+link+'"]');

								} else if(response.type == 2) {
									$.ajax({
										type: 'get',
										url: response.get,
										//dataType: 'json',
										success: function(render) {
											$('.dialog .dialog-box .content').html($('div[name="dialog-wrapper"]', render).html());
											fixedPosition();
										}
									});

								} else if(response.type == 3) {
									var limit = $('*[href="'+ link +'"]').parents('#media-render').attr('name');

									$('*[href="'+ link +'"]').parent('li').hide();
									if(response.count < limit) {
										$('*[href="'+ link +'"]').parents('#media-render').find('#upload').show();
									}
								} else if(response.type == 4) {
									$('*[href="'+ link +'"]').parent('div').hide();

								} else if(response.type == 5) {
									$.ajax({
										type: 'get',
										url: lastUrl,
										//dataType: 'json',
										success: function(render) {
											handler(render);
										}
									});

								} else if(response.type == 6) {
									//js condition
								}
							}
							//$.scrollTo("body", {duration: 800, axis:"y"});
						}
					}
				}
			}
			
			if(method == 'post') {
				options.data = $(this).serialize();
				options.type = 'POST';
			}
			$.ajax(url, options);
			event.preventDefault();
		}
	});

});

/**
 * load content ground
 */
var dialogTitle = '';
if(dialogGroundUrl != '') {
	$.ajax({
		type: 'get',
		url: dialogGroundUrl,
		//dataType: 'json',
		success: function(render) {
			$('div.body div.wrapper').html($('div.wrapper', render).html());
		}
	});
}

/**
 * jquery address function
 */
var init = true;
var state = window.history.pushState !== undefined;

// Handles response
var handler = function(data) {
	$('title').html($('title', data).html());
	if($('div[name="dialog-wrapper"]', data).html() != '') {
		if($('div.fixed', data).attr('name') == 'apps') {
			$('body').attr('style', 'overflow-y: hidden');			
		}
		$('div.dialog').attr('id', $('div.fixed', data).attr('name'));
		dialogShow($('div[name="dialog-wrapper"]', data).html(), $('div[name="dialog-wrapper"]', data).attr('id'));
	} else {
		if($('div.wrapper', data).html() != '') {
			$('body').attr('style', '');
			$('div.dialog').fadeOut().attr('id','');
			$('div.body div.wrapper').html($('div.wrapper', data).html());
		}	
	}
	$.address.title(/>([^<]*)<\/title/.exec(data)[1]);
};

$.address.state(baseUrl).init(function() {

	// Initializes the plugin
	$('a').address();
	
}).change(function(event) {

	// Selects the proper navigation link
	$('a').each(function() {
		if ($(this).attr('href') == ($.address.state() + event.path)) {
			$(this).addClass('active').focus();
		} else {
			$(this).removeClass('active');
		}
	});
	
	if (state && init) {
	
		init = false;
	
	} else {
		//Show Loading
		loadingShow();

		// Loads the page content and inserts it into the content area
		$.ajax({
			url: $.address.state() + event.path,
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				handler(XMLHttpRequest.responseText);
			},
			success: function(data, textStatus, XMLHttpRequest) {
				//Hide Loading
				loadingHidden();
				handler(data);
			}
		});
	}

});