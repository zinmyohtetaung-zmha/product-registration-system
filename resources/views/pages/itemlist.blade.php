@if(isset($items) && $items->count() == 0 && $items->currentPage() > 1)
@php
// Get the current URL
$currentUrl = url()->current();

// Get the URL parameters as an associative array
$queryParams = request()->query();

// Decrease the page value by one
$previousPage = $queryParams['page'] - 1;

// Set the updated page value in the query parameters
$queryParams['page'] = $previousPage;

// Generate the previous page URL with the updated query parameters
$previousPageUrl = $currentUrl . '?' . http_build_query($queryParams);

// Redirect to the previous page URL
header('Location: ' . $previousPageUrl);
exit;
@endphp
@endif

@extends('layouts.app')

@section('title')
Item List
@endsection

<link rel="stylesheet" href="{{ asset('style/modal.css') }}">


@section('route')

<style>
    .table-striped tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }

    .table-striped tbody tr:nth-of-type(even):hover {
        background-color: rgb(234, 246, 246);
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #ffffff;
    }

    .table-striped tbody tr:nth-of-type(odd):hover {
        background-color: rgb(234, 246, 246);
    }

    .thead {
        background-color: #36b9cc !important;

    }

    .table td {
        vertical-align: middle !important;
    }

    .tabel-btn {
        background-color: rgb(210, 233, 233);
        color: #000000;
    }

    .tabel-btn:hover {
        background-color: #17a2b8;
        border-radius: 5px;
        color: #ffffff !important;
        font-weight: bolder;

    }

    .tabel-btn-inactive {
        background-color: #6c757d;
        border-radius: 5px;
        color: #fff !important;
        /* font-weight: bolder; */
    }

    .tabel-btn-inactive:hover {
        background-color: #dc3545;
        border-radius: 5px;
        color: #ffffff !important;
        font-weight: bolder;

    }

    .icon:hover {
        color: #ffffff !important;

    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #17a2b8 !important;
        border-color: #17a2b8 !important;
    }

    .download {
        background-color: rgb(210, 233, 233) !important;
        border: 2px solid rgb(210, 233, 233);

    }

    .download:hover {
        color: green !important;
        border-radius: 5px;
        border: 2px solid green;
        background-color: #fff !important;
    }

    .activeCol {
        width: 110px;
    }

    .autocomplete {
        width: 160px;
        /* border: 1px solid #36b9cc; */
        border-radius: 5px;
        position: fixed;
        background-color: #fff;
        z-index: 5555;
        max-height: 140px;
        overflow: auto;
        display: none;
    }


    .idhover:hover {
        background-color: #17a2b8;
        color: #fff;
    }

    .autocomplete-text{
        margin-left: 10px;
    }
</style>
@endsection

