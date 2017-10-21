jQuery(document).ready(function ($) {
	var $container = $('.grid');
	$(window).on('load', function () {
		domasonry();
	});
	$(window).resize(function(){
		domasonry();
	});
	function domasonry(){
		//$container.imagesLoaded().progress( function() {
			$container.masonry({
				horizontalOrder: true,
				columnWidth: '.grid-sizer',
				percentPosition: true,
			});
		//});
	};
});