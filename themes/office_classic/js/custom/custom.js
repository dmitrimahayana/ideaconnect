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

function dialogAjax(url, width) {
	dialogShow(width);
	$.ajax({
		type: 'get',
		url: url,
		dataType: 'json',
		success: function(response) {
			$('*[href="'+url+'"]').removeClass('active');
			$('.dialog .dialog-box .content').html(response.data);
			loadingHidden();
			//$.scrollTo("body", {duration: 800, axis:"y"});
		}
	});
}

function dialogUpdate() { 
	$(this).addClass('active');
	var width = $(this).attr('rel');
	var url = $(this).attr('href');
	dialogAjax(url, width);
	return false;
}

function dialogShow(width) {
	$('div#ajax-message').html('');
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
		//'position' : 'absolute',
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

$(document).ready(function() {

	// Grid Options
	$('ul.gridmenu li.grid-button').live('click', function() {
		$(this).toggleClass('active');
		$('div.search-form').slideUp();
		$('div.grid-option').slideToggle();
		return false;
	});

	// Search
	$('ul.gridmenu li.search-button').live('click', function() {
		$(this).toggleClass('active');
		$('div.grid-option').slideUp();
		$('div.search-form').slideToggle();
		return false;
	});

	/* Global Dialog */
	$('.link-dialog').live('click', function() {
		var id = $(this).attr('id');
		var width = $(this).attr('rel');
		var url = $(this).attr('href');

        alert(url+'/id/'+id);
		if(url != 'javascript:void(0);') {
			dialogAjax(url, width);
		} else {
            $("a.dialog-close").click(function() {
                $(".dialog").fadeOut();
            });

			//var content = $('.open-dialog-'+id).html();
			//dialogShow(width);
			//$('.dialog .dialog-box .content').html(content);
			//loadingHidden();
			//fixedPosition();
		}
		return false;
	});

    $('.link_edit_time').live('click', function() {
        var inp=$(this).attr('id');
        var url=$(this).attr('url');

        alert(url+'/id/'+inp);
        /*$.ajax({
            type: "POST",
            //dataType: "html",
            data: "input="+inp,
            url: url+'/id/'+inp,
            success: function(data) {
                alert(url+'/id/'+inp);
                /*var content = $('dialog-edit').html(data);
                dialogShow(width);
                $('.dialog .dialog-box .content').html(content);
                loadingHidden();
                fixedPosition();
                */
           /* },
            error: function(xhr,err){
                //alert("readyState: "+xhr.readyState+" "+xhr.status);
                alert(xhr.responseText);
            }
        });*/
    });

	/* Global Grid-View Search */
	$('.search-form form').live('submit', function() {
		var grid = $('.grid-view').attr('id');
		$.fn.yiiGridView.update(grid, {
			data: $(this).serialize()
		});
		return false;
	});

	/* Global Grid-View Grid Options */
	$('form[name="gridoption"] :checkbox').live('click', function(){
		var url = $('form[name="gridoption"]').attr('action');
		var grid = $('.grid-view').attr('id');
		$.ajax({
			url: url,
			data: $('form[name="gridoption"] :checked').serialize(),
			success: function(response) {
				$.fn.yiiGridView.update(grid, {
					data: $('form[name="gridoption"]').serialize()
				});
				return false;
			}
		});
	});

	/**
	 * For general ajax submit
	 * redirect
	 *
	 * type
	 *	0 [show message]
	 *	1 [update grid-view]
	 *	2 [replace dialog]
	 *	3 [hide media-render]
	 *
	 * msg [0,1,] => message
	 * get [2,3 => url
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

		//$('div.loading').show();
		if(method != 'get') {
			var options = {
				type: 'GET',
				dataType: 'json',
				//data: { enablesave: isEnableSave },
				success: function(response) {
					//$('div.loading').hide();
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
								location.href = response.redirect;
							} else {
								if(response.type == 0) {
									$('form[action="'+link+'"]').find('div#ajax-message').html(response.msg);

								} else if(response.type == 1) {
									var grid = $('.grid-view').attr('id');
									$.fn.yiiGridView.update(grid);
									$('#'+response.id+' div#ajax-message').html(response.msg);
									/* $.ajax({
										type: 'get',
										url: response.get,
										dataType: 'json',
										success: function(render) {
											$('#'+response.id).html(render.data);
											$('#'+response.id+' div#ajax-message').html(response.msg);
										}
									}); */
									clearInput('form[action="'+link+'"]');

								} else if(response.type == 2) {
									$.ajax({
										type: 'get',
										url: response.get,
										dataType: 'json',
										success: function(render) {
											$('.dialog .dialog-box .content').html(render.data);
											fixedPosition();
										}
									});

								} else if(response.type == 3) {
									$('*[href="'+ link +'"]').parent('li').hide();

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

	// Grid Options
	$('.quickmenu ul li').live('click', function() {
		var id = $(this).attr('name');
		if(id != 'logout') {
			$('.mainmenu div[name="setting-on"]').hide();
			$('.quickmenu ul li').removeClass('active');
			$('.mainmenu div[name="setting-on"]#'+id).show();
			$(this).addClass('active');
			return false;
		}
	});


});
