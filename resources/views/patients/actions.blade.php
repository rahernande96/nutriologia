<!-- Example single danger button -->
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Acciones
    </button>
    <div class="dropdown-menu">
        <a href="{{ route('patients.show', $patient->slug) }}" class="dropdown-item">
            Ver Paciente
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="dropdown-item">
            Historia Clínica
        </a>
        
        <a href="{{ route('anthropometry.index', $patient->slug) }}" class="dropdown-item">
            Antropometría
        </a>
        <a href="{{ route('dietetic.index', $patient->slug) }}" class="dropdown-item">
            Dietética
        </a>
        
        <div class="dropdown-divider"></div>
        <a href="{{ route('patients.edit', $patient->slug) }}" class="dropdown-item">Editar Información</a>
        <form action="{{ route('patients.destroy', $patient->slug) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="deletePatient(event)" type="submit" class="dropdown-item">Eliminar</button>
        </form>
    </div>
</div>