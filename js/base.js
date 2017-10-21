jQuery(document).ready(function ($) {
	//footer高さ調整
	$(document).ready(function () {
		adjust_fheight();
	});
	var heightthumbs
	$(window).on('load', function () {
		var maxnum = 0;
		$('.slider').each(function () {
			maxnum++;
		});
		maxnum = maxnum * 2;
		for (var i = 0; i < maxnum; i++) {
			slider_scrol(i);
		};

		function slider_scrol(num) {
			var num = num;
			var slheight = $('#slider_' + num + ' li:first').height();
			eval('var loopScrol_' + num + '=' +
				"setInterval(function () {var slidecloneItem = $('#slider_' + num + ' li:first').clone(true);$('#slider_' + num + ' li:first').animate({marginTop: -slheight}, {duration: 500,complete: function () {$('#slider_' + num + ' li:first').remove();slidecloneItem.clone(true).insertAfter($('#slider_' + num + ' li:last'));slheight=$('#slider_' + num +' li:first').height();$('#slider_' + num).height(slheight)}});}, 4000);" + ';');
		};
		
		if($('.lbox')){
			heightthumbs = $('.lbox_thumbs').height();
			var cloneThumbs = $('.lbox_thumbs').children().clone();
			$('.lbox_thumbs_hidden').append(cloneThumbs);
			$(window).resize();
		};

	});
	$(document).on('click', '.slider', function () {
		alert('click');
	});

	$(window).resize(function () {
		adjust_fheight();
		masonryThumbs();
	});



	function adjust_fheight() {
		var adjheight = 0;
		if (window.innerWidth > 767) {
			$('.fblock').each(function () {
				if (jQuery(this).height() > adjheight) {
					adjheight = jQuery(this).height();
				};
			});
		} else {
			$('.fblock').each(function () {
				adjheight += jQuery(this).height();
			});
		};
		adjheight += 40;
		$('#footer_blocks').height(adjheight);
	};

	$('.grid-item a.pdfemb-viewer').on('load', function () {
		alert('masonryを実行します');
		masonryArrange();
	})

	//portfolio　スライドコントロール
	var click_enabler = true;
	$(document).on('click', '.prv_slide', function () {
		if (click_enabler) {
			click_enabler = false;
			var cloneItem = $('.pf_slider li:last').clone(true);
			$('.pf_slider li:last').remove();
			cloneItem.clone(true).insertBefore($('.pf_slider li:first'));
			$('.pf_slider li:first').css('margin-left', '-100%');
			$('.pf_slider li:first').animate({
				marginLeft: 0
			}, {
				duration: 600,
				complete: function () {
					$('.pf_slider li:first').css('margin-left', 0);
					$('.pfSlide').css('margin-left', '0px')
					click_enabler = true;
				}
			});
		} else {
			return false;
		};
	});
	$(document).on('click', '.nxt_slide', function () {
		if (click_enabler) {
			click_enabler = false;
			var cloneItem = $('.pf_slider li:first').clone(true);
			$('.pf_slider li:first').animate({
				marginLeft: '-100%'
			}, {
				duration: 600,
				complete: function () {
					$('.pf_slider li:first').remove();
					cloneItem.clone(true).insertAfter($('.pf_slider li:last'));
					$('.pf_slider li:first').css('margin-left', 0);
					click_enabler = true;
				}
			});
		} else {
			return false;
		};
	});

	$(document).on('click', '.pfIndex a', function () {
		var crtPosition = $(window).scrollTop();
		var setPosition = $('.portfolio').offset();
		if (click_enabler) {
			var targetNum = ($(this).prop('id')).slice(6);
			click_enabler = false;
			$('#slide_fader').removeClass('faderOff');
			$('#slide_fader').addClass('faderOn');

			var slideNum = parseInt($('#slide_' + targetNum).index());
			for (var i = 0; i < slideNum; i++) {
				eval("var cloneItem" + i + "= $('.pf_slider li:first').clone(true)");
				$('.pf_slider li:first').remove();
				eval("cloneItem" + i + ".clone(true).insertAfter($('.pf_slider li:last'))");
			};
			setTimeout(function () {
				$('#slide_fader').removeClass('faderOn');
				$('#slide_fader').addClass('faderOff');
				click_enabler = true;
			}, 100);
		} else {
			return false;
		};
		$(window).scrollTop(crtPosition), $('html body').stop().animate({
			scrollTop: setPosition.top
		}, 300, 'swing');
	});


	$(document).on('click', function (event) {
		if (!$(event.target).closest('.listitem_box').length) {
			$('.memberinfo').addClass('hidden');
		}


	});
	$('.memberlist .listitem_box').on('click', function () {
		$(this).find('.memberinfo').toggleClass('hidden');
	});

	/** Crown_Navコントール **/
	//マウスオーバー
	$('.cnav_item').hover(function () {
		var navindex = $('.cnav_item').index(this);
		$('.cnav_caption').addClass('hidden');
		$('.cnav_item a').removeClass('picup');
		setTimeout(function () {
			$('ul.cnav_caption_group li:eq(' + navindex + ')').removeClass('hidden');
		}, 500, 'swing');
	}, function () {
		var navindex = $('.cnav_item').index(this);
		$('ul.cnav_caption_group li:eq(' + navindex + ')').addClass('hidden');
	});
	//スマホ向け自動picup
	var cnavcnt = $('ul.cnav_item_group li').length;
	var cnavnum = 0;
	var cnavmouseout = true;

	$('#crown_nav').hover(function () {
		cnavmouseout = false;
	}, function () {
		cnavmouseout = true;
	});

	setInterval(function () {
		if (cnavmouseout == true) {
			$('.cnav_caption').addClass('hidden');
			$('.cnav_item a').removeClass('picup');
			setTimeout(function () {
				$('ul.cnav_item_group li:eq(' + cnavnum + ') a').addClass('picup');
				$('ul.cnav_caption_group li:eq(' + cnavnum + ')').removeClass('hidden');
				if (cnavnum == cnavcnt) {
					cnavnum = 0;
				} else {
					cnavnum += 1;
				};
			}, 300, 'swing');
		};
	}, 2700);

	/** Scroll to PageTop **/
	$(window).on('scroll', function () {
		var scrlPosition = $(window).scrollTop();
		if (scrlPosition > 500) {
			$('#scroll_page_top').removeClass('hidden');
		} else {
			$('#scroll_page_top').addClass('hidden');
		}
	});
	$('#scroll_page_top').on('click', function () {
		$('html,body').stop().animate({
			scrollTop: 0
		}, 300, 'swing');
		$('#scroll_page_top').addClass('hidden');
	});

	/** LightBox Control **/
	//lbox_nav 選択処理
	$(document).on('click', '.lbox_nav_item', function () {
		var selectnav = '.' + $(this).find('input').prop('value');
		$(this).parent().children().removeClass('here');
		$(this).addClass('here');
		
		var selectthumbs;
		if(selectnav == '.all'){
			selectthumbs = $(this).parents('.lbox').find('.lbox_thumbs_hidden').children().clone();
		}else{
			selectthumbs = $(this).parents('.lbox').find('.lbox_thumbs_hidden').find(selectnav).clone();
		};
		$(this).parents('.lbox').find('.lbox_thumbs').empty();
		$(this).parents('.lbox').find('.lbox_thumbs').append('<div class="grid-sizer"></div>');
		$(this).parents('.lbox').find('.lbox_thumbs').masonry({
			horizontalOrder: true,
           	itemSelector: '.lbox_thumbs_item',
           	columnWidth: '.grid-sizer',
			percentPosition: true,
			isFitWidth: false,
		}).append(selectthumbs).imagesLoaded().masonry('appended', selectthumbs);
	});
	//lbox_view open処理
	$(document).on('click', '.lbox_thumbs_item', function () {
		var crtscrol = $(window).scrollTop();
		var openitem = '#' + $(this).find('input').prop('value');
		var lboxid = $(this).parents('.lbox').find('.lbox_view').prop('class');
		$('#view').css('position', 'fixed');
		$('#view').css('top', -crtscrol);
		$(this).parents('.lbox').find('.lbox_view').removeClass('hidden');
		$(this).parents('.lbox').find('.lbox_view').addClass('visible');
		$(openitem).removeClass('hidden');
		$(openitem).addClass('visible');
	});
	//lbox_view close処理
	$('.lbox_view_box_item .btn_close').on('click', function () {
		closelboxView();
	});
	$('.lbox_view').on('click', function (event) {
		if (!$(event.target).closest('.lbox_view_box_item').length) {
			closelboxView();
		};
	});
	function closelboxView() {
		var crtscrol = -$('#view').offset().top;
		$('#view').css('position', 'relative');
		$('#view').css('top', 0);
		$(window).scrollTop(crtscrol);
		$('.lbox_view_box_item,.lbox_view').removeClass('visible');
		$('.lbox_view_box_item,.lbox_view').addClass('hidden');
	};
	function masonryThumbs(){
		$('.lbox_thumbs').masonry({
			horizontalOrder: true,
           	itemSelector: '.lbox_thumbs_item',
           	columnWidth: '.grid-sizer',
			percentPosition: true,
			isFitWidth: false,
		});
	};
	var ua = navigator.userAgent.toLowerCase();
	var isMobile = /iphone/.test(ua)||/android(.+)?mobile/.test(ua);

	if (!isMobile) {
		$('.sp-only').addClass('hidden');
		$('.sp-only').parents('a').addClass('hidden');
    	$('a[href^="tel:"]').on('click', function(e) {
        	e.preventDefault();
    	});
	}
});