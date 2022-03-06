import React from 'react'
import Libros from './Libros';
import Login from './Login';

const UserMain = () => {
  return (
    <section className="mainIndex">
      <Login />
      <Libros/>
    </section>
  )
}

export default UserMain