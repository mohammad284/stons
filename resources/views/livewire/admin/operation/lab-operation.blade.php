<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">عمليات شراء المعمل</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">عمليات شراء المعمل</li>
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
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">لحساب </th>
                        <th scope="col">المطلوب دفعه</th>
                        <th scope="col">المدفوع</th>
                        <th scope="col">البيان</th>
                        <th scope="col">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operations as $operation)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$operation->partner->name}}</td>
                            <td>{{$operation->required}}</td>
                            <td>{{$operation->payments}}</td>
                            <td>{{$operation->statment}}</td>
                            <td>{{$operation->date}}</td>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">المجموع</th>
                            <th scope="col">{{$required_in}}</th>
                            <th scope="col">{{$payments_in}}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>
                </table>
              </div>
                <div class="card-footer d-flex justify-content-end">
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
