<div class="modal" id="lienhetuvanModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Liên hệ tư vấn</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="hoten">Họ tên:</label>
          <input type="text" class="form-control" placeholder="Nhập họ tên" id="hotentuvan">
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" placeholder="Nhập email" id="emailtuvan">
        </div>

        <div class="form-group">
          <label for="email">Số điện thoại:</label>
          <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="sdttuvan">          
        </div>
          <p style="font-weight: 700;color: red;" hidden id="tuvan-error"></p>
        <button id="btn-lienhetuvan" type="button" class="btn btn-primary">Liên hệ</button>
      </div>

    </div>
  </div>
</div>