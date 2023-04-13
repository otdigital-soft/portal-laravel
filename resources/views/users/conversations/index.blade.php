@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <!-- <form class="tg-formtheme tg-formdashboard"> -->
        <fieldset>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-dashboardbox">
                    <div class="tg-dashboardboxtitle">
                        <h2>Offers/Messages</h2>
                    </div>
                    <div class="tg-dashboardholder tg-offersmessages tg-offersmessageswithsearch">
                        <ul>
                            <li>
                                <div class="tg-verticalscrollbar tg-dashboardscrollbar" style="overflow-y: scroll;">
                                    @foreach($adsWithConversation as $ad)
                                    <div class="tg-ad tg-dotnotification" data-ad-id="{{ $ad->ad->id }}">
                                        @php
                                        $filepath = $ad->ad->images[0]->filename ?? 'assets/images/ads/img-01.jpg';
                                        @endphp
                                        <figure style="width: 60px; height: 60px"><img src="{{ asset($filepath) }}" alt="image description">
                                        </figure>
                                        <h3>{{ $ad->ad->title }}</h3>
                                    </div>
                                    @endforeach
                                </div>
                            </li>
                            <li>
                                <div id="conversations-container" class="tg-offerers tg-verticalscrollbar tg-dashboardscrollbar" style="overflow-y: scroll;">
                                </div>
                            </li>
                            <li>
                                <div class="tg-chatarea">
                                    <div class="tg-messages tg-verticalscrollbar tg-dashboardscrollbar" id="messages-container" style="overflow-y: scroll;">
                                    </div>
                                    <div class="tg-replaybox">
                                        <form action="" method="POST" data-ad-id="" id="replyForm">
                                            @csrf
                                            <textarea class="form-control hidden" name="reply" placeholder="Type Here &amp; Press Enter"></textarea>
                                        </form>
                                        <!-- <div class="tg-iconbox">
                                            <i class="icon-thumbs-up"></i>
                                            <i class="icon-thumbs-down"></i>
                                            <i class="icon-smile"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </fieldset>
        <!-- </form> -->
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.6/dayjs.min.js"></script>
<script>
    const adElements = document.querySelectorAll('.tg-ad');
    const conversationsContainer = document.getElementById('conversations-container');
    const messagesContainer = document.getElementById('messages-container');
    var textarea = document.querySelector('textarea[name="reply"]');

    adElements.forEach(adElement => {
        adElement.addEventListener('click', () => {
            if (!textarea.classList.contains('hidden')) {
                textarea.classList.add('hidden');
            }
            const adId = adElement.getAttribute('data-ad-id');
            var url = `{{ url('ad-conversations/${adId}') }}`
            // Make AJAX request to fetch conversations related to the clicked ad
            fetch(url)
                .then(response => response.json())
                .then(conversations => {
                    // Render conversations in the conversations container
                    conversationsContainer.innerHTML = '';
                    messagesContainer.innerHTML = '';
                    conversations.forEach(conversation => {
                        const user = conversation.users[0].id == window.userId ? conversation.users[1] : conversation.users[0];
                        const conversationElement = document.createElement('div');
                        conversationElement.classList.add('tg-offerer', 'tg-dotnotification');
                        const image_path = user.image_path != null ? user.image_path : 'assets/images/author/img-07.jpg';
                        conversationElement.innerHTML = `
                        <figure><img src="${image_path}" style="width: 60px; height:60px;" alt="image description"></figure>
                            <h3>${user.first_name} ${user.last_name}</h3>
                            <a class="tg-btndelete icon-arrow-right" href="javascript:void(0);"></a>
                        `;
                        conversationsContainer.appendChild(conversationElement);
                        conversationElement.addEventListener('click', () => {
                            textarea.classList.remove('hidden');
                            // var replyForm = document.getElementById("replyForm");
                            // var replyFormAction = `{{ url('ads/${conversation.ad_id}/messages') }}`
                            // replyForm.setAttribute('action', replyFormAction);
                            var getMessagesUrl = `{{ url('conversations/${conversation.id}') }}`;

                            fetch(getMessagesUrl)
                                .then(response => response.json())
                                .then(response => {
                                    // console.log(response.data.messages);
                                    const messages = response.data.messages;
                                    updateMessageField(messages);
                                });

                            textarea.addEventListener('keydown', function(e) {
                                if (e.keyCode == 13 && !e.shiftKey) {
                                    e.preventDefault();
                                    var message = textarea.value.trim();
                                    if (message != '') {
                                        var url = `{{ url('ads/${conversation.ad_id}/messages') }}`;
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', url);
                                        xhr.setRequestHeader('Content-Type', 'application/json');
                                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                                        xhr.onload = function() {
                                            if (xhr.status === 200) {
                                                fetch(getMessagesUrl)
                                                    .then(response => response.json())
                                                    .then(response => {
                                                        // console.log(response.data.messages);
                                                        const messages = response.data.messages;
                                                        updateMessageField(messages);
                                                    });
                                            } else {
                                                // Handle error
                                            }
                                        };
                                        xhr.onerror = function() {
                                            // Handle error
                                        };
                                        xhr.send(JSON.stringify({
                                            content: message
                                        }));
                                        textarea.value = '';
                                    }
                                }
                            });

                        });
                        // console.log('appended');
                    });
                });
        });
    });

    function updateMessageField(messages) {
        messagesContainer.innerHTML = '';
        messages.forEach(message => {
            const messageElement = document.createElement('div');
            const who = message.user.id == window.userId ? 'tg-memessage' : 'tg-offerer';
            const image_path = message.user.image_path != null ? message.user.image_path : 'assets/images/author/img-07.jpg';
            messageElement.classList.add(who, 'tg-dotnotification');
            messageElement.innerHTML = `<figure><img src="${image_path}" style="width: 30px; height:30px;" alt="image description">
                                                </figure>
                                                <div class="tg-description">
                                                    <p>${message.content}.</p>
                                                    <div class="clearfix"></div>
                                                    <time datetime="2017-08-08">${formatDate(message.created_at)}</time>
                                                    <div class="clearfix"></div>
                                                </div>`;
            messagesContainer.appendChild(messageElement);
        });
    }

    function formatDate(dateStr) {
        const date = dayjs(dateStr);

        const now = dayjs();
        const diffInMinutes = now.diff(date, 'minutes');
        const diffInHours = now.diff(date, 'hours');
        const diffInDays = now.diff(date, 'days');

        if (diffInMinutes < 1) {
            return "Just now";
        } else if (diffInMinutes < 60) {
            return `${diffInMinutes} minute${diffInMinutes > 1 ? "s" : ""} ago`;
        } else if (diffInHours < 24) {
            return `${diffInHours} hour${diffInHours > 1 ? "s" : ""} ago`;
        } else {
            return `${diffInDays} day${diffInDays > 1 ? "s" : ""} ago`;
        }
    }
</script>

@endsection
