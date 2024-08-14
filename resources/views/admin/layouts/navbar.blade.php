<div class="row navbar">
  <div class="col-8">
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
  </div>
  <div class="col-4">
    <div class="header-content">
    @include('admin.layouts.search')
    </div>
  </div>
</div>
<form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
  @csrf
</form>