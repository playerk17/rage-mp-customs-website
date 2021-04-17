(function ($) {
	'use strict';

	function migragePrettyLinks(params) {

		var start = params.start;
		var batch = params.batch;
		var limit = params.limit;
		var security = params.security;
		var data = {
			action: 'us_handle_request',
			cmd: "import_pretty_links",
			start: start,
			batch: batch,
			limit: limit,
			security: security
		};

		sendRequest(data).then(function (resposne) {
			if (response.status === "success") {
				migragePrettyLinks();
			} else {
				console.log('Some error occured!');
			}
		});
	}


	$(document).ready(function () {



		// When we click outside, close the dropdown
		$(document).on("click", function (event) {
			var $trigger = $("#kc-us-create-button");
			if ($trigger !== event.target && !$trigger.has(event.target).length) {
				$("#kc-us-create-dropdown").hide();
			}
		});

		// Toggle Dropdown
		$('#kc-us-create-button').click(function () {
			$('#kc-us-create-dropdown').toggle();
		});

		// Clicks Reports Datatable
		if ($('#clicks-data').get(0)) {

			var sortIndex = $('#clicks-data').find("th[data-key='clicked_on']")[0].cellIndex;

			if ($('#clicks-data').get(0)) {
				$('#clicks-data').DataTable({
					order: [[sortIndex, "desc"]]
				});
			}
		}

		// Clicks Reports Datatable
		if ($('#links-data').get(0)) {

			var sortIndex = $('#links-data').find("th[data-key='created_at']")[0].cellIndex;
			if ($('#links-data').get(0)) {
				$('#links-data').DataTable({
					order: [[sortIndex, "desc"]]
				});
			}
		}

		if ($('.kc-us-groups').get(0)) {
			$('.kc-us-groups').select2({
				placeholder: 'Select Groups',
				allowClear: true,
				dropdownAutoWidth: true,
				width: 500,
				multiple: true
			});
		}

		$('.kc-us-date-picker').datepicker({
			dateFormat: 'yy-mm-dd'
		});


		/*
		$('#kc-us-import-pretty-links').click(function ( e ) {
			e.preventDefault();

			$('#kc-us-import-progress-bar').show();

			var params = {};
			migragePrettyLinks( params );

		});
		*/

		// Social Share
		$( ".share-btn" ).click(function(e) {
			$('.networks-5').not($(this).next( ".networks-5" )).each(function(){
				$(this).removeClass("active");
				$(this).hide();
			});

			$(this).next(".networks-5").show();
			$(this).next( ".networks-5" ).toggleClass( "active" );
		});

	});


})(jQuery);

// Confirm Deletion
function confirmDelete() {
	return confirm('Are you sure you want to delete short link?');
}