<div class="col-lg-8">
    <div class="card custom-card">
        <div class="card-header custom-card-header">
            <div class="d-flex justify-content-between">
                <h6 class="card-title mb-0">@lang('names.pickups-timeline')</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="vtimeline">
                @forelse($tasks as $k => $task)

                    <div
                        class="timeline-wrapper @if($k % 2 !== 0) timeline-inverted @endif @if($task->due_to < now()) timeline-wrapper-success @else timeline-wrapper-primary @endif">
                        <div class="timeline-badge d-flex align-content-between"><i
                                class="bx bx-briefcase-alt-2 bx-sm "></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h6 class="timeline-title">@lang('names.'.$task->type)</h6>
                            </div>
                            <div class="timeline-body">
                                <p>@lang('auth.location') : {{$task->location->name}}</p>
                                <p>{{$task->notes ?? __('names.no-notes')}}</p>
                            </div>
                            <div class="timeline-footer d-flex  justify-content-between flex-wrap">

                                    <span ><i class="bx bx-calendar text-muted mr-1"></i>{{$task->due_to_for_humans}}</span>
                                    <span wire:click="delete({{ $task->id }})" role="button" class=" cursor-pointer " data-placement="top"
                                          data-toggle="tooltip" title="@lang('auth.delete-pickup')">
                                    <i class="bx bx-trash bx-sm text-danger "></i>
                                </span>


                            </div>
                        </div>
                    </div>
                @empty
                    <p>{{ __('messages.no-pickups') }}</p>
                    <div class="col-md-8 offset-md-2">
                        <img src="http://blackbox.me/assets/img/svgicons/no-data.svg" alt="" class="mx-auto d-block">
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


