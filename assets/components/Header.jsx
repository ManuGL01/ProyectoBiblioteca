import React from 'react'

const Header = () => {
  return (
    <header>
        <nav class="navbar w-100">
            <a href=""><img id="logo" src="/img/logo.png" alt="logoHLANZ"/></a>
            <h1>BIBLIOTECA I.E.S. HLANZ</h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="">Ajustes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Cerrar sesión</a>
                </li>
            </ul>
            </div>
        </nav>
    </header>
  )
}

export default Header