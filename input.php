<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="out_modal.php">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="price">Harga</label>
            <input type="text" class="form-control" id="price" name="price" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12">

          </div>
          <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
input[type="number"]::-webkit-inner-spin-button, 
input[type="number"]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>

<script>
document.getElementById("price").addEventListener("input", function(e) {
  this.value = formatCurrency(this.value);
});

document.getElementById("price").addEventListener("blur", function(e) {
  this.value = parseCurrency(this.value);
});

function formatCurrency(value) {
  value = value.replace(/\D/g, "");
  return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

function parseCurrency(value) {
  return parseFloat(value.replace(/,/g, ""));
}
</script>

