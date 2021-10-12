<div>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Create Orders
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
            <a href="{{route('admin.orders.create')}}" class="dropdown-item">{{__("auth.create")}} {{__("names.order")}}</a>
            </li>
            <li>
                @can('order-import')
                    <button type="button" wire:click="on" class="dropdown-item" data-toggle="modal" data-target="#importModal">
                        Import
                    </button>
                @endcan
            </li>


        </div>
    </div>
    @if($importon)
        <div class="col-md-12">
{{--            <form  wire:submit.prevent="import" enctype="multipart/form-data" >--}}
{{--                @csrf--}}
{{--                <div class="">--}}
{{--                    <input type="file" wire:model="importFile" class="@error('import_file') is-invalid @enderror">--}}
{{--                    <input type="submit" class="btn btn-outline-secondary" value="Import">--}}
{{--                    <a href="{{route}}"></a>--}}
{{--                    @error('import_file')--}}
{{--                    <span class="invalid-feedback" role="alert">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="mt-4 flex items-center">--}}
{{--                    <label for="header">{{__('File contains header row?')}}</label>--}}
{{--                    <input id="header" class="ml-1" type="checkbox" name="header" checked/>--}}
{{--                </div>--}}
{{--            </form>--}}


            <form action="{{route('admin.import.orders')}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('POST')
                <input type="file" name="import_file">
                <button type="submit"  class="btn btn-primary">Import</button>
            </form>

{{--            @if($importing && !$importFinished)--}}
{{--                <div wire:poll="updateImportProgress">Importing...please wait.</div>--}}
{{--            @endif--}}

{{--            @if($importFinished)--}}
{{--                Finished importing.--}}
{{--            @endif--}}
        </div>


    @endif

</div>
