<div>
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">زبائن المعمل</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">زبائن المعمل</li>
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
                <button wire:click.prevent="addNew"  class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> إضافة زبون جديد</button>
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">الهاتف</th>
                        <th scope="col">التفاصيل</th>
                        <th scope="col">الخيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($partners as $partner)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                        {{$partner->name}}</td>
                        <td>{{$partner->mobile}}</td>
                        <td><a class="btn btn-primary"  href="{{ route('admin.clients.invoice', $partner) }}">
                            الفواتير
                        </a>
                       <a class="btn btn-primary"  href="{{ route('admin.lab.payment', $partner) }}">
                            الدفعات
                        </a>
                        <td>
                        <a href="" wire:click.prevent="edit({{ $partner}})">
                            <i class="fa fa-edit mr-2"></i> 
                        </a>
                        <a href="" wire:click.prevent="confirmUserRemove({{$partner->id}})"><i class="fa fa-trash text-danger"></i> </a>
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
    <form wire:submit.prevent="{{$showEditModal ? 'updatePartner': 'createPartner'}}">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
            @if($showEditModal)
            <span>تعديل الزبون</span>
            @else
            <span>اضافة زبون جديد</span>
            @endif
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" wire:model.defer='state.name' class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">الهاتف</label>
                    <input type="text" wire:model.defer='state.mobile' class="form-control @error('mobile') is-invalid @enderror" id="mobile" aria-describedby="emailHelp" placeholder="Enter mobile">
                    @error('mobile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>اغلاق</button>
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
                <h5>حذف الزبون</h5>
                </div>

                <div class="modal-body">
                <h4> هل انت متأكد من عملية الحذف </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>اغلاق</button>
                    <button type="submit" wire:click.prevent="deletePartner" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>حذف
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
