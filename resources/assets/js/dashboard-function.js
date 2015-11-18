/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		dateRangePicker('#chart1-daterange');
		datePicker('#chart2-date');
		select2Plugin('.select2')
		charts1Ajax();
		charts2Ajax();
		//charts3();
		
		/* === click charts1 button === */
		$('#charts1-view-btn').click(function(){
			charts1Ajax();
		});
		
		/* === click charts2 button === */
		$('#charts2-view-btn').click(function(){
			charts2Ajax();
		})
	}
	
	function charts1Ajax() {
		loadingModal('show','Loading charts...');
		ajaxCsrfToken();
		$.ajax({
			url: url+'/dashboard/charts1',
			type: 'post',
			data: {
				dateRange 	: $('#chart1-daterange').val(), 
				item 		: $('#charts1-item').val() , 
				priceRange	: $('#charts1-pricerange').val(),
			},
			dataType: 'json',
			complete: function(){				
				loadingModal('close');
			},
			success: function(result) {
				charts1(result);
			}
		});
		
	}
	
	function charts2Ajax() {
		loadingModal('show','Loading charts...');
		ajaxCsrfToken();
		$.ajax({
			url: url+'/dashboard/charts2',
			type: 'post',
			data: {
				date 	: $('#chart2-date').val(), 
				branch 	: $('#charts2-branch').val() , 
			},
			dataType: 'json',
			complete: function(){				
				loadingModal('close');
			},
			success: function(result) {
				charts2(result);
			}
		});
		
	}
	
	function select2Plugin(selector) {
		$(selector).select2();
	}
	
	function dateRangePicker(selector) {
		$(selector).daterangepicker({
			opens: 'right',
			startDate: moment().subtract(7, 'days').format('L'),
			endDate: moment().format('L'),
			maxDate: ''
		});
	}
	
	function datePicker(selector) {
		$(selector).daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			maxDate : ''
		});
	}
	
	function charts1(data) {
		$('#chart-1').highcharts('StockChart', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Item Price By Store Branches'
			},
			xAxis: {
				type: 'datetime'
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Price Range'
				},
				stackLabels: {
					enabled: true,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				}
			},
			rangeSelector:{
				enabled:false
			},
			legend: {
				enabled: true
			},
			tooltip: {
				formatter: function() {
					var seriesResult = '';
					var seriesTotal  = 0;
					seriesResult += '<b>' + dateFormatter(this.x) + '</b> <br>';
					$.each(this.points, function(i, point) {
						seriesResult += '<span style="color:'+point.series.color+'; font-weight:bold;">'+ point.series.name +' : (₱'+point.y +')<span><br>';
						seriesTotal = seriesTotal+point.y;
					});
					seriesResult += '<br><b>Total: '+seriesTotal+' </b>';
					return seriesResult;
				},
				shared: true
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						style: {
							textShadow: '0 0 3px black'
						}
					}
				}
			},
			credits : {
				enabled : false
			},
			series: data
		});
	}
	
	function charts2(data) {
		$('#chart-2').highcharts({
			chart: {
				type: 'bar'
			},
			title: {
				text: 'Items Price Per Store Branch'
			},
			xAxis: {
				categories: data.categories
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Price Range'
				},
				stackLabels: {
					enabled: true,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				}
			},
			legend: {
				reversed: true
			},
			plotOptions: {
				series: {
					stacking: 'normal'
				}
			},
			credits : {
				enabled : false
			},
			series: data.series
		});
	}
	
	function charts3() {
		$('#chart-3').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Browser market shares January, 2015 to May, 2015'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			credits : {
				enabled : false
			},
			series: [{
				name: "Brands",
				colorByPoint: true,
				data: [{
					name: "Microsoft Internet Explorer",
					y: 56.33
				}, {
					name: "Chrome",
					y: 24.03,
					sliced: true,
					selected: true
				}, {
					name: "Firefox",
					y: 10.38
				}, {
					name: "Safari",
					y: 4.77
				}, {
					name: "Opera",
					y: 0.91
				}, {
					name: "Proprietary or Undetectable",
					y: 0.2
				}]
			}]
		});
	}