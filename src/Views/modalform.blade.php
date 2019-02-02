<form class="form-horizontal" id="modal-form" method="POST" action="{{ $actionUrl }}">
    <table id="form-main">
      <input type="hidden" id="modal-targets" name="target_id">
      <tbody>
        @section('modalForm')
          <button type="submit" style="display:none;"></button>
        @show
      </tbody>
    </table>
    <div class="modal-hidden">
      @yield('modalHidden')
    </div>
    {{ csrf_field() }}
  </form>
  @yield('additional')
