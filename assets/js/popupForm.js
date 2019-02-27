$(function(){
	$(document).on('click','.addTweetBtn',function(){
		$('.status').removeClass().addClass('status-removed');
		$('.hash-box').removeClass().addClass('hash-box-removed');
		$('#count').attr('id','count-removed');

		$.post('http://localhost/Social_Network_Twitter/ajax/tweetForm.php',function(data)
		{
			$('.popupTweet').html(data);
			$('closeTweetPopup').click(function(){
				$('.popup-tweet-wrap').hide();
				$('.status-removed').removeClass().addClass('status');
				$('.hash-box-removed').removeClass().addClass('hash-box');
				$('#count-removed').attr('id','count');

			});
		});
	});

	$(document).on('submit','#popupForm', function(e){
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('file',$('#file')[0].files[0]);
		$.aja({
			url: "http://localhost/Social_Network_Twitter/ajax/addTweet.php",
			type: "POST",
			data: formData,
			success: function(data){
				result = JSON.parse(data);
				if(result['error'])
				{
					$('<div class="error_banner"> <div class="error-banner-inner"> <p id="errorMsg">'+result.error+' </p> </div> </div>').insertBefore('.header-wrapper');
					$('.error-banner').hide().slideDown(300).delay(5000).slideUp(300);
					$('.popup-tweet-wrap').hide();
				}else if(result['success'])
				{
					$('<div class="error_banner"> <div class="error-banner-inner"> <p id="errorMsg">'+result.success+' </p> </div> </div>').insertBefore('.header-wrapper');
					$('.error-banner').hide().slideDown(300).delay(5000).slideUp(300);
					$('.popup-tweet-wrap').hide();
	
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
});