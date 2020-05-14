<main id="scrollbar-body" data-scrollbar>
    <!-- banner wrap -->
    <section class="main-warp">
      <div class="container">
        <div class="banner">
          <div id="banner-Carousel" class="carousel slide banner-carousel" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach($result['slides'] as $k => $slide)
                <div class="<?php if($k == 0){ echo 'carousel-item active';} else { echo 'carousel-item'; } ?>">
                    <figure class="figure-banner" style="background-image: url('<?php echo 'public/'.$slide->path; ?>');"></figure>
                </div>
                @endforeach
            </div>

            <!-- Indicators -->
            <ol class="carousel-indicators">
                @foreach($result['slides'] as $k => $slide)
              <li data-target="#banner-Carousel" data-slide-to="$k" class="<?php if($k == 0){ echo 'active';} else { echo ''; } ?>"></li>
                @endforeach
            </ol>

            <!-- Left and right controls -->
            <a class="carousel-control-prev " href="#banner-Carousel" data-slide="prev">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner-Carousel" data-slide="next">
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
{{--      </div>--}}
{{--    </section>--}}
{{--</main>--}}
