
<div wire:click="mark" class="btn btn-info-gradient btn-sm">
    @if($notification->read_at)
        @lang('names.read')
    @else
        @lang('names.'.$value)
    @endif
</div>

