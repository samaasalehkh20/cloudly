@extends('layouts.front-layouts')

@section('page_title', 'Search')

@section('page_name', 'Search')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">

                        <!--begin::Form-->
                        <form action="{{ route('upload_image.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Key</label>
                                        <input type="text" class="form-control" placeholder="Enter Key" id="key" name="key"/>
                                        <span class="form-text text-muted">
                                            Enter The Key

                                        </span>
                                    </div>

                                    <div class="col-md-4 form-group" style="margin-top: 25px;">
                                        <button type="submit" class="btn btn-primary mr-2">Search</button>
                                        <span id="no-key" class="text-danger">

                                        </span>
                                    </div>

                                </div>

                                <label for="">
                                    Image
                                </label>
                                <div class="row">
                                    <img src="{{ asset('Front-assets/media/svg/avatars/def.jpg') }}" height="200" width="200" id="image">
                                </div>

                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('Front-assets/js/pages/crud/file-upload/image-input.js?v=7.0.5') }}"></script>
    <script>
        $('.btn-primary').click(function (e) {
            e.preventDefault();
            var key = $('#key').val();
            $.ajax({
                url: "{{ route('search.search') }}",
                type: 'GET',
                data: {
                    key: key,
                },
                success: function(data) {
                    if ( data.status == true ) {
                        $('#no-key').empty()
                        $('#image').attr('src',  '{{ asset('storage'). '/' }}'+ data.value );
                    }else{
                        $('#no-key').append(data.data)
                    }

                },
                error: function(data) {
                    console.log('No')
                },

            })
        })
    </script>
@endsection
