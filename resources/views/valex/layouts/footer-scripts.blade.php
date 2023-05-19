<!-- Back-to-top -->
<a href="#top" class="bg-primary-gradient" id="back-to-top"><i class='bx bxs-chevrons-up bx-xs'></i></a>
<script src="{{asset('js/app.js')}}" ></script>
@livewireScripts

<script>
    window.livewire.on('alert', param => {
        toastr[param['type']](param['message']);
    });
</script>



@yield('js')
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>

<!-- custom js -->
<script src="{{URL::asset('js/custom.js')}}"></script>
<!-- Left-menu js-->
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

