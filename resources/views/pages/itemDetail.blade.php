@php
$currentUrl = url()->current();
$previousUrl = url()->previous();
if ($currentUrl != $previousUrl)
Session::put('requestReferrer', $previousUrl);
@endphp

@extends('layouts.app')

@section('title')
Item Detail
@endsection

<style>
    .detailImage {
        animation: fadeIn 1s ease-in;
        opacity: 1;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    #animate {
        animation: topDownAnimation 0.5s ease-in;
        opacity: 1;
    }

    @keyframes topDownAnimation {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

@section('body')
<div class="container">
    <div class="row mt-2">
        <div class="col d-flex">
            <a href="{{ Session::get('requestReferrer') }}" class="text-info btn border-info" title="Back"><i class="fa-solid fa-chevron-left"></i>Back</a>
            <span class="text-info h4 mx-3">{{ trans('language.item_detail') }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mt-2 shadow">
                <div class="card-header">
                    <h4 class="text-info">{{ $items->item_name }}</h4>
                </div>
                <div class="row p-4">

                    <div class="col-6">

                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.item_id') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-success h6">{{ $items['item_id'] }}</div>
                        </div>

                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.item_code') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-success h6">{{ $items['item_code'] }}</div>
                        </div>

                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.category_name') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-success h6">{{ $items->category_name }}</div>
                        </div>

                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.safety_stock') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-success h6">{{ $items->safety_stock }}</div>
                        </div>

                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.received_date') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-success h6">{{ $items->received_date }}</div>
                        </div>

                        @if ($items['deleted_at'] !== null)
                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.in_active') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-danger h6">Inactive</div>
                        </div>
                        @else
                        <div class="row d-flex shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col-4 h6 text-info ml-1">{{ trans('language.in_active') }}</div>
                            <div class="col-1 text-info"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                            <div class="col-6 text-success h6">Active</div>
                        </div>
                        @endif



                        <div class="row shadow-sm border-left border-right border-info rounded p-1 mb-1" id="animate">
                            <div class="col">
                                <div class="row h6 text-info ml-1 d-block">
                                    {{ trans('language.description') }}
                                </div>
                                <div class="row mx-1 text-justify">

                                    <span><i class="fa-solid fa-minus text-info mr-1"></i>{{ $items->description }}</span>

                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="col-6">
                        <div class="card shadow rounded">
                            <img src="{{ asset($items->file_path) }}" class="card-img-top detailImage" alt="" style="width: 100%; height:350px">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection