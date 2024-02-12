@include('dashboard.layout.header')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">request provider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">request provider</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">all users</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>first_name</th>
                      <th>last_name</th>
                      <th>email</th>
                      <th>category</th>
                      <th>phone</th>
                      <th>address</th>
                      <th>image</th>
                      <th scope="col">option</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($providers as $provider)
                    <tr>
                        <td>{{$provider->first_name}}</td>
                        <td>{{$provider->last_name}}</td>
                        <td>{{$provider->email}}</td>
                        <td>{{$provider['category']->category['name']}}</td>
                        <td>{{$provider->phone}}</td>
                        <td>{{$provider->address}}</td>
                        <td>{{$provider->image}}</td>
                        <td><a href="/admin/accept_provider/{{$provider->id}}" >
                           <i class="fas fa-check"></i>
                            </a>
                            <a href="/admin/deleteUser/{{$provider->id}}"><i class="fa fa-trash text-danger"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('dashboard.layout.footer')
