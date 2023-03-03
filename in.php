<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pemasukan</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="in_modal.php">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="category">Kategori</label>
            <select class="form-select" name="category" aria-label="Default select example" required>
              <?php
              $query = mysqli_query($conn, "SHOW COLUMNS FROM income WHERE Field = 'category'");
              $data = mysqli_fetch_array($query);
              $enum_list = explode(",", str_replace("'", "", substr($data['Type'], 5, (strlen($data['Type']) - 6))));
              foreach ($enum_list as $enum_value) {
              ?>
                <option value="<?php echo $enum_value; ?>"><?php echo $enum_value; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="price">Harga</label>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">Rp.</span>
              <input type="text" class="form-control" id="price2" name="price" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12">
            </div>
          </div>
          <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <div class="form-group">
            <label for="comment">Keterangan</label>
            <input type="text" class="form-control" id="comment" name="comment">
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
  document.getElementById("price2").addEventListener("input", function(e) {
    this.value = formatCurrency(this.value);
  });

  document.getElementById("price2").addEventListener("blur", function(e) {
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