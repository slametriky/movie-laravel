<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Movies</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Libraries -->
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>
<body class="layout-2">
  <div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<nav class="navbar navbar-expand-lg main-navbar">
			<a href="{{ url('/') }}" class="navbar-brand sidebar-gone-hide">Movies</a>
			<a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
			
			<ul class="navbar-nav">
				<!-- Dropdown -->
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
					Categories
				  </a>
				  <div class="dropdown-menu">
					@foreach ($categories as $category)
						<a class="dropdown-item" @click="getMovie({{ $category->id }})" href="javascript:void(0)">{{ $category->name }}</a>											
					@endforeach
				  </div>
				</li>

				<li class="nav-item justify-content-end">
					<a class="nav-link" href="{{ route("form-login") }}">Login</a>
				</li>
			</ul>
		</nav>
	</div>
					
	<div class="container-fluid">
	
		<section class="section" style="margin-top:100px;postion:">
			<h1 class="section-title">List Movies</h1>
			<div class="row">				
				<div v-if="movieData.length == 0" class="col-12">
					<p class="text-center">Please Select Movie Category</p>
				</div>
				<div v-else v-for="(data, index) in movieData" :key="data.id" class="col-12 col-md-3 col-lg-3">
					<article class="article article-style-c">
						<div class="article-header">
							<img class="card-img-top" :src="data.poster_path | image" alt="Card image">
						</div>
						<div class="article-details">
							<div class="article-title">
								<h3 class="text-center">@{{ data.original_title }}</h3>
							</div>
							<p class="text-justify">
								@{{ data.overview.substr(0, 80) }}												
							</p>
							<div class="text-center">
								<button class="btn btn-primary">Detail</button>
							</div>
						</div>
					</article>
				</div>									
			</div>
		</section>
		
	</div>

  </div>
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  <script src="../assets/js/vue.js"></script>
  <script src="../assets/js/stisla.js"></script>
  <!-- JS Libraies -->
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
  <!-- Page Specific JS File -->

  <script>

	new Vue({
		el: '#app',
		data: {
			movieData:[],
		},
		mounted() {
		},
		methods:{

			getMovie(id){
				axios.get(`/movies/${id}`, {                                
				})
				.then((res) => {               
					
					if(res.data.results.length > 0){
						this.movieData = res.data.results;
					} else {
						this.movieData = [];
					}					

				}, (error) => {
					console.log(error);
				}).finally(() => {
					
				})
			},
			
		}, //end vue
		filters: {
			image: (value) => {

				let url = 'https://image.tmdb.org/t/p/original'+value;

				return url;
			},
		},
	});

</script>
</body>
</html>