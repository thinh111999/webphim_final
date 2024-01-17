{{-- thay đổi danh mục --}}
    <script type="text/javascript">
        $('.category_choose').change(function(){
            var category_id = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('category-choose')}}",
                method: "GET",
                data:{
                    category_id:category_id, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi danh mục thành công');
                }
            });
        })
    </script>

{{-- thay đổi quốc gia --}}
    <script type="text/javascript">
        $('.country_choose').change(function(){
            var country_id = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('country-choose')}}",
                method: "GET",
                data:{
                    country_id:country_id, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi quốc gia thành công');
                }
            });
        })
    </script>

{{-- thay đổi phụ đề --}}
    <script type="text/javascript">
        $('.phude_choose').change(function(){
            var phude = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('phude-choose')}}",
                method: "GET",
                data:{
                    phude:phude, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi phụ đề thành công');
                }
            });
        })
    </script>

{{-- thay đổi phim hot --}}
    <script type="text/javascript">
        $('.phim_hot_choose').change(function(){
            var phim_hot = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('phim_hot-choose')}}",
                method: "GET",
                data:{
                    phim_hot:phim_hot, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi phim hot thành công');
                }
            });
        })
    </script>

{{-- thay đổi trạng thái --}}
    <script type="text/javascript">
        $('.status_choose').change(function(){
            var status = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('status-choose')}}",
                method: "GET",
                data:{
                    status:status, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi trạng thái phim thành công');
                }
            });
        })
    </script>

{{-- thay đổi thuộc phim --}}
    <script type="text/javascript">
        $('.thuocphim_choose').change(function(){
            var thuocphim = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('thuocphim-choose')}}",
                method: "GET",
                data:{
                    thuocphim:thuocphim, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi thuộc phim thành công');
                }
            });
        })
    </script>

{{-- thay đổi định dạng phim --}}
    <script type="text/javascript">
        $('.resolution_choose').change(function(){
            var resolution = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{route('resolution-choose')}}",
                method: "GET",
                data:{
                    resolution:resolution, 
                    movie_id:movie_id
                },
                success: function(data) {
                    alert('Thay đổi định dạng phim thành công');
                }
            });
        })
    </script>

{{-- thay đổi hình ảnh phim --}}
    <script type="text/javascript">
        $(document).on('change', '.file_image', function(){
            var movie_id = $(this).data('movie_id');
            var files = $("#file-"+movie_id)[0].files;

            console.log(files);

            var image = document.getElementById("file-"+movie_id).files[0];
            var form_data = new FormData();
                form_data.append("file", document.getElementById("file-"+movie_id).files[0]);
                form_data.append("movie_id",movie_id);

            $.ajax({
                url: "{{route('update-image-movie-ajax')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data:form_data,

                contentType:false,
                cache:false,
                processData:false,

                success: function() {
                    location.reload();
                    $('#success_image').html('<span class="text-success"> Cập nhật hình ảnh thành công </span>');
                }
            });
        })
    </script>

{{-- select episode phim --}}
    <script type="text/javascript">
        $('.select-movie').change(function(){
            var id = $(this).val();
            $.ajax({
                url: "{{route('select-movie')}}",
                method: "GET",
                data:{id:id},
                success: function(data) {
                    $('#show_movie').html(data);
                }
            });
        })
    </script>

{{-- select year --}}
    <script type="text/javascript">
        $('.select-year').change(function() {
            var year = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            // alert(year);
            // alert(id_phim);
            $.ajax({
                url: "{{ url('/update-year-phim') }}",
                method: "GET",
                data: {
                    year: year,
                    id_phim: id_phim
                },
                success: function(data) {
                    alert('Thay đổi năm phim theo năm ' + year + ' thành công');
                console.log(data);
                }
            });
        })
    </script>

{{-- select season --}}
    <script type="text/javascript">
        $('.select-season').change(function() {
            var season = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            // alert(year);
            // alert(id_phim);
            $.ajax({
                url: "{{ url('/update-season-phim') }}",
                method: "GET",
                data: {
                    season: season,
                    id_phim: id_phim
                },
                success: function(data) {
                    alert('Thay đổi mùa phim theo season ' + season + ' thành công');
                console.log(data);
                }
            });
        })
    </script>

