@extends('layouts.default')

@section('content')
<form action="/calorific-values/{{ $calorificValue->id }}" method="POST">
    @csrf
    @method('PUT')
    <label for=""> Applicable For</label>
    <input type="date" id="" name="applicable_for" value={{ $calorificValue->applicable_for->format('Y-m-d')}}><br><br>
    <label for="">Value:</label>
    <input type="text" id="" name="value" value={{ $calorificValue->value}}><br><br>
    <div class="custom-select" style="width:200px;">
        <label for="areaId">Area:</label>
        <select name="areaId">
          <option>Select Area:</option>
          @foreach ($areas as $area)
        <option
            @if ($area->id == $calorificValue->area->id)
            selected
        @endif
        value="{{ $area->id }}">{{ $area->name }}</option>
          @endforeach
    </div><br><br>
    <input type="submit" value="Submit">

  </form>

@endsection
