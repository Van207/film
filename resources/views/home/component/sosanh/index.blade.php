@include('home.layout.header')
<div id="portfolio" class=" section" style="padding-top:130px">
	<div class="container">
		<h1 class="mb-4">So sánh phim</h1>

		<div class="row">
			<div class="col-md-6 w-50">
				<div class="card">
					<div class="card-body text-center">
						<h5 class="card-title">Lựa chọn phim</h5>
						<h3 id="selectedMovie1"></h3>
						<div class="box-button" onclick="showMovieSelectionForm(1)">+</div>
						<div class="img_wrapper1"></div>
					</div>
				</div>
			</div>

			<div class="col-md-6 w-50">
				<div class="card">
					<div class="card-body text-center">
						<h5 class="card-title">Lựa chọn phim</h5>
						<h3 id="selectedMovie2"></h3>
						<div class="box-button" onclick="showMovieSelectionForm(2)">+</div>
						<div class="img_wrapper2"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 text-center my-3">
			<button type="button" class="btn btn-success" onclick="compareMovies()">So sánh</button>

		</div>

		<!-- Form chọn phim (ẩn ban đầu) -->
		<div id="movieSelectionForm" style="display: none;" class="mt-4">
			<form id="compareForm">
				@csrf
				<label for="movieSelect">Chọn phim:</label>
				<select class="form-select" name="movieSelect" id="movieSelect">
					@foreach ($films as $film)
						<option value="{{ $film->id }}">{{ $film->name_vi }}</option>
					@endforeach
				</select>
				<button type="button" class="btn btn-primary sosanhbtn" onclick="selectMovie()">Chọn</button>
			</form>
		</div>

		<div class="col-md-12 result-form">

			<table class="table table-hover table-bordered text-center" style="display: none">
				<thead>
					<tr>
						<th>So sánh</th>
						<th class="thFilm1"></th>
						<th class="thFilm2"></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>


		<script>
			let filmIds = [];

			// Show form chọn phim
			function showMovieSelectionForm(boxNumber) {
				document.getElementById('movieSelectionForm').style.display = 'block';
				document.getElementById('compareForm').setAttribute('data-box-number', boxNumber);
			}

			function selectMovie() {
				let movieSelect = document.getElementById('movieSelect');
				let filmId = movieSelect.value;
				let filmName = movieSelect.options[movieSelect.selectedIndex].text;
				let boxNumber = document.getElementById('compareForm').getAttribute('data-box-number');

				document.getElementById('movieSelectionForm').style.display = 'none';
				document.getElementById('selectedMovie' + boxNumber).innerHTML = `${filmName}`;

				document.querySelector('.thFilm' + boxNumber).innerHTML = `${filmName}`;
				filmIds[boxNumber - 1] = filmId;

			}

			function compareMovies() {
				$('.img_wrapper1').html("");
				$('.img_wrapper2').html("");
				$('.result-form table tbody').html('');

				if (filmIds.length === 2) {
					$.ajax({
						type: "POST",
						url: "{{ route('phim.sosanhAjax') }}",
						data: {
							'_token': '{{ csrf_token() }}',
							'filmId1': filmIds[0],
							'filmId2': filmIds[1]
						},
						success: function(data) {
							// console.log(data.data);

							$('.result-form table').show();
							$('.sosanhbtn').show()
							$('.box-button').hide()
							$('.box-button').hide()

							let film1 = data.data.film1;
							let film2 = data.data.film2;
							console.log(film1);
							let detail1 = data.data.film1.film_detail;
							let detail2 = data.data.film2.film_detail;

							let revenue1 = data.data.film1.film_revenue;
							let revenue2 = data.data.film2.film_revenue;

							$('.img_wrapper1').append(`<img class="w-50" loading="lazy" src="${film1.img_big}" alt="${film1.name_vi}">`)
							$('.img_wrapper2').append(`<img class="w-50" loading="lazy" src="${film2.img_big}" alt="${film2.name_vi}">`)
							$('.result-form table tbody').append(`
							<tr>
								<td>Năm phát hành</td>
								<td>${film1.year}</td>
								<td>${film2.year}</td>
							</tr>
							<tr>
								<td>Chi phí (Dự kiến)</td>
								<td>${(film1.budget != "") ? parseFloat(film1.budget).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) : '-'}</td>
								<td>${(film2.budget != "") ? parseFloat(film2.budget).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) : '-'}</td>
							</tr>
							<tr>
								<td>Doanh thu toàn thế giới</td>
								<td>${parseFloat(film1.worldwide).toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
								<td>${parseFloat(film2.worldwide).toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
							</tr>
							<tr>
								<td>Lợi nhuận</td>
								<td>${(film1.budget != "") ? (((parseFloat(film1.worldwide) - parseFloat(film1.budget)) / parseFloat(film1.worldwide)) * 100).toFixed(2) + '%' : '-'}</td>
								<td>${(film2.budget != "") ? (((parseFloat(film2.worldwide) - parseFloat(film2.budget)) / parseFloat(film2.worldwide)) * 100).toFixed(2) + '%' : '-'}</td>
							</tr>`)
							console.log(detail1);
							console.log(detail2);



						},
						error: function(error) {
							console.error(error);
						}
					});
				} else {
					alert('Vui lòng chọn đủ 2 phim trước khi so sánh.');
				}
			}
		</script>
	</div>
</div>

@include('home.layout.footer')
