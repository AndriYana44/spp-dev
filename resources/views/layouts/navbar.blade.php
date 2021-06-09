<div class="app-header white box-shadow">
    <div class="navbar">
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
          <i class="material-icons">&#xe5d2;</i>
        </a>
        <!-- / -->

        <!-- Page title - Bind to $state's title -->
        <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

        <!-- navbar right -->
        <ul class="nav navbar-nav pull-right">
          <li class="nav-item dropdown">
            <a class="nav-link clear" href data-toggle="dropdown">
              <span class="avatar w-32">
                <img src="{{ asset('') }}img/user.png" alt="...">
                <i class="on b-white bottom"></i>
              </span>
            </a>
          </li>
        </ul>
        <!-- / navbar right -->

        <!-- navbar collapse -->
        <div class="collapse navbar-toggleable-sm" id="collapse">
            <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
            <!-- link and dropdown -->
            <ul class="nav navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href data-toggle="dropdown">
                  <i class="fa fa-fw fa-book text-muted"></i>
                  SISTEM PEMBAYARAN SPP
                </a>
                <div ui-include="'../views/blocks/dropdown.new.html'"></div>
              </li>
            </ul>
            <!-- / -->
          </div>
          <!-- / navbar collapse -->
    </div>
</div>
