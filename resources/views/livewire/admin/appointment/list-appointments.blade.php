<div>
  {{-- <div wire:loading>
    <div style="display:flex; justify-content:center;align-items:center;
      background-color:black; position:fixed; top:0px; left:0px ;z-index:9999;
      width:100%; height:100%; opacity: .75;">
      <div class="la-ball-spin la-2x" >
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </div> --}}
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Appointment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Appointment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a href="{{ route('admin.appointment.create') }}">
                  <button   class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New Appointment</button>
                </a>
                @if($selectedRows)
                <div class="btn-group ml-2">
                  <button type="button" class="btn btn-default">bluk actions</button>
                  <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu" role="menu" style="">
                      <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">deleted selected</a>
                      <a wire:click.prevent="markAllAsScheduled" class="dropdown-item" href="#">mark as scheduled</a>
                      <a wire:click.prevent="markAllAsClose" class="dropdown-item" href="#">mark as close</a>
                    </div>
                  </button>
                </div>
                <span class="ml-2"> selected {{count($selectedRows)}} {{Str::plural('appointment',count($selectedRows))}} </span>
                @endif
              </div>
              @if($selectedRows)
                <div class="btn-group">
                  <button wire:click="filterAppointmentsByStatus" type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                    <span class="mr-1">All</span> 
                    <span class="badge badge-pill badge-info">{{$appointmentCount}}</span>
                  </button>

                  <button wire:click="filterAppointmentsByStatus('scheduled')" type="button" class="btn {{ ($status === 'scheduled') ? 'btn-secondary' : 'btn-default' }}">
                    <span class="mr-1">Scheduled</span>
                    <span class="badge badge-pill badge-primary">{{$scheduledAppointmentCount}}</span>
                  </button>

                  <button wire:click="filterAppointmentsByStatus('closed')" type="button" class="btn {{ ($status === 'closed') ? 'btn-secondary' : 'btn-default' }}">
                    <span class="mr-1">Closed</span>
                    <span class="badge badge-pill badge-success">{{$closedAppointmentCount}}</span>
                  </button>
                </div>
                @endif
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>
                          <div class="icheck-primary d-inline ml-2">
                            <input wire:model="selectPageRows" type="checkbox" value="" name="todo2" id="todoCheck2" >
                            <label for="todoCheck2"></label>
                          </div>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">client_id</th>
                        <th scope="col">date</th>
                        <th scope="col">time</th>
                        <th scope="col">status</th>
                        <th scope="col">note</th>
                        <th scope="col">option</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($appointments as $appointment)
                        <tr>
                        <th>
                          <div class="icheck-primary d-inline ml-2">
                              <input wire:model="selectedRows" type="checkbox" value="{{$appointment->id}}" name="todo2" id="{{$appointment->id}}">
                              <label for="{{$appointment->id}}"></label>
                            </div>
                        </th>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$appointment->client->name}}</td>
                        <td>{{$appointment->date}}</td>
                        <td>{{$appointment->time}}</td>
                        <td>{{$appointment->status}}</td>
                        <td>{{$appointment->note}}</td>
                        <td><a href="" wire:click.prevent="edit()">
                            <i class="fa fa-edit mr-2"></i> 
                        </a>
                        <a href="" wire:click.prevent="confirmUserRemove()"><i class="fa fa-trash text-danger"></i> </a>
                        </td>
                      @endforeach
                    </tbody>
                </table>
              </div>
              <div class="card-footer d-flex justify-content-end">
                  {!! $appointments->links() !!}
              </div>
            </div>
            @dump($selectedRows)
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
    <form wire:submit.prevent="">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">

            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" wire:model.defer='state.name' class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" wire:model.defer='state.email' class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" wire:model.defer='state.password' class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="passwordConfirmation">confirm Password</label>
                    <input type="password" wire:model.defer='state.password_confirmation' class="form-control" id="passwordConfirmation" placeholder="confirm Password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>

                    </button>
                </div>
            </form>
        </div>

        </div>
    </div>
    </div>
    <!-- delete Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">     
            <div class="modal-content">
                <div class="modal-header">
                <h5>Delete User </h5>
                </div>

                <div class="modal-body">
                <h4> Are you sure you want to delete this user </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                    <button type="submit" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete user
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
