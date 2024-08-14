<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.layouts.header')
</head>

<body>
    <div class="admin">
        <div class="row g-0">
               <div class="col-md-3">
                    @include('admin.layouts.sidebar')
               </div>
               <div class="col-md-9">
                @include('admin.layouts.navbar')
               @yield('content')
              </div>
          </div>
    </div>
</body>
@include('admin.layouts.footer')
</html>
