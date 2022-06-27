@extends('admin.layouts.admin')
@section('page-header')

@endsection

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-">
                <h1 class="text-center">@lang('auth.app-setting')</h1>

                <p class="text-center">@lang('messages.setting') </p>

                <form action="{{route('admin.system')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="auto_send" value="0">


                    <div class="form-group row mb-0">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success">
                                @lang('Save')
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>



@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#company_logo').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
@endsection
