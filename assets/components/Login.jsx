import React from 'react';

const Login = () => {
  return (
        <form method="post">
                
                <h1 class="h3 mb-3 font-weight-normal">Log In</h1>
                <div class="form-group">
                    <label for="inputUsername">Nombre </label>
                    <input type="text" value="" name="username" id="inputUsername" class="form-control" autocomplete="username" required autofocus/>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Contraseña</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" autocomplete="current-password" required/>
                </div>
                <input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}"/>
            
                <button class="btn btn-lg btn-primary" type="submit">
                    Entrar
                </button>
            </form>
  )
}

export default Login