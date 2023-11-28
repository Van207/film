<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Crawl;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\DB;

class ThuThapController extends Controller
{

	// Thu thập list film theo năm
	function crawl1_name_link_year($year)
	{

		$url = "https://www.boxofficemojo.com/year/world/$year/"; // Thay thế URL của trang web bạn muốn crawl
		$count = 0;
		$client = new Client();
		$crawler = $client->request('GET', $url);
		$links = $crawler->filter('a.a-link-normal');

		$links->each(function ($node) use ($year, &$count) {
			$href = $node->attr('href');
			$name = $node->text();
			if (str_contains($href, '/releasegroup')) {
				$link = "https://www.boxofficemojo.com" . $href;

				$phim_check = DB::table('films')
					->where('year', $year)
					->where('name', $name)
					->exists();

				if ($phim_check) {
					$public = 1;
				} else {
					$public = 0;
				}
				$result = DB::table('film_store')->insertOrIgnore([
					'name' => $name,
					'link' => $link,
					'year' => $year,
					'status' => '1',
					'public' => $public
				]);
				if ($result) {
					$count++;
				}
			}
		});
		return $count;
	}


	// Thu thập chi tiết phim và doanh thu theo quốc gia
	function crawl2_detail()
	{
		$film = DB::table('film_store')
			->select('id', 'name', 'link')
			->where('status', '1')
			->first();

		if ($film) {

			$id = $film->id;
			$link = $film->link;

			// Thực hiện crawl
			$client = new Client();
			$crawler = $client->request('GET', $link);

			// Crawl ảnh (image)
			$image_html = $crawler->filter('.a-col-left.a-fixed-left-grid-col > .mojo-primary-image img');
			if ($image_html) {
				$image = $image_html->attr('src');
			} else {
				$image = "";
			}
			// echo $image;


			// Crawl tóm tắt phim (summary)
			$summary_html = $crawler->filter('.a-col-right.a-fixed-left-grid-col > p.a-size-medium');
			if ($summary_html) {
				$summary = $summary_html->text();
			} else {
				$summary = "";
			}
			// echo '<br>' . $summary;

			// Doanh thu nội địa _ nước ngoài _ toàn thế giới
			$domestic_international_worldwide_html = $crawler->filter('.mojo-performance-summary-table .a-section.a-spacing-none .a-size-medium.a-text-bold');
			if ($domestic_international_worldwide_html) {
				$domestic = trim($domestic_international_worldwide_html->eq(0)->text());
				$international = trim($domestic_international_worldwide_html->eq(1)->text());
				$worldwide = trim($domestic_international_worldwide_html->eq(2)->text());
			}
			// echo '<br>' . $domestic . '<br>' . $international . '<br>' . $worldwide;


			// Lấy link chứa detail, lần sau crawl tiếp
			$link_title = $crawler->filter('#title-summary-refiner .mojo-title-link');
			if ($link_title) {
				$title_summary_link = 'https://www.boxofficemojo.com' . $link_title->attr('href');
			} else {
				$title_summary_link = "";
			}
			// echo '<br>' . $title_summary_link;

			if ($title_summary_link != "") {
				$imdb_url = str_replace("www.boxofficemojo.com", "www.imdb.com", $title_summary_link);
				$parsed_url = parse_url($imdb_url);
				$link_imdb = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
			}
			// echo '<br>' . $link_imdb;

			DB::table('film_store')
				->where('id', $id)
				->update([
					'image' => $image,
					'summary' => $summary,
					'domestic' => $domestic,
					'international' => $international,
					'worldwide' => $worldwide,
					'title_summary_link' => $title_summary_link,
					'link_imdb' => $link_imdb,
					'status' => '2',

				]);


			// Thu thập doanh thu theo quốc gia (film_revenue)
			$table_html = $crawler->filter('.releases-by-region-section table.releases-by-region');
			if ($table_html->count() > 0) {
				$table_html->each(function ($table) use ($id) {
					$country_list = $table->filter('tr');

					if ($country_list->count() > 0) {
						$country_list->each(function ($country)  use ($id) {
							if ($country->filter('td:nth-child(1) a')->count() > 0) {
								$country_name = trim($country->filter('td:nth-child(1) a')->text());
								$release_date = trim($country->filter('td:nth-child(2)')->text());
								$opening = trim($country->filter('td:nth-child(3)')->text());
								$gross = trim($country->filter('td:nth-child(4)')->text());
								DB::table('film_store_revenue')->insertOrIgnore([
									'film_id' => $id,
									'country' => $country_name,
									'release_date' => $release_date,
									'opening' => $opening,
									'gross' => $gross,
								]);
							}
						});
					} else {
						// echo "no country list";
					}
				});
				DB::table('film_store')
					->where('id', $id)
					->update([
						'status' => '3',
					]);
			} else {
				// echo "No table";
			}
		} else {
			// echo "Hết dữ liệu";
		}
	}


