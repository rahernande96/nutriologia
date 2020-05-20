
<div class="btn-group btn-group-sm" role="group" aria-label="First group">
   
    <a href="{{ route('patients.show', $patient->slug) }}" class="btn btn-info">
       
        Ver <span class="fa fa-eye"></span>
    
    </a>

    <a href="{{ route('patients.edit', $patient->slug) }}" class="btn btn-primary">
    
        Editar <span class="fa fa-pencil-alt"></span>
    
    </a>

    <form action="{{ route('patients.destroy', $patient->slug) }}" method="POST">
        
        @method('DELETE')

        @csrf
        
        <button onclick="deletePatient(event)" type="submit" class="btn btn-danger btn-sm">Eliminar <span class="fa fa-trash"></span></button>
    
    </form>

</div>
              
        
        


       
  