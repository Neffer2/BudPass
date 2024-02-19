@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'BudPass')
<img src="https://www.budpass.co/assets/budweiser/logo-budweiser.svg" class="logo" alt="Budweiser logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
