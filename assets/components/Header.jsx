import React from 'react'

const Header = () => {
  return (
    <header>
        <nav className="navbar w-100">
            <a href=""><img id="logo" src="/img/logo.png" alt="logoHLANZ"/></a>
            <h1>BIBLIOTECA I.E.S. HLANZ</h1>
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
            </button>

            <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav">
                <li className="nav-item">
                <a className="nav-link" href="">Ajustes</a>
                </li>
                <li className="nav-item">
                <a className="nav-link" href="#">Cerrar sesión</a>
                </li>
            </ul>
            </div>
        </nav>
    </header>
  )
}

export default Header