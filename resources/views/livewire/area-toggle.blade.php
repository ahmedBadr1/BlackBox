<div>
    @if($active)
        <button wire:click="toggle" class="btn btn-warning">
            <i class="fa fa-power-off"></i>
        </button>
    @else
        <button wire:click="toggle" class="btn btn-success">
            <i class="fa fa-podcast"></i>
        </button>
    @endif
</div>
