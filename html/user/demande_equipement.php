<div class="container-fluid">
        <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Demande</h4>
        <hr>
          <div class="card">
            <div class="card-body">
              
              <form>    
                  <div class="">
                  <label for="assistance" class="me-2 fw-semibold">
                    <input id="assistance" type="radio" name="type" value="assistance" checked>
                    Demande d'assistance
                  </label>

                  <label for="nouvelle_installation" class="ms-5 mb-3 fw-semibold">
                    <input id="nouvelle_installation" type="radio" name="type" value="nouvelle_installation">
                    Nouvelle installation
                  </label>
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
                    <div class="mb-3">
                      <label for="raison" class="form-label">Raison de la demande</label>
                      <textarea class="form-control" name="raison" id="raison" cols="30" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="code_secret" class="form-label">Code Secret</label>
                      <input type="password" class="form-control" id="code_secret">
                    </div>
                    <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn btn-primary w-25 mt-3">Envoyer demande</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>