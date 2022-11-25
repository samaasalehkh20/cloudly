@extends('layouts.front-layouts')

@section('page_title', 'All Images')
@section('page_name', 'Images Page')

@section('content')
    <div class="container">
        <div class="row">
            @if ( $images )
                @foreach( $images as $key => $value )
                        <div class="col-md-4 mb-4" >
                            <a type="button" style="text-decoration: none; color: #0c0e1a" data-key="{{ $key }}" class="getRecent" data-toggle="modal" data-target="#exampleModal-{{ $key }}" >
                                <div class="card shadow-sm">
                                    <div class="card-header" style="height: 65px; margin-bottom: 20px;">
                                        <h3 class="card-title">
                                            {{ $key }}
                                        </h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="card-p mb-10">
                                            <div class="text-center px-4">
                                                <img class="mw-100 mh-300px card-rounded-bottom" alt="" src="{{ asset('storage') . '/' . $value }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ $key }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img class="mw-100 mh-300px card-rounded-bottom" alt="" src="{{ asset('storage') . '/' . $value }}" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            @else
                <div class="col-md-12">
                        <div class="card-body text-center">
                            <img src="{{ asset('Front-assets/media/svg/avatars/no-data2.png') }}" style="border-radius: 40%" height="50%" width="50%">
                        </div>

                </div>
            @endif

        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.getRecent').click(function(e) {
            e.preventDefault();
            // alert()

            key = $(this).data('key')

            $.ajax({
               url: '{{ route('upload_image.getRecent') }}',
               type: 'get',
               data: {
                   key: key,
               },
               success: function (data) {
                   console.log('Done');
               },
               error: function(data) {
                   console.log(data);
               }
            });

        })
    </script>
@endsection
