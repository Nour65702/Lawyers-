@include('dashboard.layout.header')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">notification</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12" id="accordion">
                @foreach($nots as $not)
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" >
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                {{$not['reciver_user']->first_name}} {{$not['reciver_user']->last_name}}
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" >
                        <div class="card-body">
                            {{$not->notification}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 text-center">
                <p class="lead">
                    <a href="contact-us.html">Contact us</a>,
                    if you found not the right anwser or you have a other question?<br />
                </p>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('dashboard.layout.footer')