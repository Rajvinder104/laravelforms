@extends('layout')
@section('title')
    Reports
@endsection
@section('content')
    <div class="heading">
        <h4>
            {{ $header }}
        </h4>
    </div>
    <div class="my-2">
        {!! $field !!}
    </div>
    <table class="table table-responsive">
        <thead>
            {!! $thead !!}
        </thead>

        <tbody>
            @foreach ($tbody as $key => $value)
                {!! $value !!}
            @endforeach
        </tbody>
    </table>
    <div class="Custum-pagination">
        {{ $records->links('pagination') }}
    </div>
@endsection
