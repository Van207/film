@include('home.layout.header')
<div id="portfolio" class="section" style="padding-top:130px; min-height: 550px">
	<div class="container">
		<h3 class="mb-4 fw-bold h3 text-center">So sánh phim</h3>

		<div class="row">
			<div class="col-md-6 w-50">
				<div class="card">
					<div class="card-body text-center">

						<h5 class="card-title mb-0">Lựa chọn phim</h5>
						<h3 id="filmName1" class="h3 p-0 mb-0"></h3>
						<div class="box-button1" onclick="showFormSelectFim(1)">+</div>

						<div class="box-image img_wrapper1"></div>
						<div class="delete-button1 circle-singleline" onclick="deleteFilm(1)" style="display: none;">
							<i class="fa fa-times" aria-hidden="true"></i>
						</div>
						<div class="loading load1" style="display: none;">
							<div class="lds-roller">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>


						{{-- Chọn phim --}}
						<div id="movieSelectionForm1" style="display: none;" class="mt-4 py-3">
							<form id="compareForm">
								@csrf
								<label for="movieSelect1">Chọn phim:</label>
								<select class="js-example-matcher-start form-control" id="movieSelect1" name="movieSelect1" style="width: 100%"></select>
								<button type="button" class="btn btn-primary my-3" onclick="selectFilm(1)">Chọn</button>
							</form>
						</div>

					</div>
				</div>
			</div>

			<div class="col-md-6 w-50">
				<div class="card">
					<div class="card-body text-center">
						<h5 class="card-title mb-0">Lựa chọn phim</h5>
						<h3 id="filmName2" class="h3 p-0 mb-0"></h3>
						<div class="box-button2" onclick="showFormSelectFim(2)">+</div>

						<div class="box-image img_wrapper2"></div>
						<div class="delete-button2 circle-singleline" onclick="deleteFilm(2)" style="display: none;">
							<i class="fa fa-times" aria-hidden="true"></i>
						</div>
						<div class="loading load2" style="display: none;">
							<div class="lds-roller">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>


						{{-- Chọn Phim --}}
						<div id="movieSelectionForm2" style="display: none;" class="mt-4 py-3">
							<form id="compareForm">
								@csrf
								<label for="movieSelect1">Chọn phim:</label>
								<select class="js-example-matcher-start form-control" id="movieSelect2" name="movieSelect2" style="width: 100%"></select>
								<button type="button" class="btn btn-primary my-3" onclick="selectFilm(2)">Chọn</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 text-center my-3">
			<button type="button" class="btn btn-success sosanhbtn" onclick="soSanhPhim()">So sánh</button>
		</div>

		<div class="col-md-12 result-form text-center">
			<div class="lds-ripple mt-5 result-loading" style="display: none">
				<div></div>
				<div></div>
			</div>
			<table class="table table-hover table-bordered text-center" style="display: none">
				<h3 class="fw-bold text-center mt-3 h3 chart-title" style="display: none">Bảng so sánh thông tin phim</h3>

				<thead>
					<tr>
						<th>So sánh</th>
						<th class="thFilm1"></th>
						<th class="thFilm2"></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>


			<h3 class="fw-bold text-center mt-4 h3 chart-title" style="display: none">Biểu đồ so sánh doanh thu phim</h3>
			<div id="chart" style="width: 100%;height:500px; display:none; min-width: 100%"></div>
		</div>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
			let filmIds = [];
			// Show form chọn phim
			function showFormSelectFim(boxNumber) {
				document.getElementById('movieSelectionForm' + boxNumber).style.display = 'block';
				// document.getElementById('compareForm').setAttribute('data-box-number', boxNumber);
			}

			function selectFilm(boxNumber) {
				let movieSelect = document.getElementById('movieSelect' + boxNumber);
				let filmId = movieSelect.value;
				let filmName = movieSelect.options[movieSelect.selectedIndex].text;
				// let boxNumber = document.getElementById('compareForm').getAttribute('data-box-number');

				document.getElementById('movieSelectionForm' + boxNumber).style.display = 'none';

				document.querySelector('.thFilm' + boxNumber).innerHTML = `${filmName}`;
				filmIds[boxNumber - 1] = filmId;
				$.ajax({
					type: "GET",
					url: "{{ route('phim.getImgAjax') }}",
					data: {
						'id': filmId,
					},
					beforeSend: function() {
						$('.load' + boxNumber).show()
					},
					success: function(data) {
						$('.load' + boxNumber).hide()

						$('.img_wrapper' + boxNumber).append(`<img loading="lazy" src="${data.img}" alt="${data.name}">`)

						// SET tên
						$('#filmName' + boxNumber).append(`<a href="/${data.url}" target="_blank">${data.name}</a>`)

						$('.box-button' + boxNumber).hide() // Ẩn button chọn phim
						$('.delete-button' + boxNumber).show() //Hiện button xóa phim
					}
				})

			}

			function deleteFilm(boxNumber) {
				document.getElementById('filmName' + boxNumber).innerHTML = '';
				filmIds[boxNumber - 1] = undefined;
				document.getElementById('movieSelectionForm' + boxNumber).style.display = 'block';
				$('.box-button' + boxNumber).show();
				$('.img_wrapper' + boxNumber).html("");
				document.getElementById('movieSelectionForm' + boxNumber).style.display = 'none';
				$('.sosanhbtn').show()
				$('.table').hide()
				$('#chart').hide()
				$('.chart-title').hide()
			}

			function soSanhPhim() {
				$('.result-form table tbody').html('');
				document.getElementById('chart').style.display = 'block';

				if (filmIds.length == 2) {
					$.ajax({
						type: "POST",
						url: "{{ route('phim.sosanhAjax') }}",
						data: {
							'_token': '{{ csrf_token() }}',
							'filmId1': filmIds[0],
							'filmId2': filmIds[1]
						},
						beforeSend: function() {
							$('.result-loading').show();
						},
						success: function(data) {
							$('.result-loading').hide();

							$('.table').show()
							$('#chart').show()
							$('.result-form table').show();
							$('.sosanhbtn').hide();
							$('.chart-title').show()
							let film1 = data.data.film1;
							let film2 = data.data.film2;

							let detail1 = data.data.film1.film_detail;
							let detail2 = data.data.film2.film_detail;

							let revenue1 = data.data.film1.film_revenue;
							let revenue2 = data.data.film2.film_revenue;


							(film1.budget != "") ? loinhuan1 = (parseFloat(film1.worldwide) - parseFloat(film1.budget)) / parseFloat(film1.worldwide) * 100: loinhuan1 = 0;
							(film2.budget != "") ? loinhuan2 = (parseFloat(film2.worldwide) - parseFloat(film2.budget)) / parseFloat(film2.worldwide) * 100: loinhuan2 = 0;

							$('.result-form table tbody').append(`
								<tr>
									<td>Năm phát hành</td>
									<td class="${(loinhuan1 >= loinhuan2) ? 'text-success fw-bold' : ''}">${film1.year}</td>
									<td class="${(loinhuan2 >= loinhuan1) ? 'text-success fw-bold' : ''}">${film2.year}</td>
								</tr>
								<tr>
									<td>Chi phí (Dự kiến)</td>
									<td class="${(loinhuan1 >= loinhuan2) ? 'text-success fw-bold' : ''}">
										${(film1.budget != "") ? parseFloat(film1.budget).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) : '-'}
									</td>
									<td class="${(loinhuan2 >= loinhuan1) ? 'text-success fw-bold' : ''}">
										${(film2.budget != "") ? parseFloat(film2.budget).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) : '-'}
									</td>
								</tr>
								<tr>
									<td>Doanh thu toàn thế giới</td>
									<td class="${(loinhuan1 >= loinhuan2) ? 'text-success fw-bold' : ''}">
										${parseFloat(film1.worldwide).toLocaleString('en-US', { style: 'currency', currency: 'USD' })}
									</td>
									<td class="${(loinhuan2 >= loinhuan1) ? 'text-success fw-bold' : ''}">
										${parseFloat(film2.worldwide).toLocaleString('en-US', { style: 'currency', currency: 'USD' })}
									</td>
								</tr>
								<tr>
									<td>Lợi nhuận</td>
									<td class="${(loinhuan1 >= loinhuan2) ? 'text-success fw-bold' : ''}">${loinhuan1.toFixed(2) + '%'}</td>
									<td class="${(loinhuan2 >= loinhuan1) ? 'text-success fw-bold' : ''}">${loinhuan2.toFixed(2) + '%'}</td>
								</tr>`)

							const r1 = revenue1.filter(item1 => {
								return revenue2.some(item2 => item2.country === item1.country);
							});

							const r2 = revenue2.filter(item2 => {
								return revenue1.some(item1 => item1.country === item2.country);
							});
							// console.log(r1);
							// console.log(r2);
							charts(film1.name_vi, film2.name_vi, r1, r2)

						},
						error: function(error) {
							console.error(error);
						}
					});
				} else {
					alert('Vui lòng chọn đủ 2 phim trước khi so sánh.');
				}
			}



			function charts(name1, name2, arr1, arr2) {

				var chartDom = document.getElementById('chart');
				var myChart = echarts.init(chartDom);
				var option;

				option = {
					title: {
						text: ''
					},
					tooltip: {
						trigger: 'axis'
					},
					legend: {
						data: [name1, name2]
					},
					grid: {
						left: '3%',
						right: '4%',
						bottom: '3%',
						containLabel: true
					},
					toolbox: {
						feature: {
							saveAsImage: {}
						}
					},
					xAxis: {
						type: 'category',
						boundaryGap: false,
						data: arr1.filter(item => item.country !== "Domestic").map(item => item.country).sort()
					},
					yAxis: {
						type: 'value'
					},
					series: [{
							name: name1,
							type: 'line',
							// stack: 'Total',
							data: arr1.filter(item => item.country !== "Domestic").map(item => item.gross)
						},
						{
							name: name2,
							type: 'line',
							// stack: 'Total',
							data: arr2.filter(item => item.country !== "Domestic").map(item => item.gross)
						}
					]
				};

				option && myChart.setOption(option);
				window.addEventListener('resize', function() {
					myChart.resize();
				})

			}

			// Select2
			var data = {!! json_encode($filmData) !!};

			function matchCustom(params, data) {
				if ($.trim(params.term) === '') {
					return data;
				}
				if (typeof data.text === 'undefined') {
					return null;
				}

				var searchTerm = params.term.toLowerCase();
				var dataText = data.text.toLowerCase();

				if (dataText.indexOf(searchTerm) > -1) {
					var modifiedData = $.extend({}, data, true);
					modifiedData.text += ' (Khớp)';
					return modifiedData;
				}
				return null;
			}


			$(".js-example-matcher-start").select2({
				data: data,
				matcher: matchCustom,
			});
		</script>
	</div>
</div>

@include('home.layout.footer')
