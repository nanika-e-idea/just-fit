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