@section('body')
<div class="container">
    <div class="row mt-3">

        <div class="col">
            <div class="row">
                <div class="col">
                    @if (session('success'))
                    <div class="alert alert-success border-success d-flex justify-content-between shadow-sm" id="alertBox">
                        <div class="col-6">
                            <i class="fa-solid fa-circle-check text-success"></i>
                            {{ session('success') }}
                        </div>
                        <div class="col-6 d-flex flex-row-reverse">
                            <span class="btn" id="alertClose">&times;</span>
                        </div>

                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger d-flex justify-content-between shadow-sm" id="alertBox">
                        <div class="col-6">
                            <i class="fa-solid fa-circle-exclamation text-danger"></i>
                            {{ session('error') }}
                        </div>
                        <div class="col-6 d-flex flex-row-reverse">
                            <span class="btn" id="alertClose">&times;</span>
                        </div>

                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="row alert alert-danger d-flex" id="alertBox">
                        <div class="col-6">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </div>

                        <div class="col-6 d-flex flex-row-reverse">
                            <span class="btn" id="alertClose">&times;</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="row ml-2">
                <span class="text-info h4">{{ trans('language.item_list') }}</span>
            </div>

            {{-- ############ --}}
            {{-- START  --}}
            {{-- ************************************** --}}
            {{-- searching in 4 type fiel   --}}
            {{-- **************************************** --}}
            <div class="row mb-1">
                <form action="{{ route('item.search') }}" method="GET" class="d-flex w-100" id="searchForm">

                    <input type="hidden" name="search" value="search">
                    <div class="col-2">
                        <input type="text" class="form-control" name="itemId" id="itemIdField" placeholder="{{ trans('language.enter_id') }}" autocomplete="off">
                        <div id="searchResults" class="autocomplete shadow"></div>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="itemCode" id="itemCode" placeholder="{{ trans('language.enter_code') }}">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="itemName" id="itemName" placeholder="{{ trans('language.enter_name') }}">
                    </div>
                    <div class="col-3">
                        <select class="form-control" aria-label="Default select example" id="category" name="category">
                            <option value="" selected>{{ trans('language.choose_category') }}</option>

                            @foreach ($categories as $row)
                            {
                            <option value="{{ $row['id'] }}">{{ $row['category_name'] }}</option>
                            }
                            @endforeach

                        </select>
                    </div>

                    <div class="col-2">
                        <button type="submit" class="btn btn-info w-100" id="inputBtn"><i class="fa-solid fa-magnifying-glass mr-2"></i>{{ trans('language.search') }}</button>
                    </div>
                </form>
            </div>
            {{-- ############ --}}
            {{-- END  --}}
            {{-- ************************************** --}}


            <div class="row">
                <div class="col-6">
                </div>

                @if (count($items) !== 0)
                <div class="col-6 d-flex flex-row-reverse mt-2">
                    <form action="{{ route('item.search') }}" method="GET" class="">
                        @csrf
                        @method('GET')
                        <input type="hidden" name="search" value="pdf">
                        <input type="text" name="itemId" id="pdfItemId" hidden>
                        <input type="text" name="itemCode" id="pdfItemCode" hidden>
                        <input type="text" name="itemName" id="pdfItemName" hidden>
                        <input type="text" name="category" id="pdfCategory" hidden>
                        <input type="text" name="page" value="{{ $items->currentPage() }}" hidden>

                        <button type="submit" class="btn btn-light download"><i class="fa-solid fa-file-arrow-down mr-2"></i>{{ trans('language.pdf_down') }}</button>
                    </form>

                    <form action="{{ route('item.search') }}" method="GET" class="mr-3">
                        @csrf
                        @method('GET')
                        <input type="hidden" name="search" value="excel">
                        <input type="text" name="itemId" id="excelItemId" hidden>
                        <input type="text" name="itemCode" id="excelItemCode" hidden>
                        <input type="text" name="itemName" id="excelItemName" hidden>
                        <input type="text" name="category" id="excelCategory" hidden>
                        <input type="text" name="page" value="{{ $items->currentPage() }}" hidden>

                        <button type="submit" class="btn btn-light download"><i class="fa-solid fa-file-arrow-down mr-2"></i>{{ trans('language.excel_down') }}</button>
                    </form>

                </div>
                @endif
            </div>

            <div class="card mt-2 shadow cardTable mb-4">

                <div class="row">
                    <div class="col">



                        @if (count($items) === 0)
                        <div class="row">
                            <div class="col m-auto">
                                <h6 class="p-3 text-center">{{ trans('language.no_data') }}</h6>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col d-flex flex-row-reverse">
                                <p class="text-info mr-3 mt-2">{{ trans('language.total') }} :
                                    {{ $rowCount }} row(s)
                                </p>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col border-info">
                                <table class="table table-hover table-striped table-bordered border-primary" id="myTable">
                                    <thead class="bg-info text-white tHead">
                                        <tr rowspan=2>
                                            <th class="text-center" scope="col">{{ trans('language.no') }}
                                            </th>
                                            <th class="text-center" scope="col">
                                                {{ trans('language.item_id') }}
                                            </th>
                                            <th class="text-center" scope="col">
                                                {{ trans('language.item_code') }}
                                            </th>
                                            <th class="text-center" scope="col">
                                                {{ trans('language.item_name') }}
                                            </th>
                                            <th class="text-center" scope="col">
                                                {{ trans('language.category_name') }}
                                            </th>
                                            <th class="text-center" scope="col">
                                                {{ trans('language.safety_stock') }}
                                            </th>
                                            <th class="text-center activeCol" scope="col">
                                                {{ trans('language.in_active') }}
                                            </th>
                                            <th class="text-center" scope="col">
                                                {{ trans('language.action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($items as $row)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="text-center">{{ $row['item_id'] }}</td>
                                            <td class="text-center">{{ $row['item_code'] }}</td>
                                            <td class="">{{ $row['item_name'] }}</td>
                                            <td class="">{{ $row['category_name'] }}</td>
                                            <td class="text-center">{{ $row['safety_stock'] }}</td>
                                            <td class="">
                                                @if (@empty($row['deleted_at']))
                                                <a href="#" class="activeBtn" id="" value="{{ $row['id'] }}">
                                                    <button type="button" class="btn border-info w-100 tabel-btn activeInactiveBtn" data-bs-toggle="modal" data-bs-target="#addCategory" id="{{ $row['item_id'] }}" title="" value="active">
                                                        Active
                                                    </button>
                                                </a>
                                                @else
                                                <a href="#" class="inactiveBtn" id="" value="{{ $row['id'] }}">
                                                    <button type="button" class="btn border-info w-100 tabel-btn-inactive activeInactiveBtn" data-bs-toggle="modal" data-bs-target="#addCategory" id="{{ $row['item_id'] }}" title="" value="active">
                                                        Inactive
                                                    </button>
                                                </a>
                                                @endif



                                            </td>
                                            <td class="text-center d-flex justify-content-between">
                                                <a href="{{ route('detail.item', $row['id']) }}" class="tabel-btn" id="editRoute">
                                                    <button class="btn border-info text-white" title="Detail">
                                                        <i class="fa-solid fa-circle-info text-dark icon"></i>
                                                    </button>
                                                </a>

                                                @if (@empty($row['deleted_at']))
                                                <a href="{{ route('edit.item', $row['id']) }}" class="mx-1 tabel-btn" id="editLink{{ $row['item_id'] }}">
                                                    <button type="" class="btn border-info" title="Edit" id="editBtn{{ $row['item_id'] }}">
                                                        <i class="fa-solid fa-pen-to-square text-success icon"></i>
                                                    </button>
                                                </a>



                                                <button class="btn border-info deleteBtn tabel-btn" id="deleteBtn{{ $row['id'] }}" title="Delete" value="{{ $row['id'] }}">
                                                    <i class="fa-solid fa-trash-can text-danger icon"></i>
                                                </button>
                                                @else
                                                <a href="" class="mx-1" id="editLink{{ $row['item_id'] }}" disabled>
                                                    <button class="btn border-info" title="Disable Edit" id="editBtn{{ $row['item_id'] }}" disabled>
                                                        <i class="fa-solid fa-pen-to-square text-secondary"></i>
                                                    </button>
                                                </a>

                                                <a href="" class="" id="deleteLink{{ $row['item_id'] }}" disabled>
                                                    <button class="btn border-info" title="Disable Delete" id="deleteBtn{{ $row['item_id'] }}" disabled>
                                                        <i class="fa-solid fa-trash-can text-secondary"></i>
                                                    </button>
                                                </a>
                                                @endif

                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col d-flex justify-content-center">

                                {{ $items->appends(request()->except('page'))->links() }}

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- active state model -->
<div id="myActivInactiveModal" class="myActivInactiveModalClass">
    <!-- Modal content -->
    <div class="active-inactive-modal-content col-3">
        <div class="row d-flex justify-content-between mb-4">
            <div class="col-10 h6 text-info d-flex flex-row-reverse">Are you sure want to inactive?</div>
            <div class="col-2 closeBox d-flex flex-row-reverse">&times;</div>
        </div>

        <div class="col-10 m-auto d-flex justify-content-between">
            <div>
                <button type="submit" id="changeState" class="btn btn-success w-100" value="">Inactive</button>
            </div>

            <div class="">
                <button type="submit" id="" class="btn btn-danger w-100">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- inactive state model -->
<div id="myInactiveModal" class="myInactiveModalClass">
    <!-- Modal content -->
    <div class="inactive-modal-content col-3">
        <div class="row d-flex justify-content-between mb-4">
            <div class="col-10 h6 text-info d-flex flex-row-reverse">Are you sure want to active?</div>
            <div class="col-2 closeBox d-flex flex-row-reverse">&times;</div>
        </div>

        <div class="col-10 m-auto d-flex justify-content-between">
            <div>
                <button type="submit" id="inactiveChangeState" class="btn btn-success w-100" value="">Active</button>
            </div>

            <div class="">
                <button type="submit" id="" class="btn btn-danger w-100">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- delete items model -->
<div id="deleteModal" class="deleteModalClass">
    <!-- Modal content -->
    <div class="delete-modal-content col-3">
        <div class="row d-flex justify-content-between mb-4">
            <div class="col-10 h6 text-info d-flex flex-row-reverse">Are you sure want to delete?</div>
            <div class="col-2 closeBox d-flex flex-row-reverse">&times;</div>
        </div>

        <div class="col-10 m-auto d-flex justify-content-between">
            <div>
                <form action="{{ route('delete.item') }}" method="POST" class="d-flex w-100">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="paginationPage" name="paginationPage">
                    <input type="hidden" id="deleteConfirm" name="deleteInput">
                    <input type="hidden" id="" name="perpage" value="{{ $items->perPage() }}">


                    <button type="submit" class="btn btn-success w-100" value="">Delete</button>
                </form>
            </div>

            <div class="">
                <button type="" id="" class="btn btn-danger w-100">Cancel</button>
            </div>
        </div>
    </div>
</div>


@endsection

<!-- OtherBladeTemplate.blade.php -->
@push('script')
<script src="{{ asset('jquery/autocomplete.js') }}"></script>
<script src="{{ asset('jquery/itemlist.js') }}"></script>
<script src="{{ asset('jquery/search.js') }}"></script>
<script src="{{ asset('jquery/activeState.js') }}"></script>
<script src="{{ asset('jquery/inactiveState.js') }}"></script>
<script src="{{ asset('jquery/deleteItem.js') }}"></script>
<script src="{{ asset('jquery/inputChange.js') }}"></script>
@endpush