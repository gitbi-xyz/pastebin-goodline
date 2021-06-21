@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10">
            <h6>New paste</h6>
            <form action="" method="post">
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-2">
            <h6>Public pastes</h6>
        </div>
    </div>
@endsection
