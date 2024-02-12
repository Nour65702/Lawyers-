  @include('dashboard.layout.header')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Questions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Questions</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @foreach($questions as $question)
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">{{ \Carbon\Carbon::parse($question->created_at)->format('d/M/Y')}}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($question->created_at)->format('H:i:s')}}</span>
                  <h3 class="timeline-header"><a href="#">{{$question['category']->name}} --- </a>{{$question['user']->first_name}} : sent a question</h3>

                  <div class="timeline-body">
                    {{$question->question}}
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm" href="/admin/reply/{{$question->id}}">see replies</a>
                    {{-- <a class="btn btn-danger btn-sm">Delete</a> --}}
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        @endforeach
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('dashboard.layout.footer')