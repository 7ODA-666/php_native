<!doctype html>
@php 
 $lang = get_local();
 $dir = $lang == 'ar' ? 'rtl' : 'ltr';
@endphp

<html lang="{{ $lang }}" dir="{{ $dir }}">
    <?php view('layout.header', ['title' => trans('main.home')]);?>
  <body>
    <?php view('layout.navbar') ?>


    <div class="container align-content-center mt-5">
        <h1 class="text-center">
                {{ trans('main.home_page') }}
        </h1>

       
            @if(session_has('success'))
                <div class="alert alert-success text-center m-4">
                    {{ session_delete('success'); }}
                </div>
            @endif
          
        
        <div class="col-md-6 offset-md-3 mt-5">
            <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data">
              <div class="form-group mb-2">
                  <label for="file">{{ trans('main.choose_file') }}</label>
                  <input type="file" class="form-control" id="file" name="file">
              </div>
              <div class="form-group mb-2">
                  <label for="email">{{ trans('main.email') }}</label>
                  <input type="text" class="form-control " id="email" name="email"
                            value="{{ old('email') ?? '' }}">
                  {{ render_validation_errors('email') }}
              </div>
              <div class="form-group mb-2">
                  <label for="phone">{{ trans('main.phone') }}</label>
                  <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') ?? '' }}">
                  {{ render_validation_errors('phone') }}
              </div>
              <div class="form-group mb-2">
                  <label for="address">{{ trans('main.address') }}</label>
                  <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') ?? '' }}">
                  {{ render_validation_errors('address') }}
              </div>
              <button type="submit" class="btn btn-primary mt-2">{{ trans('main.save') }}</button>
            </form>
        </div>

        <div class="col-md-6 offset-md-3 mt-3">
            <a class="btn btn-success" href="{{ url('storage/users/images/shams.jpeg') }}">{{ trans('main.view_uploaded_file') }}</a>
            <a class="btn btn-danger" href="{{ url('delete/file') }}">{{ trans('main.delete_uploaded_file') }}</a>
        </div>
        
    </div>
    

 
    
    
    <?php view('layout.footer') ?>
  </body>
</html>


