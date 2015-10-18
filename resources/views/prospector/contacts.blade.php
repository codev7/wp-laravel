@extends('spark::layouts.spark')

@section('content')



<div class="hr-divider m-t-md m-b">
  <h3 class="hr-divider-content hr-divider-heading">All Contacts</h3>
</div>

<form action="/contacts" method="get">
<div class="flextable table-actions">
  <div class="flextable-item flextable-primary">
    <div class="btn-toolbar-item input-with-icon">
      
        <input type="text" name="search" class="form-control input-block" placeholder="Search prospects">
        <span class="icon icon-magnifying-glass"></span>
      
    </div>
  </div>

</div>
</form>
<div class="row">
  <div class="col-md-12">
  

      <div class="table-full">
          <div class="table-responsive">
            <table class="table table-middle">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Last Contacted</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                
                @if($prospects->count() > 0)

                @foreach($prospects as $prospect)

                <tr>
                  <td><a style="text-decoration: none !important" href="{{ route('prospect', ['id' => $prospect->company_id, 'person_id' => $prospect->id]) }}">{{ $prospect->first_name. ' '.$prospect->last_name }}<br /><small class="text-muted">{{ $prospect->email }}</small></a></td>
                  <td>{{ $prospect->company->name }}</td>
                  <td>{!! $prospect->getTimeOfLastActivity() !!}</td>
                  <td><a href="{{ route('prospect', ['id' => $prospect->company_id, 'person_id' => $prospect->id]) }}" class="btn btn-warning"><i class="icon icon-edit"></i></a></td>
                </tr>
                @endforeach

   
                @else
                    <tr>
                      <td colspan"5">No prospects.</th>
               
                    </tr>
                @endif
            
            </table>

            <div class="text-center">
              {!! $prospects->render() !!}
            </div><!-- text-center -->
        </div>
    </div>
      
  </div>
  
</div>


  

@endsection