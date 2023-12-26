<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">مدفوعات المقلع</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">مدفوعات المقلع</li>
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
                <button wire:click.prevent="addNew"  class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> اضافة مدفوعات</button>
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">الزبون</th>
                        <th scope="col">المطلوب</th>
                        <th scope="col">المدفوع</th>
                        <th scope="col">البيان</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">المستلم</th>
                        <th scope="col">خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$payment->partner->name}}</td>
                        <td>{{$payment->required}}</td>
                        <td>{{$payment->payments}}</td>
                        <td>{{$payment->statment}}</td>
                        <td>{{$payment->date}}</td>
                        <td>{{$payment['received']->name}}</td>
                        <td>
                            <a href="" wire:click.prevent="confirmUserRemove({{$payment->id}})"><i class="fa fa-trash text-danger"></i> </a>
                        </td>
                        @endforeach
                    </tbody>
                </table>
              </div>
                <div class="card-footer d-flex justify-content-end">
                    {{-- {{ $payments->links() }} --}}
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
        <form wire:submit.prevent="{{$showEditModal ? 'updateInvoice': 'createPayment'}}">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if($showEditModal)
                <span>Edit Invoice</span>
                @else
                <span>Add new Invoice</span>
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">required</label>
                        <input type="text" wire:model.defer='state.required' class="form-control @error('required') is-invalid @enderror" id="required" aria-describedby="emailHelp" placeholder="Enter required">
                        
                        @error('required')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">payments</label>
                        <input type="text" wire:model.defer='state.payments' class="form-control @error('payments') is-invalid @enderror" id="payments" aria-describedby="emailHelp" placeholder="Enter payments">
                        @error('payments')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">date</label>
                        <input type="date" wire:model.defer='state.date' class="form-control @error('date') is-invalid @enderror" id="date" aria-describedby="emailHelp" placeholder="Enter date">
                        <input type="hidden" value="{{$user->id}}" wire:model.defer='state.crusher' class="form-control ">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">statment</label>
                        <input type="text" wire:model.defer='state.statment' class="form-control @error('statment') is-invalid @enderror" id="statment" aria-describedby="emailHelp" placeholder="Enter statment">
                        @error('statment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label>المستلم</label>
                          <select class="form-control" wire:model.defer="state.received_id" id="subject">
                          <option value="">اختر المستلم</option>
                            @foreach($partners as $partner)
                              <option value="{{$partner->id}}">{{$partner->name}}</option>
                              @endforeach
                          </select>
                          @error('received_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                                <span>Edit</span>
                            @else
                                <span>Save</span>
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
                <h5>Delete invoice </h5>
                </div>

                <div class="modal-body">
                <h4> Are you sure you want to delete this payment </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                    <button type="submit" wire:click.prevent="deletePayment" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete payment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
