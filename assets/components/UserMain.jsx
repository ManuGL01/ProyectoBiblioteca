import React from 'react'
import Libros from './Libros';
import Login from './Login';

const UserMain = () => {
  return (
    <section class="mainIndex">
        
        <section class="mainContent">
          <Login />
          <Libros/>
        </section>

    </section>
  )
}

export default UserMain