@extends('layouts.Obase')
@section('title', '| modifier ')
@section('content')
    <div class="mt-3">
        <section class="get-in-touch">
            <h1 class="title"><i class="fa fa-crop-simple"></i></h1>
            <form action="{{ route('organisateur.ev-update', ['id' => $evenement->id]) }}" method="POST" enctype="multipart/form-data"
                class="contact-form row">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-md-12 col-sm-12 col-lg-6 ">
                        <div class="row form-group ">
                            <div class="col-md-6 mt-4 form-field">
                                <label for="categorie" class="form-label text-bold">Catégorie d'événement</label>
                                <select class=" select2-container--default js-input text-black pt-3 w-100" id="categorie"
                                    name="categorie"
                                    style="border-bottom: 2px solid rgb(107, 52, 207); border-top: none;border-right: none;border-left: none">
                                    <option disabled selected>Selectionner la categorie</option>
                                    <option value="conference et congrès"
                                        {{ old('categorie', $evenement->categorie) == 'conference et congrès' ? 'selected' : '' }}>
                                        Conférence et congrès</option>
                                    <option value="vie nocturne"
                                        {{ old('categorie', $evenement->categorie) == 'vie nocturne' ? 'selected' : '' }}>
                                        Vie nocturne</option>
                                    <option value="évènement sportive"
                                        {{ old('categorie', $evenement->categorie) == 'évènement sportive' ? 'selected' : '' }}>
                                        Événement sportif</option>
                                    <option value="fête"
                                        {{ old('categorie', $evenement->categorie) == 'fête' ? 'selected' : '' }}>Fête
                                    </option>
                                    <option value="concert et festivals de musique"
                                        {{ old('categorie', $evenement->categorie) == 'concert et festivals de musique' ? 'selected' : '' }}>
                                        Concerts et festivals de musique</option>
                                    <option value="santé"
                                        {{ old('categorie', $evenement->categorie) == 'santé' ? 'selected' : '' }}>Santé
                                    </option>
                                    <option value="voyage et tourisme"
                                        {{ old('categorie', $evenement->categorie) == 'voyage et tourisme' ? 'selected' : '' }}>
                                        Voyage et tourisme</option>
                                </select>
                                @error('categorie')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-4 form-field">
                                <label for="titre" class="form-label text-bold">Titre de l'événement</label>
                                <input type="text" name="titre" id="titre" class="input-text js-input text-black"
                                    value="{{ old('titre', $evenement->titre) }}">
                                @error('titre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row form-group">

                            <div class="col-md-6 mt-4 form-field">
                                <label for="start_heure" class="form-label text-bold">Heure de début</label>
                                <input type="time" name="start_heure" id="start_heure"
                                    class="input-text js-input text-black heure"
                                    value="{{ old('start_heure', $evenement->start_heure) }}"">
                                @error('start_heure')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-4 form-field">
                                <label for="end_heure" class="form-label text-bold">Heure de fin</label>
                                <input type="time" name="end_heure" id="end_heure"
                                    class="input-text js-input text-black heure"
                                    value="{{ old('end_heure', $evenement->end_heure) }}">
                                @error('end_heure')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row form-group">

                            <div class="col-md-6 mt-4 form-field">
                                <label for="date" class="form-label text-bold">Date de déroulement</label>
                                <input type="date" name="date" id="date"
                                    class="input-text js-input text-black date"
                                    value="{{ old('date', $evenement->date) }}">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-4 form-field">
                                <label for="satut" class="form-label text-bold">Situation de l'evenement</label>
                                <select name="statut" id="satut"
                                    style="border-bottom: 2px solid rgb(107, 52, 207); border-top: none;border-right: none;border-left: none"
                                    class=" select2-container--default js-input text-black pt-3 w-100">
                                    <option value="en organisation"
                                        {{ old('satus', $evenement->satut) == 'en organisation' ? 'selected' : '' }}>
                                        Completer après des informations</option>
                                    <option value="publier"
                                        {{ old('satut', $evenement->status) == 'publiere' ? 'selected' : '' }}>Mètre en
                                        ligne maintenant</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group d-flex justify-content-center mt-5">
                            <img src="{{ asset('asset/image/EvenAf.png') }}" alt="" class="mt-5 w-100 img-fluid">
                        </div>

                    </div>
                    <div class="col-xxl-6 col-xl-6 col-md-12 col-sm-12 col-lg-6 ">
                        <div class="row form-group">
                            <div class="col-md-6 mt-4 form-field">
                                <label for="lieu" class="form-label text-bold">Lieu de déroulement</label>
                                <input type="text" id="lieu" name="lieu" class="input-text js-input text-black"
                                    value="{{ old('lieu', $evenement->lieu) }}">
                                @error('lieu')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-4 form-field">
                                <label for="lien_google_map" class="form-label text-bold">Lien Google Map du lieu de
                                    l'événement</label>
                                <input type="text" id="lien_google_map" name="lien_google_map"
                                    class="input-text js-input text-black"
                                    value="{{ old('lien_google_map', $evenement->lien_google_map) }}">
                                @error('lien_google_map')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 mt-4 form-field">
                                <label for="photo" class="form-label text-bold p-0">photo pour illustrer
                                    l'événement</label>
                                <input type="file" id="photo" name="photo" class="file"
                                value="{{ old('photo',$evenement->photo) }}"
                                    style="border-bottom: 2px solid rgb(107, 52, 207); border-top: none;border-right: none;border-left: none">
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($evenement->photo)
                                    <img src="{{ asset('storage/evenement/photo/' . $evenement->photo) }}"
                                        class="img-fluid rounded-1 w-100  p-2 " style="border-radius: 5px "
                                        alt="{{ $evenement->photo }}">
                                        <input type="text" name="photo" value="{{ $evenement->photo}}">
                                @else
                                    <p class="text-danger">Ajouter une photo ou affiche de l'evenment</p>
                                @endif

                            </div>
                            <div class="col-md-6 mt-4 form-field">
                                <label for="video" class="form-label text-bold">Vidéo pour illustrer
                                    l'événement</label>
                                <input type="file" id="video" name="video" class="file"
                                    style="border-bottom: 2px solid rgb(107, 52, 207); border-top: none;border-right: none;border-left: none">
                                @error('video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($evenement->video)
                                    <video id="video" controls class="img-fluid rounded-1 w-100  p-2">
                                        <source src="{{ asset('storage/evenement/videos/' . $evenement->video) }}"
                                            type="video/mp4">
                                    </video>
                                @else
                                    <p class="text-danger text-center text-bold">pas de video</p>
                                @endif

                            </div>
                        </div>
                        <div class=" form-group card">
                            <h3 class="card-header text-center">
                                info de l'organiasteur
                            </h3>
                            <div class="card-body">
                                <div class="row form-group">

                                    <div class="col-md-12 mt-4 form-field">
                                        <label for="nom_proprietaire" class="form-label text-bold">nom et prenom</label>
                                        <input type="text" name="nom_proprietaire" id="nom_proprietaire"
                                            class="input-text js-input text-black "
                                            value="{{ old('nom_proprietaire', $evenement->nom_proprietaire) }}">
                                        @error('nom_proprietaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 mt-4 form-field">
                                        <label for="telephone" class="form-label text-bold">Tel</label>
                                        <input type="telephone" name="telephone" id="telephone"
                                            class="input-text js-input text-black "
                                            value="{{ old('telephone', $evenement->telephone) }}">
                                        @error('telephone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-4 form-field">
                                        <label for="email" class="form-label text-bold">Email</label>
                                        <input type="email" name="email" id="telephone"
                                            class="input-text js-input text-black heure"
                                            value="{{ old('email', $evenement->email) }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">

                                    <div class="col-md-6 mt-4 form-field">
                                        <label for="facebook" class="form-label text-bold">lien facebook</label>
                                        <input type="url" name="facebook" id="facebook"
                                            class="input-text js-input text-black heure"
                                            value="{{ old('facebook', $evenement->facebook) }}">
                                        @error('facebook')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-4 form-field">
                                        <label for="whatsapp" class="form-label text-bold">lien Whatsapp</label>
                                        <input type="text" name="whatsapp" id="whatsapp"
                                            class="input-text js-input text-black "
                                            value="{{ old('whatsapp', $evenement->whatsapp) }}">
                                        @error('whatsapp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-4 form-field">
                                        <label for="twiter" class="form-label text-bold">lien twiter</label>
                                        <input type="text" name="twitter" id="twiter"
                                            class="input-text js-input text-black heure"
                                            value="{{ old('twiter', $evenement->twiter) }}">
                                        @error('twiter')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-md-12 mt-4 form-field">
                        <label for="description" class="form-label text-bold">Description de l'événement</label>
                        <textarea name="description" id="description" cols="30" rows="15"
                            placeholder="deescription de l'evenement" title="Description de l'evenement" class="form-control text-black"
                            style="resize: none">{{ old('description', $evenement->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="user_id" min="1" value="1">
                <input type="hidden" name="id" value="{{ $evenement->id }}">
                <div class="d-flex justify-content-end align-items-lg-end form-group row"
                    style="margin-bottom: 25vh; margin-right: 10px">
                    <div class="col-md-12 form-field">
                        <button type="submit"
                            class=" valid-button btn btn-success float-end w-50 d-flex justify-content-center align-items-center">
                            <h2>Suivant</h2> <i class="fa fa-arrow-right" style="width: 30px ; height: 20px;"></i>
                        </button>
                    </div>
                </div>
            </form>
        </section>

    </div>

    <style>
        input {
            color: black;
        }
    </style>
@endsection
