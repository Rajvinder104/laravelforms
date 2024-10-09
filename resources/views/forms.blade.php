@extends('layout')
@section('title')
    Forms
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7 form-brand">
            <div class="heading">
                <h4>
                    {{ $header }}
                </h4>
            </div>
            {{ $form_open }}
            @csrf
            @foreach ($form as $key => $value)
                <div class="form-group">
                    @php
                        // Apply the validation classes based on whether there are errors or old input
                        $inputClass = $errors->has($key) ? 'is-invalid' : (old($key) ? 'is-valid' : '');
                        $value = str_replace('form-control', 'form-control ' . $inputClass, $value);
                    @endphp
                    {!! $value !!}
                    <div class="valid-feedback">Looks good!</div>
                </div>

                <span class="text-brand">
                    @error($key)
                        {{ $message }}
                    @enderror
                </span>
            @endforeach
            {{ $form_button }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
