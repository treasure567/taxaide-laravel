<!-- BEGIN: Footer For Desktop and tab -->
        <footer class="md:block hidden" id="footer">
          <div class="site-footer px-6 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-300 py-4 ltr:ml-[248px] rtl:mr-[248px]">
            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-5">
              <div class="text-center ltr:md:text-start rtl:md:text-right text-sm"> COPYRIGHT © <span id="thisYear"></span> {{ env('APP_NAME') }}, All rights Reserved </div>
              </div>
            </div>
          </div>
        </footer>
        <!-- END: Footer For Desktop and tab -->
      </div>
    </main>
    <!-- scripts -->
    <!-- Core Js -->
    <script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
    <script src="{{ url('/') }}/assets/js/rt-plugins.js"></script>
    <script src="{{ assets('js/toastr.js') }}"></script>
    <script src="{{ assets('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('/') }}/assets/js/popper.js"></script>
    <script src="{{ url('/') }}/assets/js/tw-elements-1.0.0-alpha13.min.js"></script>
    <script src="{{ url('/') }}/assets/js/SimpleBar.js"></script>
    <script src="{{ url('/') }}/assets/js/iconify.js"></script>
    <!-- Jquery Plugins -->
    <!-- app js -->
    <script src="{{ url('/') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ url('/') }}/assets/js/app.js"></script>
    <script src="{{ assets('js/selectrows.min.js') }}"></script>
    <script src="{{ assets('js/overlay.js') }}"></script>
    <script src="{{ assets('js/server.js') }}"></script>
  </body>
</html> 

<script>
  toastr.options.timeOut = 5000;
  toastr.options.progressBar = true;
  toastr.options.positionClass = "toast-top-centre";
  @if (Session::has('success_alert'))
    sweet('Success!!', "{!! Session::get('success_alert') !!}", 'success');
  @elseif(Session::has('danger_alert')) 
    sweet('Error!!', "{!! Session::get('danger_alert') !!}", 'error');
  @endif
</script>