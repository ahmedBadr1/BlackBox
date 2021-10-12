<div>

   <button wire:click="toggle" class="btn btn-danger">

       @if($active)
       <i class="fa fa-heart"></i>
           @else
           <i class="fa fa-heart-broken   "></i>
       @endif
   </button>
</div>
