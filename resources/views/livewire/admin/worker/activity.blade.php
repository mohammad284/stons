<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">نشاط العمال </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">نشاط العمال</li>
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
                <button type="button" class="btn btn-default">حسب النوع</button>
                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                  <div class="dropdown-menu" role="menu" style="">
                    <a wire:click.prevent="filterSubjectByStatus('')" class="dropdown-item" href="#">الكل</a>
                    @foreach($workers as $worker)
                    <a wire:click.prevent="filterSubjectByStatus('{{$worker->id}}')" class="dropdown-item" href="#">{{$worker->name}}</a>
                    @endforeach
                  </div>
                </button>
              </div>
              <button wire:click.prevent="addNew"  class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> إضافة نشاط عامل</button>
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم </th>
                        <th scope="col">نوع البلوك</th>
                        <th scope="col">العدد</th>
                        <th scope="col">الافرادي</th>
                        <th scope="col">المستحقات</th>
                        <th scope="col">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$activity->worker->name}}</td>
                            <td>{{$activity->category->name}}</td>
                            <td>{{$activity->count}}</td>
                            <td>{{$activity->price}}</td>
                            <td>{{$activity->total_price}}</td>
                            <td>{{$activity->date}}</td>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">المجموع</th>
                            <th scope="col"></th>
                            <th scope="col">{{$counts}}</th>
                            <th scope="col"></th>
                            <th scope="col">{{$totals}}</th>
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
        <form wire:submit.prevent="{{$showEditModal ? 'updateActive': 'createActive'}}">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if($showEditModal)
                <span>تعديل نشاط عامل</span>
                @else
                <span>اضافة نشاط عامل </span>
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
                          <label>اسم العامل</label>
                          <select class="form-control" wire:model.defer="state.worker_id" id="subject">
                          <option value="">اختر اسم العامل</option>
                            @foreach($workers as $worker)
                              <option value="{{$worker->id}}">{{$worker->name}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label>نوع المواد</label>
                          <select class="form-control" wire:model="selectedValue"  wire:model.defer="state.category_id" id="subject">
                          <option value="">اختر نوع البلوك</option>
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
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">المستحقات</label>
                        <input type="text"  wire:model.defer='state.total_price' class="form-control @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{$total_price}}" placeholder="{{$total_price}}" aria-describedby="emailHelp" >
                        @error('total_price')
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