	// Thu thập bảng chi tiết phim (film_detail)
	function crawl3_film_detail()
	{
		$film = DB::table('film_store')
			->select('id', 'title_summary_link')
			->where('status', '3')
			->first();

		if ($film) {
			$id = $film->id;
			$title_summary_link = $film->title_summary_link;

			// Thực hiện crawl
			$client = new Client();
			$crawler = $client->request('GET', $title_summary_link);
			$summary_tables = $crawler->filter('#a-page > main > div > div.a-section.a-spacing-none.mojo-gutter.mojo-summary-table > div.a-section.a-spacing-none.mojo-summary-values.mojo-hidden-from-mobile > div');;
			$summary_tables->each(function ($node) use ($id) {
				$title = strtolower(trim($node->filter('span:nth-child(1)')->text()));
				$detail = strtolower(trim($node->filter('span:nth-child(2)')->text()));
				if ($title != "imdbpro") {
					DB::table('film_store_detail')->insertOrIgnore([
						'film_id' => $id,
						'title' => $title,
						'details' => $detail,
					]);
				}
			});

			DB::table('film_store')
				->where('id', $id)
				->update([
					'status' => '4',
				]);
		} else {
			// echo "HẾT";
		}
	}

	// Thu thập cast và url_media
	function crawl4_imdb()
	{
		$film = DB::table('film_store')
			->select('id', 'name', 'link_imdb')
			->where('status', '4')
			->first();

		if ($film) {
			$id = $film->id;
			$name_en = $film->name;
			$link = $film->link_imdb;

			// Thực hiện crawl
			$client = new Client();
			$crawler = $client->request('GET', $link);
			$name = $crawler->filter('h1.sc-afe43def-0 span');
			$budget_text = $crawler->filter('span:contains("Budget")');

			// Crawl name_vi và budget
			if ($name->count() > 0) {
				$name_vi = $name->text();
			} else {
				$name_vi = $name_en;
			}

			if ($budget_text->count() > 0) {
				$divNode = $budget_text->nextAll()->filter('div')->first();
				$ulNode = $divNode->filter('ul');
				$liNode = $ulNode->filter('li');
				$spanNode = $liNode->filter('span');
				$budget = $spanNode->count() > 0 ? $spanNode->text() : '';
			} else {
				$budget = '';
			}

			// echo "$name_vi - $budget";
			// END Crawl name_vi và budget


			// Crawl link cast (film_cast)
			$list_cast = $crawler->filter('.title-cast__grid .sc-bfec09a1-5');
			if ($list_cast->count() > 0) {
				$list_cast->each(function ($cast) use ($id) {
					$castImgNode  = $cast->filter('div div div img');
					$cast_img = $castImgNode->count() > 0 ? $castImgNode->attr('src') : '';

					$castNameNode = $cast->filter('div:nth-child(2) a.sc-bfec09a1-1');
					$cast_name = $castNameNode->count() > 0 ? $castNameNode->text() : '';

					$castRoleNode = $cast->filter('div:nth-child(2) .title-cast-item__characters-list ul li a span.sc-bfec09a1-4');
					$cast_role = $castRoleNode->count() > 0 ? $castRoleNode->text() : '';

					// echo "$cast_name - $cast_role - $cast_img" . '<br>';

					DB::table('film_store_cast')->insertOrIgnore([
						'film_id' => $id,
						'avatar' => $cast_img,
						'name' => $cast_name,
						'role' => $cast_role,
					]);
				});
			} else {
				// echo "no cast";
			}

			// END Crawl link cast (film_cast)


			// Crawl link media
			$media_viewer = $crawler->filter('a.ipc-lockup-overlay.ipc-focusable');
			if ($media_viewer->count() > 0) {
				$href = $media_viewer->attr('href');
				$url_media = $href && strpos($href, '/') === 0 ? 'https://www.imdb.com' . $href : $href;
			} else {
				$url_media = '';
			}
			// END Crawl link media

			DB::table('film_store')
				->where('id', $id)
				->update([
					'name_vi' => $name_vi,
					'budget' => $budget,
					'url_media' => $url_media,
					'status' => '5',
				]);
		} else {
			// echo 'HẾT RỒI';
		}
	}


