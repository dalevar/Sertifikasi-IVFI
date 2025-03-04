@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.certifications.store-units', $id) }}" method="POST">
      @csrf
      <div id="competency-units-container" class="mb-2">
        <div class="competency-unit">
          <div class="row g-3 align-items-center mb-2">
            <div class="col-5">
              <input type="text" name="competency_units[0][unit_name]" placeholder="Nama Unit Kompetensi" class="form-control" required>
            </div>
            <div class="col-5">
              <input type="text" name="competency_units[0][unit_code]" placeholder="Kode Unit Kompetensi" class="form-control" required>
            </div>
          </div>
          <button type="button" class="remove-unit btn btn-danger mb-2">Hapus</button>
        </div>
      </div>
      <button type="button" id="add-unit" class="btn btn-success">Tambah Unit</button>
      <br><br>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  let index = 1;

  document.getElementById("add-unit").addEventListener("click", function () {
    console.log(index);
    let container = document.getElementById("competency-units-container");

    let newUnit = document.createElement("div");
    newUnit.classList.add("competency-unit");
    newUnit.innerHTML = `
      <div class="row g-3 align-items-center mb-2">
        <div class="col-5">
          <input type="text" name="competency_units[${index}][unit_name]" placeholder="Nama Unit Kompetensi" class="form-control" required>
        </div>
        <div class="col-5">
          <input type="text" name="competency_units[${index}][unit_code]" placeholder="Kode Unit Kompetensi" class="form-control" required>
        </div>
      </div>
      <button type="button" class="remove-unit btn btn-danger mb-2">Hapus</button>
    `;

    container.appendChild(newUnit);
    index++;
  });

  document.addEventListener('click', function (event) {
    if (event.target.classList.contains("remove-unit")) {
      console.log(event.target.parentElement)
      event.target.parentElement.remove();
    }
  });
});
</script>
@endsection