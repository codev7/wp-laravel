<table>
    <caption>Lite Items</caption>
    <thead>
    <tr>
        <th>Description</th>
        <th>Unit Cost</th>
        <th>Qty</th>
        <th>Line Total</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($invoice->line_items as $item)
    <tr>
        <td>{{ $item['description'] }}</td>
        <td>${{ $item['price'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>${{ $item['price'] * $item['quantity'] }}</td>
    </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="3">Total:</td>
        <td>${{ $invoice->grandAmount }}</td>
    </tr>
    </tfoot>
</table>

<a href="{{ env('APP_URL') }}/project/{{ $invoice->project->slug }}/invoices/{{ $invoice->id }}" target="_blank">Details</a>

{{--
    $invoice->getSpeed() ..
--}}