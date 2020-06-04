@if(!empty($food_groups))
<div class="content-food" data-id="{{ $food_time->id }}">
    <div class="form-row bg-light-blue ml-1">
            <div class="col-12">
                <label class="form-label mb-0 pt-1 white" for=""><b>{{ $food_time->name }}</b></label>
            </div>
    </div>
    <div class="border-light-blue ml-1 food-list" style="width:100%">
        @foreach($food_groups as $fg)
            <div class="form-row pl-1 mt-2">
                <div class="col-sm-4">
                    <input type="number" step="0.5" min="0" name="field[{{ $food_time->id }}][{{ $fg->id }}][quantity][]" value="0" class="form-control" required>
                </div>
                <label for="inputEmail3" class="col-sm-5 control-label pt-2">
                    {{ $fg->name }}
                </label>
            
                <div class="col-sm-3 pt-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs mr-1 plus-equivalent"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-default btn-xs minus-equivalent"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div><br>
@endif