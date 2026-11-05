<div class="mb-3">
    <label for="nom" class="form-label">Nom :</label>
    <input type="text"
           class="form-control @error('nom') is-invalid @enderror"
           id="nom"
           name="nom"
           value="{{ old('nom', $categorie->nom) }}"
           required>
    @error('nom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="couleur" class="form-label">Couleur :</label>
    <input type="text"
           class="form-control @error('couleur') is-invalid @enderror"
           id="couleur"
           name="couleur"
           value="{{ old('couleur', $categorie->couleur) }}"
           placeholder="#000000"
           required>
    @error('couleur')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">Format : #RRGGBB (ex: #FF8800)</small>
</div>
