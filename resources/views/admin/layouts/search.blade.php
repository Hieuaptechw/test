<form class="form-inline my-2 my-lg-0 d-flex" action="{{ route('search') }}" method="GET">
    <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search" id="search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> LogOut
    </a>
</form>

<div id="search-results"></div>

<form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();

        $.ajax({
            url: '{{ route("search") }}',
            data: { query: query },
            success: function(response) {
                $('#search-results').html(response.html);
            }
        });
    });
});

</script>
