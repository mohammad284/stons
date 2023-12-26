<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">عمليات المقلع</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">عمليات المقلع</li>
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
                <div class="btn-group ml-2">
                  <button type="button" class="btn btn-default">حسب الشريك</button>
                  <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu" role="menu" style="">
                      <a wire:click.prevent="filterPartnerByStatus('')" class="dropdown-item" href="#">الكل</a>
                      @foreach($partners as $partner)
                      <a wire:click.prevent="filterPartnerByStatus({{$partner->id}})" class="dropdown-item" href="#">{{$partner->name}}</a>
                      @endforeach
                    </div>
                  </button>
                </div>
              <div>
              
              </div>
                <div class="btn-group">
                  <button wire:click="filterAppointmentsByStatus" type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                    <span class="mr-1">All</span> 
                    <span class="badge badge-pill badge-info"></span>
                  </button>

                  <button wire:click="filterAppointmentsByStatus('in')" type="button" class="btn {{ ($status === 'in') ? 'btn-secondary' : 'btn-default' }}">
                    <span class="mr-1">الداخل</span>
                    <span class="badge badge-pill badge-primary"></span>
                  </button>

                  <button wire:click="filterAppointmentsByStatus('out')" type="button" class="btn {{ ($status === 'out') ? 'btn-secondary' : 'btn-default' }}">
                    <span class="mr-1">الخارج</span>
                    <span class="badge badge-pill badge-success"></span>
                  </button>
                </div>
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">القائم بالعملية</th>
                        <th scope="col">الداخل</th>
                        <th scope="col">الخارج</th>
                        <th scope="col">البيان</th>
                        <th scope="col">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operations as $operation)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            @if($operation->state == 'in')
                            <td>{{$operation->received->name}}</td>
                            <td>{{$operation->payments}}</td>
                            <td>----</td>
                            @else
                            <td>{{$operation->partner->name}}</td>
                            <td>----</td>
                            <td>{{$operation->payments}}</td>
                            @endif
                            <td>{{$operation->statment}}</td>
                            <td>{{$operation->date}}</td>
                        @endforeach
                        {{-- @foreach($operations as $operation)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td> <span class="badge {{ ($operation->state === 'in') ? 'bg-primary' : 'bg-danger' }} ">{{$operation->state}}</span></td>
                            @if($operation->state == 'in')
                            <td>{{$operation->received->name}}</td>
                            @else
                            <td>{{$operation->partner->name}}</td>
                            @endif
                            <td>{{$operation->payments}}</td>
                            <td>{{$operation->statment}}</td>
                            <td>{{$operation->date}}</td>
                        @endforeach --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">المجموع</th>
                            <th scope="col">{{$ins}}</th>
                            <th scope="col">{{$outs}}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>
                </table>
              </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $operations->links() }}
                </div>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
        <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
        <form wire:submit.prevent="{{$showEditModal ? 'updateExpense': 'createExpense'}}">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if($showEditModal)
                <span>تعديل المصروف</span>
                @else
                <span>اضافة مصروف </span>
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">المبلغ المدفوع</label>
                        <input type="text" wire:model.defer='state.payment' class="form-control @error('payment') is-invalid @enderror" id="payment" aria-describedby="emailHelp" placeholder="Enter payment">
                        @error('payment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">البيان</label>
                        <input type="text" wire:model.defer='state.statment' class="form-control @error('statment') is-invalid @enderror" id="statment" aria-describedby="emailHelp" placeholder="Enter statment">
                        @error('statment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">date</label>
                        <input type="date" wire:model.defer='state.date' class="form-control @error('date') is-invalid @enderror" id="date" aria-describedby="emailHelp" placeholder="Enter date">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                                <span>تعديل</span>
                            @else
                                <span>حفظ</span>
                            @endif
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
                <h5>حذف المصروف </h5>
                </div>

                <div class="modal-body">
                <h4> هل انت متأكد من حذف المصروف</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>اغلاق</button>
                    <button type="submit" wire:click.prevent="deletePayment" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>حذف
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
