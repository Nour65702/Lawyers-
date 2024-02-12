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
                  <h3 class="timeline-header"><a href="#"> </a>{{$question['user']->first_name}} : sent a question</h3>

                  <div class="timeline-body">
                    {{$question->question}}
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#question-{{$question->id}}">accept question</a>
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
    @foreach($questions as $question)
      <div class="modal fade" id="question-{{$question->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/acceptQuestion/{{$question->id}}">
            @csrf
                <div class="modal-body">
                    <div class="row mb-12">
                        {{-- <div class="form-group"> --}}
                          <label>Select</label>
                          <select class="form-control" name="category" >
                            @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach
  @include('dashboard.layout.footer')

  