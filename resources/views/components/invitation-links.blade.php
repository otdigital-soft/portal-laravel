<style>
    table.invite-codes {
        border-collapse: collapse;
        width: 100%;
    }

    table.invite-codes td,
    table.invite-codes th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    table.invite-codes th {
        background-color: #f2f2f2;
    }

    table.invite-codes tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.invite-codes tr:hover {
        background-color: #ddd;
    }
</style>
<script>
    function copyToClipboard(event, text) {
        event.preventDefault();
        var input = document.createElement('textarea');
        input.innerHTML = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
    }
</script>

<div class="invitation-links">
    <table class="invite-codes">
        <thead>
            <tr>
                <th>Invitation Code</th>
                <th>Invitation Link</th>
                <th>Name of Invited</th>
                <th>Username of Redeemer</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse ($invitationLinks as $invitationLink)
            <tr>
                <td>
                    <div class="d-flex">
                        {{ $invitationLink['code'] }}
                        <a href="#" onclick="copyToClipboard(event, '{{ $invitationLink['code'] }}')" title="Copy code to clipboard">
                            <i class="fas fa-copy fa-lg text-primary"></i>
                        </a>
                    </div>
                </td>
                <td class="d-flex">
                    {!! route('referrer', ['ref_code' => $invitationLink['code']]) !!}
                    <a href="#" onclick="copyToClipboard(event, '{{ route('referrer', ['ref_code' => $invitationLink['code']]) }}')" title="Copy link to clipboard">
                        <i class="fas fa-copy fa-lg text-primary ml-2"></i>
                    </a>
                </td>
                <td>{{ $invitationLink['expected_invitee'] ?? null }}</td>
                <td>{{ auth()->user()->whoIsthis($invitationLink['redeemer']) != null ?
                    auth()->user()->whoIsthis($invitationLink['redeemer'])->name : '' }}</td>
                @php
                $status = '';
                if ($invitationLink['status'] && $invitationLink['verified']) {
                $status = 'success';
                $message = 'Verified';
                }elseif ($invitationLink['status'] && !$invitationLink['verified']) {
                $status = 'warning';
                $message = 'Pending';
                }elseif ($invitationLink['expired'] && !$invitationLink['status']) {
                $status = 'danger';
                $message = 'expired';
                }else{
                $status = 'default';
                $message = 'Not Used Yet';
                }
                @endphp
                <td>
                    <span class="inline-block px-2 py-1 rounded-full text-xs font-bold text-white bg-label-{{$status}}">{{
                        $message }}</span>
                    @if($message == 'pending')
                    <a href="{{ route('invitation.accept', ['ref_code' => $invitationLink['code']]) }}" style="background-color: #276ebe;" class="btn px-2 py-1 rounded-full text-xs font-bold text-white bg-label-primary text-white m-3 font-bold py-1 px-2 rounded">
                        {{ __('Accept') }}
                    </a>
                    @endif
                </td>
            </tr>
            @empty
            <p>You have not created any Invitation Codes yet. Click the button to Generate a new one.</p>
            @endforelse
        </tbody>
    </table>
</div>

<!-- @push('scripts') -->
<!-- @endpush -->
