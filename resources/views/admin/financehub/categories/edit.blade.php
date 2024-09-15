@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <br>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <form id="userForm" method="POST" action="{{ route('financehub_categories_save') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name" name="name"
                                placeholder="Enter name"
                                value="{{ isset($category) ? $category->name : old('name') }}"
                                required
                            />
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{isset($category) ? $category->id : ''}}" />
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a type="submit" href="{{ route('users') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection