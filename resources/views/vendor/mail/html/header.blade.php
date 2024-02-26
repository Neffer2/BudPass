@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'BudPass')
<img src="{{ asset('assets/budweiser/logo-budweiser-mail.png') }}" class="logo" alt="Budweiser logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
