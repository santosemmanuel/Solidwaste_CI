$(document).ready(function(){
	var counter = 0;
	$('#addAssign').click(function(){
		var copy = "<div class='copy"+counter+"'>";
		copy += $(".assignCopy").html();
		copy += "</div>";
		$(".assignCopy").after(copy);
		$('.copy'+counter).find('.bootstrap-select button:first').remove();
		$('.copy'+counter).find('select:last').selectpicker();
		$('.copy'+counter).find("select[name='driver[0][]']").attr("name","driver["+(counter+1)+"][]");
		$('.copy'+counter).find("select[name='truck[0][]']").attr("name","truck["+(counter+1)+"][]");
		$('.copy'+counter).find("select[name='brgy[0][]']").attr("name","brgy["+(counter+1)+"][]");
		counter++;
	})

	$('#removeAssign').click(function(){
		counter--;
		$('#collectSchedForm .modal-body').find(".copy"+counter).remove();
	})

	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		events: base_url + "collectionsched/getCollection",
		initialView: 'dayGridMonth',
		dateClick: function(info) {
			$('#collectSched').modal('show');
			$('#collectSched').find('form').trigger('reset');
			$('#collectSched').find('.modal-body input[name="collectionDate"]').val(info.dateStr);
		},
		eventClick: function (info) {
			$('#collectEditSubmitDelete').modal('show');
			$('#delSchedButton').attr('data-whatever', info.event.id);
			$('#editSchedButton').attr('data-whatever', info.event.id);
			$('#finishCollection').attr('data-whatever', info.event.id);
		}
	});
	calendar.render();

	$('#delSchedButton').click(function() {
		$("#deleteSched").modal("show");
		var dataId = $(this).attr('data-whatever');
		$('#deleteSched').find('input[name="schedID"]').val(dataId);
	});


	$('#editSchedButton').click(function() {
		$('#collectEditSubmitDelete').modal("hide");
		$('#editCollectSched').modal("show");
		var dataId = $(this).attr('data-whatever');
		$(".editCopy").remove();
		var count = 0
		$.ajax({
			url: base_url+"collectionsched/get_collectionLocation",
			type: "post",
			dataType: "json",
			data: {data: dataId},
			success: function (data) {
				$('#editCollectSched').find("select[name='brgy[0][]'] option:selected").removeAttr('selected');
				$('#editCollectSched').find('input[name="collectionID"]').val(data[0].collectionId);
				$('#editCollectSched').find('input[name="collectionDate"]').val(data[0].date);
				$('#editCollectSched').find("select[name='driver[0][]'] option[value='"+data[0].driver+"']").attr('selected','selected');
				$('#editCollectSched').find("select[name='truck[0][]'] option[value='"+data[0].truck+"']").attr('selected','selected');

				for(let k = 0; k < data[0][0].length; k++) {
					$('#editCollectSched').find("select[name='brgy[0][]'] option[value='" + data[0][0][k] + "']").attr('selected', 'selected');
				}

				for(let i = 1; i < data.length; i++){
					var copy = "<div class='editCopy copyedit"+count+"'>";
					copy += $(".assignCopyEdit").html();
					copy += "</div>";
					$(".assignCopyEdit").after(copy);
					$('.copyedit'+count).find('.bootstrap-select button:first').remove();
					$('.copyedit'+count).find('select:last').selectpicker();
					$('.copyedit'+count).find('.bootstrap-select .filter-option-inner-inner').html('Select Poblacion');
					$('.copyedit'+count).find("select[name='driver[0][]']").attr("name","driver["+(count+1)+"][]");
					$('.copyedit'+count).find("select[name='truck[0][]']").attr("name","truck["+(count+1)+"][]");
					$('.copyedit'+count).find("select[name='brgy[0][]']").attr("name","brgy["+(count+1)+"][]");
					$('.copyedit'+count).find("select[name='driver["+(count+1)+"][]'] option[value='"+data[i].driver+"']").attr('selected','selected');
					$('.copyedit'+count).find("select[name='truck["+(count+1)+"][]'] option[value='"+data[i].truck+"']").attr('selected','selected');
					$('.copyedit'+count).find("select[name='brgy["+(count+1)+"][]'] option:selected").removeAttr('selected');

					for(let j = 0; j < data[i][0].length; j++) {
						$('.copyedit'+count).find("select[name='brgy["+(count+1)+"][]'] option[value='" + data[i][0][j] + "']").attr('selected', 'selected');
					}
					count++;
				}
			}
		})
		$('#addAssignedit').unbind().click(function(){
			var copy = "<div class='editCopy copyedit"+count+"'>";
			copy += $(".assignCopyEdit").html();
			copy += "</div>";
			$(".assignCopyEdit").after(copy);
			$('.copyedit'+count).find('.bootstrap-select button:first').remove();
			$('.copyedit'+count).find('select:last').selectpicker();
			$('.copyedit'+count).find("select[name='driver[0][]']").attr("name","driver["+(count+1)+"][]");
			$('.copyedit'+count).find("select[name='truck[0][]']").attr("name","truck["+(count+1)+"][]");
			$('.copyedit'+count).find("select[name='brgy[0][]']").attr("name","brgy["+(count+1)+"][]");
			count++;
		})

		$('#removeAssignedit').unbind().click(function(){
			count--;
			$('#editCollectSchedForm .modal-body').find(".copyedit"+count).remove();
		})

	});

	$("#finishCollection").click(function(){
		$("#totalKG").html(0);
		$('#collectEditSubmitDelete').modal("hide");
		$('#finishSched').modal('show');
		var dataId = $(this).attr('data-whatever');
		$.ajax({
			url: base_url+"collectionsched/get_DriverTruckCollection",
			type: "post",
			dataType: "json",
			data: {data: dataId},
			success: function (data) {
				$('#finishCollectSchedForm').find('input[name="collectionID"]').val(data[0].collectionId);
				$('#finishCollectSchedForm').find('input[name="collectionDate"]').val(data[0].date);
				var card = "";
				for (let i = 0; i < data.length; i++) {

					card += "<div class=\"card\">\n" +
						"\t\t\t\t\t\t<div class=\"card-header\" id=\"heading"+i+"\">\n" +
						"\t\t\t\t\t\t\t<h2 class=\"mb-0\">\n" +
						"\t\t\t\t\t\t\t\t<button class=\"btn btn-link btn-block text-left\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapse"+i+"\" aria-expanded=\"true\" aria-controls=\"collapseOne\">\n" +
						"\t\t\t\t\t\t\t\t\t"+data[i].driverName+"- ("+data[i].truck+"-"+data[i].truckName+", "+data[i].truckColor+")"
						+"\n" +
						"\t\t\t\t\t\t\t\t</button>\n" +
						"\t\t\t\t\t\t\t</h2>\n" +
						"\t\t\t\t\t\t</div>\n" +
						"\t\t\t\t\t\t<div id=\"collapse"+i+"\" class=\"collapse\" aria-labelledby=\"heading"+i+"\" data-parent=\"#accordionExample\">\n" +
						"\t\t\t\t\t\t\t<div class=\"card-body\">\n";

					for(let l = 0; l < data[i][0].length; l++){

						card += "<div class=\"form-row\">\n" +
							"    <div class=\"col-10\">\n" +
							"      <input type=\"text\" class=\"form-control\" value='"+data[i][0][l].brgyName+"' name='brgy[]' placeholder=\"First name\" readonly>\n" +
							"    </div>\n" +
							"    <div class=\"col-2\">\n" +
							"      <input type=\"text\" class=\"form-control\" placeholder=\"Kg. per Brgy\" name='kg[]'>\n" +
							"    </div>\n" +
							"  </div>";
					}

					card += "\t\t\t\t\t\t\t\t" +
						"\t\t\t\t\t\t\t</div>\n" +
						"\t\t\t\t\t\t</div>\n" +
						"\t\t\t\t\t</div>";

				}
				$("#accordionExample").html(card);

			}
		})
	})

	$("#finishCollectSchedForm").change(function(){
		var values = $("input[name='kg[]']")
			.map(function () {
				return Number($(this).val());
			}).get();
		$("#totalKG").html(values.reduce((total, num)=> total + num));
	})

	$("#finishCollectSchedForm").submit(function(e){
		e.preventDefault();
		var dataCollection = $(this).serializeArray();
		console.log(dataCollection);
	});
})
