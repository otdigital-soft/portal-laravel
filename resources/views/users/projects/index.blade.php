@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 tg-lgcolwidthhalf">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Projects</h2>
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
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                            <tr data-category="active">
                                <td data-title="">
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                                        <span>{{ $loop->iteration }}</span>
                                        <label for="tg-adone"></label>
                                    </span>
                                </td>
                                <td data-title="Name">
                                    <h3>{{ $project->title }}</h3>
                                </td>
                                <td data-title="Name">
                                    <p>{{ $project->description }}</p>
                                </td>
                                <td data-title="Action">
                                    <div class="tg-btnsactions">
                                        <a class="tg-btnaction tg-btnactionview" href="{{ route('projects.show', $project->id) }}"><i class="fa fa-eye"></i></a>
                                        <a class="tg-btnaction tg-btnactionview" href="{{ route('projects.show', $project->id) }}"><i class="fa fa-eye"></i></a>
                                        <span class="tg-btnaction tg-btnactiondelete tg-like {{ Auth::user() && Auth::user()->subscribedProjects->contains($project) ? 'tg-liked' : '' }} add-to-subscribedProjects" data-project-id="{{ $project->id }}" style="top:auto; right:auto"><i class="fa fa-bell"></i></span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{ 'No project'}}
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="tg-pagination">
                        {{ $projects->links() }}
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
        </div>
</section>
@endsection
@section('scripts')
<script>
    let addToSubscriptionsBtns = document.querySelectorAll('.add-to-subscribedProjects');
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    addToSubscriptionsBtns.forEach(addToSubscriptionsBtn => {
        let projectId = addToSubscriptionsBtn.getAttribute('data-project-id');
        addToSubscriptionsBtn.addEventListener('click', () => {
            console.log('i clicked o');
            const url = `{{ url('projects/${projectId}/favorite') }}`
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.on_subscription) {
                        addToSubscriptionsBtn.classList.add('tg-liked');
                        addToSubscriptionsBtn.innerHTML = `<i class="fa fa-bell"></i>`;
                    } else {
                        addToSubscriptionsBtn.classList.remove('tg-liked');
                        addToSubscriptionsBtn.innerHTML = `<i class="fa fa-bell-slash"></i>`;
                    }
                });
        });
    });
</script>
@endsection
