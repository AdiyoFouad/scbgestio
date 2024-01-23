<div class="container-fluid">
        <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Demander un nouvel équipement</h4>
        <hr>
          <div class="card">
            <div class="card-body">
              
              <form>    
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
                    <div class="mb-3">
                      <label for="raison" class="form-label">Raison de la demande</label>
                      <input type="text" class="form-control" id="raison" required>
                    </div>
                    <div class="mb-3">
                      <label for="code_secret" class="form-label">Code Secret</label>
                      <input type="password" class="form-control" id="code_secret">
                    </div>
                    <button type="submit" class="btn btn-primary">Signaler</button>
                  </form>
            </div>
          </div>
        </div>
      </div>