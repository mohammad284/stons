<div>
         <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">تقارير المقلع</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">تقارير المقلع</li>
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
                      <a wire:click.prevent="filterSubjectByStatus('كتل 1')" class="dropdown-item" href="#">كتل 1</a>
                      <a wire:click.prevent="filterSubjectByStatus('كتل 2')" class="dropdown-item" href="#">كتل 2</a>
                      <a wire:click.prevent="filterSubjectByStatus('كتل 3')" class="dropdown-item" href="#">كتل 3</a>
                      <a wire:click.prevent="filterSubjectByStatus('رقّات')" class="dropdown-item" href="#">رقّات</a>
                      <a wire:click.prevent="filterSubjectByStatus('دبش')" class="dropdown-item" href="#">دبش</a>
                      <a wire:click.prevent="filterSubjectByStatus('دساتير')" class="dropdown-item" href="#">دساتير</a>
                    </div>
                  </button>
                </div>
                <button wire:click.prevent="addNew"  class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> فلتر التقارير</button>
                
            </div>
            <div class="card">
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">النوع</th>
                        <th scope="col">الوزن</th>
                        <th scope="col">الافرادي</th>
                        <th scope="col">الاجمالي</th>
                        <th scope="col">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$report->subject}}</td>
                        <td>{{$report->wight}}</td>
                        <td>{{$report->price}}</td>
                        <td>{{$report->total_price}}</td>
                        <td>{{$report->date}}</td>
                        <td>
                        </td>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">النوع</th>
                            <th scope="col">{{$total_wight}}</th>
                            <th scope="col">الافرادي</th>
                            <th scope="col">{{$total_price}}</th>
                            <th scope="col">التاريخ</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
                <div class="card-footer d-flex justify-content-end">
                    {{-- {!! $reports->links() !!} --}}
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
        <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="filterReports">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                        <span>filter</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="name">من تاريخ</label>
                        <input type="date" wire:model.defer='state.from' class="form-control @error('from') is-invalid @enderror" id="from" aria-describedby="emailHelp" placeholder="Enter from">
                        @error('from')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">الى تاريخ</label>
                        <input type="date" wire:model.defer='state.to' class="form-control @error('to') is-invalid @enderror" id="to" aria-describedby="emailHelp" placeholder="Enter to">
                        @error('to')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                          <label>نوع المواد</label>
                          <select class="form-control @error('subject') is-invalid @enderror" wire:model.defer="state.subject"  id="subject">
                            <option value="1" selected>اختر نوع المواد</option>
                              <option value="1">الكل</option>
                              <option value="كتل 1">كتل 1</option>
                              <option value="كتل 2">كتل 2</option>
                              <option value="كتل 3">كتل 3</option>
                              <option value="رقّات">رقّات</option>
                              <option value="دساتير">دساتير</option>
                              <option value="دبش">دبش</option>
                          </select>
                          @error('status')
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
</div>

