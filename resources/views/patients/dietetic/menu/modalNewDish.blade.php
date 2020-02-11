<div class="modal fade" id="newDishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Platillo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNewDish" action="">
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del platillo</label>
                        <div class="alert alert-danger mb-2" id="alert-name" role="alert" style="display:none;">
                            <strong>Error!</strong> <span></span>.
                        </div>
                        <input type="text" name="dish_name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Ingrese nombre">
                        <small id="nameHelp" class="form-text text-muted">Ingrese el nombre del platillo.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Busque ingredientes</label>
                        <input type="text" class="form-control" id="searchFood" aria-describedby="searchHelp">
                        <small id="searchHelp" class="form-text text-muted">Busque los ingredientes del platilo.</small>
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger mb-2" id="alert-foods" role="alert" style="display:none;">
                            <strong>Error!</strong> <span></span>.
                        </div>
                        <table class="table table-bordered" id="modalTableDish">
                            <thead>
                                <tr>
                                    <th class="text-center">Ingrediente</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Eq</th>
                                    <th class="text-center">Gr</th>
                                    <th class="text-center">Unidad</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Preparación o notas</label>
                        
                        <div class="alert alert-danger mb-2" id="alert-note" role="alert" style="display:none;">
                                <strong>Error!</strong> <span></span>.
                            </div>
                        <textarea class="form-control" name="note" id="" cols="30" rows="6"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
                    <button type="button" class="btn btn-info" id="btn-save-dish">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
  </div>