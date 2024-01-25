<div class="container-fluid">
        <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Assigner ou retirer un équipement à un utilisateur</h4>
        <hr>
          <div class="card">
            <div class="card-body">
              
              <form>    
                  <div class="">
                  <label for="assistance" class="me-2 fw-semibold">
                    <input id="assistance" type="radio" name="type" value="assistance" checked>
                    Assigner un équipement
                  </label>

                  <label for="nouvelle_installation" class="ms-5 mb-3 fw-semibold">
                    <input id="nouvelle_installation" type="radio" name="type" value="nouvelle_installation">
                    Retirer un équipement
                  </label>
                    </div>   
                  <div class="mb-3">
                        <label for="type_equipement" class="form-label">Département</label>
                        <select id="type_equipement" class="form-select" required>
                          <option></option>
                          <option>Matériel</option>
                          <option>Logiciel</option>
                        </select>
                    </div>   
                  <div class="mb-3">
                        <label for="type_equipement" class="form-label">Utilisateur</label>
                        <select id="type_equipement" class="form-select" required>
                          <option></option>
                          <option>Matériel</option>
                          <option>Logiciel</option>
                        </select>
                    </div>
                  <div class="mb-3">
                        <label for="type_equipement" class="form-label">Type d'équipement</label>
                        <select id="type_equipement" class="form-select" required>
                          <option></option>
                          <option>Matériel</option>
                          <option>Logiciel</option>
                        </select>
                    </div>
                        
                  <div class="mb-3">
                        <label for="equipements" class="form-label">Equipements</label>
                        <select id="equipements" class="form-select" required>
                          <option></option>
                          <option>Ordinateur</option>
                          <option>Imprimante</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary w-25 mt-3">Terminé</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>