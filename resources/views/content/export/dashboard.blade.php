@extends ('layout')

@section('title', 'Export')

@section('content')
<div id="mainForm" class="row">

    <form method="POST" enctype="multipart/form-data"
          action="{{ route('export.cloudexport') }}"
      class="col-6">

      @csrf

      @isset($export)
          @method('PUT')
      @endisset

        <label for="category" class="form-label mt-2 mb-1">{{ __('Export on eDirectory format') }}</b></label>
        <select name="category" class="form-select select">
            <option value="listingsExport">Listings</option>
            <option value="dealsExport">Deals</option>
            <!-- <option value="banners">Banners</option>
            <option value="events">Events</option>
            <option value="blog">Blog</option>
            <option value="listing_types">Listing Types</option>
            <option value="faq">FAQ</option> -->
        </select>

      <div class="mt-2 col-12">
          <button type="submit" class="btn btn-primary">{{ __('Export') }}</button>
      </div>

  </form>

  <form method="POST" enctype="multipart/form-data"
          action="{{ route('export.localexport') }}"
      class="col-6">
      @csrf

      @isset($export)
          @method('PUT')
      @endisset

        <label for="categories" class="form-label mt-2 mb-1">{{ __('Export Backup file') }}</b></label>
        <select name="category" class="form-select select">
            <option value="listingsExport">Listings</option>
            <option value="dealsExport">Deals</option>
            <option value="bannersExport">Banners</option>
            <option value="eventsExport">Events</option>
            <option value="blogExport">Blog</option>
            <option value="listingTypesExport">Listing Types</option>
            <option value="faqExport">FAQ</option>
        </select>

      <div class="mt-2 col-12">
          <button data-href="/manager/export/local/export" type="submit" class="btn btn-primary" onclick="exportTasks(event.target);">{{ __('Export') }}</button>
      </div>
  </form>

  <div class="panel panel-default mt-4">
    <h5>Download Exported Files</h5>
    <div class="table-responsive content-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th nowrap="">Filename</th>
                    <th nowrap="">File Size</th>
                    <th nowrap="">Date Created</th>
                    <th nowrap="">Options</th>
                </tr>
            </thead>
            <tbody>
              @isset($exportList)
                @foreach ($exportList as $item)
                <tr>
                    <td>{{ $item->filename }}</td>
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
                    <td>{{ $item->created_at }}</td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="{{ route("export.downloadfile", $item->filename) }}">Download</a>
                      <a class="btn btn-danger btn-sm" href="{{ route('export.deletefile', $item->filename) }}">Delete</a>
                    </td>
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
@endsection
