@extends ('new-layout')

@section('title', 'Export')

@section('content')

<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Export</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <div class="row">
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
                    <button type="submit" class="btn btn-sm btn-light-warning">{{ __('Export on eDirectory') }}</button>
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
                    <button data-href="/manager/export/local/export" type="submit" class="btn btn-sm btn-light-primary" onclick="exportTasks(event.target);">{{ __('Export') }}</button>
                </div>
            </form>
        </div>

        <!--begin::Table container-->
        <div class="table-responsive pt-3">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-25px rounded-start">Filename</th>
                        <th class="min-w-225px">File Size</th>
                        <th class="min-w-225px">Date Created</th>
                        <th class="min-w-200px text-end rounded-end"></th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    @foreach($exportList as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <span class="text-dark fw-bolder mb-1 fs-6">{{ $item->filename }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-dark fw-bolder d-block mb-1 fs-6">
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
                                </span>
                        </td>
                        <td>
                            <span class="text-dark fw-bolder mb-1 fs-6">{{ $item->created_at }}</span>
                        </td>
                        <td class="text-end">
                                <a href="{{ route('export.downloadfile', $item->filename) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="-70 -70 575 575" style="enable-background:new 0 0 475.078 475.077;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path fill="#a1a5b7" d="M467.083,318.627c-5.324-5.328-11.8-7.994-19.41-7.994H315.195l-38.828,38.827c-11.04,10.657-23.982,15.988-38.828,15.988    c-14.843,0-27.789-5.324-38.828-15.988l-38.543-38.827H27.408c-7.612,0-14.083,2.669-19.414,7.994    C2.664,323.955,0,330.427,0,338.044v91.358c0,7.614,2.664,14.085,7.994,19.414c5.33,5.328,11.801,7.99,19.414,7.99h420.266    c7.61,0,14.086-2.662,19.41-7.99c5.332-5.329,7.994-11.8,7.994-19.414v-91.358C475.078,330.427,472.416,323.955,467.083,318.627z     M360.025,414.841c-3.621,3.617-7.905,5.424-12.854,5.424s-9.227-1.807-12.847-5.424c-3.614-3.617-5.421-7.898-5.421-12.844    c0-4.948,1.807-9.236,5.421-12.847c3.62-3.62,7.898-5.431,12.847-5.431s9.232,1.811,12.854,5.431    c3.613,3.61,5.421,7.898,5.421,12.847C365.446,406.942,363.638,411.224,360.025,414.841z M433.109,414.841    c-3.614,3.617-7.898,5.424-12.848,5.424c-4.948,0-9.229-1.807-12.847-5.424c-3.613-3.617-5.42-7.898-5.42-12.844    c0-4.948,1.807-9.236,5.42-12.847c3.617-3.62,7.898-5.431,12.847-5.431c4.949,0,9.233,1.811,12.848,5.431    c3.617,3.61,5.427,7.898,5.427,12.847C438.536,406.942,436.729,411.224,433.109,414.841z"></path>
                                                    <path fill="#000" d="M224.692,323.479c3.428,3.613,7.71,5.421,12.847,5.421c5.141,0,9.418-1.808,12.847-5.421l127.907-127.908    c5.899-5.519,7.234-12.182,3.997-19.986c-3.23-7.421-8.847-11.132-16.844-11.136h-73.091V36.543c0-4.948-1.811-9.231-5.421-12.847    c-3.62-3.617-7.901-5.426-12.847-5.426h-73.096c-4.946,0-9.229,1.809-12.847,5.426c-3.615,3.616-5.424,7.898-5.424,12.847V164.45    h-73.089c-7.998,0-13.61,3.715-16.846,11.136c-3.234,7.801-1.903,14.467,3.999,19.986L224.692,323.479z"/>
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('export.deletefile', $item->filename) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>

    {{ $exportList->links() }}
@endsection
