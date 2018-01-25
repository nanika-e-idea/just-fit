jQuery(document).ready(function ($) {
	// DWQA Questions Vote
	var update_vote = false;
	$( '.dwqa-votes-count' ).on('click', function(e){
		e.preventDefault();
		var t = $(this),
			id = t.data('post'),
			nonce = t.data('nonce'),
			vote_for = 'question';

		var data = {
			action: 'dwqa-action-vote',
			vote_for: vote_for,
			nonce: nonce,
			post: id,
			type: 'up'
		};

		$.ajax({
			url: dwqa.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function( data ) {
            	console.log(data);
            	if (data.success) {
                    t.find('strong').text(data.data.vote);
                }
            },
			error:function( data ) {
				console.log("error",data);
            	
            },
		});
	});
	//single Question vote
	var update_vote = false;
	$( '.dwqa-vote-1up' ).on('click', function(e){
		e.preventDefault();
		var t = $(this),
			parent = t.parent(),
			id = parent.data('post'),
			nonce = parent.data('nonce'),
			vote_for = 'question';

		if ( parent.hasClass( 'dwqa-answer-vote' ) ) {
			vote_for = 'answer';
		}

		var data = {
			action: 'dwqa-action-vote',
			vote_for: vote_for,
			nonce: nonce,
			post: id,
			type: 'up'
		}

		$.ajax({
			url: dwqa.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function( data ) {
            	console.log(data);
            	if (data.success) {
                    t.find('.dwqa-vote-count').text(data.data.vote);
                }
            },
			error:function( data ) {
				console.log("error",data);
            	
            },
		});
	});

});