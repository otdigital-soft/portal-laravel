@extends('layouts.main')
@section('styles')
<style>
    /* For mobile devices, stack table rows vertically */
    @media screen and (max-width: 767px) {
        table#tg-adstype tbody tr {
            display: block;
            margin-bottom: 10px;
        }

        /* Hide table headers */
        table#tg-adstype thead {
            display: none;
        }

        /* Display table cells as block-level elements */
        table#tg-adstype tbody td {
            display: block;
            text-align: right;
        }

        /* Add a "data-title" attribute to each cell */
        table#tg-adstype tbody td:before {
            content: attr(data-title);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
            margin-right: 10px;
            border-right: 1px solid #eee;
        }

        /* Add padding to checkbox cells */
        table#tg-adstype tbody td:first-child {
            padding-top: 20px;
        }

        .tg-btnaction {
            margin: 5px;
            float: right;
            border-radius: 5px;
            font-size: 12px;
        }

        /* Add margin to input element to create some space between input and button */
        form#ref-form div {
            margin-bottom: 10px;
        }

        /* Set input and button elements to display block */
        form#ref-form input[type=text] {
            margin-bottom: 5px;
        }

        form#ref-form button {
            border-radius: 5px;
        }

        form#ref-form input[type=text],
        form#ref-form button {
            display: block;
            width: 100%;
        }
    }
</style>
@endsection
@section('content')
<div class="tg-dashboardbox">
    <div class="tg-dashboardboxtitle">
        <h2>Invite Friends to Shifft and Manage Invitation Codes</h2>
    </div>
    <div class="tg-dashboardholder">
        <nav class="tg-navtabledata">
            <ul>
                <li class="tg-active"><a href="_.html">Invitation Codes</a></li>
                <!-- <li><a href="javascript:void(0);" data-category="packageone">Package 01 (12)</a></li>
                <li><a href="javascript:void(0);" data-category="packagetwo">Package 02 (42)</a></li>
                <li><a href="javascript:void(0);" data-category="packagethree">Package 03 (03)</a></li> -->
            </ul>
        </nav>
        <div class="tg-otherfilters">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 pull-left">
                    <!-- <div class="form-group tg-sortby">
                        <span>Sort by:</span>
                        <div class="tg-select">
                            <select>
                                <option>Most Recent</option>
                                <option>Most Recent</option>
                                <option>Most Recent</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-6 pull-right">
                    <form method="POST" action="{{ route('get.referrer.link') }}" id="ref-form">
                        @csrf
                        <div>
                            <x-input id="redeemer" class="block mt-1" placeholder="Expected Redeemer" type=" text" name="redeemer" :value="null" required autofocus style="display: inline;" />
                            <x-button class="tg-btn">{{ __('Generate Invitation Codes') }}</x-button>
                        </div>
                    </form>
                    <!-- <div class="form-group tg-inputwithicon">
                        <i class="icon-magnifier"></i>
                        <input type="search" name="search" class="form-control" placeholder="Search Here">
                    </div> -->
                </div>
            </div>
        </div>
        <table id="tg-adstype" class="table tg-dashboardtable tg-payments">
            <thead>
                <tr>
                    <th>
                        <span class="tg-checkbox">
                            <!-- <input id="tg-checkedall" type="checkbox" name="myads" value="checkall"> -->
                            #
                            <label for="tg-checkedall"></label>
                        </span>
                    </th>
                    <th>Invitation Code</th>
                    <th>Invitation Link</th>
                    <th>Name of Invited </th>
                    <th>Name of Redeemer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($refCodes as $invitationLink)
                <tr data-category="packageone">
                    <td>
                        <span class="tg-checkbox">
                            <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                            {{ $loop->iteration }}
                            <label for="tg-adone"></label>
                        </span>
                    </td>
                    <td data-title="Invitation Code">
                        <span>
                            {{ $invitationLink['code'] }}
                        </span>
                        <a href="#" onclick="copyToClipboard(event, '{{ $invitationLink['code'] }}')" title="Copy code to clipboard">
                            <i class="icon-copy"></i>
                        </a>
                    </td>
                    <td data-title="Invitation Link">{!! route('referrer', ['ref_code' => $invitationLink['code']]) !!}
                        <a href="#" onclick="copyToClipboard(event, '{{ route('referrer', ['ref_code' => $invitationLink['code']]) }}')" title="Copy link to clipboard">
                            <i class="icon-copy"></i>
                        </a>
                    </td>
                    <td data-title="Name of Invited">
                        <h3>{{ $invitationLink['expected_invitee'] ?? null }}</h3>
                    </td>
                    <td data-title="Name of Redeemer">
                        <h3>{{ auth()->user()->whoIsthis($invitationLink['redeemer']) != null ?
                    auth()->user()->whoIsthis($invitationLink['redeemer'])->name : '' }}</h3>
                    </td>
                    @php
                    $status = '';
                    if ($invitationLink['status'] && $invitationLink['verified']) {
                    $status = 'success';
                    $message = 'verified';
                    }elseif ($invitationLink['status'] && !$invitationLink['verified']) {
                    $status = 'warning';
                    $message = 'pending';
                    }elseif ($invitationLink['expired'] && !$invitationLink['status']) {
                    $status = 'danger';
                    $message = 'expired';
                    }else{
                    $status = 'default';
                    $message = 'not in use';
                    }
                    @endphp
                    <td data-title="Status">
                        <div class="tg-btnsactions">
                            <a class="tg-btnaction tg-btnactionview text-white bg-label-{{$status}}" href=" javascript:void(0);" style="width: auto; padding: 0 10px">{{
                        $message }}</a>
                            @if($message == 'pending')
                            <a class="tg-btnaction tg-btnactionedit" href="{{ route('invitation.accept', ['ref_code' => $invitationLink['code']]) }}" style="width: auto; padding: 0 10px; background-color: #276ebe; color: #ffffff;">{{ __('Accept') }}</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <p>No Invitation Code. Click the button to Generate</p>
                @endforelse
            </tbody>
        </table>
        <nav class="tg-pagination">
            {{ $refCodes->links() }}
            <!-- <ul>
                <li class="tg-prevpage"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li class="tg-active"><a href="#">5</a></li>
                <li>...</li>
                <li><a href="#">10</a></li>
                <li class="tg-nextpage"><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul> -->
        </nav>
    </div>
</div>
<div class="tg-dashboardbox">
    <div class="tg-dashboardboxtitle">
        <h2>Referral Hierarchy Tree</h2>
    </div>
    <div class="tg-dashboardholder">
        <div class="tf-tree example">
            <ul>
                @foreach ($hierarchicalData as $hierarchyNode)
                <li>
                    <span class="tf-nc">{{ $hierarchyNode['user']->username }}</span>
                    @if (count($hierarchyNode['children']) > 0)
                    @include('partials.treeflex', ['hierarchicalData' => $hierarchyNode['children']])
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
@section('scripts')
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
@endsection
