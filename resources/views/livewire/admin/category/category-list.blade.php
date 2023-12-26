<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">منتجات المعمل</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">منتجات المعمل</li>
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
            </div>
            <div class="card">
              <div class="card-header">
                <button wire:click.prevent="addNew"  class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>إضافة مادة جديدة</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">اسم المادة</th>
                            <th scope="col">سعر المبيع</th>
                            <th scope="col">سعر التصنيع</th>
                            <th scope="col">الخيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->price}}</td>
                            <td>{{$category->worker_wages}}</td>
                            <td><a href="" wire:click.prevent="edit({{ $category}})">
                                <i class="fa fa-edit mr-2"></i> 
                            </a>
                            {{-- <a href="" wire:click.prevent="confirmUserRemove({{$category->id}})"><i class="fa fa-trash text-danger"></i> </a> --}}
                            </td>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="{{$showEditModal ? 'updateCategory': 'createCategory'}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                        @if($showEditModal)
                        <span>تعديل المواد الاولية</span>
                        @else
                        <span>اضافة مادة جديدة</span>
                        @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="name">اسم المادة</label>
                        <input type="text" wire:model.defer='state.name' class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">سعر المبيع</label>
                        <input type="text" wire:model.defer='state.price' class="form-control @error('price') is-invalid @enderror" id="price" aria-describedby="emailHelp" placeholder="Enter price">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="worker_wages">سعر التصنيع</label>
                        <input type="text" wire:model.defer='state.worker_wages' class="form-control @error('worker_wages') is-invalid @enderror" id="price" aria-describedby="emailHelp" placeholder="Enter worker wages">
                        @error('worker_wages')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                                <span>تعديل </span>
                            @else
                                <span>حذف</span>
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
                <h5>حذف المادة الاولية </h5>
                </div>

                <div class="modal-body">
                <h4> هل انت متأكد من عملية الحذف</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>اغلاق</button>
                    <button type="submit" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>حذف
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
