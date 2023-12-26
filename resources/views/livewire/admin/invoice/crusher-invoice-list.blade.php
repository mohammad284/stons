<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">فواتير المقلع</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">فواتير المقلع</li>
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
                        <th scope="col">partner_id</th>
                        <th scope="col">driver</th>
                        <th scope="col">wight</th>
                        <th scope="col">kind</th>
                        <th scope="col">price</th>
                        <th scope="col">total_price</th>
                        <th scope="col">date</th>
                        <th scope="col">note</th>
                        <th scope="col">option</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$invoice->partner->name}}</td>
                        <td>{{$invoice->driver}}</td>
                        <td>{{$invoice->wight}}</td>
                        <td>{{$invoice->subject}}</td>
                        <td>{{$invoice->price}}</td>
                        <td>{{$invoice->total_price}}</td>
                        <td>{{$invoice->date}}</td>
                        <td>{{$invoice->note}}</td>
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
                <span>Add new Invoice</span>
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">driver</label>
                        <input type="text" wire:model.defer='state.driver' class="form-control @error('driver') is-invalid @enderror" id="driver" aria-describedby="emailHelp" placeholder="Enter driver">
                        <input type="hidden" value="{{$crusher->id}}" wire:model.defer='state.crusher' class="form-control ">
                        @error('driver')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">wight</label>
                        <input type="text" wire:model.defer='state.wight' class="form-control @error('wight') is-invalid @enderror" id="wight" aria-describedby="emailHelp" placeholder="Enter wight">
                        @error('wight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label>kind</label>
                          <select class="form-control" wire:model.defer="state.subject" id="subject">
                          <option value="">select kind</option>
                              <option value="كتل 1">كتل 1</option>
                              <option value="كتل 2">كتل 2</option>
                              <option value="كتل 3">كتل 3</option>
                              <option value="رقّات">رقّات</option>
                              <option value="دساتير">دساتير</option>
                              <option value="دبش">دبش</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="email">price</label>
                        <input type="text" wire:model.defer='state.price' class="form-control @error('price') is-invalid @enderror" id="price" aria-describedby="emailHelp" placeholder="Enter price">
                        @error('price')
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
                    <div class="form-group">
                        <label for="email">note</label>
                        <input type="text" wire:model.defer='state.note' class="form-control @error('note') is-invalid @enderror" id="note" aria-describedby="emailHelp" placeholder="Enter note">
                        @error('note')
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
