<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="https://res.cloudinary.com/dxkd6xlpq/image/upload/c_crop,g_center,h_860,q_auto:best,w_860/c_scale,h_60,q_auto:best,w_60/v1677214100/logos/logo%20icon/ICON-BLACK-TP_tlflbj.png" class="logo" alt="Shifft Marketplace Logo"></img>
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>
