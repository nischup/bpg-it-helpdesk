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
        
        <form class="row g-3">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Issue Title</label>
                  <input type="text" class="form-control" id="inputName5" wire:model="subject">
                   @error('subject') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-3">
                   <label for="inputState" class="form-label">Issue Category</label>
                    <select id="inputState" class="form-select" wire:model="task_category" wire:click="categoryChnaged($event.target.value)">
                          <option value="">{{ __('Select Category') }}</option>
                            @foreach($categories as $item)
                                <option value="{{ $item['id'] }}">{{ $item[$category_column] ? $item[$category_column] : $item['name_en'] }}</option>
                            @endforeach
                      </select>
                      @error('task_category') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>                    

                <div class="col-md-3">
                   <label for="inputState" class="form-label"> Sub Category</label>
                    <select id="inputState" class="form-select" wire:model="sub_category">
                          <option value="">{{ __('Select Sub Category') }}</option>
                             @if($child_categories)
                                @foreach($child_categories as $child_category)
                                    <option value="{{ $child_category['id'] }}">{{ $child_category[$category_column] ? $child_category[$category_column] : $child_category['name_en'] }}</option>
                                @endforeach
                            @endif
                      </select>
                      @error('sub_category') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>                

                <div class="col-md-4">
                   <label for="inputState" class="form-label">Company</label>
                    <select id="inputState" class="form-select" wire:model.defer="company_id" wire:click="compnaytoProject($event.target.value)">
                        <option value="">{{ __('Select Company') }}</option>
                            @foreach($companies as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('company_id') <span class="text-danger error">{{ $message }}</span> @enderror


                </div>

                <div class="col-md-4" @if($task_category != 1) style="display: none" @endif>
                   <label for="inputState" class="form-label" wire:ignore >Project</label>
                      <select id="inputState" class="form-select" wire:model.defer="project" wire:click="projectToModule($event.target.value)">
                       <option selected>{{ __('Select Project') }}</option>
                            @foreach($projects as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                      </select>
                      @error('project') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>                


                <div class="col-md-4" @if($task_category != 1) style="display: none" @endif>
                   <label for="inputState" class="form-label" wire:ignore >Module Name</label>
                      <select id="inputState" class="form-select" wire:model="project_module">
                       <option selected>{{ __('Select Project Module') }}</option>
                            @foreach($project_modules as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                      </select>
                      @error('project_module') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>    

                <div class="col-md-4" @if($task_category != 1) style="display: none" @endif>
                   <label for="inputState" class="form-label" wire:ignore >Page Name</label>
                    <input type="text" class="form-control" id="inputAddres5s" wire:model="page_name" placeholder="Page Name">
                </div>                

        {{--         <div class="col-md-4">
                   <label for="inputState" class="form-label">Attachment</label>
                    <select id="inputState" class="form-select">
                      <option selected>Choose one...</option>
                      <option>...</option>
                    </select>
                </div> --}}

                <div class="col-4">
                  <label for="inputAddress5" class="form-label">Remarks</label>
                  <input type="text" class="form-control" id="inputAddres5s" wire:model="remarks" placeholder="Remarks">
                </div>


                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Issue Details</label>
                  <textarea type="text" class="form-control" wire:model="issue_details"></textarea>
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Status</label>
                  <select id="inputState" class="form-select" wire:model="status_id">
                      <option value="">{{ __('Select status') }}</option>
                            @foreach($status as $item)
                                <option selected value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                        @error('status_id') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Priority</label>
                  <select id="inputState" class="form-select" wire:model="priority_id">
                       <option value="">{{ __('Select Priority') }}</option>
                            @foreach($priority as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                        @error('priority_id') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>


                <div class="col-md-4">
                  <label for="inputState" class="form-label">Severity</label>
                  <select id="inputState" class="form-select" wire:model="severity_id">
                   <option value="">{{ __('Select severity') }}</option>
                            @foreach($severity as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('severity_id') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>
{{-- 
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div> --}}
                <div class="text-center">
                  <button type="button" class="btn btn-success" wire:click.prevent="storeTicket">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <button type="button" class="btn btn-primary" onclick="window.location.reload(true);"/>Reload</button>
                </div>
              </form>

              