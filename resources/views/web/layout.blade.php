<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
      @include('web.common.meta')


  </head>
    <!-- dir="rtl" -->
    <body class="animation-s1"  dir="{{ session('direction')}}">

    // Facebook Script


      <!-- Header Content -->
        <?php echo $final_theme['header']; ?>
       <!-- End Header Content -->
<!--        --><?php //echo $final_theme['mobile_header']; ?>
       <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
      <!-- END NOTIFICATION CONTENT -->
         @yield('content')



      <!-- Footer content -->

      <?php  echo $final_theme['footer']; ?>

      <!-- End Footer content -->
      <?php  echo $final_theme['mobile_footer']; ?>


      <div class="mobile-overlay"></div>
      <!-- Product Modal -->


      <a href="web/#" id="back-to-top" title="Back to top">&uarr;</a>

      <div class="modal" tabindex="-1" id="myModal" role="dialog" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div class="container" id="products-detail">

                    </div>
                  </div>
            </div>
          </div>
      </div>

      <!-- Include js plugin -->
       @include('web.common.scripts')
      @yield('scripts')
    </body>
</html>

