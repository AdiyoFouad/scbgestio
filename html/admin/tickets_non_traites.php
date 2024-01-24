<div class="container-fluid">
  <div class="container-fluid">
    <h4 class="fw-semibold mb-4 justify-content-end">Tickets non traités</h4>
    <hr>
    <div class="card mb-3 p-0">
      <div class="card-body  pt-0 pb-0">
        <div id="filtres" class="row">
          
        
        <div class="mb-3 col-6 col-sm-3">
            <label for="type_equipement" class="form-label"></label>
            <select id="type_equipement" class="form-select" >
              <option disabled selected>Type de demande</option>
              <option>Nouvelle installation</option>
              <option>Demande d'assistance</option>
              <option value="">Problème technique</option>
            </select>
          </div>
          <div class="mb-3 col-6 col-sm-3">
            <label for="type_equipement" class="form-label"></label>
            <select id="type_equipement" class="form-select" >
              <option disabled selected>Type d'équipement</option>
              <option>Matériel</option>
              <option>Logiciel</option>
            </select>
          </div>
          <div class="mb-3 col-6 col-sm-3">
            <label for="staut_ticket" class="form-label"></label>
            <select id="statut_ticket" class="form-select" >
              <option disabled selected>Statut ticket</option>
              <option>En cours</option>
              <option>Traités</option>
              <option>Rejetés</option>
            </select>
          </div>
          
          
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-sm-7">
        <div class="card ">
          <div style="height:450px; overflow: auto" class="card-body p-0">
            <table class="table table-striped-custom table-bordered text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Ref. Ticket</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Date de création</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Type de demande</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Type d'équipement</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Statut du ticket</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr onclick="alert('dd');">
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">T-AEDR78HA</h6></td>
                        <td class="border-bottom-0">
                            <p class="fw-normal mb-0">22/11/2022</p>                         
                        </td>
                        <td class="border-bottom-0">
                            <p class="fw-normal mb-0">Nouvelle installation</p>                         
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-normal mb-0">Logiciel</h6>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success rounded-3 fw-semibold">Traité</span>
                          </div>
                        </td>
                      </tr> 
                      <tr onclick="alert('dd');">
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">T-AEDR78HA</h6></td>
                        <td class="border-bottom-0">
                            <p class="fw-normal mb-0">22/11/2022</p>                         
                        </td>
                        <td class="border-bottom-0">
                            <p class="fw-normal mb-0">Problème technique</p>                         
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-normal mb-0">Logiciel</h6>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success rounded-3 fw-semibold">Traité</span>
                          </div>
                        </td>
                      </tr> 
                      <tr onclick="alert('dd');">
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">T-AEDR78HA</h6></td>
                        <td class="border-bottom-0">
                            <p class="fw-normal mb-0">22/11/2022</p>                         
                        </td>
                        <td class="border-bottom-0">
                            <p class="fw-normal mb-0">Demande d'assistance</p>                         
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-normal mb-0">Logiciel</h6>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success rounded-3 fw-semibold">Traité</span>
                          </div>
                        </td>
                      </tr>                       
                    </tbody>
                  </table>
            
          </div>
        </div>  
      </div>
      <div class="col-sm-5">
        <div class="card p-0 bg-light">
          <div style="height:450px; overflow: auto" class="card-body pt-0 p-3"><hr>
          <div class="row">
          <h6 class=" col-7 fw-bolder mt-1">Détails du tickets</h6>
          <div class="col-5 d-flex justify-content-end">
            <span class=" badge bg-info rounded-3 fw-semibold">En cours</span>
          </div>
          </div>
          <hr>
          <span class="fw-semibold">Référence ticket : </span><span>T-AEDR78HA</span><br>
          <span class="fw-semibold">Utilisateur : </span><span>ODJOUOYE Fouad</span><br>
          <span class="fw-semibold">Date de création du ticket : </span><span>22/11/2023</span><br>
          <span class="fw-semibold">Type de demande : </span><span>Nouvelle installation</span><br><hr>
          <h6 class="text-center fw-bolder">Détails sur l'équipement</h6><hr>
          <span class="fw-semibold">Type de l'équipement : Logiciel</span><span></span><br>
          <span class="fw-semibold">Nom d'équipement : SYGEP</span><span></span><br>
          <hr>
          <h6 class="text-center fw-bolder">Description de la demande</h6><hr>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur maiores dolore earum quas aliquam cumque iure. Temporibus earum magnam vero quibusdam veritatis voluptatem eveniet unde?</p>
          </div>
        </div>  
      </div>
    </div>
    
  </div>
</div>


<style>
    thead, .table-striped-custom tbody tr:nth-child(even) {
      background-color: rgba(45,45,45,0.05); /* couleur du texte sur la ligne impaire */
    }
  </style>
      