	// Thu thập ảnh chất lượng cao
	function crawl5_img()
	{
		$film = DB::table('film_store')
			->select('id', 'name', 'url_media')
			->where('status', '5')
			->where('url_media', '!=', '')
			->first();
		if ($film) {
			$id = $film->id;
			$film_name = $film->name;
			$url = $film->url_media;

			// Thực hiện crawl
			$client = new Client();
			$crawler = $client->request('GET', $url);
			$name = $crawler->filter('h1.sc-afe43def-0 span');
			$img = $crawler->filter('img.sc-7c0a9e7c-0');
			if ($img->count() > 0) {
				$img_big = $img->attr('src');
			} else {
				$img_big = 'nồ';
			}
			DB::table('film_store')
				->where('id', $id)
				->update([
					'img_big' => $img_big,
					'status' => '6',
				]);
			// echo $img_big;
			return $film_name;
		}
	}

	public function list()
	{
		$title = "Quản lý thu thập";
		$crawl = Crawl::all();
		return view('admin.component.crawl.index', compact('title', 'crawl'));
	}

	function edit($id)
	{
		$title = "Cài đặt thu thập";
		$crawl = Crawl::find($id);
		return view('admin.component.crawl.edit', compact('title', 'crawl'));
	}

	function update($id, Request $request)
	{
		$crawl = Crawl::find($id);
		$crawl->name = $request->name;
		$crawl->year = $request->year;
		$crawl->start = $request->start;
		$crawl->schedule = $request->schedule;

		$crawl->save();
		return redirect()->route('crawl.index')->with('msg', "Cập nhật thành công");
	}

	function run_tien_trinh($unique_name)
	{
		$check = DB::table('crawl')
			->where('unique_name', $unique_name)
			->where('start', 1)
			->first();
		if ($check) {
			if ($unique_name == 'crawl_list' && $check->year != '0') {
				$count = $this->crawl1_name_link_year($check->year);
				return redirect()->route('crawl.index')->with('msg', "Đã tổng hợp được $count phim");
			} else {
				$this->crawl2_detail();
				$this->crawl3_film_detail();
				$this->crawl4_imdb();
				$name = $this->crawl5_img();
				return redirect()->route('crawl.index')->with('msg', "Tổng hợp thành công chi tiết và doanh thu phim <b>$name</b>");
			}
		} else {
			return redirect()->route('crawl.index')->with('err', 'Tiến trình chưa được bật');
		}
	}

	public function storage()
	{
		$title = "Dữ liệu thu thập";
		$film_store = DB::table('film_store')->simplePaginate(25);

		return view('admin.component.crawlStorage.index', compact('title', 'film_store'));
	}


	public function view($id)
	{
		$film = DB::table('film_store')
			->where('id', $id)
			->first();
		if ($film) {
			$title = "Chi tiết phim " . $film->name_vi;
			$details = DB::table('film_store_detail')
				->where('film_id', $id)
				->get();

			$casts = DB::table('film_store_cast')
				->where('film_id', $id)
				->get();
			$revenues = DB::table('film_store_revenue')
				->where('film_id', $id)
				->get();
			return view('admin.component.crawlStorage.view', compact('title', 'film', 'casts', 'details', 'revenues'));
		} else {
			abort(404);
		}
	}

