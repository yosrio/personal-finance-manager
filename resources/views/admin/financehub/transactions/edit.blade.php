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
    <div class="row justify-content-start">
        <a href="javascript:history.back()" style="text-decoration: none;display: inline-block; width: 7%; padding: 10px;">
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Back
        </a>
        <div class="col-md-12">
            <br>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <form id="transactionForm" method="POST" action="{{ route('financehub_transactions_save') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input
                                type="number"
                                class="form-control"
                                id="amount" name="amount"
                                placeholder="Enter amount"
                                value="{{ isset($transaction) ? $transaction->amount : old('amount') }}"
                                required
                            />
                        </div>
                        @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="custom-select" id="type" name="type" >
                                        @foreach($types as $type)
                                            @if (isset($transaction) && ($transaction->type === $type))
                                                <option value="{{ $type }}" selected>
                                                    {{ ucfirst($type) }}
                                                </option>
                                            @else
                                                <option value="{{ $type }}">
                                                    {{ ucfirst($type) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="custom-select" id="category_id" name="category_id" >
                                        @foreach($categories as $category)
                                            @if (isset($transaction) && ($transaction->category->id === $category->id))
                                                <option value="{{ $category->id }}" selected>
                                                    {{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea
                                class="form-control"
                                rows="3"
                                id="description"
                                name="description"
                                placeholder="Enter description"
                            >{{ isset($transaction) ? $transaction->description : old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{isset($transaction) ? $transaction->id : ''}}" />
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a type="submit" href="{{ route('financehub_transactions') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection