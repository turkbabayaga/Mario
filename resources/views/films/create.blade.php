<form action="{{ route('films.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="release_year">Année de sortie</label>
        <input type="number" name="release_year" id="release_year" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="language_id">ID Langue</label>
        <input type="number" name="language_id" id="language_id" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="original_language_id">ID Langue d'origine</label>
        <input type="number" name="original_language_id" id="original_language_id" class="form-control">
    </div>
    <div class="form-group">
        <label for="rental_duration">Durée de location</label>
        <input type="number" name="rental_duration" id="rental_duration" class="form-control" value="3">
    </div>
    <div class="form-group">
        <label for="rental_rate">Taux de location</label>
        <input type="number" name="rental_rate" id="rental_rate" class="form-control" step="0.01">
    </div>
    <div class="form-group">
        <label for="length">Longueur (en minutes)</label>
        <input type="number" name="length" id="length" class="form-control">
    </div>
    <div class="form-group">
        <label for="replacement_cost">Coût de remplacement</label>
        <input type="number" name="replacement_cost" id="replacement_cost" class="form-control" step="0.01">
    </div>
    <div class="form-group">
        <label for="rating">Évaluation</label>
        <input type="text" name="rating" id="rating" class="form-control">
    </div>
    <div class="form-group">
        <label for="special_features">Caractéristiques spéciales</label>
        <input type="text" name="special_features" id="special_features" class="form-control">
    </div>
    <div class="form-group">
        <label for="id_director">ID du réalisateur</label>
        <input type="number" name="id_director" id="id_director" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Ajouter le film</button>
</form>
