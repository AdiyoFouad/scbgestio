<div class="container-fluid">
        <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Demande</h4>
        <hr>
          <div class="card">
            <div class="card-body">
              
              <form action="controllers/ticket_controler.php" method="post">
                  <div class="">
                  <label for="assistance" class="me-2 fw-semibold">
                    <input id="assistance" type="radio" name="type" value="Demande d'assistance" checked>
                    Demande d'assistance
                  </label>

                  <label for="nouvelle_installation" class="ms-5 mb-3 fw-semibold">
                    <input id="nouvelle_installation" type="radio" name="type" value="Nouvelle installation">
                    Nouvelle installation
                  </label>
                    </div>   
                  <div class="mb-3">
                        <label for="type_equipement" class="form-label">Type d'équipement</label>
                        <select id="type_equipement" class="form-select" onchange="chargerEquipement()" required>
                          <option></option>
                          <option value="Matériel">Matériel</option>
                          <option value="Logiciel">Logiciel</option>
                        </select>
                    </div>
                        
                  <div class="mb-3">
                        <label for="equipements" class="form-label">Equipements</label>
                        <select id="equipements" name="equipement" class="form-select" required>
                          <option></option>
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Raison de la demande</label>
                      <textarea class="form-control" name="description" id="description" cols="30" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" name="creerTicket" class="btn btn-primary w-25 mt-3">Envoyer demande</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>

      <script>

function chargerEquipement() {

  document.getElementById('equipements').innerHTML = '<option></option>';
    
    fetch('controllers/equipement_controler.php?type=' + document.getElementById('type_equipement').value +'&user_id=' + <?php echo $_SESSION['id_user'];?>)
        .then(response => response.json())
        .then(equipements => {
            equipements.forEach(function (equipement) {
                var option = document.createElement('option');
                option.value = equipement.id_equipement;
                option.textContent = equipement.désignation + " - " + equipement.caractéristique;
                document.getElementById('equipements').appendChild(option);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des équipements:', error));
}

        
      </script>