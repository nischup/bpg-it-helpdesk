@extends('frontend.layouts-helpdesk.master')
@section('title', 'Dashboard')
@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection
@section('content')

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('frontend.dashboard') }}" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">BPG IT HELPDESK</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
             <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->name }}</h6>
              <span>{{ auth()->user()->email }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
   {{--          <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li> --}}
  {{--           <li>
              <hr class="dropdown-divider">
            </li> --}}

{{--             <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li> --}}
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

 @include('frontend.layouts-helpdesk.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Assign Ticket</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('frontend.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Assign Ticket</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Assign Ticket Details</h5>

               @if (session()->has('message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('error') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

              <form method="POST" action="{{ route('frontend.assignSubmit') }}" class="row g-3" x-data="ticket">
                @csrf
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Issue Title</label>
                  <input type="text" value="{{ $ticket->subject }}" class="form-control" disabled id="inputName5">
                   @error('subject') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                   <label for="inputState" class="form-label">Issue Category</label>
                   <select id="inputState" class="form-select" wire:model="task_category" disabled>
                          <option value="" selected>{{ $ticket->category->name_en }}</option>
                      </select>
                      @error('task_category') <span class="text-danger error">{{ $message }}</span> @enderror 
                </div>                

                <div class="col-md-4">
                   <label for="inputState" class="form-label">Company</label>
                    <select id="inputState" class="form-select" wire:model.defer="company_id" wire:click="compnaytoProject($event.target.value)" disabled> 
                        <option value="" selected >{{ $ticket->company->name }}</option>
                            {{--   @foreach($companies as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach --}}
                        </select>
                        @error('company_id') <span class="text-danger error">{{ $message }}</span> @enderror


                </div>

                @if ($ticket->project != null)
                <div class="col-md-4">
                   <label for="inputState" class="form-label">Project</label>
                      <select id="inputState" class="form-select" wire:model.defer="project" wire:click="projectToModule($event.target.value)" disabled>
                        <option value="" selected >{{ $ticket->project->name }}</option>
                          {{--   @foreach($projects as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach --}}
                      </select>
                      @error('project') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>                
                @endif

               @if ($ticket->project_module != null)
                <div class="col-md-4">
                   <label for="inputState" class="form-label">Module Name</label>
                      <select id="inputState" class="form-select" wire:model="project_module" disabled>
                     <option value="" selected >{{ $ticket->project_module->title }}</option>
                         {{--    @foreach($project_modules as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach --}}
                      </select>
                      @error('project_module') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>    
              @endif
              
                <div class="col-md-4">
                   <label for="inputState" class="form-label">Page Name</label>
                    <input type="text" class="form-control" id="inputAddres5s" value="{{ $ticket->page_name }}" disabled>
                </div>                

{{--                 <div class="col-md-4">
                   <label for="inputState" class="form-label">Attachment</label>
                    <select id="inputState" class="form-select">
                      <option selected>Choose one...</option>
                      <option>...</option>
                    </select>
                </div> --}}

                <div class="col-4">
                  <label for="inputAddress5" class="form-label">Remarks</label>
                  <input type="text" class="form-control" id="inputAddres5s" value="{{ $ticket->remarks }}" disabled>
                </div>


                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Issue Details</label>
                  <textarea type="text" class="form-control" disabled>{{ $ticket->issue_details }}</textarea>
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Status</label>
                  <select id="inputState" class="form-select" wire:model="status_id" disabled>
                   <option value="" selected >{{ $ticket->status->title }}</option>
                    {{--         @foreach($status as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach --}}
                        </select>
                        @error('status_id') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Priority</label>
                  <select id="inputState" class="form-select" wire:model="priority_id" disabled>
                           <option value="" selected >{{ $ticket->priority->title }}</option>
                       {{--      @foreach($priority as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach --}}
                        </select>
                        @error('priority_id') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Severity</label>
                  <select id="inputState" class="form-select" wire:model="severity_id" disabled>
                     <option value="" selected >{{ $ticket->severity->name }}</option>
                   {{--          @foreach($severity as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach --}}
                        </select>
                        @error('severity_id') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4">
                  <label for="inputState" class="form-label">Assign To</label>
                  <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                  <select id="inputState" class="form-select" name="assign_to">
                      <option value="" selected>{{ __('Select Assign User') }}</option>
                            @foreach($user as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('assign_to') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>                

                <div class="col-md-4">
                  <label for="inputState" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date">
                        @error('start_date') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">End Date</label>
                      <input type="date" class="form-control"name="end_date">
                        @error('end_date') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Deadline</label>
                    <input type="date" class="form-control" name="deadline">
                        @error('deadline') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>

                <div class="text-center">
                  <button type="button" class="btn btn-success" onclick="event.preventDefault();this.closest('form').submit();">Assign</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <button type="button" class="btn btn-primary" onclick="window.location.reload(true);"/>Reload</button>
                </div>
              </form>

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
  <!-- End #main -->
  
@endsection

@section('scripts')
    @livewireScripts
@endsection