	public function public_film($store_id)
	{
		$store = DB::table('film_store')
			->where('id', $store_id)
			->select(
				'name',
				'name_vi',
				'image',
				'img_big',
				'url_media',
				'summary',
				'link',
				'title_summary_link',
				'link_imdb',
				'budget',
				'worldwide',
				'domestic',
				'international',
				'year',
				'status'
			)
			->first();

		if ($store) {
			$budget = $this->chuanHoaSo($store->budget);
			$domestic = $this->chuanHoaSo($store->domestic);
			$worldwide = $this->chuanHoaSo($store->worldwide);
			$international = $this->chuanHoaSo($store->worldwide);

			$film_id = DB::table('films')->insertGetId([
				'name' => $store->name,
				'name_vi' => $store->name_vi,
				'image' => $store->image,
				'img_big' => $store->img_big,
				'url_media' => $store->url_media,
				'summary' => $store->summary,
				'link' => $store->link,
				'title_summary_link' => $store->title_summary_link,
				'link_imdb' => $store->link_imdb,
				'budget' => $budget,
				'worldwide' => $worldwide,
				'domestic' => $domestic,
				'international' => $international,
				'year' => $store->year,
				'status' => $store->status,
			]);

			// Thêm detail film_detail
			$store_details = DB::table('film_store_detail')
				->select('title', 'details')
				->where('film_id', $store_id)->get();
			if (count($store_details) > 0) {
				foreach ($store_details as $detail) {
					if ($detail->title == 'domestic distributor') {
						DB::table('film_detail')->insert([
							'film_id' => $film_id,
							'title' => $detail->title,
							'details' => preg_replace("/see full company information/i", "", $detail->details),
						]);
					} else if ($detail->title == 'domestic opening') {
						DB::table('film_detail')->insert([
							'film_id' => $film_id,
							'title' => $detail->title,
							'details' => $this->chuanHoaSo($detail->details),
						]);
					}
					// genres
					else if ($detail->title == 'genres') {
						DB::table('film_detail')->insert([
							'film_id' => $film_id,
							'title' => $detail->title,
							'details' => ucfirst(str_replace(' ', ',', $detail->details)),
						]);
					} else {
						DB::table('film_detail')->insert([
							'film_id' => $film_id,
							'title' => $detail->title,
							'details' => $detail->details,
						]);
					}
				}
			}

			$revenues = DB::table('film_store_revenue')
				->select('country', 'release_date', 'opening', 'gross')
				->where('film_id', $store_id)->get();

			if (count($revenues) > 0) {
				foreach ($revenues as $revenue) {
					DB::table('film_revenue')->insert([
						'film_id' => $film_id,
						'country' => $revenue->country,
						'release_date' => $revenue->release_date,
						'opening' => $this->chuanHoaSo($revenue->opening),
						'gross' => $this->chuanHoaSo($revenue->gross),
					]);
				}
			}


			$casts = DB::table('film_store_cast')
				->select('avatar', 'name', 'role')
				->where('film_id', $store_id)->get();

			if (count($casts) > 0) {
				foreach ($casts as $cast) {
					DB::table('film_cast')->insert([
						'film_id' => $film_id,
						'avatar' => $cast->avatar,
						'name' => $cast->name,
						'role' => $cast->role,
					]);
				}
			}
			// Cuối cùng update trạng thái
			DB::table('film_store')->where('id', $store_id)->update(['public' => 1]);
		}

		return redirect()->route('crawl.storage')->with('msg', "Đã public thành công");
	}


	public function chuanHoaSo($text)
	{
		$text = preg_replace("/\(estimated\)/", "", $text);
		$text = preg_replace("/[^0-9]/", "", $text);
		$text = floatval($text);
		return $text;
	}

	public function filter(Request $request)
	{
		$name = $request->input('name');
		$year = $request->input('year');
		$public = $request->input('public');

		$film = DB::table('film_store');
		// dd($name, $year);
		if ($name && $name != "") {
			$film->where('name', 'LIKE', "%{$name}%")->orWhere('name_vi', 'LIKE', "%{$name}%");
		}

		if ($year && $year != '0') {
			$film->where('year', $year);
		}
		if ($public !== null) {
			$film->where('public', $public);
		}


		$film_store = $film->simplePaginate(25)->appends(['name' => $name, 'year' => $year, 'public' => $public]);

		$title = "Danh sách phim";
		return view('admin.component.crawlStorage.index', compact('title', 'film_store'));
	}

	function cronjob_tien_trinh($unique_name)
	{
		$check = DB::table('crawl')
			->where('unique_name', $unique_name)
			->where('start', 1)
			->first();
		if ($check) {
			if ($unique_name == 'crawl_list' && $check->year != '0') {
				$count = $this->crawl1_name_link_year($check->year);
				return response()->json(["message" => "Đã tổng hợp được <b>$count</b> phim trong năm <b>$check->year</b>"]);
			} else {
				$this->crawl2_detail();
				$this->crawl3_film_detail();
				$this->crawl4_imdb();
				$name = $this->crawl5_img();
				return response()->json(["message" => "Tổng hợp thành công chi tiết và doanh thu phim <b>$name</b>"]);
			}
		} else {
			return response()->json(["message" => "Tiến trình chưa được bật"]);
		}
	}
}
