<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Store</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Store</li>
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
                        <th scope="col">category</th>
                        <th scope="col">count</th>
                        <th scope="col">option</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->count}}</td>
                        <td><a href="" wire:click.prevent="edit({{ $product}})">
                            <i class="fa fa-edit mr-2"></i> 
                        </a>
                        <a href="" wire:click.prevent="confirmUserRemove({{$product->id}})"><i class="fa fa-trash text-danger"></i> </a>
                        </td>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Modal -->
</div>
