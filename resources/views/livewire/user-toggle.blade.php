<div>
    @if($active)
    <button wire:click="toggle" class="btn btn-warning">
            Active
    </button>
        @else
        <button wire:click="toggle" class="btn btn-success">
            Not Active
        </button>
        @endif
</div>
