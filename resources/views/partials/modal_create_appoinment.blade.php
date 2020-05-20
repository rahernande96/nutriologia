<div class="modal fade" id="create_appoinment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agendar Cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('event.store') }}" method="POST">
            @csrf
        <div class="row">
            <div class="form-group col-md-12">
              <label for="title">Titulo de la cita</label>
              <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Ejemplo: Cita con Jonas">
            </div>
            <div class="form-group col-md-12">
              <label for="patient">Seleccione un paciente</label>
              @if($patients->isNotEmpty())
              <select class="custom-select" id="patient" name="patient">
                <option selected>Seleccione un paciente de su lista de pacientes...</option>
                @foreach($patients as $patient)
                  <option value="{{ $patient->id }}">{{ $patient->id }} - {{ $patient->name }}</option>
                @endforeach
              </select>
              @else
              <p>No hay ningún paciente registrado</p>
              @endif
            </div>
            <div class="form-group col-md-12">
              <label>Ingrese la fecha de la cita:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="date" name="start_date" class="form-control">
              </div>
            </div>
            <div class="form-group col-md-12">
              <label for="description">Descripción de la cita (Opcional)</label>
              <textarea class="form-control" name="description" id="description" rows="3" placeholder="Ingrese las notas de la cita o una breve descripción."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Agendar Cita</button>
        </div>
        </form>
      </div>
    </div>
  </div>