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
            <option value="listings">Listings</option>
            <option value="deals">Deals</option>
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
            <option value="Listings">Listings</option>
            <option value="Deals">Deals</option>
            <option value="bannersExport">Banners</option>
            <option value="Events">Events</option>
            <option value="Blog">Blog</option>
            <option value="ListingTypes">Listing Types</option>
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
                <tr>
                    <td>export_Listing_3ac4aef6b244e5fb3b200cc3d4c459fa</td>
                    <td>1.21 Mb</td>
                    <td>03/02/2021 - 09:24:21</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="#">Download</a>
                        <!-- @isset ($event) -->
                        <form class="col" method="POST" action="{{ route('export.destroy', $event) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-3">Delete</button>
                        </form>
                        <!-- @endisset -->
                    </td>
                </tr>
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
