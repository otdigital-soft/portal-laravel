@extends('layouts.main')
@section('styles')
<style>
    figure>img {
        width: 200px;
        height: 200px;
        margin: 10px;
        position: relative;
    }
</style>
@endsection
@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <form method="POST" action="{{ route('events.store', $project->id) }}" enctype="multipart/form-data" class="tg-formtheme tg-formdashboard">
            @csrf
            <fieldset>
                <div class="tg-postanad">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <div class="tg-dashboardbox">
                            <div class="tg-dashboardboxtitle">
                                <h2>Create New Event {{ isset($project) ? "For ".$project->title : "" }}</h2>
                            </div>
                            <div class="tg-dashboardholder">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Title*" required>
                                </div>
                                <div class="form-group">
                                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" placeholder="Start Time*" required>
                                </div>
                                <div class="form-group">
                                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" placeholder="End Time*" required>
                                </div>
                                <div class="form-group">
                                    <textarea id="content" class="form-control" name="description" placeholder="Enter event description"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="tg-select">
                                        <select name="location" id="location" required>
                                            <option disabled selected>Select Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <input type="submit" class="tg-btn" style="background-color: #00cc67; border: none" value="Create Event">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">

                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Get today's date and time in the format yyyy-MM-ddThh:mm
      const now = new Date().toISOString().slice(0, 16);

      // Set the default value of the datetime-local input field
      document.getElementById("start_time").value = now;
      document.getElementById("end_time").value = now;
</script>
@endsection
