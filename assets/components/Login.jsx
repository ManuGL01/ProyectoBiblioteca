import React, { useState } from 'react'
import Main from './Main';

const loginUrl = `http://localhost:8000/api/login`;

const Login = () => {
  const [inputUsername, setInputUsername] = useState("");
  const [inputPassword, setInputPassword] = useState("");

  const fetchPost = async (url, objectToUpload) => {
    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(objectToUpload)
      });
      const data = await response.json();
      console.log(data);
    } catch (error) {
      console.log(error);
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (inputUsername.length === 0 || inputPassword.length === 0) {
      alert("Rellene todos los campos");
      return;
    }
    const data = {
      username: inputUsername,
      password: inputPassword
    }
    console.log(data);
    fetchPost(loginUrl, data);
  }

  const handleChange = (e) => {
    if (e.target.name === "username") {
      setInputUsername(e.target.value);
    }
    if (e.target.name === "password") {
      setInputPassword(e.target.value);
    }
  }

  return (
    <section class="mainIndex">

      <section class="mainContent">
        <form method="post" onSubmit={handleSubmit}>

          <h1 class="h3 mb-3 font-weight-normal">Log In</h1>
          <div class="form-group">
            <label for="inputUsername">Nombre </label>
            <input type="text" value={inputUsername} onChange={handleChange} name="username" id="inputUsername" class="form-control" autocomplete="username" required autofocus />
          </div>
          <div class="form-group">
            <label for="inputPassword">Contraseña</label>
            <input type="password" value={inputPassword} onChange={handleChange} name="password" id="inputPassword" class="form-control" autocomplete="current-password" required />
          </div>

          <button class="btn btn-lg btn-primary" type="submit">
            Entrar
          </button>
        </form>
        <Main />
      </section>
    </section>
  )
}

export default Login