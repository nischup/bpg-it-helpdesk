{{-- <div class="col-sm-10 col-md-7 col-lg-3">
    <div class="dashboard-widget mb-30 mb-lg-0">
        <div class="user">
            <div class="thumb-area">
                <div class="thumb">
                    <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="user">
                </div>
            </div>
            <div class="content">
                <h5 class="title"><a href="#0">{{ auth()->user()->name }}</a></h5>
                <span class="username">{{ auth()->user()->email }}</span>
            </div>
        </div>
        <ul class="dashboard-menu">
            <li>
                <a href="{{ route('frontend.dashboard') }}" @if(url()->current() == route('frontend.dashboard')) class="active" @endif><i class="flaticon-dashboard"></i>{{ __('Dashboard') }} </a>
            </li>
            <li>
                <a href="{{ route('frontend.profile') }}" @if(url()->current() == route('frontend.profile')) class="active" @endif><i class="flaticon-settings"></i> {{ __('Personal Profile') }} </a>
            </li>
            <li>
                <a href="{{ route('frontend.catalogue') }}" @if(url()->current() == route('frontend.catalogue')) class="active" @endif><i class="flaticon-settings"></i> {{ __('Catalogue') }} </a>
            </li>
            <li>
                <a href="{{ route('frontend.wallet') }}" @if(url()->current() == route('frontend.wallet')) class="active" @endif><i class="fas fa-wallet"></i> {{ __('Wallet') }} </a>
            </li>
            <li>
                <a href="{{ route('frontend.my-auctions') }}" @if(url()->current() == route('frontend.my-auctions')) class="active" @endif><i class="flaticon-auction"></i>{{ __('Auction list') }}</a>
            </li>

            <li class="child-menu">
                <a href="{{ route('frontend.my-auctions', ['status' => 'active']) }}" @if(url()->current() == route('frontend.my-auctions', ['status' => 'active'])) class="active" @endif>
                    {{ __('Active auctions') }} </a>
            </li>
            <li class="child-menu">
                <a href="{{ route('frontend.my-auctions', ['status' => 'closed']) }}" @if(url()->current() == route('frontend.my-auctions', ['status' => 'closed'])) class="active" @endif>
                    {{ __('Expire Auctions') }} </a>
            </li>
            <li class="child-menu">
                <a href="{{ route('frontend.my-auctions', ['status' => 'won']) }}" @if(url()->current() == route('frontend.my-auctions', ['status' => 'won'])) class="active" @endif>
                   {{ __('Complete Auctions') }} </a>
            </li>
            <li class="child-menu">
                <a href="{{ route('frontend.newAuction') }}" @if(url()->current() == route('frontend.newAuction')) class="active" @endif>
                    {{ __('New Auction') }}</a>
            </li>
            <li>
                <a href="{{ route('frontend.myBids') }}" @if(url()->current() == route('frontend.myBids')) class="active" @endif><i class="flaticon-auction"></i>{{ __('My Bids') }}</a>
            </li>            
            <li>
                <a href="{{ route('frontend.wonBids-list') }}" @if(url()->current() == route('frontend.wonBids-list')) class="active" @endif><i class="flaticon-auction"></i>{{ __('Won Bids') }}</a>
            </li>            
            <li>
                <a href="{{ route('frontend.dashboard.favorites') }}" @if(url()->current() == route('frontend.dashboard.favorites')) class="active" @endif><i class="flaticon-auction"></i>{{ __('Favorites') }}</a>
            </li>
        </ul>
    </div>
</div> --}}

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('frontend.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>      

      <li class="nav-item">
        <a class="nav-link " href="{{ route('frontend.new-ticket') }}">
          <i class="bi bi-journal-text"></i>
          <span>Create New Ticket</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('frontend.all-ticket') }}">
          <i class="bi bi-journal-text"></i>
          <span>All Tickets</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link " href="{{ route('frontend.my-ticket') }}">
          <i class="bi bi-journal-text"></i>
          <span>My Tickets</span>
        </a>
      </li>      

      <li class="nav-item">
        <a class="nav-link " href="{{ route('frontend.assigned-ticket') }}">
          <i class="bi bi-journal-text"></i>
          <span>Assigned Tickets</span>
        </a>
      </li>

{{--       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Badges</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
          </li>
          <li>
            <a href="components-buttons.html">
              <i class="bi bi-circle"></i><span>Buttons</span>
            </a>
          </li>
          <li>
            <a href="components-cards.html">
              <i class="bi bi-circle"></i><span>Cards</span>
            </a>
          </li>
          <li>
            <a href="components-carousel.html">
              <i class="bi bi-circle"></i><span>Carousel</span>
            </a>
          </li>
          <li>
            <a href="components-list-group.html">
              <i class="bi bi-circle"></i><span>List group</span>
            </a>
          </li>
          <li>
            <a href="components-modal.html">
              <i class="bi bi-circle"></i><span>Modal</span>
            </a>
          </li>
          <li>
            <a href="components-tabs.html">
              <i class="bi bi-circle"></i><span>Tabs</span>
            </a>
          </li>
          <li>
            <a href="components-pagination.html">
              <i class="bi bi-circle"></i><span>Pagination</span>
            </a>
          </li>
          <li>
            <a href="components-progress.html">
              <i class="bi bi-circle"></i><span>Progress</span>
            </a>
          </li>
          <li>
            <a href="components-spinners.html">
              <i class="bi bi-circle"></i><span>Spinners</span>
            </a>
          </li>
          <li>
            <a href="components-tooltips.html">
              <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
          </li>
        </ul>
      </li> --}}

{{--       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li> --}}
{{-- 
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li> --}}

{{--       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li>
        </ul>
      </li> --}}

{{--       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li>
 --}}
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('frontend.profile') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

{{--       <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>
 --}}
      <li class="nav-item">
         <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="nav-link collapsed" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log Out</span>
              </a>
          </form>
      </li>
{{-- 
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li> --}}

    </ul>

  </aside><!-- End Sidebar-->
