<form method="post" action="{{ route('login') }}">
    @csrf
  <div class="form-group">
    <label>Login</label>
    <input type="text" name="login" class="form-control p_input">
  </div>
  <div class="form-group">
    <label>Password *</label>
    <input type="password" name="password" class="form-control p_input">
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
  </div>

  <p class="sign-up">Don't have an Account?<a href="{{ route('signup') }}"> Sign Up</a></p>
</form>
