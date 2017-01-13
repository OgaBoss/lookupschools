   <!--NAVIGATION-->
   <div id="navigation">
      <div id="navbar">
         <!-- Navigation Inner -->
         <div class="nav-inner">
            <div class="dark-nav">
               <!-- Site Logo -->
               <div class="site-logo">
                  <a href="/" id="logo" class="logo scrol">
                     <!-- Your Logo -->
                      <img src="/img/LUS.png" alt="" width="100px" height="100px">
                  </a>
               </div>
               <!-- End Site Logo -->
               <a class="mini-nav-button dark"><i class="fa fa-bars"></i></a>
               <!-- Navigation Menu -->
               <div class="nav-menu">
                  <ul class="nav">
                     <li class="current"><a href="#home">Home</a></li>
                     <li><a href="#services">Services</a></li>
                     <li><a href="#Features">Features</a></li>
                     <li><a href="#Adverts">Schools</a></li>
                     <li><a href="#Pricing">Pricing</a></li>
                     <li><a href="#Contact">Contact</a></li>
                      @if(!Sentry::check())
                          <li><a href="/login" class="external">Login</a></li>
                          <li><a href="/signup" class="external">Signup</a></li>
                      @elseif(Sentry::check() && isset($permissions['admin']) && $permissions['admin'] == 1)
                          <li><a href="/admin/home" class="external">Dashboard Home</a></li>
                          <li><a href="/logout" class="external">Logout</a></li>
                      @elseif(Sentry::check() && isset($permissions['user']) && $permissions['user'] == 1)
                          <li><a href="/school/home" class="external">Dashboard Home</a></li>
                          <li><a href="/logout" class="external">Logout</a></li>
                      @elseif(Sentry::check() && isset($permissions['guest']) && $permissions['guest'] == 1)
                          <li><a href="/guest/home" class="external">Dashboard Home</a></li>
                          <li><a href="/logout" class="external">Logout</a></li>
                      @endif

                  </ul>
               </div>
               <!-- End Navigation Menu -->
            </div>
            <!-- End Navigation Inner -->
         </div>
      </div>
   </div>
   <!-- END NAVIGATION -->