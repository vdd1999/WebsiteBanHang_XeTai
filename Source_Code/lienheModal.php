<div class="modal" id="lienheModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Liên hệ</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="hoten">Họ tên:</label>
          <input type="text" class="form-control" placeholder="Nhập họ tên" id="hotenlienhe">
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" placeholder="Nhập email" id="emaillienhe">
        </div>

        <div class="form-group">
          <label for="email">Số điện thoại:</label>
          <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="sdtlienhe">          
        </div>

        <div class="form-group">
          <label for="xechon">Mẫu xe:</label>
          <input type="text" class="form-control" readonly id="xechon" value="">          
        </div>

        <p style="font-weight: 700;color: red;" hidden  id="lienhe-error"></p>
        <button id="btn-lienhe" type="button" class="btn btn-primary">Liên hệ</button>
      </div>

    </div>
  </div>
</div>