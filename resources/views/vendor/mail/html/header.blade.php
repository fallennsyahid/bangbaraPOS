@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="cid:logo_bangbara.png" class="logo" alt="BangbaraPOS">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
