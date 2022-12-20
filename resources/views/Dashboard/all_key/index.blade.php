@extends('layouts.front-layouts')

@section('page_title', 'All Keys')

@section('page_name', 'All Keys')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            @if ( $images )
                                All Keys ( {{ count( $images ) }} )
                            @else
                                All Keys ( 0 )
                            @endif
                            <span class="text-muted pt-2 font-size-sm d-block">
                                All  Keys - Read It From Confiq
                            </span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#clearAll">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            Clear All
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Key Name</th>
                                <th scope="col">image For Key</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ( $images )
                            @php
                                $i = 1;
                            @endphp
                            @foreach( $images as $value )
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->key }}</td>
                                    <td>
                                        <img src="{{ $value->image }}" width="80" height="80" style="border-radius: 50%">
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center text-danger">
                                <th colspan="3" scope="row">{{ 'No Keys' }}</th>

                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

    <!-- Modal-->
    <div class="modal fade" id="clearAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('all_keys.clear') }}" method="POST">
                @csrf
                @method('GET')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Clear All Keys</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to Clear all Keys ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Yes, Sure</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('Front-assets/js/pages/crud/ktdatatable/base/data-local.js?v=7.0.5') }}"></script>
@endsection
