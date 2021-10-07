@extends('layouts.default')

@section('content')
<form action="/search" method="POST">
    @csrf
    <div class="mb-6">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" value="{{ $fromDate }}"><br><br>
    </div>
    <div class="mb-6">
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" value="{{ $toDate }}"><br><br>
    </div>


    <div class="custom-select" style="width:200px;">
    <label for="areaId">Area:</label>
    <select name="areaId">
      <option>Select Area:</option>
      @foreach ($areas as $area)
    <option
    @if ($area->id == $areaId)
        selected
    @endif
    value="{{ $area->id }}">{{ $area->name }}</option>
      @endforeach

    </select>
  </div><br><br>
  <input type="submit">
  </form>

  @if(isset($calorificValues))
  <table>
      <thead>
        <tr>
            <th>Applicable for </th>
            <th>Value </th>
            <th>Area</th>
            <th></th>
        </tr>
      </thead>

      @foreach ($calorificValues as $value)
          <tr>
              <td>{{ $value->applicable_for }}</td>
              <td>{{ $value->value }}</td>
              <td>{{ $value->area->name }}</td>
              <td>
              <a href="/calorific-values/{{$value->id}}/edit">Edit</a>
              </td>
          </tr>
      @endforeach


  </table>
  @endif



 @endsection
