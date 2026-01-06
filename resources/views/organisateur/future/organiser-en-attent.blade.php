@extends('layouts.Obase')
@section('title', 'organiser un évènement pour le future')
@section('content')
    <div class="container">

        <div class=" mt-5 cadre">
            <h4 class="texth3">Organiser</h4>
        </div>

        <div class="container mt-4">
            <form action="" method="POST" enctype="multipart/form-data" class=" mb-5">
                @csrf
                <div class="mb-5">

                    <div class="row form-group">
                        <div class="col-md-4 mt-4">
                            <label for="categorie" class="form-label text-bold">Categorie d'evenemnt</label>
                            <select class="form-control " id="categorie" style="border: 1px solid black">
                                <option disabled selected>Categorie d'evenemnt</option>
                                <option value="conference et congRès">Conference et congrès</option>
                                <option value="vie nocturne">Vie nocturne</option>
                                <option value="évènement sportive">Evenement sportive</option>
                                <option value="fête">Fête</option>
                                <option value="concert et festivals de musique">Concerts et festivals de musique </option>
                                <option value="santé">Santé</option>
                                <option value="voyage et tourisme">Voyages et tourisme</option>
                            </select>
                        </div>

                        <div class="col-md-4 mt-4">
                            <label for="nom" class="form-label text-bold">Nom de l'évènement</label>
                            <input type="text" name="nom" id="nom" class="form-control"
                                placeholder="le nom de l'évènement">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="date" class="form-label text-bold"> Date de déroulement</label>
                            <input type="date" name="date" id="date" class="form-control date"
                                placeholder="Date de déroulement">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 mt-4">
                            <label for="heur" class="form-label text-bold">L'heur de déroulement</label>
                            <input type="time" name="heur" id="heur" class="form-control heur"
                                placeholder="l'heur de déroulement">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="lieu" class="form-label text-bold">Lieu de déroulement</label>
                            <input type="text" id="lieu" name="lieu" class="form-control"
                                placeholder="lieu de l'évènement">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="place" class="form-label text-bold">Nombre de place disponible </label>
                            <input type="number" id="place" name="nombre_de_place" class="form-control"
                                placeholder="nombre de place disponible" min="0">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mt-4">
                            <label for="description" class="form-label text-bold">Une description de l'evenement</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="resize: none"
                                placeholder="une description de votre évènement"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 mt-4">
                            <label for="image" class="form-label text-bold p-0">Image pour illustré l'evenement</label>
                            <input type="file" id="image" name="image" class="file"
                                placeholder="nombre de place disponible" min="0">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="video" class="form-label text-bold">Vidéo pour illustré l'evenement</label>
                            <input type="file" id="video" name="video" class="file"
                                placeholder="nombre de place disponible" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mt-4">
                            <h3 class="card-title text-center text-bold bg-dark-subtle">Les sponsort de l'evenemnt </h3>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">Nom du sponsor</label>
                                <input type="text" name="nom-sponsor1" class="form-control" id="nomsponsor">
                            </div>
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">photo ou logo du sponsor</label>
                                <input type="file" name="photo-sponsor1"
                                    class="file file-upload-info bg-body-secondary" id="nomsponsor">
                            </div>
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">Un lien du sponsor</label>
                                <input type="text" name="lien-sponsor1" class="form-control" id="nomsponsor">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">Nom du sponsor</label>
                                <input type="text" name="nom-sponsor2" class="form-control" id="nomsponsor">
                            </div>
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">photo ou logo du sponsor</label>
                                <input type="file" name="photo-sponsor2"
                                    class="file file-upload-info bg-body-secondary" id="nomsponsor">
                            </div>
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">Un lien du sponsor</label>
                                <input type="text" name="lien-sponsoré" class="form-control " id="nomsponsor">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">Nom du sponsor</label>
                                <input type="text" name="nom-sponsor3" class="form-control" id="nomsponsor">
                            </div>
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">photo ou logo du sponsor</label>
                                <input type="file" name="photo-sponsor3"
                                    class="file file-upload-info bg-body-secondary" id="nomsponsor">
                            </div>
                            <div class="col-md-4">
                                <label for="nomspnsor" class="text-bold">Un lien du sponsor</label>
                                <input type="text" name="lien-sponsor3" class="form-control" id="nomsponsor">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="mt-4">
                            <h3 class="card-title text-center text-bold bg-dark-subtle">Gestion des billet de l'évènement
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 25vh">
                        <button type="submit" class="btn btn-success float-end w-50 p-3 ">
                            <h2>Sauvegarder</h2>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
