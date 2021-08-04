@extends ('layout')

@section('title', 'Import')

@section('content')
<div id="mainForm">

    @if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
    </div>
    @endif

    @if ( session()->has('failures') )
    <table class="table table-danger">
      <tr>
        <th>Row</th>
        <th>Attribute</th>
        <th>Errors</th>
        <th>Value</th>
      </tr>

      @foreach (session()->get('failures') as $validation )
      <tr>
        <td>{{ $validation->row() }}</td>
        <td>{{ $validation->attribute() }}</td>
        <td>
            <ul style="list-style-type: none;padding-left: 0!important;">
                @foreach ($validation->errors() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </td>
        <td>{{ $validation->values()[$validation->attribute()] }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
        <label for="categories" class="form-label mt-2 mb-1">{{ __('What type of data do you want to import?') }}</b></label>
        <select name="category" class="form-select select">
            <option value="listingsImport">Listings</option>
            <option value="dealsImport">Deals</option>
            <option value="bannersImport">Banners</option>
            <option value="eventsImport">Events</option>
            <option value="blogImport">Blog</option>
            <option value="listingTypesImport">Listing Types</option>
            <option value="faqImport">FAQ</option>
        </select>

        <input type="file" class="custom-file-input mt-2" name="import_file" /><br>
        <button class="btn btn-primary mt-2">Import File</button>
    </form>

@isset($importList)
  <div class="panel panel-default mt-4">
    <h5>Imported logs</h5>
    <div class="table-responsive content-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th nowrap="">File</th>
                    <th nowrap="">File size</th>
                    <th nowrap="">Rows</th>
                    <th nowrap="">Date of import</th>
                </tr>
            </thead>
            <tbody>
              @isset($importList)
                @foreach ($importList as $item)
                <tr>
                    <td>{{ $item->category }}</td>
                    <td>
                      @php
                        $units = ['B','KB','MB','GB','TB'];
                        $step = 1024;
                        $i = 0;
                        while (($item->filesize / $step) > 1) {
                            $item->filesize = $item->filesize / $step;
                            $i++;
                        }
                        $filesize = round($item->filesize, 2).' '.$units[$i];
                      @endphp
                      {{ $filesize }}
                    </td>
                    <td>
                        {{ $item->rows }}
                    </td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @endforeach
              @endisset
            </tbody>
        </table>
    </div>
  </div>

<script>
    function exportTasks(_this) {
       let _url = $(_this).data('href');
       window.location.href = _url;
    }
</script>
@endisset

@endsection
