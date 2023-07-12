@extends('layouts.backend.app')

@section('title', $data['title'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create New {{ $data['title'] }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item"><a href="/projects">{{ $data['title'] }} List</a></li>
                            <li class="breadcrumb-item active">Create New {{ $data['title'] }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['title'] }} Create Form</h3>

                            <a href="{{ route('projects.index') }}" class="btn btn-secondary float-right btn-sm"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Upload Perspective View Image</label>
                                        <input id="image" type="file" name="image"
                                            data-max-file-size="2000KB">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="project_title" class="form-label">Project Title</label>
                                                <input name="project_title" type="text" class="form-control"
                                                    id="project_title">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="description" class="form-label">Description</label>
                                                <input name="description" type="text" class="form-control"
                                                    id="description">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="project_cost" class="form-label">Project Cost</label>
                                                <input name="project_cost" type="number" class="form-control"
                                                    id="project_cost">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="client_name" class="form-label">Client Name</label>
                                                <input name="client_name" type="text" class="form-control"
                                                    id="client_name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="address_location" class="form-label">Address Location</label>
                                                <input name="address_location" type="text" class="form-control"
                                                    id="address_location" placeholder="1234 Main St">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="longitude">Longitude <span
                                                            class="text-danger">*</span></label>
                                                    <input readonly id="longitude" type="text" class="form-control"
                                                        name="longitude" value="{{ old('longitude') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="latitude">Latitude <span
                                                            class="text-danger">*</span></label>
                                                    <input readonly id="latitude" type="text" class="form-control"
                                                        name="latitude" value="{{ old('latitude') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="map" style="height:400px; width: 100%;" class="my-3"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });
    </script>

    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 15.9599,
                    lng: 120.3421
                },
                zoom: 15,
                scrollwheel: true,
            });


            const uluru = {
                lat: 15.9599,
                lng: 120.3421
            };

            $('#latitude').val(uluru.lat)
            $('#longitude').val(uluru.lng)

            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });
            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#latitude').val(lat)
                    $('#longitude').val(lng)
                })
            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
@endpush
