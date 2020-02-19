<div class="row">
    
    <div class="col-4">
        
        <a href="{{ route('patients.show', $patient->slug) }}" class="btn btn-info">
           Ver <span class="fa fa-eye"></span>
        </a>  

    </div>

    <div class="col-4">
        
        <a href="{{ route('patients.edit', $patient->slug) }}" class="btn btn-primary">Editar <span class="fa fa-pencil-alt"></span></a>

    </div>

    <div class="col-4">
        
         <form action="{{ route('patients.destroy', $patient->slug) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="deletePatient(event)" type="submit" class="btn btn-danger">Eliminar <span class="fa fa-trash"></span></button>
        </form>
    </div>


</div>
              
        
        


       
  