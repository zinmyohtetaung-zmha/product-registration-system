@extends('layouts.app')

@section('title')
Normal Register Form
@endsection

<link rel="stylesheet" href="{{ asset('style/modal.css') }}">



@section('body')
<div class="container mt-2">
    <div class="row mb-3">
        <div class="col d-flex">
            <a href="{{ route('item.lists') }}" class="text-info btn border-info" title="Back"><i class="fa-solid fa-chevron-left"></i>Back</a>
            <span class="text-info h4 mx-3">{{ trans('language.items_register') }}</span>
        </div>      
    </div>

    <div class="row">
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
                    @if (session('message'))
                    <div class="alert alert-danger d-flex justify-content-between shadow-sm" id="alertBox">
                        <div class="col-6">
                            <i class="fa-solid fa-circle-check text-dangers"></i>
                            {{ session('message') }}
                        </div>
                        <div class="col-6 d-flex flex-row-reverse">
                            <span class="btn" id="alertClose">&times;</span>
                        </div>

                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger d-flex justify-content-between" id="alertBox">
                        <div class="col-6">
                            @foreach ($errors->all() as $error)
                            <i class="fa-solid fa-circle-exclamation text-danger"></i>
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        <div class="col-6 d-flex flex-row-reverse">
                            <span class="btn" id="alertClose">&times;</span>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
            <div class="card shadow">
                <div class="form-check row d-flex justify-content-between mt-4">
                    <div class="col-6" id="redioText">
                        <input type="radio" name="formSelector" value="form1" checked> <span id="normalRegisterText">{{ trans('language.normal_register') }}</span>
                    </div>
                    <div class="col-6">
                        <input type="radio" name="formSelector" value="form2"> <span id="excelRegisterText">{{ trans('language.excel_register') }}</span>
                    </div>
                </div>
                <hr>



                <div class="card-body">
                    <form id="form1" class="form" action="{{ route('store.item') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="item_id">{{ trans('language.item_id') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="item_id" id="item_id" aria-describedby="" value="{{ $itemId }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="item_code">{{ trans('language.item_code') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="item_code" id="item_code" aria-describedby="" placeholder="{{ trans('language.enter_code') }}" value="{{ old('item_code') }}" maxlength="50">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="item_name">{{ trans('language.item_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="item_name" id="item_name" aria-describedby="" placeholder="{{ trans('language.enter_name') }}" value="{{ old('item_name') }}" maxlength="100">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col"><label for="inputState">{{ trans('language.category_name') }}<span class="text-danger">*</span><span id="addCategorysuccess" class="text-success"></span></label></div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <select class="form-control" aria-label="Default select example" id="inputState" name="selectbox">
                                                <option disabled selected hidden value="" id="registerCategory">
                                                    {{ trans('language.choose_category') }}
                                                </option>
                                                @foreach ($categories as $opt)
                                                <option id="removeOption" value="{{ $opt['id'] }}" @if (old('selectbox')==$opt['id']) selected @endif>
                                                    {{ $opt['category_name'] }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <button type="button" class="input-group-text rounded bg-info ml-2" data-bs-toggle="modal" data-bs-target="#addCategory" id="myBtn" title="Add Category">
                                                <i class="fa-solid fa-circle-plus text-white"></i>
                                            </button>
                                            <button type="button" class="input-group-text rounded bg-info ml-2" data-bs-toggle="modal" data-bs-target="#removeCategory" id="categoryRemoveBtn" title="Delete Category">
                                                <i class="fa-solid fa-circle-minus text-white"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="myNumber">{{ trans('language.safety_stock') }}<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="safety_stock" id="myNumber" min="0" aria-describedby="" placeholder="{{ trans('language.enter_safety_stock') }}" value="{{ old('safety_stock') }}" max="99999999999" onKeyDown='if(this.value.length>=11) return false;'>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="received_date">{{ trans('language.received_date') }}<span class="text-danger bolder">*</span></label>
                                    <input type="date" class="form-control" name="received_date" id="received_date" aria-describedby="" placeholder="{{ trans('language.category_name') }}" value="{{ old('received_date') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">{{ trans('language.description') }}</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" value="">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="uploadImage">{{ trans('language.upload_photo') }}</label>
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col d-flex">
                                                            <input id="uploadImage" class="form-control rounded" style="padding-top: 3px; padding-left: 3px" value="{{ old('filename') }}" type="file" name="filename" onchange="PreviewImage();" />
                                                            <input type="button" id="removeImage" value="-" class="btn bg-info text-white border rounded ml-1" title="Remove Image">
                                                        </div>
                                                    </div>


                                                    <script type="text/javascript">
                                                        function PreviewImage() {
                                                            var oFReader = new FileReader();
                                                            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                                                            oFReader.onload = function(oFREvent) {
                                                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                                                            };
                                                        };
                                                    </script>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 d-flex flex-row-reverse">
                                            <img id="uploadPreview" style="width: 120px; height: 80px; border-radius:5px;" />
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-info w-100">{{ trans('language.save') }}</button>
                            </div>
                            <div class="col-6">
                                <button type="reset" class="btn btn-danger w-100">{{ trans('language.reset') }}</button>
                            </div>
                        </div>

                    </form>

                    <form action="{{ route('itemexcel.import') }}" method="POST" id="form2" class="form" style="display:none; animation-duration: 4s;" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="excel">{{ trans('language.upload_excel') }} <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="excel" aria-describedby="" style="padding-top: 3px; padding-left: 3px" name="file" old>
                        </div>

                        <div class="row d-flex justify-content-between">
                            <div class="col-6">
                                <a href="{{ route('excelformat.down') }}" class="btn btn-info">
                                    {{ trans('language.excel_format_download') }}
                                </a>

                            </div>
                            <div class="col-6 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-info">{{ trans('language.save') }}</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- addcategory model -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content col-4">
        <div class="row d-flex justify-content-between ">
            <div class="col-9 h5 text-info d-flex flex-row-reverse">{{ trans('language.category_register') }}</div>
            <div class="col-3 close d-flex flex-row-reverse">&times;</div>
        </div>

        <div class="form-group">
            <label for="dialogCategoryInput">{{ trans('language.category_register') }}<span class="text-danger bolder">*</span></label>
            <input type="text" class="form-control" id="dialogCategoryInput" aria-describedby="" placeholder="{{ trans('language.enterd_category') }}">
            <span id="addCategoryRequire" class="text-danger"></span>
        </div>

        <div class="d-flex flex-row-reverse">
            <button type="submit" id="dialogSaveButton" class="btn btn-info">{{ trans('language.add_category') }}</button>
        </div>
    </div>
</div>


<!-- category remove model -->
<div id="categoryRemoveModal" class="categoryRemoveModal">

    <!-- Modal content -->
    <div class="category-remove-modal-content col-4">

        <div class="row d-flex justify-content-between">
            <div class="col-9 h5 text-info d-flex flex-row-reverse">{{ trans('language.delete_category') }}</div>
            <div class="col-3 closeRemove d-flex flex-row-reverse">&times;</div>
        </div>

        <div class="row">
            <div class="col text-danger"></div>
        </div>
        <form id="removeForm">
            @csrf
            <div class="form-group">
                <label for="removeSelectBox">{{ trans('language.category_name') }}</label>

                <select id="removeSelectBox" class="form-control select2" name="selected_value">
                    <option selected id="noDeleteCategory" value="notselect">{{ trans('language.enterd_category') }}</option>

                    @foreach ($deleteAbleCategory as $opt)
                    {
                    <option value="{{ $opt['id'] }}">{{ $opt['category_name'] }}</option>
                    }
                    @endforeach
                </select>
                <span id="notSeledctCategory" class="text-danger"></span>

            </div>
            <div class="row">
            </div>

            <div class="d-flex flex-row-reverse">
                <button type="submit" id="removeCategoryButton" class="btn btn-info">{{ trans('language.remove_category') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection

<!-- OtherBladeTemplate.blade.php -->
@push('script')
<script src="{{ asset('jquery/itemlist.js') }}"></script>
<script src="{{ asset('jquery/changeregister.js') }}"></script>
<script src="{{ asset('jquery/modal.js') }}"></script>
<script src="{{ asset('jquery/addcategory.js') }}" data-url="{{ route('create.category') }}"></script>
<script src="{{ asset('jquery/removecategory.js') }}" data-url="{{ route('delete.category') }}"></script>
<script src="{{ asset('jquery/inputtypenumber.js') }}"></script>
@endpush