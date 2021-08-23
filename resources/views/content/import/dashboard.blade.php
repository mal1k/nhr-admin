@extends ('new-layout')

@section('title', 'Import')

@section('content')

<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Import</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">

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

            <!-- <input type="file" class="custom-file-input mt-2" name="import_file" /><br> -->
            <label for="import_file" class="form-label mt-2 mb-1">Choose your import file:</label>
            <div>
                <input type="file" id="import_file" name="import_file" class="choose me-2 mb-2"><br>
            </div>

            <button class="btn btn-sm btn-light-primary mt-2">Import File</button>
        </form>

        <!--begin::Table container-->
        <div class="table-responsive pt-3">
            <!--begin::Table-->
            <table class="table table-rounded table-striped border gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th>@sortablelink('category', 'File')</th>
                        <th>@sortablelink('filesize', 'File size')</th>
                        <th>@sortablelink('rows', 'Rows')</th>
                        <th>@sortablelink('updated_at', 'Date of import')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($importList as $item)
                    <tr class="">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-dark fw-bolder mb-1 fs-6">{{ $item->category }}</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bolder d-block mb-1 fs-6">
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
                            </a>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bolder d-block mb-1 fs-6">{{ $item->rows }}</a>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bolder d-block mb-1 fs-6">{{ $item->created_at }}</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>

<script>
    var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
    url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 10,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "wow.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    }
});
</script>

    {{ $importList->links() }}
@endsection
