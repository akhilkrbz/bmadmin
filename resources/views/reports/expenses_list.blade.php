<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Ledger</th>
            <th>Amount</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->voucher_date }}</td>
                <td>{{ $expense->ledger->title }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
                <td>{{ $expense->description }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-end"><strong>Total:</strong></td>
            <td>{{ number_format($expenses->sum('amount'), 2) }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>