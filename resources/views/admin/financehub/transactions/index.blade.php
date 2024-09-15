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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 style="font-weight: 600;"> Finance Transactions </h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a type="submit" class="btn btn-primary" href="{{ route('financehub_transactions_add') }}">Add Transaction</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table">
                        <table id="financeTransactionsTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Transaction Date</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td scope="row">{{ $transaction->id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</td>
                                    <td>{{ 'Rp ' . number_format($transaction->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($transaction->type) }}</td>
                                    <td>{{ $transaction->category->name }}</td>
                                    <td>
                                        <a class="btn btn-primary mr-1 btn-sm" href="{{ route('financehub_transactions_update', $transaction->id) }}">
                                            Edit
                                        </a>
                                        <a class="btn btn-danger deleteItem btn-sm" href="#modalDelete" data-toggle="modal" data-href="{{ route('financehub_transactions_delete', $transaction->id) }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalDelete" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete transaction?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-danger deleteModal">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#financeTransactionsTable').DataTable({
            "columnDefs": [{
                "sortable": false
            }]
        });

        $('.deleteItem').click(function() {
            var href = $(this).data('href');
            $('.deleteModal').attr('href', href);
        });
    });
</script>
@endsection