 @yield('modals')

 <script>
   var resizefunc = [];
 </script>

 <!-- jQuery  -->
 <script src="{{url('assets/js/jquery.min.js')}}"></script>
 <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
 <script src="{{url('assets/js/detect.js')}}"></script>
 <script src="{{url('assets/js/fastclick.js')}}"></script>

 <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
 <script src="{{url('assets/js/jquery.blockUI.js')}}"></script>
 <script src="{{url('assets/js/waves.js')}}"></script>
 <script src="{{url('assets/js/wow.min.js')}}"></script>
 <script src="{{url('assets/js/jquery.nicescroll.js')}}"></script>
 <script src="{{url('assets/js/jquery.scrollTo.min.js')}}"></script>

 @yield('script')

 <script src="{{url('assets/js/jquery.core.js')}}"></script>
 <script src="{{url('assets/js/jquery.app.js')}}"></script>
 @yield('scriptcode')