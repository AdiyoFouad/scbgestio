<div class="container-fluid">

        <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Signaler un problème technique</h4>
        <hr>
          <div class="card">
            <div class="card-body">
              
              <form action="controllers/ticket_controler.php" method="post">
                   
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
                      <label for="raison" class="form-label">Description de la panne</label>
                      <textarea class="form-control" name="description" id="raison" cols="30" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" name="signaler" class="btn btn-primary w-25 mt-3">Signaler problème</button>
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