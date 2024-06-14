@if ($message = Session::get('success'))
    <div class="alert alert-custom alert-success alert-shadow gutter-b" role="alert">
        <div class="alert-icon">
            <i class="flaticon2-check-mark icon-xl"></i>

        </div>
        <div class="alert-text">{{$message}}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>

@endif

@if ($message = Session::get('error'))
    <div class="alert alert-custom alert-danger alert-shadow gutter-b" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning icon-xl"></i>
        </div>
        <div class="alert-text">{{$message}}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>

@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-custom alert-warning alert-shadow gutter-b" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning icon-xl"></i>
        </div>
        <div class="alert-text">{{$message}}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-custom alert-info alert-shadow gutter-b" role="alert">
        <div class="alert-icon">
            <i class="flaticon-info icon-xl"></i>
        </div>
        <div class="alert-text">{{$message}}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
        <div class="alert-icon">
            <i class="flaticon-info icon-xl"></i>
        </div>
        <div class="alert-text">{{$message}}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif
