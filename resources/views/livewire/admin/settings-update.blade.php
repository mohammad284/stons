<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="updateSetting">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="siteEmail">Site name</label>
                                    <input wire:model.defer="state.name" type="text" class="form-control" id="name" placeholder="Enter site email">
                                </div>
                                <div class="form-group">
                                    <label for="siteEmail">Site Email</label>
                                    <input wire:model.defer="state.email" type="email" class="form-control" id="email" placeholder="Enter site email">
                                </div>
                                <div class="form-group">
                                    <label for="siteTitle">Site mobile</label>
                                    <input wire:model.defer="state.mobile" type="text" class="form-control" id="mobile" placeholder="Enter site mobile">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
