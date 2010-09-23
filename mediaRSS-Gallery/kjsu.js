		
$(function() {
var kUploadConfig = new KalturaConfiguration(kPartnerId);
				$("#upload_field").html5_upload({
					url: function(number) {
						return prompt(number + " url", "/");
					},
					sendBoundary: window.FormData || $.browser.mozilla,
					onStart: function(event, total) {
						return confirm("You are trying to upload " + total + " files. Are you sure?");
					},
					setName: function(text) {
							$("#progress_report_name").text(text);
					},
					setStatus: function(text) {
						$("#progress_report_status").text(text);
					},
					setProgress: function(val) {
						$("#progress_report_bar").css('width', Math.ceil(val*100)+"%");
					},
					onFinishOne: function(event, response, name, number, total) {
						//alert(response);
					}
				});
			});

