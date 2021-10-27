<div>
    @forelse($notifications as $notification)

        <div class="card bd-0 mg-b-20">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="{{$notification->data['url']}}">
                        <h4 class="mg-b-20 card-title">{{$notification->data['from']}} </h4>
                        <p>{{$notification->data['msg']}}</p>
                    </a>
                    <div class="d-flex flex-column justify-content-between">
                        <livewire:main.mark-as-read :notification="$notification" />
                        <small class="d-flex" ><i class='bx bx-time-five bx-xs'></i>{{$notification->created_at->diffForHumans()}}</small>
                    </div>

                </div>
            </div>
        </div>

    @empty
        <p class="text-center">{{ __('messages.no-notifications') }}</p>
        <div class="col-md-8 offset-md-2">
            <img src="http://blackbox.me/assets/img/svgicons/no-data.svg" alt="" class="mx-auto d-block">
        </div>
    @endforelse
</div>
