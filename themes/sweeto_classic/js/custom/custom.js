/*custom.js
Adding custom javascript or jquery function
* Copyright (c) 2010, ECC UGM. All rights reserved.
* version: 0.0.9
*/

function dialogAjax(url, width) {
	$('*[href="'+url+'"]').addClass('active');
	dialogShow(width);
	$.ajax({
		type: 'get',
		url: url,
		dataType: 'json',
		success: function(response) {
			$('*[href="'+url+'"]').removeClass('active');
			$('.dialog .dialog-box .content').html(response.data);
			loadingHidden();
		}
	});
}

function dialogUpdate() { 
	$('.dialog .dialog-box .content').html('<div class="loader"></div>');
	var width = $(this).attr('rel');
	var url = $(this).attr('href');
	dialogAjax(url, width);
	return false;
}

function dialogShow(width) {
	$('#ajax-message').html('');
	$('div.dialog').fadeIn();
	$('div.loading').show();
	$('.dialog').find('.content').attr('id', width+'px');
}

function loadingHidden() {
	$('div.loading').hide();
	$('.dialog').find('.content').removeClass('overflow');
	fixedPosition();
}

function dialogClosed() {
	$('div.dialog').hide();
	$('div.loading').hide();
	$('div.dialog .dialog-box .content').html('');
	$('div.dialog .dialog-box').attr('style', '');
	$('.dialog-box')
		.find('.content')
			.addClass('overflow')
			.stop()
		.attr('id', '');
}

function fixedPosition() { 
	var dialogHeight = $('.dialog .dialog-box').height();
	var dialogWidth = $('.dialog .dialog-box').width();
	$('.dialog .dialog-box').css({
		'position' : 'absolute',
		'top' : - dialogHeight / 2,
		'left' : - dialogWidth / 2
	});

	$('.dialog .dialog-box input[type="button"]#closed').live('click',function(){
		dialogClosed();
	});
}

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
function clearInput(formId) {
	$(formId).find(':input').each(function() {
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


$(document).ready(function() {
	// Search
	$('.search-button').click(function(){
		$(this).parent('li').toggleClass('active');
		$('.search-form').slideToggle();
		return false;
	});

	// Global Add and Update Dialog
	$('.contentmenu ul li a#ajax-on').live('click', function() {
		var width = $(this).attr('class');
		var url = $(this).attr('href');
		dialogAjax(url, width);
		return false;
	});
	
	// Global Add and Update Dialog
	$('.mainmenu ul li a#ajax-on').live('click', function() {
		var width = $(this).attr('class');
		var url = $(this).attr('href');
		dialogAjax(url, width);
		return false;
	});


	$('.link-dialog').live('click', function() {
		var id = $(this).attr('id');
		var width = $(this).attr('rel');
		var url = $(this).attr('href');
		if(url != 'javascript:void(0);') {
			dialogAjax(url, width);
		} else {
			var content = $('.open-dialog-'+id).html();
			dialogShow(width);
			$('.dialog .dialog-box .content').html(content);
			loadingHidden();
			fixedPosition();
		}
		return false;
	});

	/**
	 * For general ajax submit
	 * error = 0,1
	 * msg
	 * redirect
	 * type = 0[show message], 1[grid tr delete], 2[replace this], 3[get render partial]
	 *		4[replace dialog]
	 * replace[2]
	 * title[2] <= untuk merubah title
	 * name[2] <= untuk merubah class
	 * get[3,4]
	 */ 

	// Dialog and General Function Form
	$('div[name="post-on"] form, .dialog .dialog-box form').live('submit', function(event) {
		$(this).find('input[type="submit"]').addClass('active');
		var method  = $(this).attr('method');
		var url     = $(this).attr('action');
		var form	= $(this).attr('id');
		var id		= $(this).attr('name');
		var type	= $(this).parents('div[name="post-on"]').attr('id');

		if(method != 'get') {
			var options = {
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					var hasError = 0;
					if(countProperties(response) > 0) {
						for(i in response) {
							if(strpos(i,'_'))
								hasError = 1;
						}
						if(hasError == 1) {
							$('form#'+form).find('input[type="submit"]').removeClass('active');
							$('div.desc div.errorMessage').hide().html('');
							$('fieldset textarea').removeClass('error');
							$('fieldset input').removeClass('error');
							for(i in response) {							
								$('#' + i ).addClass('error');					
								$('#' + i + '_em_').show().html(response[i][0]);							
							}
							fixedPosition();

						} else {
							$('form#'+form).find('input[type="submit"]').removeClass('active');
							$('div.desc div.errorMessage').hide().html('');
							$('fieldset textarea').removeClass('error');
							$('fieldset input').removeClass('error');

							if(response.type != 4) {
								dialogClosed();
							}
							if(response.redirect != null) {
								location.href = response.redirect;
							} else {
								if(response.type == 0) {
									$('div#ajax-message').html(response.msg);
								} else if(response.type == 1) {
									$('*[href="'+ url +'"]').parents('tr').slideUp();
									$('div#ajax-message').html(response.msg);
								} else if(response.type == 2) {
									$('*[href="'+ url +'"]').attr('title', response.title).attr('class', response.class).html(response.replace);
								} else if(response.type == 3) {
									$.ajax({
										type: 'get',
										url: response.get,
										dataType: 'json',
										success: function(render) {
											$('div#get-data').html(render.data);
											$('div#ajax-message').html(response.msg);
										}
									});
									clearInput('form#'+form);
								} else if(response.type == 4) {
									$.ajax({
										type: 'get',
										url: response.get,
										dataType: 'json',
										success: function(render) {
											$('.dialog .dialog-box .content').html(render.data);
											fixedPosition();
										}
									});
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
