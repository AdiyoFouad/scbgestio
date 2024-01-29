<div class="container-fluid">
    <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Assigner ou retirer un équipement à un utilisateur</h4>
        <hr>
        <div class="card">
            <div class="card-body">
                <form action="controllers/equipement_controler.php" method="post">
                    <div class="">
                        <label for="assigner" class="me-2 fw-semibold">
                            <input id="assigner" type="radio" name="action" value="assigner" onchange="updatefieldr()" checked>
                            Assigner un équipement
                        </label>

                        <label for="retirer" class="ms-5 mb-3 fw-semibold">
                            <input id="retirer" type="radio" name="action" value="retirer" onchange="updatefieldr()">
                            Retirer un équipement
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <select id="departement" name="departement" class="form-select" onchange="updatefield()" required>
                            <option></option>
                            <option value="DE">DE</option>
                            <option value="HSE">HSE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">Utilisateur</label>
                        <select id="user" name="user" class="form-select" onchange="updatefieldr()" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type_equipement" class="form-label">Type d'équipement</label>
                        <select id="type_equipement" class="form-select" onchange="updatefieldr()" required>
                            <option></option>
                            <option value="Matériel">Matériel</option>
                            <option value="Logiciel">Logiciel</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="equipement" class="form-label">Equipement</label>
                        <select id="equipement" name="equipement" class="form-select" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button  type="submit" class="btn btn-primary mt-3" name="update_equipement_user" >Terminé</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Sélection des éléments du formulaire
var departementSelect = document.getElementById('departement');
var userSelect = document.getElementById('user');
var typeEquipementSelect = document.getElementById('type_equipement');
var equipementsSelect = document.getElementById('equipement');


function updatefield(){
    var selectedDepartement = departementSelect.value;
    userSelect.innerHTML = '<option></option>';
    fetchUtilisateurs(selectedDepartement);
}

function updatefieldr(){
    var selectedDepartement = departementSelect.value;
    var selectedType = typeEquipementSelect.value;
    var selectedUser = userSelect.value;
    var action = document.getElementById('assigner').checked ? 'assigner' : 'retirer';
    equipementsSelect.innerHTML = '<option></option>';
    fetchEquipements(selectedType, selectedUser, action);
}

function fetchUtilisateurs(selectedDepartement) {
    fetch('controllers/user_controler.php?departement=' + selectedDepartement)
        .then(response => response.json())
        .then(utilisateurs => {
            utilisateurs.forEach(function (utilisateur) {
                var option = document.createElement('option');
                option.value = utilisateur.id_user;
                option.textContent = utilisateur.nom + " " + utilisateur.prenom;
                userSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des utilisateurs:', error));
}


function fetchEquipements(selectedType, selectedUser, action) {
    
    var url = action == 'assigner' ? 'controllers/equipement_controler.php?type=' + selectedType + '&statut=Tout' : 'controllers/equipement_controler.php?type=' + selectedType +'&user_id=' + selectedUser;
    
    console.log("User: " + selectedUser + " action: " + action);
    fetch(url)
        .then(response => response.json())
        .then(equipements => {
            equipements.forEach(function (equipement) {
                var option = document.createElement('option');
                option.value = equipement.id_equipement;
                option.textContent = equipement.désignation +" "  +equipement.caractéristique;
                equipementsSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des équipements:', error));
}



</script>
