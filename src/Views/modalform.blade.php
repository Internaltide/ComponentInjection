<form class="form-horizontal" id="modal-form" method="POST" action="{{ $actionUrl }}">
    <table id="form-main">
      <input type="hidden" id="modal-targets" name="target_id">
      <tbody>
        @section('modalForm')
          <tr>
              <td colspan="2">
                <label for="mailSubject"><span class="star">*</span>Subject</label>
                <input type="text" id="mailSubject" name="subject" required>
              </td>
          </tr>
          <tr>
              <td colspan="2">
                <label for="mailbody"><span class="star">*</span>Mail</label>
                <textarea id="mailbody" name="content" rows="10" required></textarea>
              </td>
          </tr>
          <button type="submit" class=""></button>
        @show
      </tbody>
    </table>
    <div class="modal-hidden">
      @yield('modalHidden')
    </div>
    {{ csrf_field() }}
  </form>
  @yield('additional')
