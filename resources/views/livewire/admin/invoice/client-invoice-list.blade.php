<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">فواتير زبائن المعمل</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">فواتير زبائن المعمل</li>
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
                <button wire:click.prevent="addNew"  class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> انشاء فاتورة</button>
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">اسم الزبون</th>
                            <th scope="col">المادة</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">الافرادي</th>
                            <th scope="col">الاجمالي</th>
                            <th scope="col">التاريخ</th>
                            <th scope="col">البيان</th>
                            <th scope="col">الخيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$invoice->partner->name}}</td>
                        <td>{{$invoice->category->name}}</td>
                        <td>{{$invoice->count}}</td>
                        <td>{{$invoice->price}}</td>
                        <td>{{$invoice->total_price}}</td>
                        <td>{{$invoice->date}}</td>
                        <td>{{$invoice->statment}}</td>
                        <td>
                            <a href="" wire:click.prevent="confirmUserRemove({{$invoice->id}})"><i class="fa fa-trash text-danger"></i> </a>
                        </td>
                        @endforeach
                    </tbody>
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
        <form wire:submit.prevent="{{$showEditModal ? 'updateInvoice': 'createInvoice'}}">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if($showEditModal)
                <span>Edit Invoice</span>
                @else
                <span>إضافة فاتورة جديدة</span>
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label>نوع المواد</label>
                          <select class="form-control" wire:model="selectedValue" wire:model.defer="state.subject_id" id="subject">
                          <option value="">اختر نوع المواد</option>
                            @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="email">العدد</label>
                        <input type="text" wire:model="calTotal" wire:model.defer='state.count' class="form-control @error('count') is-invalid @enderror" id="count" aria-describedby="emailHelp" placeholder="Enter count">
                        @error('count')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">الافرادي</label>
                        <input type="text"  wire:model.defer='state.price' class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{$price}}" placeholder="{{$price}}" aria-describedby="emailHelp" >
                        <input type="hidden" value="{{$client->id}}" wire:model.defer='state.client' class="form-control ">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">السعر الاجمالي</label>
                        <input type="text"  wire:model.defer='state.total_price' class="form-control @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{$total_price}}" placeholder="{{$total_price}}" aria-describedby="emailHelp" >
                        @error('total_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">التاريخ</label>
                        <input type="date" wire:model.defer='state.date' class="form-control @error('date') is-invalid @enderror" id="date" aria-describedby="emailHelp" placeholder="Enter date">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="statment">البيان</label>
                        <input type="text" wire:model.defer='state.statment' class="form-control @error('statment') is-invalid @enderror" id="statment" aria-describedby="emailHelp" placeholder="Enter statment">
                        @error('statment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                                <span>Edit</span>
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
                <h5>Delete invoice </h5>
                </div>

                <div class="modal-body">
                <h4> Are you sure you want to delete this invoice </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                    <button type="submit" wire:click.prevent="deleteInvoice" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
