@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('frontendnew/images/logo1.JPG') }}" style="width: 160px;" class="logo" alt="Laravel Logo">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
