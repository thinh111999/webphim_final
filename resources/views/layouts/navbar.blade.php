<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('info.create')}}">Thông tin website</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('category.create')}}">Danh mục</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('genre.create')}}">Thể loại</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('country.create')}}">Quốc gia</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('movie.index')}}">Phim</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('episode.create')}}">Tập phim</a>
        </li>

      </ul>
      {{-- <form class="d-flex">
        <input class="form-control me-2" type="search" id="search-input" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
      <div id="search-results">
        <!-- Kết quả tìm kiếm sẽ được hiển thị ở đây -->
    </div>
      <script>
          // Lấy các phần tử DOM cần sử dụng
          const searchForm = document.getElementById('search-form');
          const searchInput = document.getElementById('search-input');
          const searchResults = document.getElementById('search-results');
      
          // Xử lý sự kiện submit của form
          searchForm.addEventListener('submit', function (e) {
              e.preventDefault(); // Ngăn chặn form submit lại
      
              const searchTerm = searchInput.value.trim(); // Lấy giá trị từ ô input và loại bỏ khoảng trắng
      
              // Kiểm tra nếu ô tìm kiếm không rỗng
              if (searchTerm !== '') {
                  // Gửi yêu cầu tìm kiếm đến máy chủ (có thể sử dụng AJAX hoặc fetch API)
                  // Ở đây tôi sẽ giả định rằng bạn đã có một hàm tìm kiếm trên máy chủ và nó trả về kết quả dưới dạng HTML
                  // Ví dụ: fetchResults(searchTerm);
      
                  // Giả định kết quả từ máy chủ
                  const searchResultHTML = '<p>Kết quả tìm kiếm: ...</p>'; // Thay thế bằng kết quả thực tế
      
                  // Hiển thị kết quả tìm kiếm trong phần tử #search-results
                  searchResults.innerHTML = searchResultHTML;
              }
          });
      </script>
    </div>
  </div>
</nav>