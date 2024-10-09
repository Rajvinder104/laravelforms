@extends('layout')
@section('title')
    WELCOME
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('form.index') }}" class="btn btn-primary form-control btn-sm">News Report</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('form.create') }}" class="btn btn-warning form-control btn-sm">Create News</a>
        </div>
        <div class="col-md-6 mt-3">
            <a href="{{ route('user.create') }}" class="btn btn-danger form-control btn-sm">Add New User</a>
        </div>
        <div class="col-md-6 mt-3">
            <a href="{{ route('user.index') }}" class="btn btn-success form-control btn-sm">Users Report</a>
        </div>
        <div class="col-md-6 mt-3">
            <a href="{{ route('popup.create') }}" class="btn btn-secondary form-control btn-sm">Add Popup Image</a>
        </div>
        <div class="col-md-6 mt-3">
            <a href="{{ route('popup.index') }}" class="btn btn-primary form-control btn-sm">Update Popup Image</a>
        </div>
        <div class="col-md-6 mt-3">
            <a href="{{ route('admin.create') }}" class="btn btn-success form-control btn-sm">Admin</a>
        </div>
        <div class="col-md-6 mt-3">
            <a href="{{ route('admin.create') }}" class="btn btn-warning form-control btn-sm">Send Email</a>
        </div>

    </div>
@endsection
