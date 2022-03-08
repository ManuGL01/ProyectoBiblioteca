import React, { useState } from 'react'
import Libros from './Libros';
import Login from './Login';

const UserMain = ({userGlobal,setUserGlobal}) => {
  
  return (
    <section className="mainIndex">
      {userGlobal ? null : <Login setUserGlobal={setUserGlobal}/>}
      <Libros/>
    </section>
  )
}

export default UserMain