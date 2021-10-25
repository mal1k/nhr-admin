@extends ('new-layout')

@section('title', 'Elastic search')

@section('content')
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Elastic</span>
        </h3>

    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->

            <script type="text/javascript">
                $(document).ready(async () => {

                    const getAndRenderResults = async (text_to_search) => {
                        const search_results = await fetch(`/elastic/listings?text=${text_to_search}`);
                        const json_resp = await search_results.json();
                        console.log(json_resp);
                        return json_resp;
                    };

                    function debounce(f, ms) {
                        let isCooldown = false;
                        return function() {
                            if (isCooldown) return;
                            f.apply(this, arguments);
                            isCooldown = true;
                            setTimeout(() => isCooldown = false, ms);
                        };
                    };

                    const debounce_overloaded = debounce(getAndRenderResults, 350);
                    const input_selector = $("#input_id_example");

                    input_selector.on("input", async () => {
                        const input_value = input_selector.val();
                        await debounce_overloaded(input_value);
                    });

                });
            </script>

            <table class="table align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-60px rounded-start">@sortablelink('id', 'ID')</th>
                        <th class="min-w-225px">@sortablelink('title', 'Title')</th>
                        <th class="min-w-225px">@sortablelink('level', 'Level')</th>
                        <th class="min-w-200px">@sortablelink('basic_status', 'Status')</th>
                        <th class="min-w-200px text-end rounded-end">
                            <form action="">
                                <div class="row m-0">
                                    <input id="input_id_example" type="text" class="col form-control" placeholder="Search" name="s" value="">
                                    <a href="#" class="col-2 btn btn-icon btn-bg-light btn-active-color-primary"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </form>
                        </th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-dark fw-bolder mb-1 fs-6">ID</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bolder d-block mb-1 fs-6">Title</a>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bolder d-block mb-1 fs-6">Level</a>
                        </td>
                        <td>
                            <span class="badge badge-light-primary
                             fs-7 fw-bold">Status</span>
                        </td>
                        <td class="text-end">
                            <form id="delete_listing_ELEMENT_ID" method="POST" action="">
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>
@endsection
