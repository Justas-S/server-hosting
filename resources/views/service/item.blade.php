<tr>
    <td>{{ $service->name }}</td>
    <td>{{ $service->ip }}</td>
    <td>@if($service->is_available)Laisvas @else Užimtas @endif</td>
    <td>@if($service->is_available)<a href="{{ route('service.buy', $service->id) }}">Pirkti</a>@endif</td>
</tr>