@extends('layouts.main')

@section('content')
@php
$subscribers = $project->subscribers()->paginate(5);
$events = $project->events()->paginate(5);
if (optional(auth()->user()->role)->name == 'leader') {
$blogPosts = $project->blogPosts()->where('user_id', auth()->user()->id)->paginate(5);
}else{
$blogPosts = $project->blogPosts()->paginate(5);
}

@endphp
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Project Details</h2>
                </div>
                <div class="tg-dashboardholder">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="{{ $project->title }}" readonly>
                    </div>
                    <div class="form-group">
                        <textarea id="" class="form-control" name="description" placeholder="Enter Description"
                            readonly>{{ $project->description }}</textarea>
                    </div>
                    {{-- <button class="tg-btn" type="submit">Add</button> --}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 tg-lgcolwidthhalf">

            @if(optional(auth()->user()->role)->name == 'admin')
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Subscribers</h2>
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
                                <th>Full Name of Subscribers</th>
                                {{-- <th>Description</th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $subscriber)
                            <tr data-category="active">
                                <td data-title="">
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                                        <span>{{ $loop->iteration }}</span>
                                        <label for="tg-adone"></label>
                                    </span>
                                </td>
                                <td data-title="Name">
                                    <h3>{{ $subscriber->name }}</h3>
                                </td>
                                {{-- <td data-title="Name">
                                    <p>{{ $subscriber->description }}</p>
                                </td> --}}
                                {{-- <td data-title="Action">
                                    <div class="tg-btnsactions">
                                        <a class="tg-btnaction tg-btnactiondelete" href="#"
                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to remove this subscriber? You cannot undo this process.')) { document.getElementById('delete-subscriber-{{ $subscriber->id }}').submit(); }"><i
                                                class="fa fa-trash"></i></a>
                                        <form id="delete-subscriber-{{ $subscriber->id }}"
                                            action="{{ route('subscriber.delete', $subscriber->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                            @empty
                            {{ 'No subscriber'}}
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="tg-pagination">
                        {{ $subscribers->links() }}
                    </nav>
                </div>
            </div>
            @endif

            @if (optional(auth()->user()->role)->name == 'admin' || optional(auth()->user()->role)->name == 'leader')
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Blog Posts</h2>
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
                                <th>Name</th>
                                <th>Content</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogPosts as $post)
                            <tr data-category="active">
                                <td data-title="">
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                                        <span>{{ $loop->iteration }}</span>
                                        <label for="tg-adone"></label>
                                    </span>
                                </td>
                                <td data-title="Name">
                                    <h3>{{ $post->title }}</h3>
                                </td>
                                <td data-title="Content">
                                    <p>{{ Str::limit(strip_tags($post->content), 100, '...') }}</p>
                                </td>
                                <td data-title="Created At">
                                    <h3>{{ $post->created_at->format('Y-m-d g:i a') }}</h3>
                                </td>
                                <td data-title="Updated At">
                                    <h3>{{ $post->updated_at->format('Y-m-d g:i a') }}</h3>
                                </td>
                                <td data-title="Action">
                                    <div class="tg-btnsactions">
                                        <a class="tg-btnaction tg-btnactionedit" href="{{ route('blog-posts.edit', $post->id) }}"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                        <a class="tg-btnaction tg-btnactiondelete" href="#"
                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this post? You cannot undo this process.')) { document.getElementById('delete-post-{{ $post->id }}').submit(); }"><i
                                                class="fa fa-trash"></i></a>
                                        <form id="delete-post-{{ $post->id }}"
                                            action="{{ route('blog-posts.delete', $post->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{ 'No post'}}
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="tg-pagination">
                        {{ $blogPosts->links() }}
                    </nav>
                </div>
            </div>
            @endif

            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Events</h2>
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
                                <th>Name</th>
                                <th>Date</th>
                                <th>Starts</th>
                                <th>Ends</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr data-category="active">
                                <td data-title="">
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                                        <span>{{ $loop->iteration }}</span>
                                        <label for="tg-adone"></label>
                                    </span>
                                </td>
                                <td data-title="Name">
                                    <h3>{{ $event->name }}</h3>
                                </td>
                                <td data-title="Date">
                                    <h3>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</h3>
                                </td>
                                <td data-title="Start Time">
                                    <h3>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}</h3>
                                </td>
                                <td data-title="End Time">
                                    <h3>{{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} </h3>
                                </td>
                                <td data-title="Description">
                                    <p>{{ $event->description }}</p>
                                </td>
                                <td data-title="Action">
                                    <div class="tg-btnsactions">
                                        @if(auth()->user()->id == $event->organizer->id)
                                        {{-- <a class="tg-btnaction tg-btnactionedit" href="{{ route('events.edit') }}"><i
                                                class="fa fa-pencil-square-o"></i></a> --}}
                                                <a class="tg-btnaction tg-btnactionedit" href="javascript:void(0);" onclick="openEditEventModal({{ json_encode($event) }})"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                        @endif
                                        <a class="tg-btnaction tg-btnactionview"
                                            href="{{ route('events.show', $event->id) }}"><i class="fa fa-eye"></i></a>
                                        @if (optional(auth()->user()->role)->name == 'admin' || auth()->user()->id ==
                                        $event->organizer->id)
                                        <a class="tg-btnaction tg-btnactiondelete" href="#"
                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this event? You cannot undo this process.')) { document.getElementById('delete-event-{{ $event->id }}').submit(); }"><i
                                                class="fa fa-trash"></i></a>
                                        <form id="delete-event-{{ $event->id }}"
                                            action="{{ route('events.delete', $event->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{ 'No event'}}
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="tg-pagination">
                        {{ $events->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function openEditEventModal(event) {
        console.log(event);
        // set the value of the event ID input field in the modal
        $('#modal-edit-event').find('input[name="event_id"]').val(event.id);
        $('#modal-edit-event').find('input[name="project_id"]').val(event.project_id);
        $('#modal-edit-event').find('input[name="name"]').val(event.name);
        $('#modal-edit-event').find('input[name="start_time"]').val(event.start_time);
        $('#modal-edit-event').find('input[name="end_time"]').val(event.end_time);
        $('#modal-edit-event').find('textarea[name="description"]').val(event.description);

        // open the modal
        $('#modal-edit-event').modal('show');
    }
</script>
@endsection