{{-- select top view --}}
    <script type="text/javascript">
        $('.select-topview').change(function() {
            var topview = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            // alert(year);
            // alert(id_phim);
            if(topview==0){
                var text ='Ngày';
            }else if(topview==1){
                var text ='Tuần';
            }else{
                var text ='Tháng';
            }
            $.ajax({
                url: "{{ url('/update-topview-phim') }}",
                method: "GET",
                data: {
                    topview: topview,
                    id_phim: id_phim
                },
                success: function(data) {
                    alert('Thay đổi phim theo top view ' + text + ' thành công');
                console.log(data);
                }
            });
        })
    </script>
    {{-- <script type="text/javascript">
        $(document).ready( function () {
            $('#search-input').DataTable();
        } );
        </script> --}}
{{-- loại bỏ dấu cho slug và tìm kiếm phim, phân trang--}}
    <script type="text/javascript">
    $(document).ready( function () {
        $('#tablephim').DataTable
        ({
            // Các cài đặt khác của DataTables ở đây
            columnDefs: [
                { type: 'search-ascii', targets: '_all' } // Kích hoạt tìm kiếm không phân biệt dấu
            ]
        });
    });
        function ChangeToSlug() {
            var slug;
            // Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();

            // Tạo một bộ từ điển để ánh xạ các ký tự có dấu sang không dấu
            var charMap = {
                'à': 'a', 'á': 'a', 'ả': 'a', 'ã': 'a', 'ạ': 'a',
                'ă': 'a', 'ắ': 'a', 'ằ': 'a', 'ẳ': 'a', 'ẵ': 'a', 'ặ': 'a',
                'â': 'a', 'ấ': 'a', 'ầ': 'a', 'ẩ': 'a', 'ẫ': 'a', 'ậ': 'a',
                'è': 'e', 'é': 'e', 'ẻ': 'e', 'ẽ': 'e', 'ẹ': 'e',
                'ê': 'e', 'ế': 'e', 'ề': 'e', 'ể': 'e', 'ễ': 'e', 'ệ': 'e',
                'ì': 'i', 'í': 'i', 'ỉ': 'i', 'ĩ': 'i', 'ị': 'i',
                'ò': 'o', 'ó': 'o', 'ỏ': 'o', 'õ': 'o', 'ọ': 'o',
                'ô': 'o', 'ố': 'o', 'ồ': 'o', 'ổ': 'o', 'ỗ': 'o', 'ộ': 'o',
                'ơ': 'o', 'ớ': 'o', 'ờ': 'o', 'ở': 'o', 'ỡ': 'o', 'ợ': 'o',
                'ù': 'u', 'ú': 'u', 'ủ': 'u', 'ũ': 'u', 'ụ': 'u',
                'ư': 'u', 'ứ': 'u', 'ừ': 'u', 'ử': 'u', 'ữ': 'u', 'ự': 'u',
                'ỳ': 'y', 'ý': 'y', 'ỷ': 'y', 'ỹ': 'y', 'ỵ': 'y',
                'đ': 'd'
            };

            // Sử dụng bộ từ điển để ánh xạ các ký tự có dấu sang không dấu
            slug = slug.replace(/./g, function (matched) {
                return charMap[matched] || matched;
            });

            // Thay thế khoảng trắng bằng dấu gạch ngang
            slug = slug.replace(/\s+/g, '-');

            // Xóa các ký tự không phải là chữ cái và không phải là dấu gạch ngang
            slug = slug.replace(/[^a-z0-9-]+/g, '');

            // Xóa các ký tự gạch ngang ở đầu và cuối
            slug = slug.replace(/^-+|-+$/g, '');

            // In slug ra textbox có id “convert_slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

{{-- sắp xếp thứ tự    --}}
    <script type="text/javascript">
        $('.order_position').sortable({
            placeholder : 'ui-state-highlight',
            update: function(event,ui){
                var array_id = [];
                $('.order_position tr').each(function(){
                    array_id.push($(this).attr('id'));
                })
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{route('resorting')}}",
                    method:"POST",
                    data:{array_id:array_id},
                    success:function(data){
                        alert('sắp xếp thứ tự thành công');
                    }
                })
            }
        })
    </script>
