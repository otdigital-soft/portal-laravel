@extends('layouts.main')
@section('styles')
<style>
    .mb-2 {
        margin-bottom: 20px !important;
    }
</style>
@endsection
@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-sellertitle">
                <h1>Event Detail</h1>
            </div>
            <div class="tg-sellercontact">
                <div class="tg-memberinfobox">
                    <div class="tg-memberinfo">
                        <h3 class="mb-2">{{ $event->name }}</h3>
                        <span><i class="icon-calendar"></i> Start Time: {{ $event->start_time }}</span>
                        <span><i class="icon-calendar"></i> End Time: {{ $event->end_time }}</span>
                        <span><i class="icon-location"></i> Location: {{ $event->location }}</span>
                        <span>{{ $event->description }}</span>
                        {{-- <a class="tg-btnseeallads" href="javascript:void(0);">See All Ads</a> --}}
                    </div>
                </div>
                @if(auth()->user() && !$event->attendees->contains(auth()->user()))
                <form method="POST" action="{{ route('events.signup', $event) }}">
                    @csrf
                    <label for="tg-priceoncall">Would you like to sign up for this event?</label>
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </form>
                @elseif(auth()->user() && $event->attendees->contains(auth()->user()))
                <form method="POST" action="{{ route('events.cancel', $event) }}">
                    @csrf
                    @method('DELETE')
                    <label for="tg-priceoncall">Would you like to cancel your registration for this event?</label>
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
                @endif
                {{-- <span id="add-to-subscriptions"
                    class="tg-like {{ Auth::user() && Auth::user()->subscribedProjects->contains($project) ? 'tg-liked' : '' }}"
                    data-project-id="{{ $project->id }}"><i class="fa fa-bell">Subscribe</i></span> --}}
            </div>
        </div>
    </div>

    @if ($event->organizer->id == auth()->user()->id || optional(auth()->user()->role)->name == 'admin')
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 tg-lgcolwidthhalf">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Event Attendees</h2>
                </div>
                <div class="tg-dashboardholder">
                    <table id="tg-adstype" class="table tg-dashboardtable tg-tablemyads">
                        <thead>
                            <tr>
                                <th>
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-checkedall" type="checkbox" name="myads" value="checkall"> -->
                                        #
                                        <label for="tg-checkedall"></label>
                                    </span>
                                </th>
                                <th>Full Name of Attendees</th>
                                {{-- <th>Description</th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($event->attendees as $attendee)
                            <tr data-category="active">
                                <td data-title="">
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                                        <span>{{ $loop->iteration }}</span>
                                        <label for="tg-adone"></label>
                                    </span>
                                </td>
                                <td data-title="Name">
                                    <h3>{{ $attendee->name }}</h3>
                                </td>
                            </tr>
                            @empty
                            {{ 'No Attendees for this event'}}
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="tg-pagination">
                        {{-- {{ $subscribers->links() }} --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection
