@extends('layouts.base')
@section('title', 'voyage')
@section('content')
    <div class="container mt-5 pt-5">
        <div class="row align-items-center">
            <!-- Colonne d'image à droite -->
            <div class="col-md-6">
                <img src="{{ asset('asset/voyage/undraw_travel-mode_ydxo.png')}}" alt="Image descriptive" class="img-fluid rounded">
            </div>
            <!-- Colonne de texte à gauche -->
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column">
                <div class="text-center">
                    <h2>Chaque destination, une nouvelle histoire</h2>
                </div>
                <div>
                    <a href="#continu" class="btn btn-primary mt-3" class="#continu"><i class=" fa fa-arrow-down "></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class=" row text-black" id="continu">

                <div class="event container">
                    <div class="row gy-6">

                        <div class="col-md-3 my-3 col-6 ">

                            <div class="card event-item">
                                <img src="{{ asset('asset/voyage/aledjo.png') }}" class="card-img-top  w-100 h-100 object-fit-cover" alt="">
                                <div class="card-body">
                                    <h3 class="card-title text-center">hello</h3>

                                    <p class="card-text d-none d-md-block d-none d-md-block">Some quick example text to
                                        build on the card title and make up </p>
                                    <div class="info-bouton ">
                                        <div class="w-100">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="width: 100%">
                                                plus d'info
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade modal-xl modal-fullscreen-sm-down modal-fullscreen-md-down modal-fullscreen-lg-down"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class=" d-flex  justify-between align-content-between">
                                                                <h1> logo</h1>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title
                                                                </h1>

                                                            </div>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3 w-100 border-0">
                                                                <div class="row ">
                                                                    <div class="col-md-5">
                                                                        <video src="{{ asset('asset/videos/events.mp4') }}"
                                                                            class="w-100  object-fit-none"
                                                                            aria-autocomplete="both" controls
                                                                            style="border-radius: 5px"></video>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Card title</h5>
                                                                            <p class="card-text d-none d-md-block">This is a
                                                                                wider card with
                                                                                supporting text below as a natural lead-in
                                                                                to
                                                                                additional content. This content is a little
                                                                                bit
                                                                                longer.</p>
                                                                            <p class="card-text d-none d-md-block"><small
                                                                                    class="text-body-secondary">Last updated
                                                                                    3 mins
                                                                                    ago</small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3 col-6">
                            <div class="card event-item">
                                <img src="{{ asset('asset/voyage/Caverne.png') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="">
                                <div class="card-body">
                                    <h3 class="card-title text-center">hello</h3>

                                    <p class="card-text d-none d-md-block">Some quick example text to build on the card
                                        title and make up </p>
                                    <div class="info-bouton ">
                                        <div class="w-100">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="width: 100%">
                                                plus d'info
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade modal-xl modal-fullscreen-sm-down modal-fullscreen-md-down modal-fullscreen-lg-down"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class=" d-flex  justify-between align-content-between">
                                                                <h1> logo</h1>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title
                                                                </h1>

                                                            </div>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3 w-100 border-0">
                                                                <div class="row ">
                                                                    <div class="col-md-5">
                                                                        <video src="{{ asset('asset/videos/events.mp4') }}"
                                                                            class="w-100  object-fit-none"
                                                                            aria-autocomplete="both" controls
                                                                            style="border-radius: 5px"></video>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Card title</h5>
                                                                            <p class="card-text d-none d-md-block">This is a
                                                                                wider card with
                                                                                supporting text below as a natural lead-in
                                                                                to
                                                                                additional content. This content is a little
                                                                                bit
                                                                                longer.</p>
                                                                            <p class="card-text d-none d-md-block"><small
                                                                                    class="text-body-secondary">Last updated
                                                                                    3 mins
                                                                                    ago</small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3 col-6">
                            <div class="card event-item">
                                <img src="{{ asset('asset/voyage/cases.png') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="">
                                <div class="card-body">
                                    <h3 class="card-title text-center">hello</h3>

                                    <p class="card-text d-none d-md-block">Some quick example text to build on the card
                                        title and make up </p>
                                    <div class="info-bouton ">
                                        <div class="w-100">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="width: 100%">
                                                plus d'info
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade modal-xl modal-fullscreen-sm-down modal-fullscreen-md-down modal-fullscreen-lg-down"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class=" d-flex  justify-between align-content-between">
                                                                <h1> logo</h1>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title
                                                                </h1>

                                                            </div>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3 w-100 border-0">
                                                                <div class="row ">
                                                                    <div class="col-md-5">
                                                                        <video src="{{ asset('asset/videos/events.mp4') }}"
                                                                            class="w-100  object-fit-none"
                                                                            aria-autocomplete="both" controls
                                                                            style="border-radius: 5px"></video>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Card title</h5>
                                                                            <p class="card-text d-none d-md-block">This is
                                                                                a wider card with
                                                                                supporting text below as a natural lead-in
                                                                                to
                                                                                additional content. This content is a little
                                                                                bit
                                                                                longer.</p>
                                                                            <p class="card-text d-none d-md-block"><small
                                                                                    class="text-body-secondary">Last
                                                                                    updated 3 mins
                                                                                    ago</small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3 col-6">
                            <div class="card event-item">
                                <img src="{{ asset('asset/voyage/bagage.png') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="">
                                <div class="card-body">
                                    <h3 class="card-title text-center">hello</h3>

                                    <p class="card-text d-none d-md-block">Some quick example text to build on the card
                                        title and make up </p>
                                    <div class="info-bouton ">
                                        <div class="w-100">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="width: 100%">
                                                plus d'info
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade modal-xl modal-fullscreen-sm-down modal-fullscreen-md-down modal-fullscreen-lg-down"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class=" d-flex  justify-between align-content-between">
                                                                <h1> logo</h1>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title
                                                                </h1>

                                                            </div>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3 w-100 border-0">
                                                                <div class="row ">
                                                                    <div class="col-md-5">
                                                                        <video src="{{ asset('asset/videos/events.mp4') }}"
                                                                            class="w-100  object-fit-none"
                                                                            aria-autocomplete="both" controls
                                                                            style="border-radius: 5px"></video>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Card title</h5>
                                                                            <p class="card-text d-none d-md-block">This is
                                                                                a wider card with
                                                                                supporting text below as a natural lead-in
                                                                                to
                                                                                additional content. This content is a little
                                                                                bit
                                                                                longer.</p>
                                                                            <p class="card-text d-none d-md-block"><small
                                                                                    class="text-body-secondary">Last
                                                                                    updated 3 mins
                                                                                    ago</small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3 col-6">
                            <div class="card event-item">
                                <img src="{{ asset('asset/voyage/cascades.png') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="">
                                <div class="card-body">
                                    <h3 class="card-title text-center">hello</h3>

                                    <p class="card-text d-none d-md-block">Some quick example text to build on the card
                                        title and make up </p>
                                    <div class="info-bouton ">
                                        <div class="w-100">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="width: 100%">
                                                plus d'info
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade modal-xl modal-fullscreen-sm-down modal-fullscreen-md-down modal-fullscreen-lg-down"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class=" d-flex  justify-between align-content-between">
                                                                <h1> logo</h1>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title
                                                                </h1>

                                                            </div>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3 w-100 border-0">
                                                                <div class="row ">
                                                                    <div class="col-md-5">
                                                                        <video src="{{ asset('asset/videos/events.mp4') }}"
                                                                            class="w-100  object-fit-none"
                                                                            aria-autocomplete="both" controls
                                                                            style="border-radius: 5px"></video>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Card title</h5>
                                                                            <p class="card-text d-none d-md-block">This is
                                                                                a wider card with
                                                                                supporting text below as a natural lead-in
                                                                                to
                                                                                additional content. This content is a little
                                                                                bit
                                                                                longer.</p>
                                                                            <p class="card-text d-none d-md-block"><small
                                                                                    class="text-body-secondary">Last
                                                                                    updated 3 mins
                                                                                    ago</small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3 col-6">
                            <div class="card event-item">
                                <img src="{{ asset('asset/voyage/campagne.png') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="">
                                <div class="card-body">
                                    <h3 class="card-title text-center">hello</h3>

                                    <p class="card-text d-none d-md-block">Some quick example text to build on the card
                                        title and make up </p>
                                    <div class="info-bouton ">
                                        <div class="w-100">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="width: 100%">
                                                plus d'info
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade modal-xl modal-fullscreen-sm-down modal-fullscreen-md-down modal-fullscreen-lg-down"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class=" d-flex  justify-between align-content-between">
                                                                <h1> logo</h1>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title
                                                                </h1>

                                                            </div>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3 w-100 border-0">
                                                                <div class="row ">
                                                                    <div class="col-md-5">
                                                                        <video
                                                                            src="{{ asset('asset/videos/events.mp4') }}"
                                                                            class="w-100  object-fit-none"
                                                                            aria-autocomplete="both" controls
                                                                            style="border-radius: 5px"></video>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Card title</h5>
                                                                            <p class="card-text d-none d-md-block">This is
                                                                                a wider card with
                                                                                supporting text below as a natural lead-in
                                                                                to
                                                                                additional content. This content is a little
                                                                                bit
                                                                                longer.</p>
                                                                            <p class="card-text d-none d-md-block"><small
                                                                                    class="text-body-secondary">Last
                                                                                    updated 3 mins
                                                                                    ago</small></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

    </div>
@endsection
